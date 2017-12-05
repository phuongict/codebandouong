<?php

function LoginDB($username, $pass){
    $sql = "select * from taikhoan where ten_dang_nhap = '$username'";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        return 'Lỗi lấy tài khoản '.mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        if($row['mat_khau'] == md5($pass)){
            return $row;
        }
        else{
            return 'Sai mật khẩu!';
        }
    }
    else{
        return 'Không tồn tại tài khoản: '.$username;
    }
}
function delete_User($id){
    $sql = "delete from taikhoan where id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        return "Lỗi: ".mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function Update_user($id, $id_nhom_tk, $password){
    $sql = "update taikhoan set id_nhom_tai_khoan = $id_nhom_tk";
    if(!empty($password)){
        $sql .= ",mat_khau = '$password' where id = $id";
    }
    else{
        $sql .= " where id = $id";
    }
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if($res === false){
        return "Lỗi đổi mật khẩu".mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function SELECT_One_user($id){
    $sql = "select * from taikhoan where id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return 'Lỗi lấy thông tin tài khoản: '.mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)<1){
        return 'Không tồn tại tài khoản có id = '.$id;
    }
    $row = mysqli_fetch_assoc($res);
    return $row;
}

function select_list_user($offset = 0){
    $limit = _admin_page_limit;
    $sql="select taikhoan.id,taikhoan.ten_dang_nhap,taikhoan.email,nhomtaikhoan.ten_nhom 
          from taikhoan,nhomtaikhoan
          where taikhoan.id_nhom_tai_khoan = nhomtaikhoan.id LIMIT $offset,$limit";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        $return_data = "Lỗi lấy danh sách: ". mysqli_error($GLOBALS['conn']);
        return $return_data;
    }

    $return_data = array();
    while ($row = mysqli_fetch_assoc($res)){
        $return_data[] = $row;
    }

    return $return_data;
}
function countUser(){

    $sql = "SELECT COUNT(id) FROM taikhoan";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
}
function Insert_tai_khoan($params){
    
    $ten_dang_nhap = $params['ten_dang_nhap'];
    $mat_khau = $params['mat_khau'];
    $email = $params['email'];
    $id_nhom_tai_khoan = $params['id_nhom_tai_khoan'];
    
    $sql = "INSERT INTO taikhoan (ten_dang_nhap,mat_khau,email,id_nhom_tai_khoan) VALUES ('$ten_dang_nhap','$mat_khau','$email','$id_nhom_tai_khoan')";

    $res = mysqli_query($GLOBALS['conn'],$sql);

    if($res ===false){
        return "Lỗi INSERT: ". mysqli_error($GLOBALS['conn']);
    }

    return true;

}