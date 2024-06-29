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
    return fetch(`HomPro/static/html${page}.html`)  // Promise를 반환하도록 return 추가
        .then(response => {
            if (!response.ok) {
                throw new Error('Page not found');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("app").innerHTML = data;
        })
        .catch(error => {
            console.error('Error loading page:', error);
            document.getElementById("app").innerHTML = `<div>Page not found.</div>`;
        });
}

function loadContent(page) {
    console.log(page);
    if (window.location.pathname === '/' || window.location.pathname === '/HomePro/') {
        page = '/home';
    }
    fetchContent(page);
}

function navigate(path, formId, title, subtitle) {
    window.history.pushState({}, path, path);
    document.getElementById("app").innerHTML = `<div>Loading...</div>`;
    fetchContent(path).then(() => {
        if (formId) {
            showForm(formId, title, subtitle);
        }
    });
}

