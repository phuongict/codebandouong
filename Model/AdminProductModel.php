<?php


function SelectOneOrderView($id_don_hang){
    $sql = "SELECT id_don_hang,sanpham.ten_san_pham,donhang.ngay_gio_dat,donhang.trang_thai,donhang.ngay_cap_nhat,donhang.ho_ten,donhang.dia_chi,donhang.dien_thoai,donhang.email,donhang.ghi_chu,chitietdonhang.so_luong,chitietdonhang.don_gia 
            FROM donhang,sanpham,chitietdonhang 
            WHERE chitietdonhang.id_don_hang = donhang.id
            AND chitietdonhang.id_san_pham = sanpham.id
            AND 
            id_don_hang = $id_don_hang";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return  "Lỗi lấy thông tin đơn hàng: ". mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    else{
        return 'Không tồn tại đơn hàng có id là '.$id_don_hang;
    }
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function SelectOneOrder($id){
    $sql = "SELECT trang_thai FROM donhang WHERE id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return  "Lỗi lấy thông tin trạng thái đơn hàng cần sửa: ". mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    else{
        return 'Không tồn tại trạng thái có ID đơn hàng là '.$id;
    }
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function Update_Order($id, $trang_thai){
    $sql = "UPDATE donhang SET trang_thai = '$trang_thai' WHERE id=$id ";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi UPDATE: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
    mysqli_close($GLOBALS['conn']);
}
function Select_list_Order( $offset = 0){
    $return_data = null;
    $limit = _admin_page_limit;
    $sql = "SELECT * FROM donhang ORDER BY id ASC LIMIT $offset,$limit";
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
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function countOrder(){
    $sql = "SELECT COUNT(id) FROM donhang";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
/**
 * Hãng sản xuất
 * @param $id
 * @return bool|string
 */
function DeleteProducer($id){
    $sql = "DELETE FROM hangsx WHERE id=$id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi Xóa: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function SelectOneProducer($id){
    $sql = "SELECT * FROM hangsx WHERE id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return  "Lỗi lấy thông tin hãng cần sửa: ". mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    else{
        return 'Không tồn tại hãng có ID là '.$id;
    }
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function Update_Producer($id, $ten_hang){
    $sql = "UPDATE hangsx SET ten_hang = '$ten_hang' WHERE id=$id ";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi UPDATE: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
    mysqli_close($GLOBALS['conn']);
}
function Select_list_Producer( $offset = 0){
    $return_data = null;
    $limit = _admin_page_limit;
    $sql = "SELECT * FROM hangsx ORDER BY id ASC LIMIT $offset,$limit";
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
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function countProducer(){
    $sql = "SELECT COUNT(id) FROM hangsx";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function InsertProducer($ten_hang){
    if(empty($ten_hang))
        return "Lỗi INSERT: Tên hãng không được rỗng!";
    $sql = "INSERT INTO hangsx (ten_hang) VALUES ('$ten_hang')";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi INSERT: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
    mysqli_close($GLOBALS['conn']);
}
/**
 * Danh mục sản phẩm
 * @param $id
 * @return bool|string
 */
function DeleteCategory($id){
    $sql = "DELETE FROM danhmucsp WHERE id=$id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi Xóa: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function SelectOneCategory($id){
    $sql = "SELECT * FROM danhmucsp WHERE id = $id";
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
function Update_danh_muc($id, $ten_danh_muc){
    $sql = "UPDATE danhmucsp SET ten_danh_muc = '$ten_danh_muc' WHERE id=$id ";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi UPDATE: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function Select_list_danh_muc_sp( $offset = 0){
    $return_data = null;

    $limit = _admin_page_limit;
    $sql = "SELECT * FROM danhmucsp ORDER BY id ASC LIMIT $offset,$limit";
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
function countDanhMucSP(){

    $sql = "SELECT COUNT(id) FROM danhmucsp";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
}
function Insert_danh_muc_sp($ten_danh_muc){
    if(empty($ten_danh_muc))
        return "Lỗi INSERT: Tên danh mục không được rỗng!";
    $sql = "INSERT INTO danhmucsp (ten_danh_muc) VALUES ('$ten_danh_muc')";
    $res = mysqli_query($GLOBALS['conn'],$sql);
//    if(mysqli_errno($GLOBALS['conn'])){
//        return "Lỗi INSERT: ". mysqli_error($GLOBALS['conn']);
//    }
    if($res ===false){
        return "Lỗi INSERT: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}

/**
 * Quản lý sản phẩm
 * Sản phẩm
 */
function delete_Product($id){
    $sql = "delete from sanpham where id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res === false){
        return "Lỗi không tồn tại: ".mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function Select_One_Product($id)
{
    $sql = "select sanpham.id,ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,id_tai_khoan,id_danh_muc,ten_hang,ten_dang_nhap,ten_danh_muc 
            from sanpham,hangsx,danhmucsp,taikhoan 
            where sanpham.id_hang_sx = hangsx.id 
            and sanpham.id_tai_khoan = taikhoan.id
            and sanpham.id_danh_muc = danhmucsp.id
            and sanpham.id =$id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi lấy dữ liệu " . mysqli_error($GLOBALS['conn']);
    } else
        $row = mysqli_fetch_assoc($res);
    return $row;
}
function Update_Product($dataProduct = null)
{
    $ten_san_pham = $dataProduct['ten_san_pham'];
    $txt_loai = $dataProduct['loai'];
    $mo_ta = $dataProduct['mo_ta'];
    $gia = $dataProduct['gia'];
    $giam_gia = $dataProduct['giam_gia'];
    $thanh_phan = $dataProduct['thanh_phan'];
    $id_hang_sx = $dataProduct['id_hang_sx'];
    $hinh_anh = $dataProduct['hinh_anh'];
    $id_tai_khoan = $dataProduct['id_tai_khoan'];
    $id_danh_muc = $dataProduct['id_danh_muc'];
    $id = $dataProduct['id'];
    $sql = "update sanpham set ten_san_pham = '$ten_san_pham',mo_ta = '$mo_ta',loai = '$txt_loai',gia = $gia,giam_gia = $giam_gia,thanh_phan = '$thanh_phan',id_hang_sx = $id_hang_sx,hinh_anh = '$hinh_anh',id_tai_khoan = $id_tai_khoan,id_danh_muc = $id_danh_muc
            where id = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi cập nhật sản phẩm " . mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function select_Hang_Sx()
{
    $sql = "select id,ten_hang from hangsx";
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

function select_Category()
{
    $sql = "select id,ten_danh_muc from danhmucsp";
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

function select_User()
{
    $sql = "select id,ten_dang_nhap from taikhoan";
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

function insert_Product($dataProduct = null)
{
    $ten_san_pham = $dataProduct['ten_san_pham'];
    $txt_loai = $dataProduct['loai'];
    $mo_ta = $dataProduct['mo_ta'];
    $gia = $dataProduct['gia'];
    $giam_gia = $dataProduct['giam_gia'];
    $thanh_phan = $dataProduct['thanh_phan'];
    $id_hang_sx = $dataProduct['id_hang_sx'];
    $hinh_anh = $dataProduct['hinh_anh'];
    $id_tai_khoan = $dataProduct['id_tai_khoan'];
    $id_danh_muc = $dataProduct['id_danh_muc'];
    $sql = "insert into sanpham(ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,hinh_anh,id_tai_khoan,id_danh_muc)
            values ('$ten_san_pham','$mo_ta','$txt_loai','$gia','$giam_gia','$thanh_phan','$id_hang_sx','$hinh_anh','$id_tai_khoan','$id_danh_muc')";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi thêm sản phẩm" . mysqli_error($GLOBALS['conn']);
    } else
        return true;
}

function Select_All_Product($offset = 0)
{
    $dataProduct = null;
    $product_show_limit = _admin_page_limit;
    $sql = "select sanpham.id,ten_san_pham,mo_ta,loai,gia,giam_gia,thanh_phan,id_hang_sx,id_hang_sx,ngay_thang,hinh_anh,id_tai_khoan,id_danh_muc,ten_danh_muc,ten_dang_nhap,ten_hang
            from sanpham,taikhoan,danhmucsp,hangsx 
            where sanpham.id_tai_khoan = taikhoan.id
            and sanpham.id_danh_muc = danhmucsp.id
            and sanpham.id_hang_sx = hangsx.id
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

function countProduct()
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
?>