$(function () {
    $('#btnSearch').click(function () {
        directhttp();
    });
    function directhttp () {
        var search = $('#txt_search').val();
        if(search == ''){
            alert('Bạn chưa nhập sản phẩm cần tìm');
            return;
        }
        window.location.href = '?controller=index&action=search&result='+search;
    }
    $('#btnSearch2').click(function () {
        directhttp2();
    });
    function directhttp2 () {
        var search2 = $('#txt_search2').val();
        if(search2 == ''){
            alert('Bạn chưa nhập sản phẩm cần tìm');
            return;
        }
        window.location.href = '?controller=index&action=search&result='+search2;
    }
    $('#txt_search2').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            event.preventDefault();
            directhttp2();
        }
    });
    $('#txt_search').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            event.preventDefault();
            directhttp();
        }
    });
    $('#btn_checkout').click(function () {
        if($('#_user_order').val() == ''){
            $('#_error_info').html("<div class=\"alert alert-danger alert-dismissable fade show\">Họ tên không được để trống!</div>");
            $('#_user_order').focus();
            return false;
        }
        if($('#_address_order').val() == ''){
            $('#_error_info').html('<div class="alert alert-danger alert-dismissable fade show">Địa chỉ không được để trống!</div>');
            $('#_address_order').focus();
            return false;
        }
        if($('#_phone_order').val() == ''){
            $('#_error_info').html('<div class="alert alert-danger alert-dismissable fade show">Điện thoại không được để trống!</div>');
            $('#_phone_order').focus();
            return false;
        }
        var regexpphone = /^0[1-9]{1}\d{8,10}$/;
        if(!regexpphone.test($('#_phone_order').val())){
            $('#_error_info').html('<div class="alert alert-danger alert-dismissable fade show">Số điện thoại không hợp lệ!</div>');
            $('#_phone_order').focus();
            return false;
        }
        if($('#_email_order').val() == ''){
            $('#_error_info').html('<div class="alert alert-danger alert-dismissable fade show">Email không được để trống!</div>');
            $('#_email_order').focus();
            return false;
        }
        var regexpemail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if(!regexpemail.test($('#_email_order').val())){
            $('#_error_info').html('<div class="alert alert-danger alert-dismissable fade show">Email không hợp lệ!</div>');
            $('#_email_order').focus();
            return false;
        }
        $('form:last').submit();

    });
});