<?php


require_once app_path . '/Model/ArticleModel.php';
require_once app_path . '/Model/IndexModel.php';
require_once app_path . '/Model/ProductModel.php';

function listArticleCategoryAction()
{
    $dataView = null;
    //lấy danh mục sản phẩm
    $list_category   = SelectListCategory();
    if (is_array($list_category)) {
        $dataView['data']['list_category']        = $list_category;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_category;
    }
    ////Lấy danh sách nhà sản xuất
    $list_producer   = SelectListProducer();
    if (is_array($list_producer)) {
        $dataView['data']['list_producer']        = $list_producer;
//        $dataView['msg']         = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_producer;
    }
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'] = "ID Danh mục bài viết không đúng!";
        return renderView($dataView);
    }
    $total_records = countProductArticle($id);
    if (!is_numeric($total_records)) {
        $dataView['msg'] = $total_records;
        return renderView($dataView);
    }
    $total_pages = ceil($total_records / _product_limit);
    if ($total_pages <= 0) {
        $dataView['msg'] = "Chưa có dữ liệu!";
        return renderView($dataView);
    }
    $current_page = @intval($_GET['page']);
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_pages)
        $current_page = $total_pages;
    $offset = ($current_page - 1) * _product_limit;
    $list   = allArticleCategory($id,$offset);
    if (is_array($list)) {
        $dataView['data']['list_article_category']   = $list;
        $dataView['total_pages']['product'] = $total_pages;
//        $dataView['msg']                             = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list;
    }

    renderView($dataView);

}
function detailAction()
{
    $dataView = null;
    $list_category = SelectListCategory();
    if (is_array($list_category)) {
        $dataView['data']['list_category'] = $list_category;
        $dataView['msg']                 = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_category;
    }
    ////Lấy danh sách nhà sản xuất
    $list_producer = SelectListProducer();
    if (is_array($list_producer)) {
        $dataView['data']['list_producer'] = $list_producer;
        $dataView['msg']                   = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $list_producer;
    }
    $id       = $_GET['id'];
    if (!is_numeric($id)) {
        $dataView['msg'] = "ID bài viết không đúng!";
        return renderView($dataView);
    }
    $view_article = viewArticle($id);
    if (is_array($view_article)) {
        $dataView['data']['detail_article'] = $view_article;
        $dataView['msg']                  = 'Lấy dữ liệu thành công!';
    } else {
        $dataView['msg'] = $view_article;
    }

    renderView($dataView);
}