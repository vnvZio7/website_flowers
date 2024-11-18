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


?>