<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

// function uploadFile($file, $folderSave){
//     $file_upload = $file;
//     $pathStorage = $folderSave . rand(10000, 99999) . $file_upload['name'];

//     $tmp_file = $file_upload['tmp_name'];
//     $pathSave = PATH_ROOT . $pathStorage; // Đường dãn tuyệt đối của file

//     if (move_uploaded_file($tmp_file, $pathSave)) {
//         return $pathStorage;
//     }
//     return null;
// }
function uploadFile($file, $folderSave){
    // nếu thiếu dấu "/" thì tự thêm
    if (!str_ends_with($folderSave, '/')) {
        $folderSave .= '/';
    }

    // thư mục thật trên máy
    $targetFolder = PATH_ASSETS_UPLOADS . $folderSave;

    // tạo thư mục nếu chưa có
    if (!file_exists($targetFolder)) {
        mkdir($targetFolder, 0777, true);
    }

    // tạo tên file random
    $fileName = rand(10000, 99999) . "-" . basename($file['name']);

    // đường dẫn tuyệt đối để lưu file
    $pathSave = $targetFolder . $fileName;

    // đường dẫn để lưu vào DB (relative)
    $pathStorage = $folderSave . $fileName;

    if (move_uploaded_file($file['tmp_name'], $pathSave)) {
        return $pathStorage; // dạng "diary/12345-anh1.jpg"
    }

    return null;
}

function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete); // Hàm unlink dùng để xóa file
    }
}
