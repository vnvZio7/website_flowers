document.addEventListener('DOMContentLoaded', function() {
    var home_page = document.getElementById('home_page');
    var home = document.getElementById('home');
    const clock = document.getElementById('clock');
    const header = document.getElementById('header');
    if(document.title === 'Tất cả sản phẩm'){
        const paginationLinks = document.querySelectorAll('.pagination li a');
        const categoryLinks = document.querySelectorAll('.category-link');
        const sortButtons = document.querySelectorAll('.sort-by');

        paginationLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const categoryId = this.getAttribute('data-category-id'); 
                const page = this.getAttribute('data-page'); // Lấy số trang từ thuộc tính data-page
                const sortOrder = this.getAttribute('data-sort'); // Lấy thứ tự sắp xếp
                const sortBy = this.getAttribute('data-sort-by');// Lấy cách sắp xếp
                console.log("pa" + categoryId);

                fetchProducts(categoryId,page,sortOrder, sortBy); // Gọi hàm fetchProducts với số trang
            });
        });
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const categoryId = this.getAttribute('data-category-id'); 
                console.log("ca" + categoryId);
                const sortOrder = this.getAttribute('data-sort');
                const sortBy = this.getAttribute('data-sort-by');
                fetchProducts(categoryId,1, 'asc', 'name'); // Gọi hàm fetchProducts với số trang
            });
        });
        
        sortButtons.forEach(button => {
            button.addEventListener('click', function() {
                // // Xóa class active khỏi tất cả nút sắp xếp
                // sortButtons.forEach(btn => btn.classList.remove('sort-active'));
                // // Thêm class active cho nút đã chọn
                // this.classList.add('sort-active');
                const sortOrder = this.getAttribute('data-sort');
                const sortBy = this.getAttribute('data-sort-by');
                const categoryId = this.getAttribute('data-category-id')?this.getAttribute('data-category-id'):1; 
                console.log("btn" + categoryId);

                fetchProducts(categoryId, 1, sortOrder, sortBy); // Lấy sản phẩm với thứ tự sắp xếp đã chọn
            });
        });
        function fetchProducts(categoryId,page,sortOrder,sort_by) {
            const xhr = new XMLHttpRequest();
            console.log(`products.php?sort=${sortOrder}&sort_by=${sort_by}&category_id=${categoryId}&page=${page}`);
            xhr.open("GET", `products.php?sort=${sortOrder}&sort_by=${sort_by}&category_id=${categoryId}&page=${page}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = this.responseText;
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(response, "text/html");

                    // Cập nhật danh sách sản phẩm
                    // document.getElementById('category-list').innerHTML = doc.getElementById('category-list').innerHTML;
                    document.getElementById('refresh').innerHTML = doc.getElementById('refresh').innerHTML;

                    // Cập nhật phân trang
                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = doc.getElementById('pagination').innerHTML;

                    // Cuộn đến phần hiển thị sản phẩm
                    document.getElementById('view').scrollIntoView({ behavior: 'smooth' });

                    // Thêm lại sự kiện click cho các liên kết phân trang mới
                    const newPaginationLinks = document.querySelectorAll('.pagination li a');
                    newPaginationLinks.forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            const category_id = this.getAttribute('data-category-id');
                            const page = this.getAttribute('data-page');
                            const sortOrder = this.getAttribute('data-sort');
                            const sortBy = this.getAttribute('data-sort-by');
                            console.log("newPa" + category_id);
                            fetchProducts(category_id,page,sortOrder,sortBy);
                        });
                    });
                    const newsortButtons = document.querySelectorAll('.sort-by');
                    
                    newsortButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Xóa class active khỏi tất cả nút sắp xếp
                            const sortOrder = this.getAttribute('data-sort');
                            const sortBy = this.getAttribute('data-sort-by');
                            const categoryId = this.getAttribute('data-category-id')?this.getAttribute('data-category-id'):1; 
                            console.log("btn" + categoryId);
                            
                            // sortButtons.forEach(btn => btn.classList.remove('sort-active'));
                            // newsortButtons.forEach(btn => btn.classList.remove('sort-active'));
                            // Thêm class active cho nút đã chọn
                            
                            fetchProducts(categoryId, 1, sortOrder, sortBy); // Lấy sản phẩm với thứ tự sắp xếp đã chọn
                        });
                    });
                }
            };
            xhr.send();
        }
        
    }
    if(document.title === "Trang chủ"){

        const tabs = document.querySelectorAll('.click-a');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                tabs.forEach(t => t.classList.remove('tab-active'));
                tab.classList.add('tab-active');
                const categoryId = this.getAttribute('data-id'); 
                console.log("ca" + categoryId);
                // const sortOrder = this.getAttribute('data-sort');
                // const sortBy = this.getAttribute('data-sort-by');
                fetchProducts(categoryId); // Gọi hàm fetchProducts với số trang
            });
        });

        function fetchProducts(categoryId) {
            const xhr = new XMLHttpRequest();
            // console.log(`products.php?sort=${sortOrder}&sort_by=${sort_by}&category_id=${categoryId}&page=${page}`);
            xhr.open("GET", `home.php?category_id=${categoryId}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = this.responseText;
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(response, "text/html");

                    // Cập nhật danh sách sản phẩm
                    // document.getElementById('category-list').innerHTML = doc.getElementById('category-list').innerHTML;
                    document.getElementById('refresh').innerHTML = doc.getElementById('refresh').innerHTML;

                    // Cuộn đến phần hiển thị sản phẩm
                    document.getElementById('view').scrollIntoView({ behavior: 'smooth' });

                
                }
            };
            xhr.send();
        }
        
    }
    if(document.title === "Sản phẩm yêu thích"){
        const paginationLinks = document.querySelectorAll('.pagination li a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const page = this.getAttribute('data-page'); // Lấy số trang từ thuộc tính data-page
                fetchProducts(page); // Gọi hàm fetchProducts với số trang
            });
        });
        function fetchProducts(page) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `favourites.php?page=${page}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = this.responseText;
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(response, "text/html");

                    // Cập nhật danh sách sản phẩm
                    // document.getElementById('category-list').innerHTML = doc.getElementById('category-list').innerHTML;
                    document.getElementById('refresh').innerHTML = doc.getElementById('refresh').innerHTML;

                    // Cập nhật phân trang
                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = doc.getElementById('pagination').innerHTML;

                    // Thêm lại sự kiện click cho các liên kết phân trang mới
                    const newPaginationLinks = document.querySelectorAll('.pagination li a');
                    newPaginationLinks.forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            const page = this.getAttribute('data-page');
                            fetchProducts(page);
                        });
                    });
                }
            };
            xhr.send();
        }
    }
    if(document.title === "Tìm kiếm"){
        const paginationLinks = document.querySelectorAll('.pagination li a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const page = this.getAttribute('data-page'); // Lấy số trang từ thuộc tính data-page
                const search = this.getAttribute('data-search'); // Lấy số trang từ thuộc tính data-page
                fetchProducts(search, page); // Gọi hàm fetchProducts với số trang
            });
        });
        function fetchProducts(search, page) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `search.php?search=${search}&page=${page}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = this.responseText;
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(response, "text/html");

                    // Cập nhật danh sách sản phẩm
                    // document.getElementById('category-list').innerHTML = doc.getElementById('category-list').innerHTML;
                    document.getElementById('refresh').innerHTML = doc.getElementById('refresh').innerHTML;

                    // Cập nhật phân trang
                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = doc.getElementById('pagination').innerHTML;

                    // Thêm lại sự kiện click cho các liên kết phân trang mới
                    const newPaginationLinks = document.querySelectorAll('.pagination li a');
                    newPaginationLinks.forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            const page = this.getAttribute('data-page');
                            const search = this.getAttribute('data-search'); // Lấy số trang từ thuộc tính data-page
                            fetchProducts(search, page);
                        });
                    });
                }
            };
            xhr.send();
        }
    }
    const inp = document.querySelectorAll('.inpsl');
    const minus = document.querySelectorAll('.minus');
    const plus = document.querySelectorAll('.plus');
    const dels = document.querySelectorAll('.del');
    dels.forEach(m => {
        m.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const id = this.getAttribute('data-id');
            console.log(id);
            delCartProduct(id);
        });
    });
    minus.forEach(m => {
        m.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const quantity = this.getAttribute('data-input');
            const id = this.getAttribute('data-id');
            updateCartProduct(id,parseInt(quantity) - 1);
        });
    });
    plus.forEach(m => {
        m.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const quantity = this.getAttribute('data-input');
            const id = this.getAttribute('data-id');
            updateCartProduct(id,parseInt(quantity) + 1);
        });
    });
    inp.forEach(cart => {
        cart.addEventListener('blur', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            this.value = this.value.replace(/[^0-9]/g, '');
            const id = this.getAttribute('data-id');
            updateCartProduct(id,this.value);
        });
    });
    function updateCartProduct(id,quantity) {
        const xhr = new XMLHttpRequest();
        console.log(id);
        if(document.title === 'Giỏ hàng'){
            xhr.open("GET", `cart.php?id_cart=${id}&update_cart=${quantity}`, true);
        }else{
            xhr.open("GET", `header.php?id_cart=${id}&update_cart=${quantity}`, true);
        }
        xhr.onload = function() {
            if (this.status === 200) {
                const response = this.responseText;
                const parser = new DOMParser();
                const doc = parser.parseFromString(response, "text/html");
                document.getElementById('carts').innerHTML = doc.getElementById('carts').innerHTML;
                if(document.title === "Giỏ hàng"){
                    document.getElementById('thanhtoan').innerHTML = doc.getElementById('thanhtoan').innerHTML;
                }
                updateFCart();
            }
        };
        xhr.send();
    }

    function delCartProduct(id) {
        const xhr = new XMLHttpRequest();
        console.log(id);
        if(document.title === 'Giỏ hàng'){
            xhr.open("GET", `cart.php?del_cart=${id}`, true);
        }else{
            xhr.open("GET", `header.php?&del_cart=${id}`, true);
        }
        xhr.onload = function() {
            if (this.status === 200) {
                const response = this.responseText;
                const parser = new DOMParser();
                const doc = parser.parseFromString(response, "text/html");
                document.getElementById('carts').innerHTML = doc.getElementById('carts').innerHTML;
                if(document.title === "Giỏ hàng"){
                    document.getElementById('thanhtoan').innerHTML = doc.getElementById('thanhtoan').innerHTML;
                }
                updateFCart();
            }
        };
        xhr.send();
    }
    function updateFCart(){
        const inpnew = document.querySelectorAll('.inpsl');
        const minusnew = document.querySelectorAll('.minus');
        const plusnew = document.querySelectorAll('.plus');
        minusnew.forEach(m => {
            m.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const quantity = this.getAttribute('data-input');
                const id = this.getAttribute('data-id');
                updateCartProduct(id,parseInt(quantity) - 1);
            });
        });
        plusnew.forEach(m => {
            m.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const quantity = this.getAttribute('data-input');
                const id = this.getAttribute('data-id');
                updateCartProduct(id,parseInt(quantity) + 1);
            });
        });
        inpnew.forEach(cart => {
            cart.addEventListener('blur', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                this.value = this.value.replace(/[^0-9]/g, '');
                const id = this.getAttribute('data-id');
                updateCartProduct(id,this.value);
            });
        });
        const delsnew = document.querySelectorAll('.del');
        delsnew.forEach(m => {
            m.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                const id = this.getAttribute('data-id');
                delCartProduct(id);
            });
        });const form_tt = document.getElementById("form-tt");
        document.getElementById("button-tt").addEventListener("click", function(){
            form_tt.classList.remove("non-display");
            document.getElementById("close").addEventListener("click", function(){
                form_tt.classList.add("non-display");
            });
        });
    }
    const fvs = document.querySelectorAll('.image .fa-heart');
    const carts = document.querySelectorAll('.cart-btn');
    const searchs = document.querySelectorAll('.image .fa-search');
    fvs.forEach(fv => {
        fv.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            // tabs.forEach(t => t.classList.remove('tab-active'));
            const Id = this.getAttribute('data-id'); 
            if(fv.classList.contains('fv-active')){
                fv.classList.remove('fv-active');
                fvProduct(Id,1);
            }else{
                fv.classList.add('fv-active');
                fvProduct(Id,0);
            }
        });
    });
    carts.forEach(cart => {
        cart.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const Id = this.getAttribute('data-id'); 
            cartProduct(Id);
        });
    });
    const info = document.getElementById("xemnhanh");
    const form_tt = document.getElementById("form-tt");
    document.getElementById("button-tt").addEventListener("click", function(){
        form_tt.classList.remove("non-display");
        document.getElementById("close").addEventListener("click", function(){
            form_tt.classList.add("non-display");
        });
    });

    
    searchs.forEach(search => {
        search.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const Id = this.getAttribute('data-id'); 
            info.classList.remove("non-display");
            XNProduct(Id);
        });
    });


    function XNProduct(id) {
        const xhr = new XMLHttpRequest();
        // console.log(`products.php?sort=${sortOrder}&sort_by=${sort_by}&category_id=${categoryId}&page=${page}`);
        xhr.open("GET", `home.php?xemnhanh=${id}`, true);
        xhr.onload = function() {
            if (this.status === 200) {
                const response = this.responseText;
                const parser = new DOMParser();
                const doc = parser.parseFromString(response, "text/html");
                document.getElementById('xemnhanh').innerHTML = doc.getElementById('xemnhanh').innerHTML;
                // document.getElementById('carts').innerHTML = doc.getElementById('carts').innerHTML;
                document.getElementById("close").addEventListener("click", function(){
                    info.classList.add("non-display");
                });
                const cartsnew = document.querySelectorAll('.cart-btn');
                cartsnew.forEach(cart => {
                    cart.addEventListener('click', function(event) {
                        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                        const Id = this.getAttribute('data-id'); 
                        cartProduct(Id);
                    });
                });
            }
        };
        xhr.send();
    }
    function cartProduct(id) {
        const xhr = new XMLHttpRequest();
        console.log(id);
        xhr.open("GET", `home.php?cart=${id}`, true);
        xhr.onload = function() {
            if (this.status === 200) {
                const response = this.responseText;
                const parser = new DOMParser();
                const doc = parser.parseFromString(response, "text/html");
                document.getElementById('carts').innerHTML = doc.getElementById('carts').innerHTML;
                updateFCart();
            }
        };
        xhr.send();
    }
    function fvProduct(id,action) {
        const xhr = new XMLHttpRequest();
        // console.log(`products.php?sort=${sortOrder}&sort_by=${sort_by}&category_id=${categoryId}&page=${page}`);
        if(action == 0){
            if(document.title === "Sản phẩm yêu thích"){
                xhr.open("GET", `favourites.php?id=${id}`, true);
            }else{
                xhr.open("GET", `home.php?id=${id}`, true);
            }
        }else{
            if(document.title === "Sản phẩm yêu thích"){
                xhr.open("GET", `favourites.php?del_id=${id}`, true);
            }else{
                xhr.open("GET", `home.php?del_id=${id}`, true);
            }
        }
        xhr.onload = function() {
            if (this.status === 200) {
                const response = this.responseText;
                const parser = new DOMParser();
                const doc = parser.parseFromString(response, "text/html");
                document.getElementById('favourites').innerHTML = doc.getElementById('favourites').innerHTML;
                if(document.title === "Sản phẩm yêu thích"){
                    document.getElementById('refresh').innerHTML = doc.getElementById('refresh').innerHTML;
                    const fvsnew = document.querySelectorAll('.image .fa-heart');
                    fvsnew.forEach(fv => {
                        fv.addEventListener('click', function(event) {
                            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                            // tabs.forEach(t => t.classList.remove('tab-active'));
                            const Id = this.getAttribute('data-id'); 
                            if(fv.classList.contains('fv-active')){
                                fv.classList.remove('fv-active');
                                fvProduct(Id,1);
                            }else{
                                fv.classList.add('fv-active');
                                fvProduct(Id,0);
                            }
                        });
                    });
                }
            }
        };
        xhr.send();
    }

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
    document.getElementById('title_page').innerHTML = document.title;
});




