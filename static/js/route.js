document.addEventListener("DOMContentLoaded", () => {
    window.onpopstate = () => {
        const path = window.location.pathname;
        loadContent(path);
    };

    // 페이지 로드 시에도 초기 콘텐츠 로드
    window.addEventListener('load', () => {
        const initialPath = window.location.pathname === '/' ? '/home' : window.location.pathname;
        loadContent(initialPath);
    });
});

function fetchContent(page) {
    console.log(`Fetching content from: static/pages${page}.php`);  // 디버깅 로그 추가
    return fetch(`static/pages${page}.php`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Page not found');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("app").innerHTML = data;
            pageInit(page);
            // 페이지 로드 후 해당 페이지에 대한 JS 파일 로드
            return loadPageScript(page);
        })
        .catch(error => {
            console.error('Error loading page:', error);
            document.getElementById("app").innerHTML = `<div>Page not found.</div>`;
        });
}

function loadPageScript(page) {
    // JS 파일 경로 설정 (페이지 이름에 해당하는 JS 파일을 동적으로 로드)
    const scriptPath = `static/js${page}.js`;

    // JS 파일이 있는지 확인하기 위해 fetch 사용
    return fetch(scriptPath, { method: 'HEAD' })
        .then(response => {
            if (response.ok && response.headers.get('content-type').includes('javascript')) {
                // 스크립트 태그를 동적으로 생성하여 JS 파일을 로드
                const script = document.createElement('script');
                script.src = scriptPath;
                document.body.appendChild(script);
                console.log(`Loaded script: ${scriptPath}`);
            } else {
                console.log(`Script not found or incorrect type: ${scriptPath}`);
            }
        })
        .catch(error => {
            console.error('Error loading script:', error);
        });
}

function loadContent(page) {
    if (window.location.pathname === '/' || window.location.pathname === '') {
        page = '/home';
    }
    if (window.location.pathname === '/edit_question') {
        page = '/edit_question';
    }
    fetchContent(page);
}

function pageInit(page) {
    switch(page) {
        case "/sales_list":
        case "/order_list":
            var _table_id = page.replace(/^\//, '');
            createDataTable(_table_id);
        break;

        case "/qa":
            $(".question-row").click(function() {
                $(this).next(".answer-row").find(".answer").slideToggle(150);
            });
            // '비밀번호 입력' 버튼 클릭 시, 비밀번호 입력창 표시
            document.querySelectorAll('.show-password').forEach(function(button) {
                button.addEventListener('click', function() {
                    var index = this.getAttribute('data-id');
                    document.getElementById('password-row-' + index).style.display = 'table-row';
                });
            });
        
            // 비밀번호 확인 버튼에 이벤트 리스너 추가
            document.querySelectorAll('.password-row button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var index = this.closest('.password-row').getAttribute('id').replace('password-row-', '');
                    var correctPassword = this.getAttribute('data-password');
                    checkPassword(index, correctPassword);
                });
            });
            
            // 비밀번호 확인 함수
            function checkPassword(index, correctPassword) {
                var inputPassword = document.getElementById('password-' + index).value;
                if (inputPassword === correctPassword) {
                    alert('비밀번호가 맞습니다. 내용을 확인합니다.');
                    // 비밀글 내용을 표시
                    var questionRow = document.querySelector(`.question-hidden-row-${index}`); // 질문 행
                    var answerRow = document.querySelector(`.answer-hidden-row-${index}`); // 답변 행
                    var secrete_q = document.querySelector(`.secrete-q-${index}`); // 비밀행 
                    if (questionRow && questionRow.classList.contains(`question-hidden-row-${index}`)) {
                        questionRow.style.display = 'table-row'; // 질문 행 표시
                        secrete_q.style.display='none';
                    }
                    
                    if (answerRow && answerRow.classList.contains('answer-row')) {
                        answerRow.style.display = 'table-row'; // 답변 행 표시
                    }
            
                    // 비밀번호 입력창 숨기기
                    document.getElementById('password-row-' + index).style.display = 'none';
                } else {
                    alert('비밀번호가 틀렸습니다.');
                }
            }
            
    }
}

function navigate(path, formId, title, subtitle) {
    window.history.pushState({}, '/'+path, path);
    document.getElementById("app").innerHTML = `<div>Loading...</div>`;
    fetchContent(path).then(() => {
        if (formId) {
            showForm(formId, title, subtitle);
        }
    });
}
