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

//Nhận CÔng Việc

const wrapper = document.querySelector(".wrapper1");
const carousel = document.querySelector(".carousel");
const firstCardWidth = carousel.querySelector(".card").offsetWidth;
const arrowBtns = document.querySelectorAll(".wrapper1 i");

let isDragging = false, isAutoPlay = true, startX, startScrollLeft, timeoutId;

// Đếm số lượng thẻ trong carousel
const updateArrowButtons = () => {
    const cards = carousel.querySelectorAll(".card");
    const totalCards = cards.length;
    
    // Nếu có ít hơn hoặc bằng 2 thẻ, tắt nút điều hướng
    arrowBtns.forEach(btn => {
        btn.style.display = totalCards <= 3 ? "none" : "block";
    });
}

// Thêm sự kiện click cho nút tiến lùi để cuộn carousel trái/phải
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        if (btn.id === "left") {
            carousel.scrollLeft -= firstCardWidth;
        } else {
            carousel.scrollLeft += firstCardWidth;
        }
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

const autoPlay = () => {
    if (window.innerWidth < 800 || !isAutoPlay) return;
    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
}

// Cập nhật nút điều hướng khi trang web tải
updateArrowButtons();

// Tự động phát khi tải
autoPlay();

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);

wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);

// Cập nhật lại nút điều hướng khi kích thước cửa sổ thay đổi
window.addEventListener("resize", updateArrowButtons);



// Hoàn Thành
document.addEventListener('DOMContentLoaded', function() {
    const formList = document.getElementById('formList');
    const items = document.querySelectorAll('.item');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');

    // Kiểm tra xem các phần tử có tồn tại không trước khi thao tác
    if (!formList || !items || !nextButton || !prevButton) {
        return;
    }

    let isDragging = false, startX, startScrollLeft;

    // Disable navigation buttons if there are 3 hoặc fewer items
    if (items.length <= 3) {
        nextButton.style.display = 'none';
        prevButton.style.display = 'none';
    }

    // Sự kiện click cho nút tiến/lùi
    nextButton.onclick = function() {
        const widthItem = document.querySelector('.item').offsetWidth + 26; // Margin + padding
        formList.scrollLeft += widthItem;
    }

    prevButton.onclick = function() {
        const widthItem = document.querySelector('.item').offsetWidth + 26; // Margin + padding
        formList.scrollLeft -= widthItem;
    }

    // Bắt đầu kéo thả
    const dragStart = (e) => {
        isDragging = true;
        startX = e.pageX;
        startScrollLeft = formList.scrollLeft;
        formList.classList.add("dragging");

        // Ngăn chặn việc chọn văn bản khi kéo
        document.addEventListener('selectstart', preventTextSelection);
    }

    // Kéo thả
    const dragging = (e) => {
        if (!isDragging) return;
        formList.scrollLeft = startScrollLeft - (e.pageX - startX);
    }

    // Dừng kéo thả
    const dragStop = () => {
        isDragging = false;
        formList.classList.remove("dragging");

        // Cho phép chọn văn bản lại sau khi ngừng kéo
        document.removeEventListener('selectstart', preventTextSelection);
    }

    // Hàm ngăn chọn văn bản
    const preventTextSelection = (e) => {
        e.preventDefault();
    }

    // Gắn sự kiện chuột để kéo thả
    formList.addEventListener("mousedown", dragStart);
    formList.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
});





//Trễ Hẹn Javacrip
document.addEventListener('DOMContentLoaded', function() {
    const formList = document.getElementById('formList1');
    const list = document.getElementById('list1');
    const items = document.querySelectorAll('.item1');
    const prevButton = document.getElementById('prev1');
    const nextButton = document.getElementById('next1');

    if (!formList || !list || !prevButton || !nextButton) {
        // Dừng thực thi nếu bất kỳ phần tử nào không tồn tại
        return;
    }

    let isDragging = false, startX, startScrollLeft;

    // Kiểm tra số lượng item
    if (items.length <= 3) {
        prevButton.style.display = 'none';
        nextButton.style.display = 'none';
    }

    // Sự kiện click cho nút tiến/lùi
    nextButton.onclick = function() {
        const widthItem = items[0].offsetWidth + 26; // Margin + padding
        formList.scrollLeft += widthItem;
    };

    prevButton.onclick = function() {
        const widthItem = items[0].offsetWidth + 26; // Margin + padding
        formList.scrollLeft -= widthItem;
    };

    // Bắt đầu kéo thả
    const dragStart = (e) => {
        isDragging = true;
        startX = e.pageX;
        startScrollLeft = formList.scrollLeft;
        formList.classList.add("dragging");

        // Ngăn chặn việc chọn văn bản khi kéo
        document.addEventListener('selectstart', preventTextSelection);
    }

    // Kéo thả
    const dragging = (e) => {
        if (!isDragging) return;
        formList.scrollLeft = startScrollLeft - (e.pageX - startX);
    }

    // Dừng kéo thả
    const dragStop = () => {
        isDragging = false;
        formList.classList.remove("dragging");

        // Cho phép chọn văn bản lại sau khi ngừng kéo
        document.removeEventListener('selectstart', preventTextSelection);
    }

    // Hàm ngăn chọn văn bản
    const preventTextSelection = (e) => {
        e.preventDefault();
    }

    // Gắn sự kiện chuột để kéo thả
    formList.addEventListener("mousedown", dragStart);
    formList.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
});


  