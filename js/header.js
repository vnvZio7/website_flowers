document.addEventListener('DOMContentLoaded', function() {
    var home_page = document.getElementById('home_page');
    var home = document.getElementById('home');
    const clock = document.getElementById('clock');
    const header = document.getElementById('header');

    // Kiểm tra xem popup có lớp 'hidden' không
    if (home_page.classList.contains('non-display') && document.title === 'Trang chủ') {
        // Nếu có, xóa lớp 'hidden' để hiển thị popup
        home_page.classList.remove('non-display');
        // home.classList.add('non-display');
    } 
    if (home.classList.contains('non-display')  && document.title !== 'Trang chủ') {
        home.classList.remove('non-display');
        // home_page.classList.add('non-display');
    }


});

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
setInterval(rotateHands, 1000);

// nút đầu trang
window.onscroll = function () { scrollFunction() };
function scrollFunction() {

    if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
        document.getElementById("myBtn").style.display = "block";
        document.getElementById('myBtn').addEventListener("click", function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
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

