document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll(".animate-on-scroll");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
        }
      });
    },
    { threshold: 0.2 }
  );

  elements.forEach((el) => observer.observe(el));
});

window.addEventListener("load", function () {
  document.body.classList.add("fade-in");
});
AOS.init({
  duration: 1000,
  once: false, // replay on scroll up & down
  offset: 100,
});
