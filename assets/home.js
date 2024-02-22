import './styles/scss/home.scss';

document.addEventListener('DOMContentLoaded', function () {
    let heroImage = document.querySelector('.hero-image');
    let a = document.querySelector('.contact-hero-btn');

    window.addEventListener('load', function () {
        heroImage.classList.add('show');
        a.classList.add('show');
    });
});