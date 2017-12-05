<?php

function AclCheck(){
    $current_action =$GLOBALS['current_action'];
    $current_controller = $GLOBALS['current_controller'];
    $link_access = $current_controller.'_'.$current_action;
    $link_public_allow = array('index_index','index_login','index_logout','product_detail','product_list-product-category','product_list-product-producer','article_detail','article_list-article-category','index_contact','product_add-cart','product_view-cart','product_delete','product_order','index_search');
    if(in_array($link_access,$link_public_allow)){
        return true;
    }
    //kiểm tra đăng nhập chưa
    if(!isset($_SESSION['userLogin'])){
        return false;
    }
    //đã đăng nhập => kiểm tra xem quyền
    if(empty($_SESSION['userLogin']['permission'])){
        //chưa lưu quyền
        $id_nhom_tai_khoan = $_SESSION['userLogin']['id_nhom_tai_khoan'];
        $sql = "select * from quyen inner JOIN  chucnang on quyen.id_chuc_nang = chucnang.id
                WHERE quyen.id_nhom_tai_khoan = $id_nhom_tai_khoan
                AND   quyen.trang_thai = 1";
        $res = mysqli_query($GLOBALS['conn'],$sql);
        $auth = array();
        while($row = mysqli_fetch_assoc($res)){
            $auth[] = $row['link'];
        }
        if(count($auth)>0){
            $_SESSION['userLogin']['permission_allow'] = $auth;
        }
        if(in_array($link_access,$_SESSION['userLogin']['permission_allow'])){
            return true;
        }
        else{
            return false;
        }
    }
    return false;
}
function checkStrSql($str){
    $String = str_replace("'","\'",$str);
    return $String;
}
function get_img_article(){
    $fileUpload = $_FILES['txt_hinh_anh'];
    $luu_file = move_uploaded_file($fileUpload['tmp_name'],'.'._app_path_images_public.'/images-article/'.$fileUpload['name']);
    if($luu_file ===false){
        return false;
    }
    else{
        $name_img = $fileUpload['name'];
        return $name_img;
    }
}
function get_img_product(){
    $fileUpload = $_FILES['txt_hinh_anh'];
    $luu_file = move_uploaded_file($fileUpload['tmp_name'],'.'._app_path_images_public.'/images-product/'.$fileUpload['name']);
    if($luu_file ===false){
        return false;
    }
    else{
    $name_img = $fileUpload['name'];
    return $name_img;
}
}
function validateUsername ($string){

    // biểu thức quy tắc kiểm tra tên đăng nhập
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if ( !preg_match($partten, $string) ){
        return "Tên đăng nhập phải là ký tự số hoặc chữ cái từ 6 đến 30 ký tự!";
    }

    return true;
}

/**
 * Hàm kiểm tra khớp mật khẩu
 */
function validatePassword ($string1,$string2){

    // biểu thức quy tắc kiểm tra mật khẩu
    $partten = "/^.{6,}$/";
    if ( !preg_match($partten, $string1)){
        return "Mật khẩu phải từ 6 ký tự trở lên!";
    }
    if($string1 !== $string2){
        return "Hai mật khẩu không khớp";
    }
    return true;
}
/**
 * Hàm kiêm tra tên group
 * @return string, boolen
 */
function validateGroupName($string){
    if(strlen($string)<3){
        return "Tên nhóm phải nhập ít nhất 3 ký tự";
    }
    return true;
}
/**
 * Hàm xử lý hiển thị view của action
 */
function renderView($data=null){
    //cần lấy tên action ở dạng chữ thường để tự động load file view
    $current_action = $GLOBALS['current_action'];
    $current_controller = $GLOBALS['current_controller'];
    $file_view_full_path = app_path.'/View/'.$current_controller.'/'.$current_action.'.phtml';

    if(!file_exists($file_view_full_path)){
        echo '<b>File view '.$file_view_full_path.' not found!';
        die();
    }

    require_once $file_view_full_path;
}



/**
 * Hàm này chuyển chuỗi tham số thành tên controller hoặc tên action. Tên hàm viết sao cho dễ nhớ thôi.
 * @param $string
 * @return string
 *
 */
function convertUpperActionAndControllerName($string){
    // $string có dạng: admin-group-user
    $tmp = str_replace('-',' ',$string);  // chữ search là tự phần mềm nó gợi ý, mình không sửa được chữ đó, nó chỉ có tác dụng hiển thị cho dễ nhìn
    // khong ảnh hưởng đến mã code nhé.

    // kết quả lệnh trên:  admin group user

    // thay thế dấu - thành dấu cách để chuyển các ký tự đầu thành chữ in hoa:
    $tmp = ucwords($tmp); // hàm này sẽ tìm toàn bộ các từ (phân biệt bởi dấu cách, thay thế kí tự đầu tiên của từ thành chữ in hoa)

    // kết quả lệnh trên:  Admin Group User

    $tmp = str_replace(' ', '', $tmp); // việc này sẽ xóa hết dấu cách trở thành 1 chuỗi liền

    // kết quả lệnh trên:  AdminGroupUser

    return $tmp; // trả về chuỗi vừa xử lý xong

}

/**
 * Hàm gọi các action và hiển thị.
 */
function ShowContentAction(){
    if(empty($GLOBALS['action_name']))
    {
        echo '<b>Action name not defined!</b>';
        exit();
    }

    $actionName = $GLOBALS['action_name'];

    //list-group
    //action name: listGroup
    // trong này cần phân biệt được đang làm việc với action nào.
    if(function_exists($actionName))
        $actionName(); //lệnh này là cái hay của PHP. Tên hàm có thể là giá trị trong biến
    else{
        echo '<b>Action '. $actionName .' not found!</b>';
        exit();
    }
}
