document.addEventListener('DOMContentLoaded', function() {
    const productPopup = document.getElementById('productPopup');
    const productNameInput = document.getElementById('productName');
    const productDesInput = document.getElementById('productDes');
    const productPriceInput = document.getElementById('productPrice');
    const productDisInput = document.getElementById('productDis');
    const productQuanInput = document.getElementById('productQuan');
    const productImgInput = document.getElementById('productImg');
    const CategoryInput = document.getElementById('category');


    document.getElementById('productNameImg').addEventListener('change', function(){
        const fileInput = this;
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0]; // Lấy tệp đã chọn
            const reader = new FileReader();
            // Khi FileReader đã đọc xong, cập nhật src của hình ảnh
            reader.onload = function(e) {
                productImgInput.src = e.target.result; // Gán kết quả đọc vào src của hình ảnh
            };
            // Đọc tệp dưới dạng URL
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('search-product').addEventListener('input', function() {
        const searchTerm = this.value;
    
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'processing.php?p-search=' + encodeURIComponent(searchTerm), true); 
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const response = xhr.responseText;
                document.getElementById('product-items').innerHTML = response; 
            }
        };
        xhr.send();
    });
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('update')) {
            const productId = event.target.getAttribute('data-id');
            const img = event.target.getAttribute('data-img');
            productNameInput.value = event.target.getAttribute('data-name');
            productDesInput.value = event.target.getAttribute('data-des');
            productPriceInput.value = event.target.getAttribute('data-price');
            productDisInput.value = event.target.getAttribute('data-dis');
            productQuanInput.value = event.target.getAttribute('data-quan');
            CategoryInput.value = event.target.getAttribute('data-category');
            productImgInput.setAttribute('src', "../images/img_products/" + img);
            document.getElementById('img_old').value = img;
            productPopup.classList.remove('non-display');
            document.getElementById('product_id').value = productId;
            document.getElementById('action').value = "p-update";
            document.getElementById('submitButton').textContent = 'Cập nhật';
        }

        // Handle delete button click
        if (event.target.classList.contains('del')) {
            const productId = event.target.getAttribute('data-id');
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'processing.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('Xóa thành công!');
                            location.reload(); 
                        } else {
                            alert('Lỗi xóa: ' + response.error);
                        }
                    }
                };
                xhr.send('action=p-delete&product_id=' + encodeURIComponent(productId));
            }
        }
    });
    document.getElementById('add').addEventListener('click', function() {
        productNameInput.value = "";
        productDesInput.value = "";
        productPriceInput.value = "";
        productDisInput.value = "";
        productQuanInput.value = "";
        productImgInput.setAttribute('src', "");
        document.getElementById('productNameImg').value = "";
        document.getElementById('action').value = "p-add";
        document.getElementById('submitButton').textContent = 'Thêm mới';
        
        productPopup.classList.remove('non-display'); // Hide the popup
    });
    // Handle the cancel button
    document.getElementById('cancelButton').addEventListener('click', function() {
        productPopup.classList.add('non-display'); // Hide the popup
    });
});