<?php
require_once app_path . '/Model/AdminGroupModel.php';

function editPermissionAction()
{
    $dataView = null;
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID nhóm!';
        return renderView($dataView);
    }
    if (isset($_POST['btnSave'])) {
        $array_chuc_nang = array();
        foreach ($_POST as $param_name => $value) {
            if (substr($param_name, 0, 3) == 'cn_') {
                $array_chuc_nang[] = intval(str_replace('cn_', '', $param_name));
            }
        }
        $res = UpdatePermission($id, $array_chuc_nang);
        foreach ($res as $msg)
            $dataView['msg'][] = $msg;
    }
    $row_info = SelectOneGroup($id);
    if (is_array($row_info)) {
        $dataView['info'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    $list_func = SelectAllFunc();
    if (is_array($list_func)) {
        $dataView['list_func'] = $list_func;
    } else {
        $dataView['msg'][] = $list_func;  // có lỗi
    }
    $list_pms = SelectEnabledPermission($id);
    if (is_array($list_pms)) {
        $dataView['list_pms'] = $list_pms;
    } else {
        $dataView['msg'][] = $list_pms;  // có lỗi
    }
    renderView($dataView);
}

function listPermissionAction()
{
    $dataView      = null;
    $total_records = countPermission();
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
    $list   = Select_All_Permission($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}

function deletefuncAction()
{
    $dataView = null;
    $id       = @$_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID chức năng!';
        renderView($dataView);
    }
    $row_info = Select_One_Func($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    if (isset($_POST['btnDelete'])) {
        $id_func = $_POST['id_func'];
        if ($id_func != $id) {
            $dataView ['msg'] = 'Không xác định ID chức năng!';
            renderView($dataView);
        } else {
            $res = DeleteFunc($id_func);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}

function listfuncAction()
{
    $dataView      = null;
    $total_records = countFunc();
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
    $list   = Select_All_Func($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}

function editfuncAction()
{
    $dataView = null;
    if (!isset($_GET['id'])) {
        $dataView['msg'] = "Không tồn tại id: " . $_GET['id'];
        return renderView($dataView);
    }
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'] = "id không đúng!";
        renderView($dataView);
    }
    $res_row = Select_One_Func($id);
    if (is_array($res_row)) {
        $dataView['data'] = $res_row;
    } else
        $dataView['msg'] = $res_row;
    $dataSend = array();
    if (isset($_POST['btnSave'])) {
        $dataSend['ten_chuc_nang'] = $_POST['txt_ten_chuc_nang'];
        $dataSend['link']          = $_POST['txt_link'];
        $dataSend['id']            = $id;
        $res                       = edit_Func($dataSend);
        if ($res === true) {
            $dataView['msg'] = "Cập nhật thành công!";
            $res_row['ten_chuc_nang'] = $dataSend['ten_chuc_nang'];
            $res_row['link'] = $dataSend['link'];
            $dataView['data'] = $res_row;
            renderView($dataView);
        } else {
            $dataView['msg'] = $res;
            return renderView($dataView);
        }
    }
    renderView($dataView);
}

function addfuncAction()
{
    $dataView = null;
    if (isset($_POST['btnSave'])) {
        $ten_chuc_nang = $_POST['txt_ten_chuc_nang'];
        $link          = $_POST['txt_link'];
        $res           = add_Func($ten_chuc_nang, $link);
        if ($res === true) {
            $dataView['msg'] = "Thêm mới thành công!";
            return renderView($dataView);
        }
        return renderView($res);
    }
    renderView($dataView);
}

function deleteAction()
{
    $dataView = null;
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID nhóm!';
        renderView($dataView);
    }
    $row_info = SelectOneGroup($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    if (isset($_POST['btnDelete'])) {
        $id_nhom = $_POST['id_nhom'];
        if ($id_nhom != $id) {
            $dataView ['msg'] = 'Không xác định ID nhóm!';
            renderView($dataView);
        } else {
            $res = DeleteGroup($id_nhom);
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
//    ?controller=admin-group&action=edit&id=12
    $dataView = null;
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'][] = 'Không xác định ID nhóm!';
        renderView($dataView);
    }
    if (isset($_POST['btnSave'])) {
        $ten_nhom     = $_POST['txt_ten_nhom'];
        $res_validate = validateGroupName($ten_nhom);
        if ($res_validate === true) {
            // hợp lệ
            $res_update = Update_ten_nhom($id, $ten_nhom);
            if ($res_update === true) {
                $dataView['msg'][] = "Cập nhật tên nhóm thành công!";
            } else
                $dataView['msg'][] = $res_update;
        } else {
            // in ra thông báo
            $dataView['msg'][] = $res_validate;
        }
    }
    $row_info = SelectOneGroup($id);
    if (is_array($row_info)) {
        $dataView['data'] = $row_info;
    } else {
        $dataView['msg'][] = $row_info;  // có lỗi
    }
    renderView($dataView);
}

function listAction()
{
    $dataView      = null;
    $total_records = countNhomTK();
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
    $list   = Select_list_nhom_tk($offset);
    if (is_array($list)) {
        $dataView['data']        = $list;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }
    renderView($dataView);
}

function indexAction()
{
    renderView();
}

function addAction()
{
    $dataView = null;
    if (isset($_POST['btnSave'])) {
        $ten_nhom     = $_POST['txt_ten_nhom'];
        $res_validate = validateGroupName($ten_nhom);
        if ($res_validate === true) {
            // gọi hàm lưu vào CSDL
            $res_insert = Insert_nhom_tk($ten_nhom);
            if ($res_insert === true) {
                $dataView['msg'] = "Thêm nhóm mới thành công!";
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

function permissionAction()
{
    renderView();
}
