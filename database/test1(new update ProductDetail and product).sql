-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 13, 2025 lúc 04:20 PM
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
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`MaLoai`, `TenLoai`) VALUES
(1, 'Laptop'),
(2, 'Laptop Gaming'),
(3, 'Màn Hình'),
(4, 'GPU'),
(5, 'CPU'),
(6, 'Bàn Phím'),
(7, 'Tablet');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptopdetails`
--

CREATE TABLE `laptopdetails` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(255) NOT NULL,
  `CPU` varchar(255) NOT NULL,
  `GPU` varchar(255) NOT NULL,
  `RAM` int(11) NOT NULL,
  `DungLuong` int(11) NOT NULL,
  `KichThuocManHinh` float NOT NULL,
  `DoPhanGiai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `laptopdetails`
--

INSERT INTO `laptopdetails` (`MaSP`, `ThuongHieu`, `CPU`, `GPU`, `RAM`, `DungLuong`, `KichThuocManHinh`, `DoPhanGiai`) VALUES
(2, 'Asus', 'AMD Ryzen 5 7520U', 'AMD Radeon Graphics', 16, 512, 14, '1920x1080'),
(10, 'Acer', 'Intel Core i3-1215U', 'Intel UHD Graphics', 8, 256, 14, '1920x1080'),
(15, 'Acer', 'AMD Ryzen 7 5700U', 'AMD Radeon Graphics', 16, 512, 15.6, '1920x1080'),
(16, 'Asus', 'Intel Core i5-13500H', 'NVIDIA Intel Iris X Graphics', 16, 512, 14, '2880x1800'),
(18, 'Asus', 'Intel Core Ultra 7 155H', 'Intel Arc Graphics', 16, 512, 16, '3200x2000'),
(19, 'HP', 'Intel Core Ultra 5 125U', 'Intel Graphics', 8, 512, 14, '1920x1200');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `AnhMoTaSP` varchar(255) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`MaSP`, `TenSP`, `MaLoai`, `AnhMoTaSP`, `SoLuong`, `Gia`) VALUES
(1, 'Màn hình MSI PRO MP242L', 3, './assets/image/50725_m__n_h__nh_msi_pro_mp242l__4_.jpg', 460, 1890000),
(2, 'Laptop ASUS VivoBook Go 14 E1404FA-NK177W', 1, './assets/image/e1404fa-1.png', 200, 11490000),
(3, 'Laptop Gaming MSI Katana 15 B13UDXK 2270VN', 2, './assets/image/8qziagrd.png', 60, 20900000),
(4, 'Laptop Lenovo LOQ 15ARP9 83JC003YVN', 2, './assets/image/48807_laptop_lenovo_loq_15arp9_83jc003yvn__3_.jpg', 50, 27790000),
(6, 'Card màn hình MSI GeForce RTX 5090 32G GAMING TRIO OC', 4, './assets/image/bzilxs4m.png', 2, 97990000),
(7, 'Laptop GIGABYTE G5 MF5-52VN383SH', 2, './assets/image/47728_laptop_gigabyte_g5_mf5_52vn383sh__1_.jpg', 55, 20790000),
(8, 'Màn Hình Gaming GIGABYTE GS27F', 3, './assets/image/man_hinh_gaming_gigabyte_gs27f__5_.jpg', 100, 3298000),
(9, 'Card màn hình ASUS Dual GeForce RTX™ 3060 V2 12GB GDDR6', 4, './assets/image/imagertx3060V2_12GB.png', 30, 7790000),
(10, 'Laptop Acer Aspire Lite AL14-51M-36MH_NX.KTVSV.001', 1, './assets/image/49837_laptop_acer_aspire_lite_al14_51m_36mh_nx_ktvsv_001__2_.jpg', 20, 9190000),
(11, 'Laptop Asus TUF Gaming F15 FX507ZC4-HN095W', 2, './assets/image/46655_laptop_asus_tuf_gaming_f15_fx507zc4_hn095w__3_.jpg', 100, 19990000),
(12, 'Laptop Lenovo Legion Pro 5 16IRX9 83DF0046VN', 2, './assets/image/47462_laptop_lenovo_legion_pro_5_16irx9_83df0046vn__1_.jpg', 20, 51990000),
(13, 'Laptop Gaming Acer Aspire 7 A715-76G-5806 - NH.QMFSV.002', 2, './assets/image/45836_ap7.jpg', 50, 18990000),
(14, 'Laptop Gaming Acer Nitro 5 Tiger AN515-58-5935 NH.QLZSV.001', 2, './assets/image/45837_bnfg.jpg', 33, 22290000),
(15, 'Laptop Acer Aspire 3 A315-44P-R5QG NX.KSJSV.001', 1, './assets/image/50618_laptop_acer_aspire_3_a315_44p_r5qg_nx_ksjsv_001__4_.jpg', 22, 12900000),
(16, 'Laptop Asus Vivobook 14 OLED A1405VA-KM095W', 1, './assets/image/44758_laptop_asus_vivobook_14_oled_a1405va_km095w__7_.jpg', 100, 16990000),
(17, 'Laptop HP VICTUS 15-fa1155TX 952R1PA_16G', 2, './assets/image/49855_laptop_hp_victus_15_fa1155tx_952r1pa_16g__2_.jpg', 50, 17990000),
(18, 'Laptop ASUS Vivobook S 16 OLED S5606MA-MX051W', 1, './assets/image/g8gdssys.png', 50, 25490000),
(19, 'Laptop HP ProBook 440 G11 A74B4PT', 1, './assets/image/49741_laptop_hp_probook_440_g11_a74b4pt__1_.jpg', 200, 21490000),
(21, 'Card màn hình Asus ROG Strix GeForce RTX 4090 OC Edition 24GB GDDR6X', 4, './assets/image/tn9pvbdr.png', 10, 64990000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `MaLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`MaLoai`) REFERENCES `categories` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
