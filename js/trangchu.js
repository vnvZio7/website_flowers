// nút sản phẩm
const swiper = new Swiper('.products', {
    // Tùy chọn Swiper
    slidesPerView: 4,  // Hiển thị 4 slide
    spaceBetween: 10,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});


// đồng hồ giảm giá
let countdown;
const h = document.getElementById('h');
const m = document.getElementById('m');
const s = document.getElementById('s');


// let timer = 3000, hours, minutes, seconds;
// countdown = setInterval(function () {
//     hours = parseInt(timer / 3600, 10);
//     minutes = parseInt(timer / 60, 10);
//     seconds = parseInt(timer % 60, 10);
//     console.log(hours,minutes,seconds)
//     hours = hours < 10 ? "0" + hours : hours;
//     minutes = minutes < 10 ? "0" + minutes : minutes;
//     seconds = seconds < 10 ? "0" + seconds : seconds;

//     // display.textContent = minutes + ":" + seconds;
//     h.textContent = hours;
//     m.textContent = minutes;
//     s.textContent = seconds;
//     if (--timer < 0) {
//         clearInterval(countdown);
//         display.textContent = "Hết thời gian!";
//     }
// }, 1000);


// scroll clock
const clock = document.getElementById('clock');

window.addEventListener('scroll', () => {
    // Kiểm tra vị trí cuộn
    var height = 550;
    if (document.title === 'Trang chủ') {
        height = 100;
    }
    if (window.scrollY > (window.innerHeight - height)) {
        clock.style.fontWeight = 'bold'; // Màu chữ ban đầu
        clock.style.color = 'black'; // Màu chữ khi cuộn
        clock.style.setProperty('--end-linear', 'red');
    } else {
        clock.style.fontWeight = 'normal'; // Màu chữ ban đầu
        clock.style.color = 'white'; // Màu chữ ban đầu
        clock.style.setProperty('--end-linear', 'white');
    }
});


// clock
function rotateHands() {
    var currentTime = new Date();
    var hour = currentTime.getHours();
    var minute = currentTime.getMinutes();
    var second = currentTime.getSeconds();
    if (hour < 10)
        hour = '0' + hour;

    if (minute < 10)
        minute = '0' + minute;

    if (second < 10)
        second = '0' + second;

    document.getElementById('hour').innerHTML = hour + ' : ';
    document.getElementById('minute').innerHTML = minute + ' : ';
    document.getElementById('second').innerHTML = second;

}

function slide_next() {
    next('slide');
}
setInterval(slide_next, 4000);
setInterval(rotateHands, 1000);
const header = document.getElementById('header');
// nút đầu trang
window.onscroll = function () { scrollFunction() };
function scrollFunction() {

    if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }

    if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
        document.getElementById('search').classList.remove('non-display');
        header.classList.add('headerSticky');
        header.style.setProperty('--active-color', 'red');

    } else {
        document.getElementById('search').classList.add('non-display');
        header.classList.remove('headerSticky');
        header.style.setProperty('--active-color', '#0d0687');
    }
}

document.getElementById('myBtn').addEventListener("click", function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});


// products
const tabs = document.querySelectorAll('.tab');
const contentDiv = document.getElementById('content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        // Đánh dấu tab đang hoạt động
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        // Lấy ID từ tab
        const cakeTypeId = tab.getAttribute('data-id');

        // Gửi yêu cầu AJAX để lấy nội dung
        // fetch(`get_cake.php?cake_type_id=${cakeTypeId}`)
        //     .then(response => response.json())
        //     .then(data => {
        //         contentDiv.innerHTML = ''; // Xóa nội dung cũ
        //         if (data.length > 0) {
        //             data.forEach(cake => {
        //                 contentDiv.innerHTML += `<div class="cake-item"><strong>${cake.name}</strong>: ${cake.description}</div>`;
        //             });
        //         } else {
        //             contentDiv.innerHTML = '<p>Không có dữ liệu nào.</p>';
        //         }
        //         contentDiv.classList.add('active');
        //     })
        //     .catch(error => {
        //         console.error('Đã có lỗi xảy ra:', error);
        //     });
    });
});

function limitInput(input) {
    // Chuyển đổi giá trị nhập thành chuỗi và kiểm tra độ dài
    if (input.value.length > 3) {
        input.value = input.value.slice(0, 3); // Giữ lại tối đa 3 ký tự
    }
}
