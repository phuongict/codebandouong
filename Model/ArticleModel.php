<?php


function allArticleCategory($id,$offset = 0){
    $datareturn = null;
    $article_show_limit =_product_limit;
    $sql = "select baiviet.id,tieu_de,noi_dung,baiviet.ngay_dang,id_tai_khoan,id_danh_muc,hinh_anh,danhmucbaiviet.ten_danh_muc,ten_dang_nhap
            from baiviet,danhmucbaiviet,taikhoan
            WHERE baiviet.id_tai_khoan = taikhoan.id
            AND   baiviet.id_danh_muc = danhmucbaiviet.id
            and id_danh_muc = $id ORDER by id DESC LIMIT $offset,$article_show_limit";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res == false){
        $datareturn = "Lỗi lấy dữ liệu: ".mysqli_error($GLOBALS['conn']);
        return $datareturn;
    }
    else{
        if(mysqli_num_rows($res)==0){
            $datareturn = "Chưa có bài viết nào";
            return $datareturn;
        }
        while($row = mysqli_fetch_assoc($res)){
            $datareturn[] = $row;
        }
    }
    return $datareturn;
}
function countProductArticle($id)
{
    $dataCount = null;
    $sql = "select count(id) from baiviet where id_danh_muc = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataCount = "Lỗi đếm bài viết " . mysqli_error($GLOBALS['conn']);
        return $dataCount;
    } else
        $row = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}
function viewArticle($id){
    $sql = "select baiviet.id,tieu_de,noi_dung,baiviet.ngay_dang,id_tai_khoan,id_danh_muc,hinh_anh,danhmucbaiviet.ten_danh_muc,ten_dang_nhap
            from baiviet,danhmucbaiviet,taikhoan
            WHERE baiviet.id_tai_khoan = taikhoan.id
            AND   baiviet.id_danh_muc = danhmucbaiviet.id
            AND   baiviet.id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res == false){
        return "Lỗi lấy dữ liệu: ".mysqli_error($GLOBALS['conn']);
    }
    else
        $row = mysqli_fetch_assoc($res);
    return $row;
}