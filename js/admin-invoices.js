document.addEventListener('DOMContentLoaded', function() {
    const info = document.getElementById("form-info");
    const Buttons = document.querySelectorAll('.btn-click');
    Buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const id = this.getAttribute('data-id'); 
            info.classList.remove("non-display");
            fetchInvoices(id); 
            
        });
    });
    function fetchInvoices(id) {
        const xhr = new XMLHttpRequest();
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
                        const id = this.getAttribute('data-id'); 
                        info.innerHTML = doc.getElementById('form-info').innerHTML;
                        info.classList.remove("non-display");
                        fetchInvoices(id); 
                    });
                });
            }
        };
        xhr.send();
    }

    document.getElementById('search-invoices').addEventListener('input', function() {
        const searchTerm = this.value;
    
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'processing.php?i-search=' + encodeURIComponent(searchTerm), true); 
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const response = xhr.responseText;
                document.getElementById('invoices').innerHTML = response; 
            }
        };
        xhr.send();
    });
});