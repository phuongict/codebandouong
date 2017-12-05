<?php
function SelectAllFunc()
{
    $sql = "SELECT * FROM chucnang ORDER BY id DESC ";
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

function SelectEnabledPermission($id_group)
{
    $sql = "SELECT * FROM quyen WHERE id_nhom_tai_khoan = $id_group AND trang_thai = 1 ";

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

function UpdatePermission($id_group, $array_func)
{
    $return_data = array();
    $list_func   = SelectAllFunc();
    if (!is_array($list_func)) {
        $return_data[] = 'Không lấy được danh sách chức năng!';
        return $return_data;
    }
    foreach ($list_func as $row_func) {
        $trang_thai   = 0;
        $id_chuc_nang = $row_func['id'];
        if (in_array($row_func['id'], $array_func))
            $trang_thai = 1;
        $sql_check = "SELECT * FROM quyen WHERE  id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group";
        $res       = mysqli_query($GLOBALS['conn'], $sql_check);
        if (mysqli_errno($GLOBALS['conn'])) {
            $return_data[] = "Lỗi kiểm tra tồn tại quyền: id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group : " . mysqli_error($GLOBALS['conn']);
        }
        if (mysqli_num_rows($res) > 0) {
            //có tồn tại
            $sql_set_on = "Update quyen SET trang_thai = $trang_thai WHERE id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group";
            $res_set_on = mysqli_query($GLOBALS['conn'], $sql_set_on);
            if (mysqli_errno($GLOBALS['conn'])) {
                $return_data[] = "Lỗi cập nhật trạng thái quyền ($trang_thai): id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group: " . mysqli_error($GLOBALS['conn']);
            } else
                $return_data[] = "Cập nhật trạng trạng thái quyền  ($trang_thai) thành công: id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group" . $res_set_on;
        } else {
            $sql_insert = "INSERT INTO quyen VALUES ($id_group,$id_chuc_nang,$trang_thai)";
            $res_insert = mysqli_query($GLOBALS['conn'], $sql_insert);

            if (mysqli_errno($GLOBALS['conn'])) {
                $return_data[] = "Lỗi thêm quyền ($trang_thai): id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group: " . mysqli_error($GLOBALS['conn']);
            } else
                $return_data[] = "Thêm quyền  ($trang_thai) mới thành công: id_chuc_nang = $id_chuc_nang AND id_nhom_tai_khoan= $id_group" . $res_insert;
        }
    }
    return $return_data;
}
/*
function Select_All_Func_KPT(){
    $return_data = null;
    $sql = "SELECT * FROM chucnang ORDER BY id DESC ";
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
*/
function DeleteFunc($id)
{
    $sql = "DELETE FROM chucnang WHERE id=$id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi Xóa: " . mysqli_error($GLOBALS['conn']);
    }
    return true;
}

function countFunc()
{

    $sql = "SELECT COUNT(id) FROM chucnang";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_errno($GLOBALS['conn'])) {
        return "Lỗi đếm bản ghi: " . mysqli_error($GLOBALS['conn']);
    }
    $row  = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}

function Select_All_Func($offset = 0)
{
    $dataFunc   = null;
    $limit_page = _admin_page_limit;
    $sql        = "select * from chucnang LIMIT $offset,$limit_page";
    $res        = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        $dataFunc = "Lỗi lấy danh sách" . mysqli_error($GLOBALS['conn']);
        return $dataFunc;
    } else
        while ($row = mysqli_fetch_assoc($res)) {
            $dataFunc[] = $row;
        }
    return $dataFunc;
}

function Select_One_Func($id)
{
    $sql = "select * from chucnang where id = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi: " . mysqli_error($GLOBALS['conn']);
    } else {
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
}

function edit_Func($data = null)
{
    $ten_chuc_nang = $data['ten_chuc_nang'];
    $link          = $data['link'];
    $id            = $data['id'];
    $sql           = "update chucnang set ten_chuc_nang = '$ten_chuc_nang', link = '$link' where id = $id";
    $res           = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Thêm mới không thành công! " . mysqli_error($GLOBALS['conn']);
    } else
        return true;
}

function add_Func($ten_chuc_nang, $link)
{
    $sql = "insert into chucnang(ten_chuc_nang,link) value('$ten_chuc_nang','$link')";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi thêm chức năng: " . mysqli_error($GLOBALS['conn']);
    }
    return true;
}

function DeleteGroup($id)
{
    $sql = "DELETE FROM nhomtaikhoan WHERE id=$id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi Xóa: " . mysqli_error($GLOBALS['conn']);
    }

    return true;
}

function Update_ten_nhom($id, $ten_nhom)
{
    $sql = "UPDATE nhomtaikhoan SET ten_nhom = '$ten_nhom' WHERE id=$id ";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if ($res === false) {
        return "Lỗi UPDATE: " . mysqli_error($GLOBALS['conn']);
    }

    return true;
}


function SelectOneGroup($id)
{

    $sql = "SELECT * FROM nhomtaikhoan WHERE id = $id";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_errno($GLOBALS['conn'])) {
        return "Lỗi lấy thông tin nhóm cần sửa: " . mysqli_error($GLOBALS['conn']);
    }
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        return $row;
    } else {
        return 'Không tồn tại nhóm có ID là ' . $id;
    }
}


function Insert_nhom_tk($ten_nhom)
{
    if (empty($ten_nhom))
        return "Lỗi INSERT: Tên nhóm không được rỗng!";


    $sql = "INSERT INTO nhomtaikhoan (ten_nhom) VALUES ('$ten_nhom')";

    $res = mysqli_query($GLOBALS['conn'], $sql);

//    if(mysqli_errno($GLOBALS['conn'])){
//        return "Lỗi INSERT: ". mysqli_error($GLOBALS['conn']);
//    }

    if ($res === false) {
        return "Lỗi INSERT: " . mysqli_error($GLOBALS['conn']);
    }

    return true;

}

function Select_list_nhom_tk($offset = 0)
{
    $return_data = null;

    $limit = _admin_page_limit;
    $sql   = "SELECT * FROM nhomtaikhoan ORDER BY id DESC LIMIT $offset,$limit";
    $res   = mysqli_query($GLOBALS['conn'], $sql);

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

function Select_All_Group()
{
    $return_data = null;

    $sql = "SELECT * FROM nhomtaikhoan ORDER BY id DESC ";
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

function countNhomTK()
{

    $sql = "SELECT COUNT(id) FROM nhomtaikhoan";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_errno($GLOBALS['conn'])) {
        return "Lỗi đếm bản ghi: " . mysqli_error($GLOBALS['conn']);
    }
    $row  = mysqli_fetch_row($res);
    $tong = intval($row[0]);
    return $tong;
}