<?php
// Kiểm tra xem tên file đã được truyền qua biến $_GET hay chưa
if (isset($_GET['file_name'])) {
    // Lấy tên file từ biến $_GET
    $file_name = $_GET['file_name'];

    // Đường dẫn tới thư mục chứa file (thay đổi theo nơi lưu trữ file của bạn)
    $file_path = __DIR__ ."/". $file_name;
    echo $file_path;
    // Kiểm tra xem file có tồn tại hay không
    if (file_exists($file_path)) {
        // Thiết lập tiêu đề và kiểu mime để tải xuống
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $file_name);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Đọc và gửi nội dung của file
        readfile($file_path);
        exit;
    } else {
        echo "File không tồn tại.";
    }
} else {
    echo "Vui lòng cung cấp tên file.";
}
?>