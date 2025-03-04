-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 06:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `himtihom`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `metode_pengiriman` varchar(50) NOT NULL,
  `total_pembelian` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','shipped','delivered') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `order_uuid` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `nama_pelanggan`, `alamat`, `metode_pengiriman`, `total_pembelian`, `status`, `created_at`, `email`, `order_uuid`) VALUES
(1, 'muzzy ardyansyah', 'aracelli\r\nbekasi kiota', 'JNE', 60000.00, 'pending', '2025-02-25 05:48:42', 'muzi.ardiansah135@gmail.com', 'ac6057f5-f529-11ef-b5e3-0a0027000005'),
(2, 'broo', 'aracelli\r\nbekasi kiota', 'JNE', 190000.00, 'pending', '2025-02-25 06:00:41', 'broo135@gmail.com', 'ac606655-f529-11ef-b5e3-0a0027000005'),
(3, 'muzzy ardyansyah', 'aracelli\r\nbekasi kiota', 'JNE', 360000.00, 'pending', '2025-02-27 01:11:40', 'muzi.ardiansah135@gmail.com', 'ac6067ec-f529-11ef-b5e3-0a0027000005'),
(4, 'kevin', 'aracelli\r\nbekasi kiota', 'JNE', 250000.00, 'pending', '2025-02-27 01:19:55', 'kevin@gmail.com', 'ac6068a0-f529-11ef-b5e3-0a0027000005'),
(5, 'irul baru', 'aracelli\r\nbekasi kiota', 'JNE', 1000000.00, 'pending', '2025-02-27 01:41:35', 'choirul@gmail.com', 'ac606923-f529-11ef-b5e3-0a0027000005'),
(6, 'iruls', 'rawa bebek', 'JNE', 2160000.00, 'pending', '2025-02-27 10:10:12', 'irulss@gmail.com', 'ac606997-f529-11ef-b5e3-0a0027000005'),
(7, 'ahmad', 'wahana blok a 15', 'SiCepat', 5000000.00, 'pending', '2025-02-27 10:48:33', 'ahmad@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `size` varchar(5) DEFAULT NULL,
  `order_uuid` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `size`, `order_uuid`) VALUES
(3, 3, 7, 1, 180000.00, 180000.00, NULL, ''),
(4, 3, 7, 1, 180000.00, 180000.00, NULL, ''),
(5, 4, 5, 1, 250000.00, 250000.00, NULL, ''),
(6, 5, 8, 10, 100000.00, 1000000.00, 'S', ''),
(7, 6, 7, 12, 180000.00, 2160000.00, 'S', ''),
(8, 7, 5, 20, 250000.00, 5000000.00, 'S', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_about`
--

CREATE TABLE `tb_about` (
  `id` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `email_website` varchar(100) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `deskripsi_website` text NOT NULL,
  `maps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_about`
--

INSERT INTO `tb_about` (`id`, `nama_website`, `logo`, `email_website`, `no_telp`, `alamat`, `deskripsi_website`, `maps`) VALUES
(1, 'ASBOVE', '20240801_722414297.png', 'ASBOVEC@gmail.com', '0123456789', 'Bekasi, Indonesia', 'Website Katalog ASBOVE', '<iframe class=\"w-100 rounded\"\r\n                        src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd\"\r\n                        frameborder=\"0\" style=\"height: 100%; min-height: 300px; border:0;\" allowfullscreen=\"\" aria-hidden=\"false\"\r\n                        tabindex=\"0\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `tb_katalog`
--

CREATE TABLE `tb_katalog` (
  `id_katalog` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `id_user` int(5) NOT NULL,
  `size` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_katalog`
--

INSERT INTO `tb_katalog` (`id_katalog`, `image`, `nama_paket`, `deskripsi`, `harga`, `id_user`, `size`) VALUES
(5, '20250226_1353255681.jpg', 'CREWNECK', '<p>CREWNECK</p>', 250000, 1, NULL),
(6, '20250226_1814142053.jpg', 'SHORTPANTS', '<p>SHORTPANTS</p>', 150000, 1, NULL),
(7, '20250226_1777254410.jpg', 'T-SHIRT', '<p>T-SHIRT</p>', 180000, 1, NULL),
(8, '20250226_1937152716.jpg', 'WHITE T-SHIRT', '<p>WHITE T-SHIRT</p>', 100000, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(5) NOT NULL,
  `id_katalog` int(5) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `email_pemesan` varchar(100) NOT NULL,
  `nama_barang` text NOT NULL,
  `status` enum('requested','approved','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '$2y$10$HnHgQXZiEPRSZyzfHuYQuOzynNr7Gb0wP21qv.DN6yAZETaNZs.1.', 1),
(2, 'irul', 'irul123', 'irul', 2),
(3, '', 'irul', '$2y$10$oqfr4XTwqRwEy4jhIJE.CuCKG7pEtEOASj8XIyp0T6fYQCP5fs.OG', 2),
(4, '', 'kevin', '$2y$10$VTvncdEc0t7s1XFV/1L6pOyUfz2pgXW9z9TtQr.h7yHdDRQ54HF4u', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_uuid` varchar(36) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `gross_amount` int(11) NOT NULL,
  `transaction_status` enum('pending','success','failure','expire','cancel') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_uuid` (`order_uuid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  ADD PRIMARY KEY (`id_katalog`),
  ADD KEY `fk_kataloguser` (`id_user`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_orderkatalog` (`id_katalog`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_uuid` (`order_uuid`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  MODIFY `id_katalog` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tb_katalog` (`id_katalog`) ON DELETE CASCADE;

--
-- Constraints for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  ADD CONSTRAINT `fk_kataloguser` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `fk_orderkatalog` FOREIGN KEY (`id_katalog`) REFERENCES `tb_katalog` (`id_katalog`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_uuid`) REFERENCES `orders` (`order_uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
