// Đang Thực Hiện
var swiper = new Swiper(".slide-content", {
  slidesPerView: 1,
  spaceBetween: 25,
  loop: false,
  centerSlide: 'true',
  fade: 'true',
  grabCursor: 'true',
  pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
  },
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },
  breakpoints: {
      0: {
          slidesPerView: 1,
      },
      520: {
          slidesPerView: 2,
      },
      950: {
          slidesPerView: 3,
      },
  },
});


//Nhận Công Việc
const wrapper = document.querySelector(".wrapper1");
const carousel = document.querySelector(".carousel");
const firstCardWidth = carousel.querySelector(".card").offsetWidth;
const arrowBtns = document.querySelectorAll(".wrapper1 i");
const carouselChildrens = [...carousel.children];

let isDragging = false, isAutoPlay = true, startX, startScrollLeft, timeoutId;

// Đếm số lượng thẻ li trong carousel
const numOfCards = carouselChildrens.length;

// Kiểm tra nếu có hơn 2 thẻ li thì mới thêm các thẻ nhân bản cho vòng lặp vô hạn
if (numOfCards > 2) {
    let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

    // Thêm các bản sao của các thẻ cuối vào đầu carousel
    carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
        carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
    });

    // Thêm các bản sao của các thẻ đầu vào cuối carousel
    carouselChildrens.slice(0, cardPerView).forEach(card => {
        carousel.insertAdjacentHTML("beforeend", card.outerHTML);
    });

    // Cuộn carousel đến vị trí phù hợp để ẩn các thẻ trùng lặp đầu tiên
    carousel.classList.add("no-transition");
    carousel.scrollLeft = carousel.offsetWidth;
    carousel.classList.remove("no-transition");
} else {
    // Ẩn nút tiến lùi nếu có 2 thẻ li hoặc ít hơn
    arrowBtns.forEach(btn => btn.style.display = 'none');
}

// Thêm sự kiện click cho nút tiến lùi để cuộn carousel trái/phải
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
    });
});

const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
    if (!isDragging) return;
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
}

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
}

const infiniteScroll = () => {
    if (numOfCards <= 2) return; // Không lặp vô hạn nếu có 2 thẻ li hoặc ít hơn

    // Nếu carousel đang ở đầu, cuộn đến cuối
    if (carousel.scrollLeft === 0) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
        carousel.classList.remove("no-transition");
    }
    // Nếu carousel đang ở cuối, cuộn đến đầu
    else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
    }

    clearTimeout(timeoutId);
    if (!wrapper.matches(":hover")) autoPlay();
}

const autoPlay = () => {
    if (window.innerWidth < 800 || !isAutoPlay || numOfCards <= 2) return;
    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
}

autoPlay();

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
carousel.addEventListener("scroll", infiniteScroll);
wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);



// Hoàn Thành
document.addEventListener('DOMContentLoaded', function() {
    const formList = document.getElementById('formList');
    const items = document.querySelectorAll('.item');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');

    // Disable navigation buttons if there are 2 or fewer items
    if (items.length <= 3) {
        nextButton.style.display = 'none';
        prevButton.style.display = 'none';
    }

    nextButton.onclick = function() {
        const widthItem = document.querySelector('.item').offsetWidth + 26; // Margin + padding
        formList.scrollLeft += widthItem;
    }

    prevButton.onclick = function() {
        const widthItem = document.querySelector('.item').offsetWidth + 26; // Margin + padding
        formList.scrollLeft -= widthItem;
    }
});


//Trễ Hẹn Javacrip
  
document.addEventListener('DOMContentLoaded', function() {
    const widthItem = document.querySelector('.item1').offsetWidth;
    const list = document.getElementById('list1');
    const prevButton = document.getElementById('prev1');
    const nextButton = document.getElementById('next1');
    const formList = document.getElementById('formList1');
  
    // Kiểm tra số lượng item
    if (list.children.length <= 3) {
      prevButton.style.display = 'none';
      nextButton.style.display = 'none';
    } else {
      prevButton.onclick = function() {
        formList.scrollLeft -= widthItem;
      };
  
      nextButton.onclick = function() {
        formList.scrollLeft += widthItem;
      };
    }
  });
  