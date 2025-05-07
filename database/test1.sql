-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2025 lúc 12:09 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `userID` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `address`
--

INSERT INTO `address` (`userID`, `address`) VALUES
(3, 'Khu đô thị Times City, 458 Minh Khai, Hai Bà Trưng, Hà Nội'),
(3, 'Tòa nhà Vincom, 72 Lê Thánh Tôn, Phường Bến Nghé, Quận 1, TP.HCM'),
(4, 'Biệt thự số 12, đường Lê Quý Đôn, Quận 3, TP.HCM'),
(4, 'Tòa nhà Vietjet, Số 1 đường Trần Hưng Đạo, Quận Hoàn Kiếm, Hà Nội'),
(5, 'Số 45 ngõ 12, đường Láng Hạ, Đống Đa, Hà Nội'),
(6, 'Chung cư Golden Westlake, 162A Hoàng Hoa Thám, Tây Hồ, Hà Nội'),
(6, 'Tòa nhà FPT Tower, 10 Phạm Văn Bạch, Cầu Giấy, Hà Nội'),
(7, 'Tòa nhà VNG, Z6 đường số 13, Khu đô thị mới Nam Thăng Long, Hà Nội'),
(8, 'Số 78 đường 3/2, Quận 10, TP.HCM'),
(9, 'Số 1 đường Hoàng Hoa Thám, Ba Đình, Hà Nội'),
(10, 'Biệt thự số 5, đường Hùng Vương, Ba Đình, Hà Nội'),
(11, 'Biệt thự ven sông, Phú Mỹ Hưng, Quận 7, TP.HCM'),
(11, 'Số 12 Nguyễn Thị Minh Khai, Quận 1, TP.HCM'),
(12, 'Chung cư The Manor, đường Mễ Trì, Nam Từ Liêm, Hà Nội'),
(13, 'Biệt thự tại Khu đô thị Vinhomes Central Park, Bình Thạnh, TP.HCM'),
(13, 'Số 24 Trần Quang Diệu, Phường 14, Quận 3, TP.HCM'),
(14, 'Số 56 Lý Tự Trọng, Quận 1, TP.HCM'),
(15, 'Số 8 đường Lê Đại Hành, Hai Bà Trưng, Hà Nội'),
(16, 'Khu tập thể Mỹ Đình, Nam Từ Liêm, Hà Nội'),
(17, 'Số 32 Nguyễn Du, Quận 1, TP.HCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`ID`, `username`, `password`) VALUES
(1, 'admin', '1111'),
(2, 'a', 'a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`ID`, `userID`, `MaSP`, `SoLuong`) VALUES
(1, 1, 21, 1),
(2, 1, 14, 5),
(3, 2, 13, 10),
(4, 3, 4, 2),
(5, 3, 12, 1),
(6, 3, 18, 3),
(7, 4, 3, 1),
(8, 4, 7, 2),
(9, 4, 22, 1),
(10, 5, 9, 1),
(11, 5, 15, 4),
(12, 6, 2, 1),
(13, 6, 11, 2),
(14, 6, 19, 1),
(15, 6, 24, 1),
(16, 7, 1, 3),
(17, 7, 8, 1),
(18, 8, 4, 2),
(19, 8, 13, 1),
(20, 8, 21, 1),
(21, 9, 6, 1),
(22, 9, 14, 2),
(23, 10, 10, 1),
(24, 10, 16, 1),
(25, 10, 23, 2),
(26, 11, 17, 3),
(27, 11, 21, 1),
(28, 12, 1, 1),
(29, 12, 6, 1),
(30, 12, 9, 1),
(31, 12, 13, 1),
(32, 13, 3, 2),
(33, 13, 7, 1),
(34, 13, 24, 1),
(35, 14, 8, 1),
(36, 14, 12, 2),
(37, 14, 18, 1),
(38, 15, 2, 1),
(39, 15, 6, 3),
(40, 15, 14, 1),
(41, 16, 4, 1),
(42, 16, 10, 2),
(43, 16, 16, 1),
(44, 16, 22, 1),
(45, 17, 11, 1),
(46, 17, 19, 2),
(47, 17, 23, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `STT` int(11) NOT NULL,
  `MaLoai` varchar(255) NOT NULL,
  `TenLoai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`STT`, `MaLoai`, `TenLoai`) VALUES
(4, 'GPU', 'GPU'),
(1, 'Laptop', 'Laptop'),
(2, 'LaptopGaming', 'Laptop Gaming'),
(3, 'ManHinh', 'Màn Hình');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gpudetails`
--

CREATE TABLE `gpudetails` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(255) NOT NULL,
  `GPU` varchar(255) NOT NULL,
  `CUDA` varchar(255) NOT NULL,
  `TocDoBoNho` varchar(255) NOT NULL,
  `BoNho` varchar(255) NOT NULL,
  `Nguon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gpudetails`
--

INSERT INTO `gpudetails` (`MaSP`, `ThuongHieu`, `GPU`, `CUDA`, `TocDoBoNho`, `BoNho`, `Nguon`) VALUES
(6, 'NVIDIA', 'NVIDIA GeForce RTX 5090', '21760 Units', '28Gbps', '32GB', '1000W');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptopdetails`
--

CREATE TABLE `laptopdetails` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(255) NOT NULL,
  `CPU` varchar(255) NOT NULL,
  `GPU` varchar(255) NOT NULL,
  `RAM` varchar(255) NOT NULL,
  `DungLuong` varchar(255) NOT NULL,
  `KichThuocManHinh` varchar(255) NOT NULL,
  `DoPhanGiai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `laptopdetails`
--

INSERT INTO `laptopdetails` (`MaSP`, `ThuongHieu`, `CPU`, `GPU`, `RAM`, `DungLuong`, `KichThuocManHinh`, `DoPhanGiai`) VALUES
(2, 'Asus', 'AMD Ryzen 5 7520U', 'AMD Radeon Graphics', '16GB', '512GB', '14 inch', '1920x1080'),
(10, 'Acer', 'Intel Core i3-1215U', 'Intel UHD Graphics', '8GB', '256GB', '14 inch', '1920x1080'),
(15, 'Acer', 'AMD Ryzen 7 5700U', 'AMD Radeon Graphics', '16GB', '512GB', '15.6 inch', '1920x1080'),
(16, 'Asus', 'Intel Core i5-13500H', 'NVIDIA Intel Iris X Graphics', '16GB', '512GB', '14 inch', '2880x1800'),
(18, 'Asus', 'Intel Core Ultra 7 155H', 'Intel Arc Graphics', '16GB', '512GB', '16 inch', '3200x2000'),
(19, 'HP', 'Intel Core Ultra 5 125U', 'Intel Graphics', '8GB', '512GB', '14 inch', '1920x1200'),
(24, 'Dell', 'Intel Core i7-1355U', 'Intel Iris Xe Graphics', '16GB', '512GB', '14 inch', '1920x1080');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptopgamingdetails`
--

CREATE TABLE `laptopgamingdetails` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(255) NOT NULL,
  `GPU` varchar(255) NOT NULL,
  `CPU` varchar(255) NOT NULL,
  `RAM` varchar(255) NOT NULL,
  `DungLuong` varchar(255) NOT NULL,
  `KichThuocManHinh` varchar(255) NOT NULL,
  `DoPhanGiai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `laptopgamingdetails`
--

INSERT INTO `laptopgamingdetails` (`MaSP`, `ThuongHieu`, `GPU`, `CPU`, `RAM`, `DungLuong`, `KichThuocManHinh`, `DoPhanGiai`) VALUES
(3, 'MSI', 'NVIDIA GeForce RTX 3050 6GB', 'Intel Core i5-13500H', '8GB', '1TB', '15.6 inch', '1920x1080'),
(4, 'Lenovo', 'NVIDIA GeForce RTX 4060 8GB', 'AMD Ryzen 7 7435HS', '24GB', '512GB', '15.6 inch', '1920x1080'),
(7, 'Gigabyte', 'NVIDIA GeForce RTX 4050 6GB', 'Intel Core i5-13500H', '8GB', '512GB', '15.6 inch', '1920x1080');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listproduct`
--

CREATE TABLE `listproduct` (
  `MaDon` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `listproduct`
--

INSERT INTO `listproduct` (`MaDon`, `MaSP`, `SoLuong`) VALUES
(1, 8, 1),
(1, 6, 3),
(1, 16, 1);

--
-- Bẫy `listproduct`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manhinhdetails`
--

CREATE TABLE `manhinhdetails` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(255) NOT NULL,
  `KichThuocManHinh` varchar(255) NOT NULL,
  `TangSoQuet` varchar(255) NOT NULL,
  `TiLe` varchar(255) NOT NULL,
  `TamNen` varchar(255) NOT NULL,
  `DoPhanGiai` varchar(255) NOT NULL,
  `KhoiLuong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manhinhdetails`
--

INSERT INTO `manhinhdetails` (`MaSP`, `ThuongHieu`, `KichThuocManHinh`, `TangSoQuet`, `TiLe`, `TamNen`, `DoPhanGiai`, `KhoiLuong`) VALUES
(1, 'MSI', '23.8 inch', '100Hz', '16:9', 'IPS', '1920x1080', '3.5 kg'),
(8, 'Gigabyte', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `MaDon` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `TrangThai` enum('đã giao','chờ xác nhận','đang giao','') NOT NULL,
  `ThanhToan` enum('chuyển khoản','tiền mặt','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`MaDon`, `UserID`, `DiaChi`, `TongTien`, `TrangThai`, `ThanhToan`) VALUES
(1, 5, 'abc', 0, 'chờ xác nhận', 'chuyển khoản');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `MaLoai` varchar(255) NOT NULL,
  `AnhMoTaSP` varchar(255) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`MaSP`, `TenSP`, `MaLoai`, `AnhMoTaSP`, `SoLuong`, `Gia`) VALUES
(1, 'Màn hình MSI PRO MP242L', 'ManHinh', './assets/image/50725_m__n_h__nh_msi_pro_mp242l__4_.jpg', 460, 1890000),
(2, 'Laptop ASUS VivoBook Go 14 E1404FA-NK177W', 'Laptop', './assets/image/e1404fa-1.png', 200, 11490000),
(3, 'Laptop Gaming MSI Katana 15 B13UDXK 2270VN', 'LaptopGaming', './assets/image/8qziagrd.png', 60, 20900000),
(4, 'Laptop Lenovo LOQ 15ARP9 83JC003YVN', 'LaptopGaming', './assets/image/48807_laptop_lenovo_loq_15arp9_83jc003yvn__3_.jpg', 50, 27790000),
(6, 'Card màn hình MSI GeForce RTX 5090 32G GAMING TRIO OC', 'GPU', './assets/image/bzilxs4m.png', 2, 97990000),
(7, 'Laptop GIGABYTE G5 MF5-52VN383SH', 'LaptopGaming', './assets/image/47728_laptop_gigabyte_g5_mf5_52vn383sh__1_.jpg', 55, 20790000),
(8, 'Màn Hình Gaming GIGABYTE GS27F', 'ManHinh', './assets/image/man_hinh_gaming_gigabyte_gs27f__5_.jpg', 100, 3298000),
(9, 'Card màn hình ASUS Dual GeForce RTX™ 3060 V2 12GB GDDR6', 'GPU', './assets/image/imagertx3060V2_12GB.png', 30, 7790000),
(10, 'Laptop Acer Aspire Lite AL14-51M-36MH_NX.KTVSV.001', 'Laptop', './assets/image/49837_laptop_acer_aspire_lite_al14_51m_36mh_nx_ktvsv_001__2_.jpg', 20, 9190000),
(11, 'Laptop Asus TUF Gaming F15 FX507ZC4-HN095W', 'LaptopGaming', './assets/image/46655_laptop_asus_tuf_gaming_f15_fx507zc4_hn095w__3_.jpg', 100, 19990000),
(12, 'Laptop Lenovo Legion Pro 5 16IRX9 83DF0046VN', 'LaptopGaming', './assets/image/47462_laptop_lenovo_legion_pro_5_16irx9_83df0046vn__1_.jpg', 20, 51990000),
(13, 'Laptop Gaming Acer Aspire 7 A715-76G-5806 - NH.QMFSV.002', 'LaptopGaming', './assets/image/45836_ap7.jpg', 50, 18990000),
(14, 'Laptop Gaming Acer Nitro 5 Tiger AN515-58-5935 NH.QLZSV.001', 'LaptopGaming', './assets/image/45837_bnfg.jpg', 33, 22290000),
(15, 'Laptop Acer Aspire 3 A315-44P-R5QG NX.KSJSV.001', 'Laptop', './assets/image/50618_laptop_acer_aspire_3_a315_44p_r5qg_nx_ksjsv_001__4_.jpg', 22, 12900000),
(16, 'Laptop Asus Vivobook 14 OLED A1405VA-KM095W', 'Laptop', './assets/image/44758_laptop_asus_vivobook_14_oled_a1405va_km095w__7_.jpg', 100, 16990000),
(17, 'Laptop HP VICTUS 15-fa1155TX 952R1PA_16G', 'LaptopGaming', './assets/image/49855_laptop_hp_victus_15_fa1155tx_952r1pa_16g__2_.jpg', 50, 17990000),
(18, 'Laptop ASUS Vivobook S 16 OLED S5606MA-MX051W', 'Laptop', './assets/image/g8gdssys.png', 50, 25490000),
(19, 'Laptop HP ProBook 440 G11 A74B4PT', 'Laptop', './assets/image/49741_laptop_hp_probook_440_g11_a74b4pt__1_.jpg', 200, 21490000),
(21, 'Card màn hình Asus ROG Strix GeForce RTX 4090 OC Edition 24GB GDDR6X', 'GPU', './assets/image/tn9pvbdr.png', 10, 64990000),
(22, 'VGA Gigabyte RTX 4060 Windforce OC 8GB', 'GPU', './assets/image/45659_vga_gigabyte_rtx_4060_windforce_oc_8gb_anphat88.jpg', 100, 8299000),
(23, 'VGA Gigabyte GeForce RTX 3050 WINDFORCE OC V2 8GB', 'GPU', './assets/image/46200_vga_gigabyte_geforce_rtx_3050_windforce___2_.jpg', 12, 5599000),
(24, 'Laptop Dell Latitude 3450 71058806', 'Laptop', './assets/image/51342_laptop_dell_latitude_3450_71058806__1_.jpg', 100, 24990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(26) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `date of birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `sex`, `phonenumber`, `date of birth`) VALUES
(1, 'ThanhThao', 'ThanhThao123', NULL, NULL, NULL, NULL),
(2, 'u', 'u', NULL, NULL, NULL, NULL),
(3, 'PhamNhatVuong', 'vietnam123', 'vuong@vin.group', 'Nam', '0987654321', '1968-08-05'),
(4, 'NguyenThiPhuongThao', 'vietjet456', 'thao@vietjetair.com', 'Nữ', '0912345678', '1970-06-07'),
(5, 'TranBaThang', 'password789', NULL, 'Nam', NULL, '1985-11-15'),
(6, 'HoangKieuTrinh', 'trinh123456', 'trinh@fpt.com', 'Nữ', '0978123456', '1990-03-22'),
(7, 'TranDucViet', 'viet789012', 'viet@vng.com', 'Nam', '0967890123', '1982-09-18'),
(8, 'LeThanhThuy', 'thuy345678', NULL, 'Nữ', '0945678901', '1978-12-30'),
(9, 'PhamMinhChinh', 'chinh2023', 'chinh@government.vn', 'Nam', NULL, '1958-03-10'),
(10, 'NguyenXuanPhuc', 'phuc2024', NULL, 'Nam', '0934567890', '1954-07-20'),
(11, 'TranThanh', 'thanh1234', 'thanh@artist.vn', 'Nam', '0923456789', '1987-04-10'),
(12, 'HoNgocHa', 'ha567890', 'ha@singer.vn', 'Nữ', NULL, '1984-11-25'),
(13, 'SonTungMTP', 'tungmtp123', 'tung@mtp.com', 'Nam', '0911223344', '1994-07-05'),
(14, 'MaiKhoi', 'khoi5678', NULL, 'Nữ', '0988776655', '1992-02-14'),
(15, 'BuiXuanHuan', 'huan123456', 'huan@coach.vn', 'Nam', '0977889900', '1976-05-01'),
(16, 'NguyenQuangHai', 'hai7890', 'hai@football.vn', 'Nam', '0966998877', '1997-04-12'),
(17, 'TranThiLena', 'lena123', NULL, 'Nữ', NULL, '1995-08-08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`userID`,`address`);

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `carts_ibfk_1` (`userID`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `gpudetails`
--
ALTER TABLE `gpudetails`
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `laptopdetails`
--
ALTER TABLE `laptopdetails`
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `laptopgamingdetails`
--
ALTER TABLE `laptopgamingdetails`
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `listproduct`
--
ALTER TABLE `listproduct`
  ADD KEY `MaDon` (`MaDon`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `manhinhdetails`
--
ALTER TABLE `manhinhdetails`
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`MaDon`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `MaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);

--
-- Các ràng buộc cho bảng `gpudetails`
--
ALTER TABLE `gpudetails`
  ADD CONSTRAINT `gpudetails_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);

--
-- Các ràng buộc cho bảng `laptopdetails`
--
ALTER TABLE `laptopdetails`
  ADD CONSTRAINT `laptopdetails_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);

--
-- Các ràng buộc cho bảng `laptopgamingdetails`
--
ALTER TABLE `laptopgamingdetails`
  ADD CONSTRAINT `laptopgamingdetails_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);

--
-- Các ràng buộc cho bảng `listproduct`
--
ALTER TABLE `listproduct`
  ADD CONSTRAINT `listproduct_ibfk_1` FOREIGN KEY (`MaDon`) REFERENCES `orders` (`MaDon`),
  ADD CONSTRAINT `listproduct_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);

--
-- Các ràng buộc cho bảng `manhinhdetails`
--
ALTER TABLE `manhinhdetails`
  ADD CONSTRAINT `manhinhdetails_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`MaLoai`) REFERENCES `categories` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
