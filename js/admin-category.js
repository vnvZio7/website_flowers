document.addEventListener('DOMContentLoaded', function() {
    const productPopup = document.getElementById('productPopup');
    const categoryNameInput = document.getElementById('categoryName');

    document.getElementById('search-category').addEventListener('input', function() {
        const searchTerm = this.value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'processing.php?c-search=' + encodeURIComponent(searchTerm), true); // Thay đổi URL nếu cần
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const response = xhr.responseText;
                document.getElementById('categorys').innerHTML = response; // Cập nhật danh sách danh mục
            }
        };
        xhr.send();
    });
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('update')) {
            const categoryId = event.target.getAttribute('data-id');
            categoryNameInput.value = event.target.getAttribute('data-name');
            categoryNameInput.setAttribute('data-id', categoryId);
            productPopup.classList.remove('non-display');
            document.getElementById('submitButton').textContent = 'Cập nhật';
        }

        // Handle delete button click
        if (event.target.classList.contains('del')) {
            const categoryId = event.target.getAttribute('data-id');
            if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
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
                xhr.send('action=c-delete&category_id=' + encodeURIComponent(categoryId));
            }
        }
    });
    document.getElementById('add').addEventListener('click', function() {
        categoryNameInput.value = "";
        document.getElementById('submitButton').textContent = 'Thêm mới';
        productPopup.classList.remove('non-display'); // Hide the popup
    });
    // Handle the cancel button
    document.getElementById('cancelButton').addEventListener('click', function() {
        productPopup.classList.add('non-display'); // Hide the popup
    });

    // Handle the submit button
    document.getElementById('submitButton').addEventListener('click', function() {
        if(this.textContent === 'Cập nhật'){
            const updatedCategoryName = categoryNameInput.value;
            const categoryId = categoryNameInput.getAttribute('data-id');
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'processing.php', true); // Send to the same PHP file
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Cập nhật danh mục thành công!');
                        productPopup.classList.add('non-display'); // Hide the popup
                        // Optionally, refresh the page or update the UI to reflect changes
                        location.reload();
                    } else {
                        alert('Cập nhật lỗi: ' + response.error);
                    }
                }
            };
            xhr.send('action=c-update&category_id=' + encodeURIComponent(categoryId) + '&category_name=' + encodeURIComponent(updatedCategoryName));
        }else if(this.textContent === 'Thêm mới'){
            const updatedCategoryName = categoryNameInput.value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'processing.php', true); // Send to the same PHP file
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Thêm danh mục thành công!');
                        productPopup.classList.add('non-display'); // Hide the popup
                        // Optionally, refresh the page or update the UI to reflect changes
                        location.reload();
                    } else {
                        alert('Thêm lỗi: ' + response.error);
                    }
                }
            };
            xhr.send('action=c-add&category_name=' + encodeURIComponent(updatedCategoryName));
        }
        
    });
});