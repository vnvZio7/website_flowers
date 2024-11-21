<?php

@include("../DB/connection.php");   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if($action === 'c-update'){
        $categoryId = $_POST['category_id'];
        $categoryName = $_POST['category_name'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $categoryName, $categoryId);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        // Close connections

        exit; // Stop further execution
    }
    if ($action === 'c-delete') {
        $categoryId = $_POST['category_id'];

        // Xóa danh mục
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        exit; // Dừng thực thi
    }

    if ($action === 'c-add') {
        $categoryName = $_POST['category_name'];

        // Thêm danh mục mới
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $categoryName);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        exit; // Dừng thực thi
    }

    if($action === 'p-update'){
        $categoryId = $_POST['category_id'];
        $categoryName = $_POST['category_name'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $categoryName, $categoryId);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        // Close connections

        exit; // Stop further execution
    }
    if ($action === 'p-delete') {
        $categoryId = $_POST['category_id'];

        // Xóa danh mục
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        exit; // Dừng thực thi
    }

    if ($action === 'p-add') {
        $name = $_POST['name'];
        $des = $_POST['des'];
        $price = $_POST['price'];
        $dis = $_POST['dis'];
        $quan = $_POST['quan'];
        // $image = $_POST['image'];
        $category = $_POST['category'];
        // Xử lý ảnh (nếu có)
        // $image = null;
        echo "bắt đầu ảnh";
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folter = '../images/img_products/'.$image;
        move_uploaded_file($image_tmp_name, $image_folter);
        echo $name;
        echo $des;
        echo $dis;
        // echo $image;
        // // Thêm danh mục mới
        // $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        // $stmt->bind_param("s", $categoryName);

        // if ($stmt->execute()) {
        //     echo json_encode(['success' => true]);
        // } else {
        //     echo json_encode(['success' => false, 'error' => $stmt->error]);
        // }

        // exit; // Dừng thực thi
    }

    

}

if(isset($_GET['c-search'])){
    $searchTerm = isset($_GET['c-search']) ? $_GET['c-search'] : '';
    if ($searchTerm) {
        $stmt = $conn->prepare("SELECT * FROM categories WHERE name LIKE ?");
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bind_param("s", $searchTerm);
    } else {
        $stmt = $conn->prepare("SELECT * FROM categories");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $output = '';
    $i = 1;

    if($result->num_rows > 0){
        while ($category = $result->fetch_assoc()) {
            $output .= "<tr data-id=\"{$category['category_id']}\">
                            <th scope=\"row\">{$i}</th>
                            <td>{$category['category_id']}</td>
                            <td class=\"category-name\">{$category['name']}</td>
                            <td>
                                <button data-name=\"{$category['name']}\" data-id=\"{$category['category_id']}\" class=\"update\">Cập nhật</button>
                                <button data-id=\"{$category['category_id']}\" class=\"del\">Xóa</button>
                            </td>
                        </tr>";
            $i++;
        }
    }else{
        $output = "Không có danh mục nào.";
    }

    echo $output; // Xuất danh sách danh mục

}
if(isset($_GET['i-search'])){
    $searchTerm = isset($_GET['i-search']) ? $_GET['i-search'] : '';
    if ($searchTerm) {
        $stmt = $conn->prepare("SELECT * FROM orders o join users u on o.user_id = u.user_id WHERE u.name LIKE ? or u.phone_number LIKE ?");
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
    } else {
        $stmt = $conn->prepare("SELECT * FROM orders o join users u on o.user_id = u.user_id");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $output = '';
    $i = 1;

    if($result->num_rows > 0){
        while ($invoices = $result->fetch_assoc()) {
            $output .= '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$invoices['order_id'].'</td>
                                        <td>'.$invoices['total_amount'].'<span>đ</span></td>
                                        <td>'.$invoices['created_at'].'</td>
                                        <td>'.$invoices['name'].'</td>
                                        <td>'.$invoices['phone_number'].'</td>
                                        <td>'.$invoices['address'].'</td>
                                        <td>
                                            <button class="btn-click" data-id="'.$invoices['order_id'].'" >Xem</button>
                                        </td>
                                    </tr>';
            $i++;
        }
    }else{
        $output = "Không có hóa đơn nào.";
    }

    echo $output; // Xuất danh sách danh mục

}
if(isset($_GET['p-search'])){
    $searchTerm = isset($_GET['p-search']) ? $_GET['p-search'] : '';
    if ($searchTerm) {
        $stmt = $conn->prepare("SELECT f.*,c.name as c_name FROM `flowers` f join categories c on f.category_id = c.category_id WHERE f.name LIKE ? ");
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bind_param("s", $searchTerm);
    } else {
        $stmt = $conn->prepare("SELECT f.*,c.name as c_name FROM `flowers` f join categories c on f.category_id = c.category_id");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $output = '';
    $i = 1;

    if($result->num_rows > 0){
        while ($products = $result->fetch_assoc()) {
            $output .= '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$products['name'].'</td>
                                            <td>'.$products['description'].'</td>
                                            <td><img class="row-image" src="../images/img_products/'.$products['image_url'].'" alt="'.$products['image_url'].'"></td>
                                            <td>'.(int)$products['price'].' <span>đ</span></td>
                                            <td>'.$products['discount'].'</td>
                                            <td>'.$products['stock'].'</td>
                                            <td>'.$products['c_name'].'</td>
                                            <td>
                                                <button data-id="'.$products['flower_id'].'" data-name="'.$products['name'].'" data-des="'.$products['description'].'" data-price="'.$products['price'].'" data-dis="'.$products['discount'].'" data-quan="'.$products['stock'].'" data-category="'.$products['category_id'].'" data-img="'.$products['image_url'].'" class="update" type="submit">Cập nhật</button>
                                                <button data-id="'.$products['flower_id'].'" class="del" type="submit">Xóa</button>
                                            </td>
                                        </tr>';
            $i++;
        }
    }else{
        $output = "Không có hóa đơn nào.";
    }

    echo $output; // Xuất danh sách danh mục

}
?>