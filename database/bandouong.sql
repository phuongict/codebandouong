-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 05, 2017 lúc 01:10 PM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bandouong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `id_tai_khoan` int(11) NOT NULL,
  `id_danh_muc` int(11) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`id`, `tieu_de`, `noi_dung`, `ngay_dang`, `id_tai_khoan`, `id_danh_muc`, `hinh_anh`) VALUES
(2, 'Trào lưu trà sữa ở Sài Gòn đã \'dậy thì thành công\' như thế nào?', 'Cách đây một năm, nhiều trào lưu ăn vặt ra đời nhanh chóng được giới trẻ đón nhận, có thể kể đến bánh mỳ nướng muối ớt, xoài lắc, trà sữa, mỳ cay 7 cấp độ, mỳ bay, kem khói...</br></br>\r\n\r\nNhững món này đã tạo nên cơn sốt tràn ngập mạng xã hội, ai ai cũng rủ nhau đi khám phá, chụp ảnh, check-in. Điều dễ thấy ở chúng là tạo hình bắt mắt, đẹp và độc, thu hút sự tò mò của nhiều người.</br></br>\r\n\r\nNhưng rồi bẵng đi một thời gian không còn ai \"tha thiết\" với các hàng bánh mỳ muối ớt, xe đẩy xoài lắc hay quán mỳ cay, mỳ bay nữa. Hàng quán dần thưa thớt khách rồi đóng cửa hẳn.</br></br>\r\n\r\n\"Sớm nở chóng tàn\" - người ta vẫn hay nói như thế khi nhắc đến các trào lưu ăn vặt đình đám một thời. Nhưng trà sữa vẫn luôn còn đó, chưa bao giờ hạ nhiệt mà còn ngày càng \"bành trướng\" và phát triển hơn.', '2017-12-03 13:21:22', 14, 6, 'trasuamariecurie_1.jpg'),
(3, 'Đây là 6 lý do người trẻ Sài Gòn uống trà sữa \'không hề rẻ\' mỗi ngày', 'Trà  sữa được biết đến như một trong những thức uống phổ biến nhất hiện nay. Đối với nhiều người trẻ, đặc biệt là tại Sài Gòn, uống trà sữa là nhu cầu cá nhân không thể bỏ qua. Vì thế, việc chi 50.000-60.000 đồng, thậm chí 100.000 đồng, cho một cốc trà sữa là chuyện khá bình thường.</br></br>\r\n\r\nNgay cả những \"tín đồ trà sữa\" cũng thừa nhận rằng mức giá trên không hề rẻ cho một loại thức uống. Và đây là 6 lý do họ giải thích cho thói quen \"rút ví\" hàng ngày của mình.</br></br>\r\n<h6>1. Đừng tiếc tiền cho niềm vui</h6>\r\nChia sẻ với Zing.vn, Vũ Hải Đăng (23 tuổi, nhân viên Công ty Harvey Nash tại TP.HCM) tự nhận mình là một trong những \"tín đồ trà sữa\" chính hiệu. Cô cho biết trung bình uống 2-3 cốc/ngày.</br></br>\r\n\r\nTrong một cuộc phỏng vấn ngắn của Zing.vn, 70% người được hỏi tiết lộ rằng trà sữa là một trong những thức uống họ yêu thích nhất.</br></br>\r\n\r\nGiải mã sức hút của trà sữa, nhiều người cho biết họ yêu thích bởi mùi vị ngon và dễ uống. Theo thời gian, đồ uống này luôn được làm mới bởi nhiều loại mùi hương, toping phong phú, hấp dẫn.</br></br>\r\n\r\nHải Đăng cũng vậy, cô thích trà sữa vì vị ngọt và đắng hòa quyện. Sau khi dùng nhiều, cô không thích những loại thức uống khác nữa.</br></br>\r\n\r\n\"Không chỉ uống trà sữa để giải khát, mình còn cảm thấy được thư giãn, xả stress. Hiện giờ, quán nước \'mọc lên như nấm\' với thực đơn phong phú, nhưng trà sữa vẫn là ưu tiên hàng đầu của mình và bạn bè như thói quen khó bỏ\", 9X tâm sự.', '2017-12-03 13:24:08', 14, 6, 'zing_5.jpg'),
(4, 'Vài phút có ngay trà sữa trân ', 'Trà sữa trân châu làm từ bột sắn dây rất đơn giản thích hợp giải nhiệt mùa hè.<br>\r\nPHẦN 1: CHUẨN BỊ NGUYÊN LIỆU<br><br>\r\n\r\n- 80gr bột sắn dây<br>\r\n\r\n- 10gr tinh bột bắp<br>\r\n\r\n- 70- 90ml nước cà phê đang sôi (nguyên liệu này có thể tăng nếu bột chưa đủ mềm dẻo)<br>\r\n- 10gr đường<br>\r\n\r\n- 50gr đường nâu để trong 1 cái tô<br>\r\n\r\n- Phần trà sữa: 2 gói trà lipton (vị tùy ý); 2 muỗng canh sữa đặc; 80ml nước sôi; 1 muỗng canh đường; 100ml sữa tươi không đường; 1/2 chén đá nhỏ.<br>\r\n\r\nLưu ý: Bạn có thể dùng bột ca cao để tạo màu-vị. Nếu dùng bột ca cao thì ta dùng nước nấu sôi không dùng nước cà phê.<br><br>\r\n\r\nPHẦN 2: CÁCH LÀM TRÀ SỮA TRÂN CHÂU TỪ BỘT BẮN DÂY<br>\r\n\r\nBước 1: Bột sắn dây + bột bắp và đường cho hết vào tô trộn chung. Sau đó cho từ từ nước cà phê đang sôi (bắt buộc) vào dùng đũa khuấy sơ (vì còn đang rất nóng).<br>\r\n\r\nBước 2: Bây giờ mang bao tay nhồi cho bột mịn dẻo không dính tay (bạn cần nhồi bột hơi mềm, đừng quá khô sẽ làm hạt trân châu bị cứng). Vo viên tròn nhỏ. bỏ vào khay có sẵn chút bột bắp hay bột sắn dây.<br>\r\n\r\nBước 3: Nấu 1 nồi nước, khi nước sôi cho các viên trân châu cà phê vào luộc.<br>\r\n\r\nBước 4: Khi thấy các viên trân châu nổi lên bạn vẫn tiếp tục luộc thêm 5 phút nữa, để trân châu chín mềm.<br>\r\n\r\nVớt trân châu ra cho vào âu nước đá lạnh 1 phút.<br>\r\n\r\nBước 5: Trước khi vớt ra cho vào tô đường nâu để sẵn, cách này giúp các viên trân châu bóng đẹp và thấm vị.<br>\r\n\r\nBước 6: Cho 2 gói trà vào ly. Cho nước sôi vào sau đó là sữa đặc để 1 lúc cho trà ra màu. Vớt bỏ gói trà. Bây giờ bạn cho đường và sữa vào hòa chung. Cho trà sữa vào bình cùng ít đá lắc mạnh (nếu thích bọt).<br>\r\n\r\nBước 7: Cuối cùng cho trân châu ra ly, đổ trà sữa vào là hoàn tất, bạn đã có cốc trà sữa thật ngon rồi đấy.<br>\r\n\r\n\r\nChỉ qua vài bước vô cùng đơn giản bạn đã có ngay 1 ly trà sữa trân châu ngọt ngào thơm ngon.<br>\r\nChúc bạn thành công với cách làm trà sữa trân châu làm từ bột sắn dây để có đồ uống hấp dẫn cho ngày nắng!<br>', '2017-12-03 13:46:41', 14, 6, 'photo-12-1501039681226.jpg'),
(5, 'Hướng dẫn pha trà sữa trân châu tại nhà vừa ngon lại đảm bảo vệ sinh', 'Trà sữa trân châu được rất nhiều người yêu thích bởi hương vị thơm ngon. Tuy nhiên, khi mua ở hàng quán thì nó lại không đảm bảo vệ sinh. Bạn có thể bắt tay vào pha chế trà sữa theo những bước đơn giản sau.<br><br>\r\n\r\nNguyên vật liệu<br>\r\n\r\n1 gói trà túi lọc<br>\r\n\r\nSữa đặc, đường.<br>\r\n\r\n30g bột năng.<br>\r\n\r\n1 muỗng bột ca cao.<br>\r\n\r\nBình to, ly đựng, ống hút loại to, muỗng, nồi nhỏ, bát tô, rây…<br>\r\n\r\nCách pha trà sữa<br><br>\r\n\r\nĐun sẵn nước nóng rồi rót ra ly. Nhúng gói trà vào ly nước và đợi cho trà tan ra.<br>\r\n\r\nSau khi pha trà với nước nóng thì cho sữa đặc vào khuấy đều cho tan.<br>\r\n\r\nCách làm trân châu<br><br>\r\n\r\nCho bột năng và bột ca cao vào cùng một chiếc bát tô sạch, rây kỹ và trộn đều hỗn hợp.<br>\r\n\r\nRót từ từ nước nóng vào, trộn khi hỗn hợp dẻo mịn (không quá khô hay nhão).<br>\r\n\r\nĐể hỗn hợp nguội thì dùng tay thoa đều bột áo, nhồi nặn. Khi bột đã đều, vo bột thành từng viên nhỏ hình tròn. Vo cho đến khi hết bột.<br>\r\n\r\nCho đường vào nồi đun sôi, để nguội (nhiều ít tùy vào khẩu vị).<br>\r\n\r\nNấu nước cho sôi, thả trân châu vào nấu trong khoảng 3 phút tùy vào viên trân châu nặn to hay nhỏ (nên cho tất cả trân châu vào một lượt nhé để chúng chín đều).<br>\r\n\r\nKhi trân châu đã chín, vớt ra nước đường đã chuẩn bị sẵn.<br>\r\n\r\nSau đó, cho trân châu vào ly trà sữa. Cho thêm đá viên và thưởng thức.<br>', '2017-12-03 13:48:41', 14, 6, 'photo-2-1496365635213.jpg'),
(6, '5 món ăn vặt mùa hè cực ngon', 'Có rất nhiều món ăn vặt mùa hè ngon, tuy nhiên bạn hãy thử \"điểm danh\" những món được rất nhiều người yêu thích sau đây nhé.\r\n5 món ăn vặt mùa hè cực ngon 1<br>\r\n  \r\nTrà sữa trân châu hẳn không còn là món ăn mới lạ khi hè về; vì thế năm nay bạn hãy thử thay món trà sữa trân châu quen thuộc bằng trà sữa sương sáo mát giòn rất dễ ăn này nhé! Kết hợp vẻ hiện đại của trà sữa và sự dân dã của sương sáo trong một món ăn vặt mùa hè, hẳn là bạn cảm thấy rất thú vị!<br><br>\r\n\r\n5 món ăn vặt mùa hè cực ngon 2<br>\r\n  \r\nSữa chua mít được yêu thích có lẽ trước hết bởi mùi thơm của mít được kết hợp cùng vị chua thanh của sữa chua; lại thêm những \"hạt lựu\" giòn ngon nhiều sắc màu bắt mắt khiến món này tuy không còn mới lạ nhưng vẫn giữ được nét đặc sắc hấp dẫn riêng.<br><br>\r\n\r\n5 món ăn vặt mùa hè cực ngon 3<br>\r\n  \r\nLà một món ăn vặt ăn hoài không chán, thực ra nộm bò khô ăn mùa nào cũng ngon; tuy nhiên tới mùa hè món ăn này trở nên đắt khách hơn bởi vị chua ngọt của nước trộn nộm và vị giòn mát của những sợi đu đủ, cà rốt. Tự làm món này ở nhà không quá khó mà lại giúp bạn giữ an toàn vệ sinh thực phẩm cho cả nhà, bạn sẽ thử chứ?<br><br>\r\n\r\n5 món ăn vặt mùa hè cực ngon 4<br>\r\n  \r\nCaramel nói chung và Caramel thập cẩm nói riêng là món ăn vặt mùa hè được nhiều người yêu thích. Với cách làm Caramel thập cẩm này, bạn sẽ có món Caramel thập cẩm rất lạ miệng do được thêm chút trân châu táo mát giòn và hơi chua chua mà khi đi ăn bên ngoài bạn sẽ không bao giờ được thưởng thức.<br><br>\r\n\r\n5 món ăn vặt mùa hè cực ngon 5<br>\r\n  \r\nMùa hè hẳn sẽ kém vui nếu thiếu đi món kem - món ăn vặt mùa hè vô cùng đặc trưng. Có thể có rất nhiều vị kem ngon tuy nhiên với thời điểm sầu riêng chín rộ đúng giữa hè, sẽ thật tuyệt khi bạn trổ tài làm một mẻ kem sầu riêng thơm phức béo ngậy đãi cả nhà phải không?', '2017-12-03 13:50:59', 14, 6, '38e2de5monanvatmuahecucngon.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id_don_hang` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT '0',
  `don_gia` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id_don_hang`, `id_san_pham`, `so_luong`, `don_gia`) VALUES
(1, 1, 10, 2000000),
(2, 1, 20, 2000000),
(4, 9, 1, 20000),
(5, 10, 1, 20000),
(7, 9, 1, 20000),
(8, 3, 1, 20000),
(9, 2, 1, 20000),
(10, 10, 1, 20000),
(11, 8, 1, 20000),
(12, 6, 1, 20000),
(14, 10, 1, 20000),
(15, 9, 1, 20000),
(16, 10, 1, 20000),
(17, 9, 1, 20000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnang`
--

CREATE TABLE `chucnang` (
  `id` int(11) NOT NULL,
  `ten_chuc_nang` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chucnang`
--

INSERT INTO `chucnang` (`id`, `ten_chuc_nang`, `link`) VALUES
(1, 'Xem danh sách tài khoản', 'admin-user_list'),
(2, 'Sửa tài khoản', 'admin-user_add'),
(3, 'Thêm tài khoản', 'admin-user_edit'),
(4, 'Xóa tài khoản', 'admin-user_delete'),
(5, 'Xem danh sách nhóm', 'admin-group_list'),
(6, 'Sửa nhóm', 'admin-group_edit'),
(7, 'Phân quyền sử dụng', 'admin-group_edit-permission'),
(8, 'Xem danh sách chức năng', 'admin-group_list-func'),
(9, 'Sửa chức năng', 'admin-group_edit-func'),
(10, 'Xóa chức năng', 'admin-group_delete-func'),
(11, 'Thêm chức năng', 'admin-group_add-func'),
(12, 'Xem danh mục sản phẩm', 'admin-product_list-category'),
(13, 'Sửa danh mục sản phẩm', 'admin-product_edit-category'),
(14, 'Xóa danh mục sản phẩm', 'admin-product_delete-category'),
(15, 'Xem danh sách danh mục sản phẩm', 'admin-product_list-category'),
(16, 'Xem danh sách hãng sản xuất', 'admin-product_list-producer'),
(17, 'Sửa hãng sản xuất', 'admin-product_edit-producer'),
(18, 'Xóa hãng sản xuất', 'admin-product_delete-producer'),
(19, 'Thêm hãng sản xuất', 'admin-product_add-producer'),
(20, 'Xem danh sách sản phẩm', 'admin-product_list'),
(21, 'Sửa sản phẩm', 'admin-product_edit'),
(22, 'Xóa sản phẩm', 'admin-product_delete'),
(23, 'Thêm sản phẩm', 'admin-product_add'),
(24, 'Xem danh sách đơn hàng', 'admin-product_list-order'),
(25, 'Sửa trạng thái đơn hàng', 'admin-product_update-order'),
(26, 'Xem chi tiết đơn hàng', 'admin-product_view-order'),
(27, 'Xem danh sách danh mục bài viết', 'admin-article_list-category'),
(28, 'Sửa danh mục bài viết', 'admin-article_edit-category'),
(29, 'Xóa danh mục bài viết', 'admin-article_delete-category'),
(30, 'Thêm danh mục bài viết', 'admin-article_add-category'),
(31, 'Xem danh sách bài viết', 'admin-article_list-article'),
(32, 'Sửa bài viết', 'admin-article_edit-article'),
(33, 'Xóa bài viết', 'admin-article_delete-article'),
(34, 'Thêm bài viết', 'admin-article_add-article'),
(35, 'Xem danh sách liên hệ', 'admin-contact_list-contact'),
(45, 'Xóa liên hệ', 'admin-contact_delete-contact'),
(46, 'Xem chi tiết liên hệ', 'admin-contact_view-contact'),
(47, 'Index Controller', 'admin-group_index'),
(48, 'Thêm nhóm tài khoản', 'admin-group_add'),
(49, 'Xóa nhóm tài khoản', 'admin-group_delete'),
(54, 'Thêm danh mục sản phẩm', 'admin-product_add-category'),
(55, 'Danh sách sản phẩm theo danh mục', 'product_list-product-category');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucbaiviet`
--

CREATE TABLE `danhmucbaiviet` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `danhmucbaiviet`
--

INSERT INTO `danhmucbaiviet` (`id`, `ten_danh_muc`) VALUES
(2, 'Thông tin giới thiệu'),
(3, 'Tin khuyến mãi'),
(6, 'Tin tức sản phẩm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucsp`
--

CREATE TABLE `danhmucsp` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `danhmucsp`
--

INSERT INTO `danhmucsp` (`id`, `ten_danh_muc`) VALUES
(2, ' Trà sữa Thảo mộc'),
(6, 'Trà sữa Gong Cha'),
(5, 'Trà sữa R&B Tea'),
(4, 'Trà sữa Thái'),
(1, 'Trà sữa trân châu'),
(3, 'Trà sữa đá xay ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `ngay_gio_dat` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trang_thai` smallint(6) DEFAULT '0',
  `ngay_cap_nhat` datetime DEFAULT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `dia_chi` varchar(200) DEFAULT NULL,
  `dien_thoai` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ghi_chu` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `ngay_gio_dat`, `trang_thai`, `ngay_cap_nhat`, `ho_ten`, `dia_chi`, `dien_thoai`, `email`, `ghi_chu`) VALUES
(1, '2017-11-18 22:28:04', 0, NULL, 'nguyen van a', 'ha noi', '0987654321', 'adsad@dm.con', 'ádsadsadsadsa'),
(2, '2017-11-22 13:53:57', 0, NULL, 'nguyen van a', 'ha noi', '0981273541', 'sssss@gm.cn', 'sdafa'),
(3, '2017-12-02 15:32:52', 0, NULL, 'sda', 'đá', 'ada', 'sdas', 'đá'),
(4, '2017-12-02 15:40:01', 0, NULL, 'sdsad', 'ádasd', 'sad', 'sada', 'sadasd'),
(5, '2017-12-02 15:44:45', 0, NULL, 'nguyen van a', 'ha noi', '09812634175', 'hdab@an.vn', 'helo'),
(6, '2017-12-02 15:45:26', 0, NULL, 'nguyen van a', 'ha noi', '09812634175', 'hdab@an.vn', 'helo'),
(7, '2017-12-02 15:45:47', 0, NULL, 'adada', 'sadas', 'dsadas', 'đá', 'adas'),
(8, '2017-12-02 15:46:37', 0, NULL, 'sfsssd', 'sdfa', 'à', 'sấ', 'fasfa'),
(9, '2017-12-02 21:55:25', 0, NULL, 'ádsa', 'dsad', 'sadasđá', 'sadasd', ''),
(10, '2017-12-02 21:56:05', 0, NULL, 'adasd', 'ádsad', 'ádasd', 'ádasdas', ''),
(11, '2017-12-02 21:57:55', 0, NULL, 'adadasd', 'áda', 'dsasdasd', 'ádad', ''),
(12, '2017-12-02 21:59:18', 0, NULL, 'sda', 'đá', 'đấ', 'sada', ''),
(13, '2017-12-02 21:59:29', 0, NULL, 'sadasdads', 'ádád', 'adad', 'ádsad', ''),
(14, '2017-12-02 22:01:25', 0, NULL, 'zxzX', 'XX', 'dấd', 'ádasdsa', ''),
(15, '2017-12-02 22:07:32', 0, NULL, 'sadad', 'sadsadsa', 'đâ', 'sdasđ', ''),
(16, '2017-12-02 22:14:18', 0, NULL, 'sadasd', 'ádad', 'ádasd', 'ádasd', ''),
(17, '2017-12-02 22:32:02', 0, NULL, 'sadsadas', 'đá', '098261427152', 'nuyea@sanbda.cn', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangsx`
--

CREATE TABLE `hangsx` (
  `id` int(11) NOT NULL,
  `ten_hang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hangsx`
--

INSERT INTO `hangsx` (`id`, `ten_hang`) VALUES
(5, 'Dingtea'),
(2, 'Gong Cha'),
(3, 'R&B Tea'),
(4, 'Royal Tea'),
(1, 'ToCoToCo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(100) NOT NULL,
  `noi_dung` text NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `dia_chi` varchar(100) DEFAULT NULL,
  `dien_thoai` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ngay_gio` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `tieu_de`, `noi_dung`, `ho_ten`, `dia_chi`, `dien_thoai`, `email`, `ngay_gio`) VALUES
(2, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'nguyen van b', 'ha noi', '098654321', 'admin@smsm.vn', '2017-11-19 19:08:32'),
(3, 'hello', 'ok baby', 'nguyen van a', 'ha noi', '09812736241', 'gggg@gmail.com', '2017-11-29 20:26:58'),
(4, 'hello', 'ok baby', 'nguyen van a', 'ha noi', '09812736241', 'gggg@gmail.com', '2017-11-29 20:27:22'),
(5, 'hello', 'ok baby', 'nguyen van a', 'ha noi', '09812736241', 'gggg@gmail.com', '2017-11-29 20:27:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomtaikhoan`
--

CREATE TABLE `nhomtaikhoan` (
  `id` int(11) NOT NULL,
  `ten_nhom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhomtaikhoan`
--

INSERT INTO `nhomtaikhoan` (`id`, `ten_nhom`) VALUES
(2, 'Nhân viên'),
(1, 'Quản trị viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id_nhom_tai_khoan` int(11) NOT NULL,
  `id_chuc_nang` int(11) NOT NULL,
  `trang_thai` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`id_nhom_tai_khoan`, `id_chuc_nang`, `trang_thai`) VALUES
(1, 1, b'1'),
(1, 2, b'1'),
(1, 3, b'1'),
(1, 4, b'1'),
(1, 5, b'1'),
(1, 6, b'1'),
(1, 7, b'1'),
(1, 8, b'1'),
(1, 9, b'1'),
(1, 10, b'1'),
(1, 11, b'1'),
(1, 12, b'1'),
(1, 13, b'1'),
(1, 14, b'1'),
(1, 15, b'1'),
(1, 16, b'1'),
(1, 17, b'1'),
(1, 18, b'1'),
(1, 19, b'1'),
(1, 20, b'1'),
(1, 21, b'1'),
(1, 22, b'1'),
(1, 23, b'1'),
(1, 24, b'1'),
(1, 25, b'1'),
(1, 26, b'1'),
(1, 27, b'1'),
(1, 28, b'1'),
(1, 29, b'1'),
(1, 30, b'1'),
(1, 31, b'1'),
(1, 32, b'1'),
(1, 33, b'1'),
(1, 34, b'1'),
(1, 35, b'1'),
(1, 45, b'1'),
(1, 46, b'1'),
(1, 47, b'1'),
(1, 48, b'1'),
(1, 49, b'1'),
(1, 54, b'1'),
(1, 55, b'1'),
(2, 1, b'1'),
(2, 2, b'0'),
(2, 3, b'0'),
(2, 4, b'0'),
(2, 5, b'1'),
(2, 6, b'0'),
(2, 7, b'0'),
(2, 8, b'0'),
(2, 9, b'0'),
(2, 10, b'0'),
(2, 11, b'0'),
(2, 12, b'0'),
(2, 13, b'0'),
(2, 14, b'0'),
(2, 15, b'0'),
(2, 16, b'0'),
(2, 17, b'0'),
(2, 18, b'0'),
(2, 19, b'0'),
(2, 20, b'0'),
(2, 21, b'0'),
(2, 22, b'0'),
(2, 23, b'0'),
(2, 24, b'0'),
(2, 25, b'0'),
(2, 26, b'0'),
(2, 27, b'0'),
(2, 28, b'0'),
(2, 29, b'0'),
(2, 30, b'0'),
(2, 31, b'0'),
(2, 32, b'0'),
(2, 33, b'0'),
(2, 34, b'0'),
(2, 35, b'0'),
(2, 45, b'0'),
(2, 46, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(200) NOT NULL,
  `mo_ta` varchar(255) DEFAULT NULL,
  `loai` varchar(100) NOT NULL,
  `gia` double NOT NULL DEFAULT '0',
  `giam_gia` double NOT NULL DEFAULT '0',
  `thanh_phan` text,
  `id_hang_sx` int(11) NOT NULL,
  `ngay_thang` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `id_tai_khoan` int(11) NOT NULL,
  `id_danh_muc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten_san_pham`, `mo_ta`, `loai`, `gia`, `giam_gia`, `thanh_phan`, `id_hang_sx`, `ngay_thang`, `hinh_anh`, `id_tai_khoan`, `id_danh_muc`) VALUES
(1, 'Trà sữa', 'adadadadad', 'Socola', 25000, 20000, 'acb', 2, '2017-11-22 13:48:39', 'foody-mobile-17192542_93968723949-182-636251844972956821.jpg', 14, 5),
(2, 'Trà sữa 02', '', '', 20000, 0, '', 2, '2017-11-22 16:24:39', '01-ceylon-S-300x300.jpg', 14, 5),
(3, 'Trà sữa 03', 'sfas', '', 25000, 20000, '', 1, '2017-11-22 16:25:01', '16-alisan-300x300.jpg', 14, 5),
(5, 'Trà sữa 05', '', '', 20000, 0, '', 2, '2017-11-22 16:25:49', '20-3Q-300x300.jpg', 14, 5),
(6, 'Trà sữa 06', '', '', 20000, 0, '', 4, '2017-11-22 16:26:21', '21-nhat-ban-300x300.jpg', 14, 2),
(7, 'Trà sữa 07', '', '', 20000, 0, '', 1, '2017-11-22 16:26:35', '22-4-mua-xuan-S-300x300.jpg', 14, 6),
(8, 'Trà sữa 08', '', '', 20000, 0, '', 1, '2017-11-22 16:26:50', '23-sen-300x300.jpg', 14, 1),
(9, 'Trà sữa 09', '', '', 20000, 0, '', 5, '2017-11-22 16:27:07', '21-nhat-ban-300x300.jpg', 14, 2),
(10, 'Trà sữa 10', '', '', 20000, 0, '', 5, '2017-11-22 16:27:26', '16-alisan-300x300.jpg', 14, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `hinh_anh` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `hinh_anh`) VALUES
(1, 'trasua.jpg'),
(2, 'slidetra.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(30) NOT NULL,
  `mat_khau` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_nhom_tai_khoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `ten_dang_nhap`, `mat_khau`, `email`, `id_nhom_tai_khoan`) VALUES
(14, 'administration', 'e10adc3949ba59abbe56e057f20f883e', 'admin@smsm.vn', 1),
(15, 'nhanvien', 'e10adc3949ba59abbe56e057f20f883e', 'addad@gmail.com', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tieu_de` (`tieu_de`),
  ADD KEY `id_danh_muc` (`id_danh_muc`),
  ADD KEY `id_tai_khoan` (`id_tai_khoan`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id_don_hang`,`id_san_pham`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Chỉ mục cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_chuc_nang` (`ten_chuc_nang`);

--
-- Chỉ mục cho bảng `danhmucbaiviet`
--
ALTER TABLE `danhmucbaiviet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_danh_muc` (`ten_danh_muc`);

--
-- Chỉ mục cho bảng `danhmucsp`
--
ALTER TABLE `danhmucsp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_danh_muc` (`ten_danh_muc`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hangsx`
--
ALTER TABLE `hangsx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_hang` (`ten_hang`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhomtaikhoan`
--
ALTER TABLE `nhomtaikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_nhom` (`ten_nhom`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id_nhom_tai_khoan`,`id_chuc_nang`),
  ADD KEY `id_chuc_nang` (`id_chuc_nang`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_san_pham` (`ten_san_pham`),
  ADD KEY `id_hang_sx` (`id_hang_sx`),
  ADD KEY `id_tai_khoan` (`id_tai_khoan`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  ADD KEY `id_nhom_tai_khoan` (`id_nhom_tai_khoan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT cho bảng `danhmucbaiviet`
--
ALTER TABLE `danhmucbaiviet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `danhmucsp`
--
ALTER TABLE `danhmucsp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT cho bảng `hangsx`
--
ALTER TABLE `hangsx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `nhomtaikhoan`
--
ALTER TABLE `nhomtaikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `baiviet_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danhmucbaiviet` (`id`),
  ADD CONSTRAINT `baiviet_ibfk_2` FOREIGN KEY (`id_tai_khoan`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`id_don_hang`) REFERENCES `donhang` (`id`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `sanpham` (`id`);

--
-- Các ràng buộc cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quyen_ibfk_1` FOREIGN KEY (`id_nhom_tai_khoan`) REFERENCES `nhomtaikhoan` (`id`),
  ADD CONSTRAINT `quyen_ibfk_2` FOREIGN KEY (`id_chuc_nang`) REFERENCES `chucnang` (`id`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_hang_sx`) REFERENCES `hangsx` (`id`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`id_tai_khoan`) REFERENCES `taikhoan` (`id`),
  ADD CONSTRAINT `sanpham_ibfk_3` FOREIGN KEY (`id_danh_muc`) REFERENCES `danhmucsp` (`id`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`id_nhom_tai_khoan`) REFERENCES `nhomtaikhoan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
