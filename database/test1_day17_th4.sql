-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 09:02 PM
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
(1, 'admin', '1111');

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
(19, 'HP', 'Intel Core Ultra 5 125U', 'Intel Graphics', '8GB', '512GB', '14 inch', '1920x1200');

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
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(26) NOT NULL,
  `email` varchar(40) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phonenumber` int(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `gender`, `phonenumber`, `date_of_birth`, `address`) VALUES
(1, 'to', '123', 'deptrai456@gmail.com', 'deptrai', 123, '0000-00-00', ''),
(2, 'to222', '123', 'deptai456@gmail.com', '', 0, '0000-00-00', ''),
(4, 'to213123', '123', 'deptrai456@gmail.com', '', 0, '0000-00-00', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

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
-- Chỉ mục cho bảng `manhinhdetails`
--
ALTER TABLE `manhinhdetails`
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

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
-- Các ràng buộc cho bảng `manhinhdetails`
--
ALTER TABLE `manhinhdetails`
  ADD CONSTRAINT `manhinhdetails_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `products` (`MaSP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
