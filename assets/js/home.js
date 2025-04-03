const $1 = document.querySelector.bind(document)
const $2 = document.querySelectorAll.bind(document)


const tabs_link_active = $2('.tab-link-item')
for(let i=0;i<tabs_link_active.length;i++) {
    tabs_link_active[i].onclick = function(e) {
        const tab_link_active = $1('.tab-link-item.tab-link-active')
        tab_link_active.classList.remove('tab-link-active')
        const tab_content_active = $1('.content-tab.content-tab-block')
        tab_content_active.classList.remove('content-tab-block')
        e.target.classList.add('tab-link-active')
        const attr = e.target.getAttribute('data-title')
        const tab_content = document.getElementById(attr)
        tab_content.classList.add('content-tab-block')
        
    }
}

   $(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    nav: true,
    navText: ["<img src='./assets/img/prev-arrow.png'>", "<img src='./assets/img/next-arrow.png'>"]
  });
});
// Tự động thay đổi banner
const sliderItems = document.querySelectorAll('.slider-item');
let currentIndex = 0;

function changeSlide() {
    // Ẩn slide hiện tại
    sliderItems[currentIndex].classList.remove('active');
    // Chuyển sang slide tiếp theo
    currentIndex = (currentIndex + 1) % sliderItems.length;
    // Hiển thị slide mới
    sliderItems[currentIndex].classList.add('active');
}

// Thay đổi mỗi 5 giây
setInterval(changeSlide, 5000);

