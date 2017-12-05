<?php

function deleteContact ($id){
    $sql = "DELETE FROM lienhe WHERE id=$id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if($res ===false){
        return "Lỗi Xóa: ". mysqli_error($GLOBALS['conn']);
    }
    return true;
}
function SelectOneContactView($id){
    $sql = "SELECT * from lienhe where id = $id";
    $res = mysqli_query($GLOBALS['conn'],$sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return  "Lỗi lấy thông tin liên hệ: ". mysqli_error($GLOBALS['conn']);
    }
    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    else{
        return 'Không tồn tại liên hệ có id là '.$id;
    }
    mysqli_free_result($res);
    mysqli_close($GLOBALS['conn']);
}
function SelectListContact( $offset = 0){
    $return_data = null;
    $limit = _admin_page_limit;
    $sql = "SELECT * FROM lienhe ORDER BY id ASC LIMIT $offset,$limit";
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
function countContact(){

    $sql = "SELECT COUNT(id) FROM lienhe";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    if(mysqli_errno($GLOBALS['conn'])){
        return "Lỗi đếm bản ghi: ". mysqli_error($GLOBALS['conn']);
    }
    $row = mysqli_fetch_row($res);
    $tong =  intval($row[0]);
    return $tong;
}