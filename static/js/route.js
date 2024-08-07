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
        })
        .catch(error => {
            console.error('Error loading page:', error);
            document.getElementById("app").innerHTML = `<div>Page not found.</div>`;
        });
}


function loadContent(page) {
    if (window.location.pathname === '/' || window.location.pathname === '') {
        page = '/home';
    }
    fetchContent(page);
}

function pageInit(page){
    switch(page){
        case"/sales_list":
        case"/order_list":
            var _table_id = page.replace(/^\//,'');
            createDataTable(_table_id);
        break
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

