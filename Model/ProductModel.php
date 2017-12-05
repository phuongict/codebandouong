<?php


function insertDetailOrder($id_product,$qt,$price,$resOrder){
    $sql_detail = "INSERT INTO chitietdonhang (id_don_hang,id_san_pham,so_luong,don_gia) VALUES($resOrder,$id_product,$qt,$price)";
    $dataReturn = null;
    $res = mysqli_query($GLOBALS['conn'], $sql_detail);
    if (mysqli_errno($GLOBALS['conn'])) {
        $dataReturn = "Lỗi ghi thông tin chi tiết đơn hàng đơn hàng vào CSDL " . mysqli_error($GLOBALS['conn']);
        return $dataReturn;
    }
    return true;
}
function insertOrder($params = null){
    $hoten = $params['hoten'];
    $dienthoai = $params['dienthoai'];
    $email = $params['email'];
    $diachi = $params['diachi'];
    $ghichu = $params['ghichu'];
    $sql = "INSERT INTO donhang (trang_thai,ho_ten, dia_chi, dien_thoai, email, ghi_chu) VALUES (0,'$hoten','$diachi','$dienthoai','$email','$ghichu')";
    $dataReturn = null;
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_errno($GLOBALS['conn'])) {
        $dataReturn = "Lỗi ghi thông tin đơn vào CSDL " . mysqli_error($GLOBALS['conn']);
        return $dataReturn;
    }
    $dataReturn = mysqli_insert_id($GLOBALS['conn']);
    return $dataReturn;
}
function SelectProductItem($params){
    $sql = "SELECT * FROM sanpham WHERE  id IN ($params)";
    $data = null;
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_errno($GLOBALS['conn'])) {
        $data =  "Lỗi lấy danh sách " . mysqli_error($GLOBALS['conn']);
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
    }
    return $data;
}
function allProductProducer($id,$offset = 0){
    $datareturn = null;
    $product_show_limit =_product_limit;
    $sql = "select sanpham.id,ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,ngay_thang,hinh_anh,id_tai_khoan,hangsx.ten_hang
            from sanpham,hangsx
            WHERE sanpham.id_hang_sx = hangsx.id
            and
            id_hang_sx = $id LIMIT $offset,$product_show_limit";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res == false){
        $datareturn = "Lỗi lấy dữ liệu: ".mysqli_error($GLOBALS['conn']);
        return $datareturn;
    }
    else{
        if(mysqli_num_rows($res)==0){
            $datareturn = "Chưa có sản phẩm nào";
            return $datareturn;
        }
        while($row = mysqli_fetch_assoc($res)){
            $datareturn[] = $row;
        }
    }
    return $datareturn;
}
function countProductProducer($id)
{
    $dataCount = null;
    $sql = "select count(id) from sanpham where id_hang_sx = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataCount = "Lỗi đếm sản phẩm " . mysqli_error($GLOBALS['conn']);
        return $dataCount;
    } else
        $row = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}
function countProductCategory($id)
{
    $dataCount = null;
    $sql = "select count(id) from sanpham where id_danh_muc = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataCount = "Lỗi đếm sản phẩm " . mysqli_error($GLOBALS['conn']);
        return $dataCount;
    } else
        $row = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}
function allProductCategory($id,$offset = 0){
    $datareturn = null;
    $product_show_limit =_product_limit;
    $sql = "select sanpham.id,ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,ngay_thang,hinh_anh,id_tai_khoan,danhmucsp.ten_danh_muc
            from sanpham,danhmucsp
            WHERE sanpham.id_danh_muc = danhmucsp.id
            and
            id_danh_muc = $id LIMIT $offset,$product_show_limit";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res == false){
        $datareturn = "Lỗi lấy dữ liệu: ".mysqli_error($GLOBALS['conn']);
        return $datareturn;
    }
    else{
        if(mysqli_num_rows($res)==0){
            $datareturn = "Chưa có sản phẩm nào";
            return $datareturn;
        }
        while($row = mysqli_fetch_assoc($res)){
            $datareturn[] = $row;
        }
    }
    return $datareturn;
}
function viewProduct($id){
    $sql = "select sanpham.id,ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,ngay_thang,hinh_anh,id_tai_khoan,id_danh_muc,ten_hang,ten_danh_muc
            from sanpham,danhmucsp,hangsx 
            WHERE  sanpham.id_danh_muc = danhmucsp.id
            AND sanpham.id_hang_sx = hangsx.id
            AND sanpham.id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res == false){
        return "Lỗi lấy dữ liệu: ".mysqli_error($GLOBALS['conn']);
    }
    else
        $row = mysqli_fetch_assoc($res);
    return $row;
}