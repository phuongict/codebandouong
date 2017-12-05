<?php
require_once app_path . '/Model/AdminContactModel.php';
function deleteContactAction(){
    $dataView = null;
    $id = $_GET['id'];
    if(!is_numeric($id)){
        $dataView['msg'] = "Không tìm thấy id liên hệ!";
        return renderView($dataView);
    }
    $row_info = SelectOneContactView($id);
    if(is_array($row_info)){
        $dataView['data'] = $row_info;
    }
    else{
        $dataView['msg'] = $row_info;
    }
    if (isset($_POST['btnDelete'])) {
        $id_contact = $_POST['id_lien_he'];
        if ($id_contact != $id) {
            $dataView ['msg'] = 'Không xác định ID liên hệ!';
            renderView($dataView);
        } else {
            $res = deleteContact($id_contact);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}
function viewContactAction (){
    $dataView = null;
    if(!isset($_GET['id'])){
        $dataView['msg'][] = 'Không tồn tại ID';
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID liên hệ!';
        renderView($dataView);
    }
    $list   = SelectOneContactView($id);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}
function listContactAction()
{
    $dataView      = null;
    $total_records = countContact();
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
    $list   = SelectListContact($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}