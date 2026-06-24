import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".card-shadow");

    cards.forEach(card => {

        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-4px)";
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
        });

    });

    const nav = document.querySelector(".navbar");

    window.addEventListener("scroll", () => {

        if (!nav) return;

        if (window.scrollY > 20) {
            nav.classList.add("shadow-md");
            nav.classList.remove("shadow-sm");
        } else {
            nav.classList.add("shadow-sm");
            nav.classList.remove("shadow-md");
        }

    });

});