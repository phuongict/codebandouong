<?php


function delete_Article($id){
    $sql = "delete from baiviet where id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        return "Lỗi không tồn tại: ".mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function Update_Article($dataArticle = null)
{
    $tieu_de = $dataArticle['tieu_de'];
    $noi_dung = $dataArticle['noi_dung'];
    $id_danh_muc = $dataArticle['id_danh_muc'];
    $hinh_anh = $dataArticle['hinh_anh'];
    $update_anh = '';
    if(!empty($hinh_anh)){
        $update_anh = ",hinh_anh = '$hinh_anh'";
    }
    $id = $dataArticle['id'];
    $sql = "update baiviet set tieu_de = '$tieu_de',noi_dung = '$noi_dung',id_danh_muc = $id_danh_muc $update_anh
            where id = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi cập nhật bài viết " . mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function Select_One_Article($id)
{
    $sql = "select baiviet.id,tieu_de,noi_dung,ngay_dang,id_tai_khoan,taikhoan.ten_dang_nhap,danhmucbaiviet.ten_danh_muc,id_danh_muc,hinh_anh 
            from baiviet,danhmucbaiviet,taikhoan
            WHERE baiviet.id_tai_khoan = taikhoan.id
            and baiviet.id_danh_muc = danhmucbaiviet.id
            and baiviet.id =$id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi lấy dữ liệu " . mysqli_error($GLOBALS['conn']);
    } else
        $row = mysqli_fetch_assoc($res);
    return $row;
}
function insert_Article($dataArticle = null)
{
    $tieude = $dataArticle['tieu_de'];
    $noidung = $dataArticle['noi_dung'];
    $nguoidang = $dataArticle['nguoi_dang'];
    $id_danh_muc = $dataArticle['id_danh_muc'];
    $hinh_anh = $dataArticle['hinh_anh'];
    $sql = "insert into baiviet(tieu_de,noi_dung,id_tai_khoan,id_danh_muc,hinh_anh)
            values ('$tieude','$noidung','$nguoidang','$id_danh_muc','$hinh_anh')";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi thêm bài viết" . mysqli_error($GLOBALS['conn']);
    } else
        return true;
}
function select_Category()
{
    $sql = "select id,ten_danh_muc from danhmucbaiviet";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_errno($GLOBALS['conn'])) {
        $return_data = "Lỗi lấy danh sách: " . mysqli_error($GLOBALS['conn']);
        return $return_data;
    }
    $return_data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $return_data[] = $row;
    }
    return $return_data;
}
function Select_All_Article($offset = 0)
{
    $dataArticle = null;
    $article_show_limit = _admin_page_limit;
    $sql = "select baiviet.id,tieu_de,noi_dung,ngay_dang,id_tai_khoan,taikhoan.ten_dang_nhap,danhmucbaiviet.ten_danh_muc,id_danh_muc,hinh_anh 
            from baiviet,danhmucbaiviet,taikhoan
            WHERE baiviet.id_tai_khoan = taikhoan.id
            and baiviet.id_danh_muc = danhmucbaiviet.id
            LIMIT $offset,$article_show_limit";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataArticle = "Lỗi không thể lấy dữ liệu " . mysqli_error($GLOBALS['conn']);
        return $dataArticle;
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            $dataArticle[] = $row;
        }
        return $dataArticle;
    }
}
function countArticle()
{
    $dataCount = null;
    $sql = "select count(id) from baiviet";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataCount = "Lỗi đếm bài viết " . mysqli_error($GLOBALS['conn']);
        return $dataCount;
    } else
        $row = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}
function DeleteCategory($id){
    $sql = "DELETE FROM danhmucbaiviet WHERE id=$id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi Xóa: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function SelectOneCategory($id){
    $sql = "SELECT * FROM danhmucbaiviet WHERE id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return  "Lỗi lấy thông tin danh mục cần sửa: ". mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    else{
        return 'Không tồn tại danh mục có ID là '.$id;
    }
}
function UpdateCategory($id, $ten_danh_muc){
    $sql = "UPDATE danhmucbaiviet SET ten_danh_muc = '$ten_danh_muc' WHERE id=$id ";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi UPDATE: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function SelectListCategory( $offset = 0){
    $return_data = null;
    $limit = _admin_page_limit;
    $sql = "SELECT * FROM danhmucbaiviet ORDER BY id ASC LIMIT $offset,$limit";
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
function countCategory(){

    $sql = "SELECT COUNT(id) FROM danhmucbaiviet";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
}
function InsertCategory($ten_danh_muc){
    if(empty($ten_danh_muc))
        return "Lỗi INSERT: Tên danh mục không được rỗng!";
    $sql = "INSERT INTO danhmucbaiviet (ten_danh_muc) VALUES ('$ten_danh_muc')";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi INSERT: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}