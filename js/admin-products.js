document.addEventListener('DOMContentLoaded', function() {
    const productPopup = document.getElementById('productPopup');
    const productNameInput = document.getElementById('productName');
    const productDesInput = document.getElementById('productDes');
    const productPriceInput = document.getElementById('productPrice');
    const productDisInput = document.getElementById('productDis');
    const productQuanInput = document.getElementById('productQuan');
    const productImgInput = document.getElementById('productImg');
    const productNameImgInput = document.getElementById('productNameImg');
    const CategoryInput = document.getElementById('category');


    document.getElementById('productNameImg').addEventListener('change', function(){
        const fileInput = this;q
    });

    document.getElementById('search-product').addEventListener('input', function() {
        const searchTerm = this.value;
    
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'processing.php?p-search=' + encodeURIComponent(searchTerm), true); // Thay đổi URL nếu cần
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const response = xhr.responseText;
                document.getElementById('product-items').innerHTML = response; // Cập nhật danh sách danh mục
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
            document.getElementById('img_old').value = ("../images/img_products/" + img);
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
                            location.reload(); // Tải lại danh sách danh mục
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

    // Handle the submit button
    // document.getElementById('submitButton').addEventListener('click', function() {
    //     if(this.textContent === 'Cập nhật'){
    //         const updatedCategoryName = categoryNameInput.value;
    //         const categoryId = categoryNameInput.getAttribute('data-id');
    //         console.log(updatedCategoryName + categoryId);
    //         const xhr = new XMLHttpRequest();
            

    //         xhr.open('POST', 'processing.php', true); // Send to the same PHP file
    //         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //         xhr.onreadystatechange = function() {
    //             if (xhr.readyState === XMLHttpRequest.DONE) {
    //                 console.log(xhr.responseText);
    //                 const response = JSON.parse(xhr.responseText);
    //                 if (response.success) {
    //                     alert('Cập nhật danh mục thành công!');
    //                     productPopup.classList.add('non-display'); // Hide the popup
    //                     // Optionally, refresh the page or update the UI to reflect changes
    //                     location.reload();
    //                 } else {
    //                     alert('Cập nhật lỗi: ' + response.error);
    //                 }
    //             }
    //         };
    //         xhr.send('action=update&category_id=' + encodeURIComponent(categoryId) + '&category_name=' + encodeURIComponent(updatedCategoryName));
    //     }else if(this.textContent === 'Thêm mới'){
            
    //         if(validateInputs()
    //         ){
    //             const updatedProductName = productNameInput.value;
    //             const updatedProductDes = productDesInput.value;
    //             const updatedProductPrice = productPriceInput.value;
    //             const updatedProductDis = productDisInput.value;
    //             const updatedProductQuan = productQuanInput.value;
    //             const updatedProductCategory = CategoryInput.value;
    //             const updatedProductImg = productNameImgInput.files[0].name;
    //             console.log(updatedProductName);
    //             console.log(updatedProductDes);
    //             console.log(updatedProductPrice);
    //             console.log(updatedProductDis);
    //             console.log(updatedProductQuan);
    //             console.log(updatedProductImg);
    //             console.log(updatedProductCategory);
                
    //         }
    //         // const xhr = new XMLHttpRequest();
    //         // xhr.open('POST', 'processing.php', true); // Send to the same PHP file
    //         // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //         // xhr.onreadystatechange = function() {
    //         //     if (xhr.readyState === XMLHttpRequest.DONE) {
    //         //         console.log(xhr.responseText);
    //         //         const response = JSON.parse(xhr.responseText);
    //         //         if (response.success) {
    //         //             alert('Thêm danh mục thành công!');
    //         //             productPopup.classList.add('non-display'); // Hide the popup
    //         //             // Optionally, refresh the page or update the UI to reflect changes
    //         //             location.reload();
    //         //         } else {
    //         //             alert('Thêm lỗi: ' + response.error);
    //         //         }
    //         //     }
    //         // };
    //         // xhr.send('action=p-add&category_name=' + encodeURIComponent(updatedCategoryName));
    //     }
        // Hàm kiểm tra các trường nhập liệu
        function validateInputs() {
            if (!productNameInput.value) {
                alert("Vui lòng nhập tên sản phẩm.");
                return false; // Trả về false nếu không hợp lệ
            }
            if (!productDesInput.value) {
                alert("Vui lòng nhập mô tả sản phẩm.");
                return false;
            }
            if (!productPriceInput.value || isNaN(productPriceInput.value) || parseFloat(productPriceInput.value) <= 0) {
                alert("Vui lòng nhập giá sản phẩm hợp lệ.");
                return false;
            }
            if (!productDisInput.value || isNaN(productDisInput.value) || parseFloat(productDisInput.value) <= 0) {
                alert("Vui lòng nhập thông tin giảm giá hợp lệ.");
                return false;
            }
            if (!productQuanInput.value || isNaN(productQuanInput.value) || parseInt(productQuanInput.value) < 0) {
                alert("Vui lòng nhập số lượng sản phẩm hợp lệ.");
                return false;
            }
            if (!productNameImgInput.files.length > 0) {
                alert('Vui lòng chọn một hình ảnh.');
                return false;
            }
            if (!CategoryInput.value) {
                alert("Vui lòng chọn danh mục sản phẩm.");
                return false;
            }
            return true; // Trả về true nếu tất cả các trường hợp lệ
        }
    // });
});