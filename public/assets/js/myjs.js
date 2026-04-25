var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  // loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  slidesOffsetBefore: 40,
  slidesOffsetAfter: 40,

  // 👉 penting untuk bisa drag / scroll
  allowTouchMove: true,
  simulateTouch: true,
  grabCursor: true,

  // 👉 biar klik tombol tetap jalan
  preventClicks: false,
  preventClicksPropagation: false,

  // 👉 kadang bikin lebih smooth di desktop
  touchStartPreventDefault: false,

  breakpoints: {
    // Ketika lebar layar >= 768px (Tablet)
    768: {
      slidesPerView: 2,
      // spaceBetween: 20,
    },
    // Ketika lebar layar >= 1024px (Desktop)
    1024: {
      slidesPerView: 4,
      // spaceBetween: 30,
    },
  },
});

function border() {
  const selectElement = document.querySelector(".form-select");
  selectElement.classList.add("filter-border");
}

function byTahun() {
  document.getElementById("formPortofolio").submit();
}

document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(
    '.navbar-nav .nav-link[href^="#"]',
  );
  const sections = document.querySelectorAll(".scroll-section");

  function removeActive() {
    navLinks.forEach((link) => link.classList.remove("active"));
  }

  function setActiveById(id) {
    removeActive();

    const activeLink = document.querySelector(
      `.navbar-nav .nav-link[href="#${id}"]`,
    );

    if (activeLink) {
      activeLink.classList.add("active");
    }
  }

  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      const targetId = this.getAttribute("href").replace("#", "");
      setActiveById(targetId);
    });
  });

  function activeOnScroll() {
    let currentSection = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 120;
      const sectionHeight = section.offsetHeight;

      if (
        window.scrollY >= sectionTop &&
        window.scrollY < sectionTop + sectionHeight
      ) {
        currentSection = section.getAttribute("id");
      }
    });

    if (currentSection) {
      setActiveById(currentSection);
    }
  }

  window.addEventListener("scroll", activeOnScroll);
  activeOnScroll();

  /* ================= FADE IN ANIMATION ================= */

  const animatedElements = document.querySelectorAll(
    ".fade-init, .fade-left, .fade-right",
  );

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-show");
          observer.unobserve(entry.target); // animasi hanya sekali
        }
      });
    },
    {
      threshold: 0.15,
      rootMargin: "0px 0px -50px 0px",
    },
  );

  animatedElements.forEach((el) => {
    observer.observe(el);
  });

  /* Fade in langsung saat pertama load untuk elemen hero */
  const firstLoadElements = document.querySelectorAll(
    "#beranda .fade-init, #beranda .fade-left, #beranda .fade-right",
  );

  firstLoadElements.forEach((el, index) => {
    setTimeout(() => {
      el.classList.add("fade-show");
    }, 150 * index);
  });
});
