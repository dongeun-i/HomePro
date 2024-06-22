document.addEventListener("DOMContentLoaded", () => {
    function loadContent(page) {
        fetch(`/static/html${page}.html`)
            .then(response => response.text())
            .then(data => {
                document.getElementById("app").innerHTML = data;
            });
    }

    function navigate(path) {
        window.history.pushState({}, path, path);
        loadContent(path);
    }

    window.onpopstate = () => {
        const path = window.location.pathname;
        loadContent(path);
    };

    const initialPath = window.location.pathname === '/' ? '/home' : window.location.pathname;
    loadContent(initialPath);
});

function navigate(path) {
    window.history.pushState({}, path, path);
    document.getElementById("app").innerHTML = `<div>Loading...</div>`;
    fetch(`/static/html${path}.html`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("app").innerHTML = data;
        });
}
