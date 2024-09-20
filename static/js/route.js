document.addEventListener("DOMContentLoaded", () => {
    window.onpopstate = () => {
        const path = window.location.pathname;
        const queryParams = window.location.search;  // 쿼리스트링 처리 추가
        loadContent(path, queryParams);
    };

    // 페이지 로드 시에도 초기 콘텐츠 로드
    window.addEventListener('load', () => {
        const initialPath = window.location.pathname === '/' ? '/home' : window.location.pathname;
        const queryParams = window.location.search;  // 쿼리스트링 포함
        loadContent(initialPath, queryParams);
    });
});

function fetchContent(page, queryParams = '') {
    // 페이지에 쿼리스트링이 있으면 포함하여 요청
    const fetchUrl = `static/pages${page}.php${queryParams}`;
    console.log(`Fetching content from: ${fetchUrl}`);  // 디버깅 로그 추가
    console.log(`queryParams = ${queryParams}`);
    return fetch(fetchUrl)
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
function loadContent(page, queryParams = '') {
    // 기본 경로 설정
    if (page === '/' || page === '') {
        page = '/home';
    }
    // if (window.location.pathname === '/edit_question') {
    //     page = '/edit_question';
    // }
    fetchContent(page, queryParams);
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
                $(this).next(".answer-row").find(".answer").slideToggle(100);
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
                    // alert('비밀번호가 맞습니다. 내용을 확인합니다.');
                    // 비밀글 내용을 표시
                    var questionRow = document.querySelector(`.question-hidden-row-${index}`); // 질문 행
                    var answerRow = document.querySelector(`.answer-hidden-row-${index}`); // 답변 행
                    var secrete_q = document.querySelector(`.secrete-q-${index}`); // 비밀행 
                    if (questionRow && questionRow.classList.contains(`question-hidden-row-${index}`)) {
                        questionRow.style.display = 'table-row'; // 질문 행 표시
                        secrete_q.style.display='none';
                    }
                    
                    if (answerRow) {
                        answerRow.style.display = 'table-row'; // 답변 행 표시
                        $(answerRow).find(".answer").slideToggle(100);
                    }
            
                    // 비밀번호 입력창 숨기기
                    document.getElementById('password-row-' + index).style.display = 'none';
                } else {
                    alert('비밀번호가 틀렸습니다.');
                }
            }
            
    }
}

function navigate(path, formId, title, subtitle, queryParams = '') {
    // URL에 쿼리스트링 포함
    const fullPath = path + queryParams;
    window.history.pushState({}, '', fullPath);  // 경로에 쿼리스트링 추가
    document.getElementById("app").innerHTML = `<div>Loading...</div>`;

    // 쿼리스트링 포함한 콘텐츠 로드
    fetchContent(path, queryParams).then(() => {
        if (formId) {
            showForm(formId, title, subtitle);
        }
    });
}