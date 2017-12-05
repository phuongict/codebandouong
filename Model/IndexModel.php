<?php


function countProductSearch($param)
{
    $dataCount = null;
    $sql = "select count(id) from sanpham WHERE ten_san_pham like '%$param%'";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataCount = "Lỗi đếm sản phẩm " . mysqli_error($GLOBALS['conn']);
        return $dataCount;
    } else
        $row = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}
function searchProduct($param,$offset = 0){
    $dataReturn = null;
    $product_show_limit =_product_limit;
    $sql = "select * from sanpham WHERE ten_san_pham like '%$param%' LIMIT $offset,$product_show_limit";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        $dataReturn = "Lỗi tìm sản phẩm".mysqli_error($GLOBALS['conn']);
        return $dataReturn;
    }
    $row_num = mysqli_num_rows($res);
    if($row_num > 0 && $param != ''){
        while($row = mysqli_fetch_assoc($res)){
            $dataReturn[] = $row;
        }
    }
    else{
        $dataReturn = "Không thấy sản phẩm cần tìm!";
    }
    return $dataReturn;
}
function InsertContact($params = null){
    $tieu_de = $params['tieu_de'];
    $noi_dung = $params['noi_dung'];
    $ho_ten = $params['ho_ten'];
    $dia_chi = $params['dia_chi'];
    $dien_thoai = $params['dien_thoai'];
    $email = $params['email'];
    $sql = "insert into lienhe(tieu_de,noi_dung,ho_ten,dia_chi,dien_thoai,email) values('$tieu_de','$noi_dung','$ho_ten','$dia_chi','$dien_thoai','$email')";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        return 'Lỗi gửi liên hệ';
    }
    else
        return true;
}
function Select_All_Article($offset = 0)
{
    $dataArticle = null;
    $sql = "select * from baiviet order by id DESC LIMIT 4";
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

function Select_All_Product($offset = 0)
{
    $dataProduct = null;
    $product_show_limit =_product_limit;
    $sql = "select sanpham.id,ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,id_hang_sx,ngay_thang,hinh_anh,id_tai_khoan,id_danh_muc,ten_danh_muc,ten_dang_nhap,ten_hang
            from sanpham,taikhoan,danhmucsp,hangsx 
            where sanpham.id_tai_khoan = taikhoan.id
            and sanpham.id_danh_muc = danhmucsp.id
            and sanpham.id_hang_sx = hangsx.id
            order by sanpham.id DESC
            LIMIT $offset,$product_show_limit";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataProduct = "Lỗi không thể lấy dữ liệu " . mysqli_error($GLOBALS['conn']);
        return $dataProduct;
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            $dataProduct[] = $row;
        }
        return $dataProduct;
    }

}
function countArticleIndex()
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
function countProductIndex()
{
    $dataCount = null;
    $sql = "select count(id) from sanpham";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataCount = "Lỗi đếm sản phẩm " . mysqli_error($GLOBALS['conn']);
        return $dataCount;
    } else
        $row = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}
function countContact(){

    $sql = "SELECT COUNT(id) FROM danhmucsp";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
}
function SelectListSlide(){
    $dataslide = null;
    $sql = "select * from slide";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        $dataslide= "Lỗi lấy danh sách sản phẩm".mysqli_error($GLOBALS['conn']);
        return $dataslide;
    }
    else{
        while($row = mysqli_fetch_assoc($res)){
            $dataslide[]=$row;
        }
    }
    return $dataslide;
}
function SelectListProduct(){
    $dataProduct = null;
    $sql = "select * from sanpham";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        $dataProduct= "Lỗi lấy danh sách sản phẩm".mysqli_error($GLOBALS['conn']);
        return $dataProduct;
    }
    else{
        while($row = mysqli_fetch_assoc($res)){
            $dataProduct[]=$row;
        }
    }
    return $dataProduct;
}
function SelectListCategory(){
    $dataCategory = null;
    $sql = "select * from danhmucsp";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        $dataCategory= "Lỗi lấy danh sách danh mục sản phẩm".mysqli_error($GLOBALS['conn']);
        return $dataCategory;
    }
    else{
        while($row = mysqli_fetch_assoc($res)){
            $dataCategory[]=$row;
        }
    }
    return $dataCategory;
}
function SelectListProducer(){
    $dataProducer = null;
    $sql = "select * from hangsx";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        $dataProducer= "Lỗi lấy danh sách hãng sản xuất".mysqli_error($GLOBALS['conn']);
        return $dataProducer;
    }
    else{
        while($row = mysqli_fetch_assoc($res)){
            $dataProducer[]=$row;
        }
    }
    return $dataProducer;
}