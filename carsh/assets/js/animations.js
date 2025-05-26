// Анимация карточек
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.car-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
        }, 100 * index);
    });
});