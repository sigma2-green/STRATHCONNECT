

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



document.addEventListener('DOMContentLoaded', () => {

    const toggle = document.getElementById('themeToggle');

    const icon = document.getElementById('themeIcon');

    function updateIcon() {

        if (document.documentElement.classList.contains('dark')) {
            icon.textContent = '☀️';
        } else {
            icon.textContent = '🌙';
        }

    }

    updateIcon();

    if (toggle) {

        toggle.addEventListener('click', () => {

            document.documentElement.classList.toggle('dark');

            if (document.documentElement.classList.contains('dark')) {
                localStorage.theme = 'dark';
            } else {
                localStorage.theme = 'light';
            }

            updateIcon();

        });

    }

});
