

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .canvas {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
            background-color: transparent;
        }
        canvas {
            max-width: 1000px;
            width: 100%;
            color: white!important;
        }
        select {
            margin: 20px;
            padding: 10px;
            font-size: 16px;
            color: white;
        }
    </style>
    
</head>

<body>
    
    <?php @include("admin-header.php");?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashboard</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                27.800.000đ
                                            </h4>
                                            <p class="mb-2">
                                                Total Earnings
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex;justify-content: space-between;"><h4>Doanh thu theo ngày</h4>
                        <select id="monthSelect">
                            <option value="1">Tháng 1</option>
                            <option value="2">Tháng 2</option>
                            <option value="3">Tháng 3</option>
                            <option value="4">Tháng 4</option>
                            <option value="5">Tháng 5</option>
                            <option value="6">Tháng 6</option>
                            <option value="7">Tháng 7</option>
                            <option value="8">Tháng 8</option>
                            <option value="9">Tháng 9</option>
                            <option value="10">Tháng 10</option>
                            <option value="11">Tháng 11</option>
                            <option value="12">Tháng 12</option>
                        </select></div>
                    <div class="canvas"><canvas id="revenueChart1"></canvas></div>
                    <script>
                        const ctx1 = document.getElementById('revenueChart1').getContext('2d');
                        const revenueChart1 = new Chart(ctx1, {
                            type: 'line', // Sử dụng biểu đồ đường
                            data: {
                                labels: Array.from({ length: 30 }, (_, i) => `${i + 1}`), // Tạo nhãn cho 30 ngày
                                datasets: [{
                                    label: 'Doanh thu (triệu VNĐ)',
                                    data: [], // Dữ liệu sẽ được cập nhật sau
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 2,
                                    fill: true // Làm đầy màu phía dưới đường biểu đồ
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Doanh thu (triệu VNĐ)',
                                            color: 'white' // Màu chữ tiêu đề trục Y
                                        },
                                        ticks: {
                                            color: 'white' // Màu chữ nhãn trục Y
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Ngày',
                                            color: 'white' // Màu chữ tiêu đề trục X
                                        },
                                        ticks: {
                                            color: 'white' // Màu chữ nhãn trục X
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: 'white' // Màu chữ nhãn trong legend
                                        }
                                    }
                                }
                            }
                        });
                
                        // Dữ liệu doanh thu cho từng tháng
                        const monthlyRevenueData = {
            1: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 15 triệu
            2: [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 27 triệu
            3: [0.6, 0.7, 0.8, 0.9, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            4: [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            5: [0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            6: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            7: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            8: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            9: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            10: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            11: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
            12: [0.5, 0.5, 0.5, 0.5, 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], // Tổng: 24 triệu
        };
                
                        // Hàm cập nhật biểu đồ theo tháng
                        function updateChart(month) {
                            revenueChart1.data.datasets[0].data = monthlyRevenueData[month];
                            revenueChart1.update();
                        }
                
                        // Lắng nghe sự kiện thay đổi tháng
                        document.getElementById('monthSelect').addEventListener('change', function() {
                            const selectedMonth = this.value;
                            updateChart(selectedMonth);
                        });
                
                        // Khởi tạo biểu đồ với tháng đầu tiên
                        updateChart(1);
                    </script>
    <h4>Doanh thu theo tháng</h4>    
                    <div class="canvas">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <script>
                        const ctx = document.getElementById('revenueChart').getContext('2d');
                const revenueChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                        datasets: [{
                            label: 'Doanh thu (triệu VNĐ)',
                            data: [0,0,0,0,0,0,0,0,12000000,25000000,27800000,0],
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Doanh thu (triệu VNĐ)',
                                    color: 'white' // Màu chữ nhãn trong legend
                                },
                                ticks:{
                                    color: 'white' // Màu chữ nhãn trong legend
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng',
                                    color: 'white' // Màu chữ nhãn trong legend
                                },
                                ticks:{
                                    color: 'white' // Màu chữ nhãn trong legend
                                }
                            }
                        } ,
                        plugins: {
                        legend: {
                            labels: {
                                color: 'white' // Màu chữ nhãn trong legend
                            }
                        }
                    }
                    }
                });
                    </script>
                    
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Danh sách khách hàng mua nhiều nhất
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Tổng đơn hàng </th>
                                        <th scope="col">Tổng giá trị</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Phạm Xuân Trường</td>
                                        <td>10</td>
                                        <td>12.000.000đ</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Ngô Thị Nguyệt</td>
                                        <td>8</td>
                                        <td>5.800.000đ</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Nguyễn Văn A</td>
                                        <td>3</td>
                                        <td>4.350.000đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
           
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
</body>

</html>