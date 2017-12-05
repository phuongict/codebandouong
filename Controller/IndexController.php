<?php
require_once app_path . '/Model/AdminUserModel.php';
require_once app_path . '/Model/IndexModel.php';
function searchAction(){
    $dataView = null;
    $result = $_GET['result'];
    $total_records = countProductSearch(addslashes($result));
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _product_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Không thấy sản phẩm cần tìm!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _product_limit;
    $res = searchProduct(addslashes($result),$offset);
    if(!is_array($res)){
        $dataView['msg'] = $res;
    }
    else{
        $dataView['data'] = $res;
        $dataView['total_pages'] = $total_pages;
    }
    renderView($dataView);
}
function contactAction(){
    $dataView = null;
    $params = array();
    if(isset($_POST['btnSave'])){
        $params['tieu_de'] = $_POST['txt_tieu_de'];
        $params['noi_dung'] = $_POST['txt_noi_dung'];
        $params['ho_ten'] = $_POST['txt_ho_ten'];
        $params['dia_chi'] = $_POST['txt_dia_chi'];
        $params['dien_thoai'] = $_POST['txt_dien_thoai'];
        $params['email'] = $_POST['txt_email'];
        $res = InsertContact($params);
        if($res === true){
            $dataView['msg'] = 'Gửi liên hệ thành công!';
        }
        else{
            $dataView['msg'] = $res;
        }
    }
    renderView($dataView);
}
function logoutAction(){
    if(isset($_SESSION['userLogin'])){
        unset($_SESSION['userLogin']);
//        header("Location:"._base_path);
        echo "<script>window.location='index.php';</script>";
    }
}
function indexAction(){
    $dataView = null;
    /////Lấy slide
    $list_slide   = SelectListSlide();
    if (is_array($list_slide)) {
        $dataView['data']['list_slide']        = $list_slide;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'][] = $list_slide;
    }
    //lấy danh sách bài viết mới
    $list   = Select_All_Article();
    if (is_array($list)) {
        $dataView['data']['list_article']        = $list;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    //lấy danh sách sản phẩm
    $total_records = countProductIndex();
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _product_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Chưa có dữ liệu!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _product_limit;
    $list   = Select_All_Product($offset);
    if (is_array($list)) {
        $dataView['data']['list_product']        = $list;
        $dataView['total_pages']['product'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    ////////////////////
//    $list_product   = SelectListProduct();
//    if (is_array($list_product)) {
//        $dataView['data']['list_product']        = $list_product;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
//    } else {
//        $dataView['msg'][] = $list_product;
//    }
    //lấy danh mục sản phẩm
    $list_category   = SelectListCategory();
    if (is_array($list_category)) {
        $dataView['data']['list_category']        = $list_category;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'][] = $list_category;
    }
    ////Lấy danh sách nhà sản xuất
    $list_producer   = SelectListProducer();
    if (is_array($list_producer)) {
        $dataView['data']['list_producer']        = $list_producer;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'][] = $list_producer;
    }
    renderView($dataView);
}
function loginAction(){
    if(isset($_SESSION['userLogin'])){
//        header("Location: "._base_path);
        echo "<script>window.location='index.php';</script>";
    }
    $dataView = null;
    if(isset($_POST['btnSave'])){
        $username = $_POST['txt_tai_khoan'];
        $pass = $_POST['txt_mat_khau'];
        $check_username = validateUsername($username);
        if($check_username === true){
            $res_login = LoginDB($username, $pass);
            if(is_array($res_login)){
                $dataView['msg'][]= "Đăng nhập thành công!<br> Tự động chuyển trang trong 3s...";
                unset($res_login['mat_khau']);
                    $_SESSION['userLogin'] = $res_login;
//                echo '<meta http-equiv="refresh" content="3; URL="google.com"/>';
//                header("Location: "._base_path);
                echo "<script type='text/javascript'>
                            function Redirect() {
                               window.location='index.php';
                            }
                            setTimeout('Redirect()', 3000);
                    </script>";
            }
            else{
                $dataView['msg'][] = $res_login;
            }
        }
        else{
            $dataView['msg'][] = $check_username;
        }
    }
    renderView($dataView);
}