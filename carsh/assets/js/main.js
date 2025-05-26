document.addEventListener('DOMContentLoaded', function() {
  // Анимация загрузки
  gsap.from(".car-card", {
    duration: 0.8,
    opacity: 0,
    y: 50,
    stagger: 0.1
  });

  // Фильтрация автомобилей
  document.getElementById('filter-price').addEventListener('change', function() {
    const price = this.value;
    document.querySelectorAll('.car-card').forEach(car => {
      car.style.display = car.dataset.price <= price ? 'block' : 'none';
    });
  });
});