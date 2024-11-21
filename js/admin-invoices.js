document.addEventListener('DOMContentLoaded', function() {
    const info = document.getElementById("form-info");
    const Buttons = document.querySelectorAll('.btn-click');
    Buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const id = this.getAttribute('data-id'); // Lấy số trang từ thuộc tính data-page
            info.classList.remove("non-display");
            fetchInvoices(id); // Gọi hàm fetchProducts với số trang
            
        });
    });
    function fetchInvoices(id) {
        const xhr = new XMLHttpRequest();
        // console.log(`admin-invoices.php?id_x=${id}`);

        xhr.open("GET", `admin-invoices.php?id_x=${id}`, true);
        xhr.onload = function() {
            if (this.status === 200) {
                const response = this.responseText;
                const parser = new DOMParser();
                const doc = parser.parseFromString(response, "text/html");
                const Buttonsnew = document.querySelectorAll('.btn-click');
                document.getElementById('form-info').innerHTML = doc.getElementById('form-info').innerHTML;
                document.getElementById("close").addEventListener("click",function(){
                    info.classList.add("non-display");
                });
                Buttonsnew.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                        const id = this.getAttribute('data-id'); // Lấy số trang từ thuộc tính data-page
                        console.log("pa" + id);
                        info.innerHTML = doc.getElementById('form-info').innerHTML;
                        info.classList.remove("non-display");
                        fetchInvoices(id); // Gọi hàm fetchProducts với số trang
                    });
                });
            }
        };
        xhr.send();
    }

    document.getElementById('search-invoices').addEventListener('input', function() {
        const searchTerm = this.value;
    
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'processing.php?i-search=' + encodeURIComponent(searchTerm), true); // Thay đổi URL nếu cần
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const response = xhr.responseText;
                document.getElementById('invoices').innerHTML = response; // Cập nhật danh sách danh mục
            }
        };
        xhr.send();
    });
});