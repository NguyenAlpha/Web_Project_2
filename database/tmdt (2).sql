-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 12, 2025 lúc 03:47 AM
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
-- Cơ sở dữ liệu: `tmdt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `address`
--

INSERT INTO `address` (`id`, `userID`, `address`) VALUES
(1, 3, 'Khu đô thị Times City, 458 Minh Khai, Hai Bà Trưng, Hà Nội'),
(2, 3, 'Tòa nhà Vincom, 72 Lê Thánh Tôn, Phường Bến Nghé, Quận 1, TP.HCM'),
(3, 4, 'Biệt thự số 12, đường Lê Quý Đôn, Quận 3, TP.HCM'),
(4, 4, 'Tòa nhà Vietjet, Số 1 đường Trần Hưng Đạo, Quận Hoàn Kiếm, Hà Nội'),
(5, 5, 'Số 45 ngõ 12, đường Láng Hạ, Đống Đa, Hà Nội'),
(6, 6, 'Chung cư Golden Westlake, 162A Hoàng Hoa Thám, Tây Hồ, Hà Nội'),
(7, 6, 'Tòa nhà FPT Tower, 10 Phạm Văn Bạch, Cầu Giấy, Hà Nội'),
(8, 7, 'Tòa nhà VNG, Z6 đường số 13, Khu đô thị mới Nam Thăng Long, Hà Nội'),
(9, 8, 'Số 78 đường 3/2, Quận 10, TP.HCM'),
(10, 9, 'Số 1 đường Hoàng Hoa Thám, Ba Đình, Hà Nội'),
(11, 10, 'Biệt thự số 5, đường Hùng Vương, Ba Đình, Hà Nội'),
(12, 11, 'Biệt thự ven sông, Phú Mỹ Hưng, Quận 7, TP.HCM'),
(13, 11, 'Số 12 Nguyễn Thị Minh Khai, Quận 1, TP.HCM'),
(14, 12, 'Chung cư The Manor, đường Mễ Trì, Nam Từ Liêm, Hà Nội'),
(15, 13, 'Biệt thự tại Khu đô thị Vinhomes Central Park, Bình Thạnh, TP.HCM'),
(16, 13, 'Số 24 Trần Quang Diệu, Phường 14, Quận 3, TP.HCM'),
(17, 14, 'Số 56 Lý Tự Trọng, Quận 1, TP.HCM'),
(18, 15, 'Số 8 đường Lê Đại Hành, Hai Bà Trưng, Hà Nội'),
(19, 16, 'Khu tập thể Mỹ Đình, Nam Từ Liêm, Hà Nội'),
(20, 17, 'Số 32 Nguyễn Du, Quận 1, TP.HCM'),
(28, 2, '229 cao thăng, p13, q4, hcm'),
(29, 1, '44 Phan Văn trị, TPHCM'),
(30, 1, 'Bãi sau Vũng Tàu');
(31, 18, '123 Đường Lê Lợi, Phường Bến Nghé, Quận 1, TP.HCM'),
(32, 19, '456 Đường Nguyễn Huệ, Phường Bến Nghé, Quận 1, TP.HCM'),
(33, 20, '789 Đường Trần Hưng Đạo, Phường Cầu Ông Lãnh, Quận 1, TP.HCM'),
(34, 21, '101 Đường Hai Bà Trưng, Phường Đa Kao, Quận 1, TP.HCM'),
(35, 22, '202 Đường Lê Duẩn, Phường Bến Thành, Quận 1, TP.HCM'),
(36, 23, '303 Đường Nam Kỳ Khởi Nghĩa, Phường Nguyễn Thái Bình, Quận 1, TP.HCM'),
(37, 24, '404 Đường Pasteur, Phường Bến Nghé, Quận 1, TP.HCM'),
(38, 25, '505 Đường Đồng Khởi, Phường Bến Nghé, Quận 1, TP.HCM'),
(39, 26, '606 Đường Nguyễn Thị Minh Khai, Phường Đa Kao, Quận 1, TP.HCM'),
(40, 27, '707 Đường Lý Tự Trọng, Phường Bến Thành, Quận 1, TP.HCM'),
(41, 28, '808 Đường Lê Thánh Tôn, Phường Bến Nghé, Quận 1, TP.HCM'),
(42, 29, '909 Đường Cách Mạng Tháng 8, Phường Bến Thành, Quận 1, TP.HCM'),
(43, 30, '111 Đường Võ Văn Tần, Phường 6, Quận 3, TP.HCM'),
(44, 31, '222 Đường Nguyễn Đình Chiểu, Phường 6, Quận 3, TP.HCM'),
(45, 32, '333 Đường Lê Văn Sỹ, Phường 14, Quận 3, TP.HCM'),
(46, 33, '444 Đường Cộng Hòa, Phường 4, Quận Tân Bình, TP.HCM'),
(47, 34, '555 Đường Hoàng Văn Thụ, Phường 9, Quận Phú Nhuận, TP.HCM'),
(48, 35, '666 Đường Phan Đình Phùng, Phường 2, Quận Phú Nhuận, TP.HCM'),
(49, 36, '777 Đường Nguyễn Văn Trỗi, Phường 11, Quận Phú Nhuận, TP.HCM'),
(50, 37, '888 Đường Trường Sa, Phường 15, Quận Bình Thạnh, TP.HCM'),
(51, 38, '999 Đường Xô Viết Nghệ Tĩnh, Phường 25, Quận Bình Thạnh, TP.HCM'),
(52, 39, '111 Đường Lê Quang Định, Phường 14, Quận Bình Thạnh, TP.HCM'),
(53, 40, '222 Đường Điện Biên Phủ, Phường 17, Quận Bình Thạnh, TP.HCM'),
(54, 41, '333 Đường Bạch Đằng, Phường 2, Quận Bình Thạnh, TP.HCM'),
(55, 42, '444 Đường Nguyễn Hữu Cảnh, Phường 22, Quận Bình Thạnh, TP.HCM'),
(56, 43, '555 Đường Ung Văn Khiêm, Phường 25, Quận Bình Thạnh, TP.HCM'),
(57, 44, '666 Đường Phan Văn Trị, Phường 7, Quận Gò Vấp, TP.HCM'),
(58, 45, '777 Đường Quang Trung, Phường 10, Quận Gò Vấp, TP.HCM'),
(59, 46, '888 Đường Lê Đức Thọ, Phường 15, Quận Gò Vấp, TP.HCM'),
(60, 47, '999 Đường Nguyễn Oanh, Phường 17, Quận Gò Vấp, TP.HCM');

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
(4, 3, 4, 2),
(5, 3, 12, 1),
(6, 3, 18, 3),
(10, 5, 9, 1),
(11, 5, 15, 4),
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
(47, 17, 23, 1),
(59, 4, 2, 2);

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
(24, 'Dell', 'Intel Core i7-1355U', 'Intel Iris Xe Graphics', '16GB', '512GB', '14 inch', '1920x1080'),
(63, 'HP', ' Intel Core™ i5-13500HX', 'GeForce RTX™ 4060 8GB GDDR6', '16GB', '512GB', '16.1 inch', '1920x1080'),
(64, 'Asus', ' Intel Core™ i5-1235', 'Onboard graphics', '16GB', '512GB', '16 inch', '2560x1440'),
(65, 'Lenovo', 'Intel Core™ Ultra 7 155H, 16C (6P + 8E + 2LPE) / 22T, Max Turbo up to 4.8GHz, 24MB', 'Intel Core™ Ultra 7 155H, 16C (6P + 8E + 2LPE) / 22T, Max Turbo up to 4.8GHz, 24MB', '16GB', '1TB', '14.5 inch', '2888x1880'),
(66, 'Acer', 'Intel Core™ i7-13700H 3.70 upto 5.00GHz ,14 Core 20 Threads, 24 MB Smart Cache', 'NVIDIA GeForce RTX™ Graphics 4050 6GB GDDR6', '32GB', '1TB', '15.6 inch', '1920x1200'),
(67, 'MSI', 'Intel Core™ Ultra 7 258V up to 4.80Ghz, 8 Cores (4P+4PLE), 8 Threads, 12MB Intel Smart Cache', 'Intel Arc™ 140V', '32GB', '1TB', '13.3 inch', '2880x1800'),
(68, 'Acer', 'Intel Core™ Ultra 7 Processor 258V 32GB 1.8 GHz (12MB Cache, up to 4.8 GHz, 8 cores, 8 Threads)', 'Intel Arc™ Graphics 140V', '32GB', '1TB', '16 inch', '1920x1080'),
(69, 'Lenovo', 'Intel Core™ Ultra 7 258V, 8C (4P + 4LPE) / 8T, Max Turbo up to 4.8GHz, 12MB', 'Integrated Intel Arc™ Graphics 140V', '32GB', '1TB', '14 inch', '2880x1800'),
(70, 'Asus', 'Intel Core™ Ultra 7 Processor 155H 1.4 GHz (24MB Cache, up to 4.8 GHz, 16 cores, 22 Threads); Intel AI Boost NPU', 'Intel Arc™ Graphics', '32GB', '1TB', '14 inch', '2880x1800');

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
(7, 'Gigabyte', 'NVIDIA GeForce RTX 4050 6GB', 'Intel Core i5-13500H', '8GB', '512GB', '15.6 inch', '1920x1080'),
(49, 'Acer', 'NVIDIA GeForce RTX 4050 6GB GDDR6 VRAM, hỗ trợ 2560 NVIDIA CUDA Cores', 'Intel Core i7-14700HX (20 lõi / 28 luồng, 3.9 GHz, 5.5 GHz, 33 MB, Intel Smart Cache)', '32GB', '512GB', '16 inch', '2560x1600'),
(51, 'Lenovo', 'NVIDIA GeForce RTX™ 4060 8GB GDDR6, Boost Clock 2370MHz, TGP 140W', 'Intel Core™ i7-14650HX, 16C (8P + 8E) / 24T, P-core 2.2 / 5.2GHz, E-core 1.6 / 3.7GHz, 30MB', '16GB', '512GB', '16 inch', '2560x1600'),
(53, 'Acer', 'NVIDIA GeForce RTX™ 4070 8GB GDDR6', 'Intel Core i7-13700HX 3.7GHz up to 5.0GHz, 16 Cores 24 Threads ,30 MB Intel Smart Cache', '16GB', '512GB', '16 inch', '2560x1600'),
(54, 'Asus', 'NVIDIA GeForce RTX™ 4060 Laptop GPU 2225Mhz* at 100W(2175MHz Boost Clock+50MHz O.C.,75W+25W Dynamic Boost) + AMD Radeon™ Graphics', 'AMD Ryzen™ AI 9 HX 370 Processor 2.0GHz (36MB Cache, up to 5.1GHz, 12 cores, 24 Threads); AMD Ryzen™ AI up to 81 TOPs', '16GB', '1TB', '14 inch', '2560x1600'),
(56, 'HP', 'NVIDIA GeForce RTX™ 4070 8GB GDDR6', 'Intel Core i9-14900HX up to 5.8Ghz, 36MB', '32GB', '1TB', '16 inch', '2560x1440'),
(57, 'MSI', 'NVIDIA GeForce RTX™ 4050 Laptop GPU 6GB GDDR6 Up to 2355MHz Boost Clock 105W Maximum Graphics Power with Dynamic Boost.', 'Intel Core™ i7-14700HX (1.5GHz upto 5.5GHz, 20 cores 28 threads, 33 MB Intel Smart Cache)', '16GB', '1TB', '16 inch', '1920x1200'),
(58, 'MSI', 'NVIDIA GeForce RTX™ 5070 Ti Laptop GPU 12GB GDDR7 up to 2220MHz Boost Clock 140W Maximum Graphics Power with Dynamic Boost. AI TOPs: 992 TOPS', 'Intel Core™ Ultra 7 255HX (1.80Hz up to 5.20GHz, 30MB Cache) AI NPU TOPs: 13 TOPs', '16GB', '512GB', '16 inch', '2560x1600'),
(59, 'Lenovo', 'NVIDIA GeForce RTX™ 4070 8GB GDDR6, Boost Clock 2175MHz, TGP 115W', 'Intel Core™ i9-14900HX, 24C (8P + 16E) / 32T, P-core 2.2 / 5.8GHz, E-core 1.6 / 4.1GHz, 36MB', '32GB', '1TB', '16 inch', '3200x3200'),
(60, 'MSI', 'NVIDIA GeForce RTX™ 3050 Laptop GPU Up to 1172.5MHz Boost Clock 45W Maximum Graphics Power with Dynamic Boost.', 'Intel Core i7-13620H (3.6GHz~4.9GHz) 10 Nhân 16 Luồng', '16GB', 'SSD NVMe PCIe 512GB Gen4x4 (Còn 1 slot 2.5\" SATA HDD)', '15,6', '1920x1080'),
(61, 'Acer', 'NVIDIA GeForce RTX™ 4060 8GB GDDR6', 'Intel Core™ i9-13900H 2.6 GHz (24MB Cache, up to 5.4 GHz, 14 cores, 20 Threads)', '16GB', '512GB', '15.6 ', '1920 x 1080'),
(62, 'MSI', 'NVIDIA GeForce RTX™ 4050 Laptop GPU 6GB GDDR6 Up to 2355MHz Boost Clock 105W Maximum Graphics Power with Dynamic Boost.', 'Intel Core i9-14900HX up to 5.8Ghz, 36MB', '16GB ', '1TB', '15.6 inch', '1920x1080');

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
(2, 9, 2),
(2, 8, 5),
(3, 2, 1),
(3, 4, 3),
(4, 3, 1),
(4, 22, 1),
(4, 4, 1),
(5, 2, 1),
(6, 2, 1),
(7, 2, 1),
(7, 11, 2),
(7, 19, 1),
(7, 24, 1),
(7, 4, 1),
(8, 4, 1),
(9, 19, 2),
(10, 4, 1),
(10, 16, 3),
(10, 49, 1);

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
(8, 'Gigabyte', '', '', '', '', '', ''),
(81, 'Asus', '25 inch', '180 Hz', '16:9', 'Fast IPS', '2560x1600', '1.2kg'),
(82, 'ViewSonic', '14 inch', '144 Hz', '16:9', 'IPS', '1920x1080', '1.1 kg'),
(83, 'ViewSonic', '15.6 inch', '60Hz', '21:9', 'LCD', '3200x3200', '0.9 kg'),
(84, 'LG', '14 inch', '75 Hz', '16:9', 'VA', '2880x1800', '1.2kg'),
(85, 'Acer', '22 inch', '120 Hz', ' 21:9', 'IPS', '2560x1440', '1.5 kg'),
(86, 'Acer', '15.6 inch', '240 Hz', '16:9', 'Fast IPS', '2560x1440', '0.9 kg'),
(87, 'Acer', '14 inch', '180 Hz', '16:9', 'LCD', '2560x1600', '1.5 kg'),
(88, 'ViewSonic', '16 inch', '60Hz', '21:9', 'VA', '2880x1800', '1.4 kg'),
(89, 'Gigabyte', '15.6 inch', '120 Hz', '16:9', 'Fast IPS', '1920x1080', '0.9 kg'),
(90, 'Philips ', '14 inch', '144 Hz', '21:9', 'LCD', '2560x1440', '1.4 kg'),
(91, 'LG', '20 inch', '180 Hz', '16:9', 'VA', '3200x3200', '1 kg'),
(92, 'E-DRA', '15.6 inch', '75 Hz', '16:9', 'LCD', '2560x1440', '1.2kg'),
(93, 'ViewSonic', '16 inch', '75 Hz', '16:9', 'LCD', '2560x1440', '1.5 kg'),
(94, 'LG', '24 inch', '180 Hz', '16:9', 'IPS', '1920x1200', '2 kg'),
(95, 'HKC', '25 inch', '120 Hz', '21:9', 'Fast IPS', '2560x1600', '1.2kg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `MaDon` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `NgayDat` datetime DEFAULT NULL,
  `NgayGiao` datetime DEFAULT NULL,
  `TongTien` int(11) NOT NULL,
  `TrangThai` enum('chờ xác nhận','đã xác nhận','đang giao','đã giao','đã huỷ','đã nhận hàng') DEFAULT NULL,
  `ThanhToan` enum('chuyển khoản','tiền mặt') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`MaDon`, `UserID`, `DiaChi`, `NgayDat`, `NgayGiao`, `TongTien`, `TrangThai`, `ThanhToan`) VALUES
(1, 5, 'abc', NULL, '2025-05-12 08:11:40', 0, '', 'chuyển khoản'),
(2, 2, '229 cao thăng, p13, q4, hcm', '2025-05-10 11:49:45', '2025-05-12 08:11:40', 32070000, 'đã xác nhận', 'chuyển khoản'),
(3, 2, '229 cao thăng, p13, q4, hcm', NULL, '2025-05-12 08:11:40', 94860000, 'đã nhận hàng', 'tiền mặt'),
(4, 4, 'Biệt thự số 12, đường Lê Quý Đôn, Quận 3, TP.HCM', NULL, '2025-05-12 08:11:40', 56989000, 'đã xác nhận', 'tiền mặt'),
(5, 4, 'Biệt thự số 12, đường Lê Quý Đôn, Quận 3, TP.HCM', NULL, '2025-05-12 08:11:40', 11490000, 'đang giao', 'tiền mặt'),
(6, 4, 'Biệt thự số 12, đường Lê Quý Đôn, Quận 3, TP.HCM', NULL, '2025-05-12 08:11:40', 11490000, 'đã giao', 'tiền mặt'),
(7, 6, 'Chung cư Golden Westlake, 162A Hoàng Hoa Thám, Tây Hồ, Hà Nội', '2025-05-11 18:04:14', '2025-05-12 08:11:40', 125740000, 'đang giao', 'tiền mặt'),
(8, 6, 'Chung cư Golden Westlake, 162A Hoàng Hoa Thám, Tây Hồ, Hà Nội', '2025-05-12 02:29:26', '2025-05-12 08:11:40', 27790000, 'đã giao', 'tiền mặt'),
(9, 6, 'Chung cư Golden Westlake, 162A Hoàng Hoa Thám, Tây Hồ, Hà Nội', '2025-05-12 03:05:39', '2025-05-12 08:11:40', 42980000, 'đã nhận hàng', 'tiền mặt'),
(10, 2, '229 cao thăng, p13, q4, hcm', '2025-05-12 07:56:34', '2025-05-12 08:11:40', 117250000, 'đã nhận hàng', 'tiền mặt');

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
  `DaBan` int(11) NOT NULL,
  `Gia` int(11) NOT NULL,
  `TrangThai` enum('hiện','ẩn') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`MaSP`, `TenSP`, `MaLoai`, `AnhMoTaSP`, `SoLuong`, `DaBan`, `Gia`, `TrangThai`) VALUES
(1, 'Màn hình MSI PRO MP242L', 'ManHinh', './assets/image/50725_m__n_h__nh_msi_pro_mp242l__4_.jpg', 460, 22, 1890000, 'hiện'),
(2, 'Laptop ASUS VivoBook Go 14 E1404FA-NK177W', 'Laptop', './assets/image/e1404fa-1.png', 195, 76, 11490000, 'hiện'),
(3, 'Laptop Gaming MSI Katana 15 B13UDXK 2270VN', 'LaptopGaming', './assets/image/8qziagrd.png', 60, 55, 20900000, 'hiện'),
(4, 'Laptop Lenovo LOQ 15ARP9 83JC003YVN', 'LaptopGaming', './assets/image/48807_laptop_lenovo_loq_15arp9_83jc003yvn__3_.jpg', 37, 78, 27790000, 'hiện'),
(6, 'Card màn hình MSI GeForce RTX 5090 32G GAMING TRIO OC', 'GPU', './assets/image/bzilxs4m.png', 2, 2, 97990000, 'hiện'),
(7, 'Laptop GIGABYTE G5 MF5-52VN383SH', 'LaptopGaming', './assets/image/47728_laptop_gigabyte_g5_mf5_52vn383sh__1_.jpg', 55, 48, 20790000, 'hiện'),
(8, 'Màn Hình Gaming GIGABYTE GS27F', 'ManHinh', './assets/image/man_hinh_gaming_gigabyte_gs27f__5_.jpg', 100, 1, 3298000, 'hiện'),
(9, 'Card màn hình ASUS Dual GeForce RTX™ 3060 V2 12GB GDDR6', 'GPU', './assets/image/imagertx3060V2_12GB.png', 30, 13, 7790000, 'hiện'),
(10, 'Laptop Acer Aspire Lite AL14-51M-36MH_NX.KTVSV.001', 'Laptop', './assets/image/49837_laptop_acer_aspire_lite_al14_51m_36mh_nx_ktvsv_001__2_.jpg', 20, 62, 9190000, 'hiện'),
(11, 'Laptop Asus TUF Gaming F15 FX507ZC4-HN095W', 'LaptopGaming', './assets/image/46655_laptop_asus_tuf_gaming_f15_fx507zc4_hn095w__3_.jpg', 92, 48, 19990000, 'hiện'),
(12, 'Laptop Lenovo Legion Pro 5 16IRX9 83DF0046VN', 'LaptopGaming', './assets/image/47462_laptop_lenovo_legion_pro_5_16irx9_83df0046vn__1_.jpg', 20, 15, 51990000, 'hiện'),
(13, 'Laptop Gaming Acer Aspire 7 A715-76G-5806 - NH.QMFSV.002', 'LaptopGaming', './assets/image/45836_ap7.jpg', 50, 32, 18990000, 'hiện'),
(14, 'Laptop Gaming Acer Nitro 5 Tiger AN515-58-5935 NH.QLZSV.001', 'LaptopGaming', './assets/image/45837_bnfg.jpg', 33, 38, 22290000, 'hiện'),
(15, 'Laptop Acer Aspire 3 A315-44P-R5QG NX.KSJSV.001', 'Laptop', './assets/image/50618_laptop_acer_aspire_3_a315_44p_r5qg_nx_ksjsv_001__4_.jpg', 22, 16, 12900000, 'hiện'),
(16, 'Laptop Asus Vivobook 14 OLED A1405VA-KM095W', 'Laptop', './assets/image/44758_laptop_asus_vivobook_14_oled_a1405va_km095w__7_.jpg', 97, 47, 16990000, 'hiện'),
(17, 'Laptop HP VICTUS 15-fa1155TX 952R1PA_16G', 'LaptopGaming', './assets/image/49855_laptop_hp_victus_15_fa1155tx_952r1pa_16g__2_.jpg', 50, 15, 17990000, 'hiện'),
(18, 'Laptop ASUS Vivobook S 16 OLED S5606MA-MX051W', 'Laptop', './assets/image/g8gdssys.png', 50, 22, 25490000, 'hiện'),
(19, 'Laptop HP ProBook 440 G11 A74B4PT', 'Laptop', './assets/image/49741_laptop_hp_probook_440_g11_a74b4pt__1_.jpg', 194, 68, 21490000, 'hiện'),
(21, 'Card màn hình Asus ROG Strix GeForce RTX 4090 OC Edition 24GB GDDR6X', 'GPU', './assets/image/tn9pvbdr.png', 10, 15, 64990000, 'hiện'),
(22, 'VGA Gigabyte RTX 4060 Windforce OC 8GB', 'GPU', './assets/image/45659_vga_gigabyte_rtx_4060_windforce_oc_8gb_anphat88.jpg', 100, 41, 8299000, 'hiện'),
(23, 'VGA Gigabyte GeForce RTX 3050 WINDFORCE OC V2 8GB', 'GPU', './assets/image/46200_vga_gigabyte_geforce_rtx_3050_windforce___2_.jpg', 12, 4, 5599000, 'hiện'),
(24, 'Laptop Dell Latitude 3450 71058806', 'Laptop', './assets/image/51342_laptop_dell_latitude_3450_71058806__1_.jpg', 96, 57, 24990000, 'hiện'),
(49, 'Laptop gaming Acer Predator Helios Neo 16 PHN16 72 78L4', 'LaptopGaming', './assets/image/1746952951_acer_predator_helios_neo_16_2024__2__3ffd04967bc44b82b78f3e0cee408665_1024x1024.jpg', 49, 1, 38490000, 'hiện'),
(51, 'Laptop gaming Lenovo Legion 5 16IRX9 83DG004YVN', 'LaptopGaming', './assets/image/1746953416_legion_5_16irx9_ct1_01_6639fb2c9ce446439a36578865a5c7d0_1024x1024.jpg', 20, 0, 37990000, 'hiện'),
(53, 'Laptop gaming Acer Predator Helios Neo 16 PHN16 71 74QR', 'LaptopGaming', './assets/image/1746953641_468f7a1472eb8f563424b86621d_c04206638f4643d58ab3079d6dc42ec0_1024x1024_18da0285e1e848248921bbcfc8c80c53_grande.jpg', 23, 0, 41990000, 'hiện'),
(54, 'Laptop gaming ASUS TUF Gaming FA401WV RG062WS', 'LaptopGaming', './assets/image/1746954077_ava_dea980b662854ab8a4dd359d3bd8d2b4_grande.jpg', 21, 0, 39990000, 'hiện'),
(55, 'HP Pavilion Gaming 15 EC2158AX', 'LaptopGaming', './assets/image/1746954382_HP-Pavilion-Gaming-15-Ryzen-03.jpg', 38, 0, 38600000, 'hiện'),
(56, 'Laptop gaming HP OMEN 16-wf1137TX A2NR9PA', 'LaptopGaming', './assets/image/1746954618_1_a4de5185d81a4d8e851974281003b6d4_grande.jpg', 25, 0, 52490000, 'hiện'),
(57, 'Laptop gaming MSI Sword 16 HX B14VEKG 856VN', 'LaptopGaming', './assets/image/1746954844_ava_ecb79fdbde454bfd87bf7ccd8675e972_grande.jpg', 15, 0, 31490000, 'hiện'),
(58, 'Laptop gaming MSI Vector 16 HX AI A2XWHG 010VN', 'LaptopGaming', './assets/image/1746955011_1024__1__035bd6ee5a8246078c525b4bc8d2e55b_grande.jpg', 7, 0, 54990000, 'hiện'),
(59, 'Laptop gaming Lenovo Legion 7 16IRX9 83FD004MVN', 'LaptopGaming', './assets/image/1746955134_ava_1388feab03cd40a2ad5b495d909a0a60_grande.jpg', 12, 0, 59990000, 'hiện'),
(60, 'Laptop gaming MSI Thin 15 B13UC 2044VN', 'LaptopGaming', './assets/image/1746955252_thin-new_d31ff3b88e7f40e7ac88acc624e03d4f_grande.jpg', 22, 0, 19290000, 'hiện'),
(61, 'Laptop gaming Acer Nitro V ANV15 51 91T5', 'LaptopGaming', './assets/image/1746955427_nitro-v_755588bd95514b6386940d73d3951e2d_1024x1024_95ef516ce29440e4ad51dedbab0e352c_grande.jpg', 11, 0, 32990000, 'hiện'),
(62, 'Laptop gaming MSI Katana 15 B13VFK 676VN', 'LaptopGaming', './assets/image/1747009559_nitro-v_755588bd95514b6386940d73d3951e2d_1024x1024_95ef516ce29440e4ad51dedbab0e352c_grande (2).jpg', 34, 0, 27990000, 'hiện'),
(63, 'Laptop HP Victus 16-r0298TX - AE0N5PA', 'Laptop', './assets/image/1747011632_unnamed.jpg', 22, 0, 29490000, 'hiện'),
(64, 'Laptop Asus ExpertBook B1 B1402CBA-EB4202W', 'Laptop', './assets/image/1747011733_unnamed.jpg', 11, 0, 12990000, 'hiện'),
(65, 'Laptop Lenovo Yoga Pro 7 14IMH9 83E2006MVN', 'Laptop', './assets/image/1747012601_ava_8236b3b0602640c48f4a922e1a7dd7f1_grande.jpg', 4, 0, 41990000, 'hiện'),
(66, 'Laptop Acer Swift X14 SFX14 71G 78SY', 'Laptop', './assets/image/1747012683_ava_426f720508c745cbb130c469ae257efc_grande.jpg', 54, 0, 39990000, 'hiện'),
(67, 'Laptop MSI Prestige 13 AI+ Evo A2VMG 040VN', 'Laptop', './assets/image/1747012787_1024__2__06169603ef974daf874ec055a501a783_grande.jpg', 12, 0, 35690000, 'hiện'),
(68, 'Laptop Acer Swift 14 AI SF14 51 75VP', 'Laptop', './assets/image/1747012911_khung-laptop-23_d5b6c84f834f4b3195b0bf8a4802aaa6_grande.jpg', 63, 0, 38990000, 'hiện'),
(69, 'Laptop Lenovo Yoga Slim 7 14ILL10 83JX0037VN', 'Laptop', './assets/image/1747012991_yoga_slim_7_14ill10_ct2_04_afa17ced1fb0466387892f3306015ebf_grande.jpg', 17, 0, 35490000, 'hiện'),
(70, 'Laptop ASUS Zenbook 14 OLED UX3405MA PP152W', 'Laptop', './assets/image/1747013085_ava_85f0a13f59c24412a311436fd2b3efc7_grande.jpg', 76, 0, 31990000, 'hiện'),
(71, 'Màn hình Asus TUF GAMING VG259Q3A 25\" Fast IPS 180Hz Gsync chuyên game', 'ManHinh', './assets/image/1747013290_asus_vg259q3a_gearvn_e76558abb18946d7b7d51dd16d915d89_1024x1024.jpg', 61, 0, 3290000, 'hiện'),
(72, 'Màn hình ViewSonic VX2479A-HD-PRO 24\" IPS 240Hz 1ms chuyên game', 'ManHinh', './assets/image/1747013439_view_vx2479a-hd-pro_gearvn_6f2507d66980467a8f1eb20e5cb6be09_grande.jpg', 22, 0, 3690000, 'hiện'),
(73, 'Màn hình ViewSonic VA2708-2K-MHD 27\" IPS 2K 100Hz', 'ManHinh', './assets/image/1747013580_va2708-2k-mhd_gearvn_b12ff93a3b144d268bccd83e4f66802b_grande.jpg', 2, 0, 3790000, 'hiện'),
(74, 'Màn hình LG 24QP500-B 24\" IPS 2K 75Hz Freesync HDR10', 'ManHinh', './assets/image/1747013650_500-b-24-ips-2k-75hz-freesync-hdr10-1_fafefcddc82444fea1481e94f056ec3e_de6a37748e6d427abe6674b439223c02_grande.jpg', 31, 0, 3890000, 'hiện'),
(75, 'Màn hình Acer SA272U-E 27\" IPS 2K 100Hz', 'ManHinh', './assets/image/1747013727_acer_sa272u_e_black_gearvn_47dbf6b9040b45519576fd57af120ccc_grande.jpg', 2, 0, 3890000, 'hiện'),
(76, 'Màn hình ACER KG270 M5 27\" IPS 180Hz chuyên game', 'ManHinh', './assets/image/1747013784_kg270_m5_01_wp_ksp_eb42565fe77d49a5bca05b233e719f27_1024x1024_1a04284f5ae24458a5ab2f6135f76a38_grande.jpg', 14, 0, 3590000, 'hiện'),
(77, 'Màn hình Acer KG270-X1 27\" IPS 200Hz Gsync chuyên game', 'ManHinh', './assets/image/1747013844_acer_kg270_x1_gearvn_15f0f9177bba487197fa984aac42d623_grande.jpg', 34, 0, 3490000, 'hiện'),
(78, 'Màn hình ViewSonic VX2779-HD-PRO 27\" IPS 180Hz chuyên game', 'ManHinh', './assets/image/1747013904_image-removebg-preview__6_.jpg', 312, 0, 3290000, 'hiện'),
(79, 'Màn hình GIGABYTE G25F2 25\" IPS 200Hz chuyên game', 'ManHinh', './assets/image/1747013965_giga_g25f2_gearvn_60630e2345514c788bd33d80077579c2_grande.jpg', 123, 0, 3290000, 'hiện'),
(80, 'Màn hình Philips 27M2N3200L 27\" IPS 180Hz chuyên game', 'ManHinh', './assets/image/1747014028_philips_27m2n3200l_gearvn_3be3acb3421e44938a76dbc96023931f_grande.jpg', 53, 0, 3190000, 'hiện'),
(81, 'Màn hình LG 24GS65F-B 24\" IPS 180Hz HDR10 Gsync chuyên game', 'ManHinh', './assets/image/1747014131_lg_24gs65f-b_gearvn_af476af1e4514a2684591304b3e4164a_grande.jpg', 12, 0, 3150000, 'hiện'),
(82, 'Màn hình E-DRA EGM27F180PV 27\" IPS 180Hz chuyên game', 'ManHinh', './assets/image/1747014186_edra_egm27f180pv_gearvn_6eb55f364f9e431886ffdd99c01cd7d1_grande.jpg', 61, 0, 3190000, 'hiện'),
(83, 'Màn hình Viewsonic VA2432-H 24\" IPS 100Hz viền mỏng', 'ManHinh', './assets/image/1747014278_1_6bf24e36cbd34fd990728781a18e1653_befa433a45b84594bf6aa5a5c8526365_grande.JPG', 9, 0, 1990000, 'hiện'),
(84, 'Màn hình LG 24MR400-B 24\" IPS 100Hz', 'ManHinh', './assets/image/1747014360_medium01_f24d7ece218a4ba5b88dc14ce521de79_grande.jpg', 23, 0, 2190000, 'hiện'),
(85, 'Màn hình HKC MB27V9-U 27\" IPS 100Hz', 'ManHinh', './assets/image/1747014433_mb24v9_mb27v9-02.jpg', 54, 0, 2150000, 'hiện');

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
  `date_of_birth` date DEFAULT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `sex`, `phonenumber`, `date_of_birth`, `avatar`, `TrangThai`) VALUES
(1, 'ThanhThao', 'ThanhThao123', NULL, NULL, NULL, NULL, '', 'mở'),
(2, 'u', 'u', 'u1@d.c', 'Nam', '0328989480', '1965-11-30', '', 'mở'),
(3, 'PhamNhatVuong', 'vietnam123', 'vuong@vin.group', 'Nam', '0987654321', '1968-08-05', '', 'mở'),
(4, 'NguyenThiPhuongThao', 'vietjet456', 'thao@vietjetair.com', 'Nữ', '0912345678', '1970-06-07', '', 'mở'),
(5, 'TranBaThang', 'password789', NULL, 'Nam', NULL, '1985-11-15', '', 'mở'),
(6, 'HoangKieuTrinh', 'trinh123456', 'trinh@fpt.com', 'Nữ', '0978123456', '1990-03-22', '', 'mở'),
(7, 'TranDucViet', 'viet789012', 'viet@vng.com', 'Nam', '0967890123', '1982-09-18', '', 'mở'),
(8, 'LeThanhThuy', 'thuy345678', NULL, 'Nữ', '0945678901', '1978-12-30', '', 'mở'),
(9, 'PhamMinhChinh', 'chinh2023', 'chinh@government.vn', 'Nam', NULL, '1958-03-10', '', 'mở'),
(10, 'NguyenXuanPhuc', 'phuc2024', NULL, 'Nam', '0934567890', '1954-07-20', '', 'mở'),
(11, 'TranThanh', 'thanh1234', 'thanh@artist.vn', 'Nam', '0923456789', '1987-04-10', '', 'mở'),
(12, 'HoNgocHa', 'ha567890', 'ha@singer.vn', 'Nữ', NULL, '1984-11-25', '', 'mở'),
(13, 'SonTungMTP', 'tungmtp123', 'tung@mtp.com', 'Nam', '0911223344', '1994-07-05', '', 'mở'),
(14, 'MaiKhoi', 'khoi5678', NULL, 'Nữ', '0988776655', '1992-02-14', '', 'mở'),
(15, 'BuiXuanHuan', 'huan123456', 'huan@coach.vn', 'Nam', '0977889900', '1976-05-01', '', 'mở'),
(16, 'NguyenQuangHai', 'hai7890', 'hai@football.vn', 'Nam', '0966998877', '1997-04-12', '', 'mở'),
(17, 'TranThiLena', 'lena123', NULL, 'Nữ', NULL, '1995-08-08', '', 'mở');
(18, 'NguyenVanA', 'password123', 'nguyenvana@gmail.com', 'Nam', '0912345678', '1990-05-15', ',mở'),
(19, 'TranThiB', 'securepass', 'tranthib@yahoo.com', 'Nữ', '0987654321', '1985-08-20', ',mở'),
(20, 'LeVanC', 'myp@ssword', 'levanc@gmail.com', 'Nam', '0978123456', '1992-11-30', ',mở'),
(21, 'PhamThiD', 'dpass123', 'phamthid@outlook.com', 'Nữ', '0967890123', '1988-03-25', ',mở'),
(22, 'HoangVanE', 'hoangpass', 'hoangvane@gmail.com', 'Nam', '0945678901', '1995-07-10', ',mở'),
(23, 'VuThiF', 'fpassword', 'vuthif@yahoo.com', 'Nữ', '0934567890', '1991-09-05', ',mở'),
(24, 'DoVanG', 'gpass1234', 'dovang@gmail.com', 'Nam', '0923456789', '1987-12-15', ',mở'),
(25, 'NguyenThiH', 'hpass5678', 'nguyenthih@outlook.com', 'Nữ', '0911223344', '1993-04-18', ',mở'),
(26, 'TranVanI', 'ipass2023', 'tranvani@gmail.com', 'Nam', '0988776655', '1989-06-22', ',mở'),
(27, 'LeThiK', 'kpass123', 'lethik@yahoo.com', 'Nữ', '0977889900', '1994-01-28', ',mở'),
(28, 'PhamVanL', 'lpass456', 'phamvanl@gmail.com', 'Nam', '0966998877', '1986-10-12', ',mở'),
(29, 'HoangThiM', 'mpass789', 'hoangthim@outlook.com', 'Nữ', '0955887766', '1996-02-08', ',mở'),
(30, 'NguyenVanN', 'npass123', 'nguyenvann@gmail.com', 'Nam', '0944776655', '1990-07-31', ',mở'),
(31, 'TranThiO', 'opass456', 'tranthio@yahoo.com', 'Nữ', '0933665544', '1988-11-14', ',mở'),
(32, 'LeVanP', 'ppass789', 'levanp@gmail.com', 'Nam', '0922554433', '1993-05-19', ',mở'),
(33, 'VuThiQ', 'qpass123', 'vuthiq@outlook.com', 'Nữ', '0911443322', '1997-08-23', ',mở'),
(34, 'DoVanR', 'rpass456', 'dovanr@gmail.com', 'Nam', '0988332211', '1985-12-07', ',mở'),
(35, 'NguyenThiS', 'spass789', 'nguyenthis@yahoo.com', 'Nữ', '0977221100', '1992-04-16', ',mở'),
(36, 'TranVanT', 'tpass123', 'tranvant@gmail.com', 'Nam', '0966110099', '1989-09-27', ',mở'),
(37, 'LeThiU', 'upass456', 'lethiu@outlook.com', 'Nữ', '0955009988', '1995-03-03', ',mở');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `MaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

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
