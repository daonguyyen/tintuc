<?php
 
// Hàm điều hướng trang
class Redirect {
    public function __construct($url = null) {
        if ($url)
        {
            echo '<script>location.href="'.$url.'";</script>';
        }
    }
}
 
?>

<!-- 1- Hàm này mình sử dụng class để kêu ra luôn nên tên hàm mình sẽ đặt __construct để nó thực thi hàm bên trong ngay sau khi gọi class. 
Hàm này có tham số $url chứa đường dẫn mà mình muốn điều hướng. -->