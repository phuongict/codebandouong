<?php
require_once app_path . '/Model/IndexModel.php';
require_once app_path . '/Model/ProductModel.php';
function orderAction(){
    $dataView = null;
    if(isset($_SESSION['cart'])) {
        $list_id_item = array();
        $list_id_item = array_keys($_SESSION['cart']);
        $list_id_item = implode(',', $list_id_item);
        $res          = SelectProductItem($list_id_item);
        if (!is_array($res)) {
            $dataView['msg'][] = $res;
        } else {
            $dataView['data'] = $res;
        }
        //add info
        $params = array();
        if (isset($_POST['btnSend'])) {
            $params['hoten']     = $_POST['txt_username'];
            $params['dienthoai'] = $_POST['txt_phone'];
            $params['email']     = $_POST['txt_email'];
            $params['diachi']    = $_POST['txt_address'];
            $params['ghichu']    = $_POST['txt_ghichu'];
            $resOrder            = insertOrder($params);
            if (is_string($resOrder)) {
                $dataView['msg'][] = $resOrder;
                return renderView($dataView);
            }
            foreach ($res as $rowProduct) {

                $id_product = $rowProduct['id'];
                $qt         = $_SESSION['cart'][$id_product];
                if (!empty($rowProduct['giam_gia'])) {
                    $price = $rowProduct['giam_gia'];
                } else {
                    $price = $rowProduct['gia'];
                }
                $resDeitalOrder = insertDetailOrder($id_product, $qt, $price, $resOrder);
                if ($resDeitalOrder === true) {
                    $dataView['msg'][] = "Gửi đơn hàng thành công!";
                    $dataView['_flag'] = true;
                    unset($_SESSION['cart']);
                } else {
                    $dataView['msg'][] = $resDeitalOrder;
                }
            }
        }
    }
    else{
        $dataView['_flag'] = true;
        $dataView['msg'][] = 'Không có sản phẩm nào trong giỏ hàng';
    }

    renderView($dataView);
}
function deleteAction(){
    $dataView = null;
    if(isset($_GET['item'])){
        $id = intval($_GET['item']);
        if($id<=0){
            die("Không xác định sản phẩm cần xóa!");
        }
        if(isset($_SESSION['cart'][$id])){
            unset($_SESSION['cart'][$id]);
            echo "<script>window.location.href='?controller=product&action=view-cart';</script>";
        }
        else
            echo "<script>window.location.href='?controller=product&action=view-cart';</script>";
    }
    else{
        $dataView['msg'] = 'Xóa sản phẩm thất bại!';
    }
    renderView($dataView);
}
function viewCartAction(){
    $dataView = null;
    if (!isset($_SESSION['cart'])) {
//        die("Bạn chưa chọn sản phẩm nào!");
        $dataView['msg'] = 'Bạn chưa chọn sản phẩm nào!';
        return renderView($dataView);
    }
    if(isset($_POST['btnUpdate'])){
        foreach ($_POST as $key => $val){
            if(substr($key,0,3) =='qt_'){
                $id_sp = intval(str_replace('qt_','',$key));
                if(isset($_SESSION['cart'][$id_sp])){
                    if($val == 0)
                        unset($_SESSION['cart'][$id_sp]);
                    else
                        $_SESSION['cart'][$id_sp] = $val;
                }
            }
        }
        echo "<script type='text/javascript'>window.location.href='?controller=product&action=view-cart';</script>";
    }
    $list_id_item = array();
    $list_id_item = array_keys($_SESSION['cart']);
    $list_id_item = implode(',', $list_id_item);
    $res = SelectProductItem($list_id_item);
    if(!is_array($res)){
        $dataView['msg'] = $res;
    }
    else{
        $dataView['data'] = $res;
    }
    renderView($dataView);
}
function addCartAction(){
    $dataView = null;
    if(isset($_GET['item'])){
        $id = intval($_GET['item']);
        if($id<=0){
            die("Không xác định sản phẩm cần mua!");
        }
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] ++;
        }
        else
            $_SESSION['cart'][$id] = 1;
            $dataView['msg'] = 'Thêm thành công!';
    }
    else{
        $dataView['msg'] = 'Thêm sản phẩm thất bại!';
    }
    renderView($dataView);
}
function listProductProducerAction()
{
    $dataView = null;
    //lấy danh mục sản phẩm
    $list_category   = SelectListCategory();
    if (is_array($list_category)) {
        $dataView['data']['list_category']        = $list_category;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_category;
    }
    ////Lấy danh sách nhà sản xuất
    $list_producer   = SelectListProducer();
    if (is_array($list_producer)) {
        $dataView['data']['list_producer']        = $list_producer;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_producer;
    }
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'] = "ID Hãng sản xuất không đúng!";
        return renderView($dataView);
    }
    $total_records = countProductProducer($id);
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
    $list   = allProductProducer($id,$offset);
    if (is_array($list)) {
        $dataView['data']['list_product_producer']   = $list;
        $dataView['total_pages']['product'] = $total_pages;
//        $dataView['msg']                             = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }

    renderView($dataView);

}

function listProductCategoryAction()
{
    $dataView = null;
    //lấy danh mục sản phẩm
    $list_category   = SelectListCategory();
    if (is_array($list_category)) {
        $dataView['data']['list_category']        = $list_category;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_category;
    }
    ////Lấy danh sách nhà sản xuất
    $list_producer   = SelectListProducer();
    if (is_array($list_producer)) {
        $dataView['data']['list_producer']        = $list_producer;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_producer;
    }
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'] = "ID Danh mục sản phẩm không đúng!";
        return renderView($dataView);
    }
    $total_records = countProductCategory($id);
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
    $list   = allProductCategory($id,$offset);
    if (is_array($list)) {
        $dataView['data']['list_product_category']   = $list;
        $dataView['total_pages']['product'] = $total_pages;
//        $dataView['msg']                             = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }

    renderView($dataView);

}

function indexAction()
{

    renderView();
}

function listAction()
{
    renderView();
}

function detailAction()
{
    $dataView = null;
    $list_category = SelectListCategory();
    if (is_array($list_category)) {
        $dataView['data']['list_category'] = $list_category;
        $dataView['msg']                 = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_category;
    }
    ////Lấy danh sách nhà sản xuất
    $list_producer = SelectListProducer();
    if (is_array($list_producer)) {
        $dataView['data']['list_producer'] = $list_producer;
        $dataView['msg']                   = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_producer;
    }
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'] = "ID sản phẩm không đúng!";
        return renderView($dataView);
    }
    $view_product = viewProduct($id);
    if (is_array($view_product)) {
        $dataView['data']['detail_product'] = $view_product;
        $dataView['msg']                  = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $view_product;
    }

    renderView($dataView);
}