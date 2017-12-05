<?php
require_once app_path . '/Model/AdminProductModel.php';

function viewOrderAction(){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID đơn hàng!';
        renderView($dataView);
    }
    $list   = SelectOneOrderView($id);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}
function updateOrderAction(){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID đơn hàng!';
        renderView($dataView);
    }
    if (isset($_POST['btnSave'])) {
        $trang_thai     = $_POST['txt_trang_thai'];
//        $res_validate = validateGroupName($trang_thai);
//        if ($res_validate === true) {
            // hợp lệ
        $regex_order = '/^1|-1|0$/';
        if(!preg_match($regex_order,$trang_thai)){
            $dataView['msg'][] = "Trạng thái không đúng";
            return renderView($dataView);
        }
            $res_update = Update_Order($id, $trang_thai);
            if ($res_update === true) {
                $dataView['msg'][] = "Cập nhật trạng thái thành công!";
            } else
                $dataView['msg'][] = $res_update;
        }
// else {
//            // in ra thông báo
//            $dataView['msg'][] = $res_validate;
//        }
//    }
    $row_info = SelectOneOrder($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    renderView($dataView);
}
function listOrderAction(){
    $dataView      = null;
    $total_records = countOrder();
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _admin_page_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Chưa có dữ liệu!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _admin_page_limit;
    $list   = Select_list_Order($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}
/**
 * Hãng sản xuất
 */
function deleteProducerAction(){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID hãng!';
        renderView($dataView);
    }
    $row_info = SelectOneProducer($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    if (isset($_POST['btnDelete'])) {
        $id_hang = $_POST['id_hang'];
        if ($id_hang != $id) {
            $dataView ['msg'] = 'Không xác định ID hãng sản xuất!';
            renderView($dataView);
        } else {
            $res = DeleteProducer($id_hang);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}
function editProducerAction(){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID hãng!';
        renderView($dataView);
    }
    if (isset($_POST['btnSave'])) {
        $ten_hang     = $_POST['txt_hang'];
        $res_validate = validateGroupName($ten_hang);
        if ($res_validate === true) {
            // hợp lệ
            $res_update = Update_Producer($id, $ten_hang);
            if ($res_update === true) {
                $dataView['msg'][] = "Cập nhật hãng thành công!";
            } else
                $dataView['msg'][] = $res_update;
        } else {
            // in ra thông báo
            $dataView['msg'][] = $res_validate;
        }
    }
    $row_info = SelectOneProducer($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    renderView($dataView);
}
function listProducerAction(){
    $dataView      = null;
    $total_records = countProducer();
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _admin_page_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Chưa có dữ liệu!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _admin_page_limit;
    $list   = Select_list_Producer($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}
function addProducerAction(){
    $dataView = null;
    if (isset($_POST['btnSave'])) {
        $ten_hang    = $_POST['txt_hang'];
        $res_validate = validateGroupName($ten_hang);
        if ($res_validate === true) {
            // gọi hàm lưu vào CSDL
            $res_insert = InsertProducer($ten_hang);
            if ($res_insert === true) {
                $dataView['msg'] = "Thêm hãng mới thành công!";
            } else
                $dataView['msg'] = $res_insert;
        } else {
            // in ra thông báo
            $dataView['msg'] = $res_validate;
            return renderView($dataView);
        }
    }
    renderView($dataView);
}

/**
 * Danh mục sản phẩm
 */
function deleteCategoryAction(){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID danh mục!';
        renderView($dataView);
    }
    $row_info = SelectOneCategory($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    if (isset($_POST['btnDelete'])) {
        $id_danh_muc = $_POST['id_danh_muc'];
        if ($id_danh_muc != $id) {
            $dataView ['msg'] = 'Không xác định ID danh mục!';
            renderView($dataView);
        } else {
            $res = DeleteCategory($id_danh_muc);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}
function editCategoryAction(){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID danh mục!';
        renderView($dataView);
    }
    if (isset($_POST['btnSave'])) {
        $ten_danh_muc     = $_POST['txt_danh_muc'];
        $res_validate = validateGroupName($ten_danh_muc);
        if ($res_validate === true) {
            // hợp lệ
            $res_update = Update_danh_muc($id, $ten_danh_muc);
            if ($res_update === true) {
                $dataView['msg'][] = "Cập nhật danh mục thành công!";
            } else
                $dataView['msg'][] = $res_update;
        } else {
            // in ra thông báo
            $dataView['msg'][] = $res_validate;
        }
    }
    $row_info = SelectOneCategory($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    renderView($dataView);
}
function listCategoryAction(){
    $dataView      = null;
    $total_records = countDanhMucSP();
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _admin_page_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Chưa có dữ liệu!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _admin_page_limit;
    $list   = Select_list_danh_muc_sp($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}
function addCategoryAction(){
    $dataView = null;
    if (isset($_POST['btnSave'])) {
        $ten_danh_muc     = $_POST['txt_danh_muc'];
        $res_validate = validateGroupName($ten_danh_muc);
        if ($res_validate === true) {
            // gọi hàm lưu vào CSDL
            $res_insert = Insert_danh_muc_sp($ten_danh_muc);
            if ($res_insert === true) {
                $dataView['msg'] = "Thêm danh mục mới thành công!";
            } else
                $dataView['msg'] = $res_insert;
        } else {
            // in ra thông báo
            $dataView['msg'] = $res_validate;
            return renderView($dataView);
        }
    }
    renderView($dataView);
}

/**
 * Sản phẩm
 */
function deleteAction(){
    $dataView = null;
    $id = $_GET['id'];
    if(!is_numeric($id)){
        $dataView['msg'] = "Không tìm thấy id sản phẩm!";
        return renderView($dataView);
    }
    $row_info = Select_One_Product($id);
    if(is_array($row_info)){
        $dataView['data'] = $row_info;
    }
    else{
        $dataView['msg'] = $row_info;
    }
    if (isset($_POST['btnDelete'])) {
        $id_product = $_POST['id_san_pham'];
        if ($id_product != $id) {
            $dataView ['msg'] = 'Không xác định ID sản phẩm!';
            renderView($dataView);
        } else {
            $res = delete_Product($id_product);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}
function editAction()
{
    $dataView = null;
    if (!isset($_GET['id'])) {
        $dataView['msg'][] = "Không tìm thấy id sản phẩm";
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = "ID sản phẩm không đúng";
        return renderView($dataView);
    }
    $select_one_pro = Select_One_Product($id);
    if (!is_array($select_one_pro)) {
        $dataView['msg'][] = $select_one_pro;
//        return renderView($dataView);
    } else {
        $dataView['data']['product_edit'] = $select_one_pro;
//        renderView($dataView);
    }
    $select_user = select_User();
    if (is_array($select_user)) {
        $dataView['data']['list_user'] = $select_user;
//        renderView($dataView);
    } else {
        $dataView['msg'][] = $select_user;
//        return renderView($dataView);
    }
    $select_hang = select_Hang_Sx();
    if (is_array($select_hang)) {
        $dataView['data']['list_hang'] = $select_hang;
//        renderView($dataView);
    } else {
        $dataView['msg'][] = $select_hang;
//        return renderView($dataView);
    }
    $select_category = select_Category();
    if (is_array($select_category)) {
        $dataView['data']['list_category'] = $select_category;
//        renderView($dataView);
    } else {
        $dataView['msg'][] = $select_category;
//        return renderView($dataView);
    }
    $dataUpdate = array();
    if (isset($_POST['btnSave'])) {
        $dataUpdate['ten_san_pham'] = $_POST['txt_ten_san_pham'];
        $dataUpdate['loai'] = $_POST['txt_loai'];
        $dataUpdate['mo_ta'] = $_POST['txt_mo_ta'];
        $dataUpdate['gia'] = $_POST['txt_gia'];
        $dataUpdate['giam_gia'] = $_POST['txt_giam_gia'];
        $dataUpdate['thanh_phan'] = $_POST['txt_thanh_phan'];
        $dataUpdate['id_hang_sx'] = $_POST['txt_hang_san_xuat'];
        $name_img_product = get_img_product();
//        if($name_img_product===false){
//            $dataView['msg'][]="Lỗi tải ảnh";
//            return renderView($dataView);
//        }
        $dataUpdate['hinh_anh'] = $name_img_product;
        $dataUpdate['id_tai_khoan'] = $_POST['txt_user'];
        $dataUpdate['id_danh_muc'] = $_POST['txt_danh_muc'];
        $dataUpdate['id'] = $id;
        $res = Update_Product($dataUpdate);
        if ($res === true) {
            $dataView['msg'][] = "Update thành công!";
            $select_one_pro['ten_san_pham'] = $dataUpdate['ten_san_pham'];
            $select_one_pro['loai'] = $dataUpdate['loai'];
            $select_one_pro['mo_ta'] = $dataUpdate['mo_ta'];
            $select_one_pro['gia'] = $dataUpdate['gia'];
            $select_one_pro['giam_gia'] = $dataUpdate['giam_gia'];
            $select_one_pro['thanh_phan'] = $dataUpdate['thanh_phan'];
            $select_one_pro['id_hang_sx'] = $dataUpdate['id_hang_sx'];
            $select_one_pro['hinh_anh'] = $dataUpdate['hinh_anh'];
            $select_one_pro['id_tai_khoan'] = $dataUpdate['id_tai_khoan'];
            $select_one_pro['id_danh_muc'] = $dataUpdate['id_danh_muc'];
            $dataView['data']['product_edit'] = $select_one_pro;
        } else
            $dataView['msg'][] = $res;
    }
    renderView($dataView);
}

function addAction()
{
    $dataView = null;
    $ds_danh_muc = select_Category();
//    $ds_tai_khoan = select_User();
    $ds_hang_sx = select_Hang_Sx();
    if (is_array($ds_danh_muc)) {
        $dataView['list_category'] = $ds_danh_muc;
    } else {
        $dataView['msg'][] = $ds_danh_muc;
    }
//    if (is_array($ds_tai_khoan)) {
//        $dataView['list_user'] = $ds_tai_khoan;
//    } else {
//        $dataView['msg'][] = $ds_tai_khoan;
//    }
    $userPost = '';
    if(isset($_SESSION['userLogin'])){
        $userPost = $_SESSION['userLogin']['id'];
    }
    if (is_array($ds_hang_sx)) {
        $dataView['list_hang_sx'] = $ds_hang_sx;
    } else {
        $dataView['msg'][] = $ds_hang_sx;
    }
    if (isset($_POST['btnSave'])) {
        $dataProduct = array();
        $dataProduct['ten_san_pham'] = $_POST['txt_ten_san_pham'];
        $dataProduct['loai'] = $_POST['txt_loai'];
        $dataProduct['mo_ta'] = $_POST['txt_mo_ta'];
        $dataProduct['gia'] = $_POST['txt_gia'];
        $dataProduct['giam_gia'] = $_POST['txt_giam_gia'];
        $dataProduct['thanh_phan'] = $_POST['txt_thanh_phan'];
        $dataProduct['id_hang_sx'] = $_POST['txt_hang_san_xuat'];
        $name_img_product = get_img_product();
        if($name_img_product===false){
            $dataView['msg'][]="Lỗi tải ảnh";
            return renderView($dataView);
        }
        $dataProduct['hinh_anh'] = $name_img_product;
        $dataProduct['id_tai_khoan'] = $userPost;
        $dataProduct['id_danh_muc'] = $_POST['txt_danh_muc'];
        $res = insert_Product($dataProduct);
        if ($res === true) {
            $dataView['msg'][] = "Thêm mới thành công!";
        } else
            $dataView['msg'][] = $res;
    }

    renderView($dataView);
}

function listAction()
{
    $dataView = null;
    $total_records = countProduct();
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _admin_page_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Chưa có dữ liệu!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _admin_page_limit;
    $list = Select_All_Product($offset);
    if (is_array($list)) {
        $dataView['data'] = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg'] = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}

?>