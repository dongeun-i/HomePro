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
    fetch(`/static/html${page}.html`)
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
    if (window.location.pathname === '/') {
        page = '/home';
    }
    fetchContent(page);
}

function fetchContent(page) {
    fetch(`/static/html${page}.html`)
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

function navigate(path) {
    window.history.pushState({}, path, path);
    document.getElementById("app").innerHTML = `<div>Loading...</div>`;
    fetchContent(path);
}