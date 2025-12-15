// Toggle de submenús
function toggleSubmenu(element) {
    element.classList.toggle('expanded');
    const submenu = element.nextElementSibling;
    if (submenu && submenu.classList.contains('submenu')) {
        submenu.classList.toggle('active');
    }
}


