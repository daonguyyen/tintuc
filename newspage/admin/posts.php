<?php
 
// Kết nối database và thông tin chung
require_once 'core/init.php';
 
// Nếu đăng nhập
if ($user) 
{
    // Nếu tồn tại POST action
    if (isset($_POST['action']))
    {
        // Xử lý POST action
        $action = trim(addslashes(htmlspecialchars($_POST['action'])));
 
        // Thêm bài viết
        if ($action == 'add_post')
        {
            // Xử lý các giá trị
            $title_add_post = trim(addslashes(htmlspecialchars($_POST['title_add_post'])));
            $slug_add_post = trim(addslashes(htmlspecialchars($_POST['slug_add_post'])));
 
            // Các biến xử lý thông báo
            $show_alert = '<script>$("#formAddPost .alert").removeClass("hidden");</script>';
            $hide_alert = '<script>$("#formAddPost .alert").addClass("hidden");</script>';
            $success = '<script>$("#formAddPost .alert").attr("class", "alert alert-success");</script>';
 
            // Nếu các giá trị rỗng
            if ($title_add_post == '' || $slug_add_post == '')
            {
                echo $show_alert.'Vui lòng điền đầy đủ thông tin';
            }
            // Ngược lại
            else
            {
                // Kiểm tra bài viết tồn tại 
                $sql_check_post_exist = "SELECT title, slug FROM posts WHERE title = '$title_add_post' OR slug = '$slug_add_post'";
                // Nếu bài viết tồn tại
                if ($db->num_rows($sql_check_post_exist))
                {
                    echo $show_alert.'Bài viết có tiêu đề hoặc slug đã tồn tại.';
                }
                else
                {
                    // Thực thi thêm bài viết
                    $sql_add_post = "INSERT INTO posts VALUES (
                        '',
                        '$title_add_post',
                        '',
                        '',
                        '$slug_add_post',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '$data_user[id_acc]',
                        '0',
                        '0',
                        '$date_current'
                    )";
                    $db->query($sql_add_post);
                    echo $show_alert.$success.'Thêm bài viết thành công.';
                    $db->close(); // Giải phóng
                    new Redirect($_DOMAIN.'posts'); // Trở về trang danh sách bài viết
                }
            }
        }
 
        // Tải chuyên mục trong chỉnh sửa bài viết
    }
    // Ngược lại không tồn tại POST action
    else
    {
        new Redirect($_DOMAIN);
    }
}
// Nếu không đăng nhập
else
{
    new Redirect($_DOMAIN);
}
 
?>