window.addEventListener('scroll', () => {
    // Kiểm tra vị trí cuộn
    var height = 550;
    if (document.title === 'Trang chủ') {
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








// đồng hồ giảm giá
let countdownInterval;
// const h = document.getElementById('h');
// const m = document.getElementById('m');
// const s = document.getElementById('s');


let totalTime = 9980; // Chuyển đổi tất cả sang giây

clearInterval(countdownInterval); // Xóa interval nếu có

displayTime(totalTime); // Hiển thị thời gian ban đầu

countdownInterval = setInterval(function() {
    if (totalTime <= 0) {
        clearInterval(countdownInterval);
        alert("Thời gian đã hết!");
    } else {
        totalTime--;
        displayTime(totalTime);
    }
}, 1000);

function displayTime(time) {
    const hours = Math.floor(time / 3600);
    const minutes = Math.floor((time % 3600) / 60);
    const seconds = time % 60;

    document.getElementById('h').textContent = String(hours).padStart(2, '0');
    document.getElementById('m').textContent = String(minutes).padStart(2, '0');
    document.getElementById('s').textContent = String(seconds).padStart(2, '0');
}



// products
// const tabs = document.querySelectorAll('.tab');
// const contentDiv = document.getElementById('content');

// tabs.forEach(tab => {
//     tab.addEventListener('click', () => {
//         // Đánh dấu tab đang hoạt động
//         tabs.forEach(t => t.classList.remove('active'));
//         tab.classList.add('active');

//         // Lấy ID từ tab
//         const cakeTypeId = tab.getAttribute('data-id');

//         // Gửi yêu cầu AJAX để lấy nội dung
//         // fetch(`get_cake.php?cake_type_id=${cakeTypeId}`)
//         //     .then(response => response.json())
//         //     .then(data => {
//         //         contentDiv.innerHTML = ''; // Xóa nội dung cũ
//         //         if (data.length > 0) {
//         //             data.forEach(cake => {
//         //                 contentDiv.innerHTML += `<div class="cake-item"><strong>${cake.name}</strong>: ${cake.description}</div>`;
//         //             });
//         //         } else {
//         //             contentDiv.innerHTML = '<p>Không có dữ liệu nào.</p>';
//         //         }
//         //         contentDiv.classList.add('active');
//         //     })
//         //     .catch(error => {
//         //         console.error('Đã có lỗi xảy ra:', error);
//         //     });
//     });
// });

function limitInput(input) {
    // Chuyển đổi giá trị nhập thành chuỗi và kiểm tra độ dài
    if (input.value.length > 3) {
        input.value = input.value.slice(0, 3); // Giữ lại tối đa 3 ký tự
    }
}
