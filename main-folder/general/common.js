document.addEventListener("DOMContentLoaded", () => {
    let arrows = document.querySelectorAll(".arrow");
    arrows.forEach(arrow => {
        arrow.addEventListener("click", (e) => {
            let arrowParent = e.target.closest('.arrow').parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    });

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
});
