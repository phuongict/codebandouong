<?php
require_once app_path.'/Model/AdminUserModel.php';
require_once app_path.'/Model/AdminGroupModel.php';

function deleteAction(){
    $dataView = null;
    $id = $_GET['id'];
    if(!is_numeric($id)){
        $dataView['msg'] = "ID tài khoản không đúng!";
        return renderView($dataView);
    }
    $row_info = SELECT_One_user($id);
    if(is_array($row_info)){
        $dataView['data'] = $row_info;
    }
    else{
        $dataView['msg'][] = $row_info;
    }
    if (isset($_POST['btnDelete'])) {
        $id_user = $_POST['id_user'];
        if ($id_user != $id) {
            $dataView ['msg'] = 'Không xác định ID tài khoản!';
            renderView($dataView);
        } else {
            $res = delete_User($id_user);
            if ($res === true) {
                $dataView ['msg'] = "Xóa thành công!";
            } else
                $dataView ['msg'] = $res;
        }
    }
    renderView($dataView);
}
function editAction(){
    $dataView = null;
    $id = $_GET['id'];
    if(!is_numeric($id)){
        $dataView['msg'][] = "ID cần nhập số";
        return renderView($dataView);
    }
    if(isset($_POST['btnSave'])){
        $id_nhom_tk = $_POST['txt_id_nhom_tai_khoan'];
            $mat_khau = $_POST['txt_mat_khau'];
            $mat_khau_2 = $_POST['txt_mat_khau_2'];
            if(!empty($mat_khau)) {
                $res_validate_password = validatePassword($mat_khau, $mat_khau_2);
                if ($res_validate_password === true) {
                    $mat_khau = md5($mat_khau);
                    $res_update = Update_user($id, $id_nhom_tk, $mat_khau);
                    if ($res_update === true) {
                        $dataView['msg'][] = "Cập nhật thành công!";
                    } else {
                        $dataView['msg'][] = $res_update;
                    }
                } else {
                    $dataView['msg'][] = $res_validate_password;
                }
            }
            else{
                $res_update = Update_user($id, $id_nhom_tk, $mat_khau);
                if ($res_update === true) {
                    $dataView['msg'][] = "Cập nhật thành công!";
                } else {
                    $dataView['msg'][] = $res_update;
                }
            }
    }
    //Lấy danh sách nhóm
    $ds_nhom = Select_All_Group();
    if(is_array($ds_nhom)){
        $dataView['list_group'] = $ds_nhom;
    }
    else
    {
        $dataView['msg'][] = $ds_nhom;
    }
    // Lấy thông tin ra
    $user_info = SELECT_One_user($id);
    if(is_array($user_info)){
        $dataView['info'] = $user_info;
    }
    else{
        $dataView['msg'][]=$user_info;
    }
    renderView($dataView);
}
function listAction(){
    $dataView = null;
    $total_records = countUser();
    if(!is_numeric($total_records)){
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records/_admin_page_limit);
    if($total_pages<1){
        $dataView['msg'] = 'Chưa có dữ liệu';
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _admin_page_limit;
    $list_user = select_list_user($offset);
    if (is_array($list_user)) {
        $dataView['data'] = $list_user;
        $dataView['total_pages'] = $total_pages;
        $dataView['msg'] = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_user;
    }
    renderView($dataView);
}
function addAction(){
    $dataView = null;
    // lấy danh sách nhóm tài khoản
    $ds_nhom = Select_All_Group();
    if(is_array($ds_nhom)){
        $dataView['list_group'] = $ds_nhom;
    }
    else
    {
        $dataView['msg'][] = $ds_nhom;
    }
    if(isset($_POST['btnSave'])){

        // thu giá trị
        $ten_dang_nhap = $_POST['txt_ten_dang_nhap'];
        $mat_khau = $_POST['txt_mat_khau'];
        $mat_khau_2 = $_POST['txt_mat_khau_2'];
        $email = $_POST['txt_email'];
        $id_nhom_tai_khoan = intval($_POST['txt_id_nhom_tai_khoan']);
        //Ktra đkiện:
        //- Tên đăng nhập: gồm chữ cái và số, từ 6 đến 30 ký tự
        //- Mật khẩu: Không để trống, xác nhận bằng nhau
        //- Email: theo chuẩn email VD: gmail...
        // Id nhóm tài khoản: phải là kiểu số và lớn hơn 0
        $res_validate_username = validateUsername($ten_dang_nhap);
        if($res_validate_username !== true){
            $dataView['msg'][] = $res_validate_username;
            return renderView($dataView);
        }
        if($mat_khau != $mat_khau_2){
            $dataView['msg'][] = "Xác nhận mật khẩu không đúng!";
            return renderView($dataView);
        }
        // đến đây coi như đã kiểm tra hợp lệ xong.
        // lưu vào CSDL:
        $mat_khau = md5($mat_khau);
        $data_save = array('ten_dang_nhap'=>$ten_dang_nhap,'mat_khau'=>$mat_khau,'email'=>$email,'id_nhom_tai_khoan'=>$id_nhom_tai_khoan);
        $res_insert =  Insert_tai_khoan($data_save);
        if($res_insert === true){
            $dataView['msg'][] = "Thêm tài khoản mới thành công!";
        }
        else
            $dataView['msg'][] = $res_insert;

    }


    renderView($dataView);
}