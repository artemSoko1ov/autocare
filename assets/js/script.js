document.addEventListener("DOMContentLoaded", () => {
  const smoothTransition = (element, transformValue, duration = "1s") => {
    element.style.transition = `transform ${duration} ease-in-out`;
    element.style.transform = transformValue;
  };

  const reviewContainer = document.getElementById("sliderContainer");
  const reviews = document.querySelectorAll(".review");
  if (reviews.length) {
    let currentIndex = 0;
    const reviewHeight = reviews[0].offsetHeight;

    setInterval(() => {
      currentIndex = (currentIndex + 1) % reviews.length;
      smoothTransition(
        reviewContainer,
        `translateY(-${currentIndex * reviewHeight}px)`
      );
    }, 10000);
  }

  const slider = document.getElementById("slider");
  const images = document.querySelectorAll(".imgWorks");
  if (images.length) {
    let index = 0;
    const imgWidth = 340;

    setInterval(() => {
      index = (index + 1) % (images.length - 1);
      smoothTransition(slider, `translateX(-${index * imgWidth}px)`);
    }, 3000);
  }

  const slides = document.querySelectorAll(".slide");
  const sliderWrapper = document.querySelector(".slider-wrapper");
  const indicators = document.querySelectorAll(".progress-indicators hr");
  let currentSlide = 0;

  const moveSlide = (n) => {
    currentSlide = (currentSlide + n + slides.length) % slides.length;
    smoothTransition(sliderWrapper, `translateX(-${currentSlide * 100}%)`);
    indicators.forEach((ind) => ind.classList.remove("active"));
    indicators[currentSlide].classList.add("active");
  };
  setInterval(() => moveSlide(1), 5000);

  document.querySelectorAll(".btnA").forEach((btn) => {
    btn.addEventListener("click", (event) => {
      const currentPage = window.location.pathname.split("/").pop();
      const noRedirectPages = ["indexWEB.php", "contacts.php", "price-list.php"];

      if (!noRedirectPages.includes(currentPage)) {
        event.preventDefault();
        window.location.href = "indexWEB.php#secForm";
      }
    });
  });
  const contactForm = document.getElementById("contactForm");
  const reviewModal = document.getElementById("reviewModal");
  const bgModal = document.querySelector(".bg-modal");
  const modalContent = document.querySelector(".modal-content");
  const butDiagnost = document.getElementById("butDiagnost");
  const formSelect = document.getElementById("formSelect");
  if (contactForm) {
    contactForm.addEventListener("submit", async (event) => {
      event.preventDefault();
      const formData = new FormData(contactForm);
      console.log("Форма отправляется..."); // Проверка
      const response = await fetch("send.php", {
        method: "POST",
        body: formData,
      });
      const data = await response.json();
      if (data.success) {
        document.getElementById("reviewName").value = data.name;
        reviewModal.style.display = "flex";
        bgModal.style.display = "flex";
        if (formSelect.value === "Диагностика") {
          butDiagnost.style.display = "flex";
          bgModal.style.display = "flex";
          bgModal.style.flexDirection = "column";
          bgModal.style.justifyContent = "center";
          bgModal.style.alignItems = "center";
        } else {
          butDiagnost.style.display = "none";
        }
      }
    });
  }

  const submitReviewBtn = document.getElementById("submitReview");
  if (submitReviewBtn) {
    submitReviewBtn.addEventListener("click", async () => {
      const reviewData = new FormData();
      reviewData.append("name", document.getElementById("reviewName").value);
      reviewData.append("review", document.getElementById("reviewText").value);
      reviewData.append(
        "rating",
        document.getElementById("reviewRating").value
      );

      const response = await fetch("save_review.php", {
        method: "POST",
        body: reviewData,
      });
      const data = await response.json();
      if (data.success) {
        modalContent.innerHTML =
          '<img src="./assets/img/galkaModal.png" alt="" style="width: 150px; height: 150px;" /><br><p style="font-size: 26px;" class="pModal">Спасибо за ваш отзыв!</p>';
        bgModal.style.display = "flex";
        bgModal.style.flexDirection = "column";
        bgModal.style.justifyContent = "center";
        bgModal.style.alignItems = "center";

        reviewModal.style.display = "flex";
        reviewModal.style.flexDirection = "column";
        reviewModal.style.alignItems = "center";
        reviewModal.style.justifyContent = "center";

        modalContent.style.display = "flex";
        modalContent.style.flexDirection = "column";
        modalContent.style.alignItems = "center";
        modalContent.style.justifyContent = "center";
        setTimeout(() => {
          bgModal.style.transition = "opacity 1s ease";
          bgModal.style.opacity = 0;

          setTimeout(() => {
            bgModal.style.display = "none";
            bgModal.style.opacity = 1;
            if (formSelect.value === "Диагностика") {
              window.location.href = "diagnostic_cards.php";
            }
          }, 1000);
        }, 3500);
      }
    });
  }

  const closeModalBtn = document.getElementById("closeModal");
  if (closeModalBtn) {
    closeModalBtn.addEventListener("click", () => {
      bgModal.style.display = "none";
    });
  }
});
