<?php
  
// Nếu đăng nhập
if ($user)
{
    echo '<h3>Bài viết</h3>';
    // Lấy tham số ac
    if (isset($_GET['ac']))
    {
        $ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
    }
    else
    {
        $ac = '';
    }
  
    // Lấy tham số id
    if (isset($_GET['id']))
    {
        $id = trim(addslashes(htmlspecialchars($_GET['id'])));
    }
    else
    {
        $id = '';
    }
  
    // Nếu có tham số ac
    if ($ac != '') 
    {
        // Trang thêm bài viết
        if ($ac == 'add')
        {
            // Dãy nút của thêm bài viết
            echo
            '
                <a href="' . $_DOMAIN . 'posts" class="btn btn-default">
                    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                </a> 
            ';
  
            // Content thêm bài viết
            echo
            '
                <p class="form-add-post">
                    <form method="POST" id="formAddPost" onsubmit="return false;">
                        <div class="form-group">
                            <label>Tiêu đề bài viết</label>
                            <input type="text" class="form-control title" id="title_add_post">
                        </div>
                        <div class="form-group">
                            <label>URL chuyên mục</label>
                            <input type="text" class="form-control slug" placeholder="Nhấp vào để tự tạo" id="slug_add_post">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                        <div class="alert alert-danger hidden"></div>
                    </form>
                </p>  
            ';
        } 
        // Trang chỉnh sửa bài viết
        else if ($ac == 'edit')
        {
            $sql_check_id_cate = "SELECT id_post, author_id FROM posts WHERE id_post = '$id'";
            // Nếu tồn tại tham số id trong table
            if ($db->num_rows($sql_check_id_cate)) 
            {
                $data_post = $db->fetch_assoc($sql_check_id_cate, 1);
 
                if ($data_post['author_id'] == $data_user['id_acc'] || $data_user['position'] == '1')
                {
                    // Dãy nút của chỉnh sửa bài viết
                    echo
                    '
                        <a href="' . $_DOMAIN . 'posts" class="btn btn-default">
                            <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                        </a>
                        <a class="btn btn-danger" id="del_post" data-id="' . $id . '">
                            <span class="glyphicon glyphicon-trash"></span> Xoá
                        </a> 
                    ';  
      
                    // Content chỉnh sửa bài viết
                }
                else
                {
                    echo '<div class="alert alert-danger">ID bài viết không thuộc quyền sở hữu của bạn.</div>';
                }
            }
            else
            {
                // Hiển thị thông báo lỗi
                echo
                '
                    <div class="alert alert-danger">ID bài viết đã bị xoá hoặc không tồn tại.</div>
                ';
            }
        }
   }
    // Ngược lại không có tham số ac
    // Trang danh sách bài viết
    else
    {
        // Dãy nút của danh sách bài viết
        echo
        '
            <a href="' . $_DOMAIN . 'posts/add" class="btn btn-default">
                <span class="glyphicon glyphicon-plus"></span> Thêm
            </a> 
            <a href="' . $_DOMAIN . 'posts" class="btn btn-default">
                <span class="glyphicon glyphicon-repeat"></span> Reload
            </a> 
            <a class="btn btn-danger" id="del_post_list">
                <span class="glyphicon glyphicon-trash"></span> Xoá
            </a> 
        ';
  
        // Content danh sách bài viết
    }
}
// Ngược lại chưa đăng nhập
else
{
    new Redirect($_DOMAIN); // Trở về trang index
}
  
?>