document.addEventListener('DOMContentLoaded', function () {
    var carousel = new bootstrap.Carousel(document.getElementById('notiCarousel'), {
      interval: 3000, // Set the desired interval (in milliseconds)
      wrap: true // Set to true if you want the carousel to wrap around when reaching the last slide
    });
  });
  