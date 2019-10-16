<?php
 
// Lớp session
class Session {
    // Hàm bắt đầu session: dùng để bắt đầu session để có thể thực hiện các hành động khác.
    public function start()
    {
        session_start();
    }
 
    // Hàm lưu session :  sẽ có một tham số $user để lưu session 
    public function send($user)
    {
        $_SESSION['user'] = $user;
    }
 
    // Hàm lấy dữ liệu session: dùng để lấy dữ liệu session đã lưu. Ở đây mình có một bước kiểm tra có tồn tại session không :
    //Nếu có trả về $user gán session đã lưu.
    //Ngược lại nếu không trả về $user bằng rỗng.     
    public function get() 
    {
        if (isset($_SESSION['user']))
        {
            $user = $_SESSION['user'];
        }
        else
        {
            $user = '';
        }
        return $user;
    }
 
    // Hàm xoá session: dùng để giải phóng session.
    public function destroy() 
    {
        session_destroy();
    }
}
 
?>