<?php session_start();

define('app_path',__DIR__);
define('layout_path',app_path.'/View/layout');
require_once app_path.'/config/config.php';
require_once app_path.'/libs/functions.php';
require_once app_path.'/config/connect_db.php';

// lấy controller và action trên url
$controller = isset($_GET['controller'])?$_GET['controller']:'index'; //mặc định là index
$action = isset($_GET['action'])?$_GET['action']:'index';

$GLOBALS['current_action'] = $action;
$GLOBALS['current_controller'] = $controller;
//kiểm tra quyền
if(AclCheck() !== true){
    echo '<strong>Bạn không có quyền sử dụng chức năng này!</strong>';
    exit();
}


//echo 'Controller: '.$GLOBALS['current_controller'];
// chuyển controller lấy trên URL thành tên file Controller tương ứng.
$controller_file_name = convertUpperActionAndControllerName($controller).'Controller.php';
$action_name = lcfirst(convertUpperActionAndControllerName($action)).'Action';
$GLOBALS['action_name'] = $action_name;
//echo $action_name;


// nhúng file controller
$controller_file_full_path = app_path.'/Controller/'.$controller_file_name;
if(!file_exists($controller_file_full_path)){
    echo '<b>'. $controller_file_name.' not found! </b>';
    exit();
}

require_once  $controller_file_full_path;

$checkController = substr($controller, 0,5);

if(strtolower($checkController)=='admin'){
    if(file_exists(layout_path.'/admin.phtml')){
        require_once layout_path.'/admin.phtml';
    }else{
        echo '<b>Layout admin not found! </b>';
        exit();
    }
}else{
    if(file_exists(layout_path.'/public.phtml'))
        require_once layout_path.'/public.phtml';
    else{
        echo '<b>Layout public not found! </b>';
        exit();
    }
}








