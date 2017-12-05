<?php
require_once app_path . '/Model/AdminArticleModel.php';

function deleteArticleAction(){
    $dataView = null;
    $id = $_GET['id'];
    if(!is_numeric($id)){
        $dataView['msg'] = "Không tìm thấy id bài viết!";
        return renderView($dataView);
    }
    $row_info = Select_One_Article($id);
    if(is_array($row_info)){
        $dataView['data'] = $row_info;
    }
    else{
        $dataView['msg'] = $row_info;
    }
    if (isset($_POST['btnDelete'])) {
        $id_product = $_POST['id_bai_viet'];
        if ($id_product != $id) {
            $dataView ['msg'] = 'Không xác định ID bài viết!';
            renderView($dataView);
        } else {
            $res = delete_Article($id_product);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}
function editArticleAction()
{
    $dataView = null;
    if (!isset($_GET['id'])) {
        $dataView['msg'][] = "Không tìm thấy id bài viết";
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = "ID bài viết không đúng";
        return renderView($dataView);
    }
    $select_one_Art = Select_One_Article($id);
    if (!is_array($select_one_Art)) {
        $dataView['msg'][] = $select_one_Art;
//        return renderView($dataView);
    } else {
        $dataView['data']['article_edit'] = $select_one_Art;
//        renderView($dataView);
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
        $dataUpdate['tieu_de'] = checkStrSql($_POST['txt_tieu_de']);
        $dataUpdate['noi_dung'] = checkStrSql($_POST['txt_noi_dung']);
        $dataUpdate['id_danh_muc'] = $_POST['txt_danh_muc'];
        $name_img_article = get_img_article();
//        if($name_img_product===false){
//            $dataView['msg'][]="Lỗi tải ảnh";
//            return renderView($dataView);
//        }
        $dataUpdate['hinh_anh'] = $name_img_article;
        $dataUpdate['id'] = $id;
        $res = Update_Article($dataUpdate);
        if ($res === true) {
            $dataView['msg'][] = "Update thành công!";
            $select_one_Art['tieu_de'] = $dataUpdate['tieu_de'];
            $select_one_Art['noi_dung'] = $dataUpdate['noi_dung'];
            $select_one_Art['id_danh_muc'] = $dataUpdate['id_danh_muc'];
            $select_one_Art['hinh_anh'] = $dataUpdate['hinh_anh'];
            $dataView['data']['article_edit'] = $select_one_Art;
        } else
            $dataView['msg'][] = $res;
    }
    renderView($dataView);
}

function addArticleAction ()
{
    $dataView = null;
    $ds_danh_muc = select_Category();
    if (is_array($ds_danh_muc)) {
        $dataView['list_category'] = $ds_danh_muc;
    } else {
        $dataView['msg'][] = $ds_danh_muc;
    }
    $tacgia = '';
    if(isset($_SESSION['userLogin'])){
        $tacgia = $_SESSION['userLogin']['id'];
    }
    if (isset($_POST['btnSave'])) {
        $dataArticle = array();
        $dataArticle['tieu_de'] = checkStrSql($_POST['txt_tieu_de']);
        $dataArticle['noi_dung'] = checkStrSql($_POST['txt_noi_dung']);

        $dataArticle['nguoi_dang'] = $tacgia;
        $dataArticle['id_danh_muc'] = $_POST['txt_danh_muc'];
        $name_img_article = get_img_article();
        if($name_img_article===false){
            $dataView['msg'][]="Lỗi tải ảnh";
            return renderView($dataView);
        }
        $dataArticle['hinh_anh'] = $name_img_article;
        $res = insert_Article($dataArticle);
        if ($res === true) {
            $dataView['msg'][] = "Thêm mới thành công!";
        } else
            $dataView['msg'][] = $res;
    }
    renderView($dataView);
}

function listArticleAction()
{
    $dataView = null;
    $total_records = countArticle();
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
    $list = Select_All_Article($offset);
    if (is_array($list)) {
        $dataView['data'] = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg'] = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}

/**
 * Danh mục bài viết
 */
function deleteCategoryAction()
{
    $dataView = null;
    $id       = $_GET['id'];
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

function editCategoryAction()
{
    $dataView = null;
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID danh mục!';
        renderView($dataView);
    }
    if (isset($_POST['btnSave'])) {
        $ten_danh_muc     = $_POST['txt_danh_muc'];
        $res_validate = validateGroupName($ten_danh_muc);
        if ($res_validate === true) {
            // hợp lệ
            $res_update = UpdateCategory($id, $ten_danh_muc);
            if ($res_update === true) {
                $dataView['msg'][] = "Cập nhật tên danh mục thành công!";
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

function listCategoryAction()
{
    $dataView      = null;
    $total_records = countCategory();
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
    $list   = SelectListCategory($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}
function addCategoryAction()
{
    $dataView = null;
    if (isset($_POST['btnSave'])) {
        $ten_danh_muc     = $_POST['txt_danh_muc'];
        $res_validate = validateGroupName($ten_danh_muc);
        if ($res_validate === true) {
            // gọi hàm lưu vào CSDL
            $res_insert = InsertCategory($ten_danh_muc);
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