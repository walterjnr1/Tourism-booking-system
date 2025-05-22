-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: May 22, 2025 at 10:15 PM
=======
-- Generation Time: Apr 30, 2025 at 11:55 AM
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473
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
-- Database: `tourist_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `category` varchar(222) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `description` text NOT NULL,
<<<<<<< HEAD
  `capacity` varchar(4) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `address`, `category`, `amount`, `description`, `capacity`, `photo`) VALUES
(2, 'Slave History Museum', 'Marina Beach', 'Cultural and Heritage Sites', '4500', 'Located within the Marina Resort complex, the Slave History Museum stands on the site of a 15th-century slave-trading warehouse in Marina Beach. Calabar was a major embarkation point during the transatlantic slave trade, with approximately 200,000 Africans sold into slavery from the city between 1662 and 1863.', '11', 'uploadImage/places/download.jpg');

=======
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473
-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(4) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` text NOT NULL,
  `fullname` varchar(222) NOT NULL,
  `email` varchar(111) NOT NULL,
  `role` varchar(22) NOT NULL,
  `status` int(1) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `username`, `password`, `fullname`, `email`, `role`, `status`, `photo`) VALUES
<<<<<<< HEAD
(1, 'walterjnr1', 'escobar2012', 'Ndueso Walter', 'newleastpaysolution@gmail.com', 'Admin', 1, 'uploadImage/Profile/photo3.jpg');
=======
(1, 'walterjnr1', 'escobar2012', 'Ndueso Walter', 'newleastpaysolution@gmail.com', 'Admin', 1, 'uploadImage/Profile/photo1.jpg');
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(4) NOT NULL,
  `booking_id` varchar(18) NOT NULL,
<<<<<<< HEAD
  `user_id` varchar(42) NOT NULL,
  `place_id` int(4) NOT NULL,
  `check_in` varchar(25) NOT NULL,
  `check_out` varchar(25) NOT NULL,
  `amount` varchar(22) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `booking_id`, `user_id`, `place_id`, `check_in`, `check_out`, `amount`, `status`) VALUES
(2, '682f83e2b04df', 'eTech', 2, '2025-05-22', '2025-05-24', '9000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(4) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `name`) VALUES
(1, 'Natural Attractions'),
(2, 'Cultural and Heritage Sites'),
(3, ' Religious Sites'),
(4, 'Historical and Archaeological Sites'),
(5, 'Modern Attractions'),
(6, 'Eco-tourism Sites');

=======
  `place_name` varchar(255) NOT NULL,
  `check_in` varchar(25) NOT NULL,
  `check_out` varchar(25) NOT NULL,
  `amount` varchar(22) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473
-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `id` int(4) NOT NULL,
<<<<<<< HEAD
  `user_id` varchar(33) NOT NULL,
  `payment_id` varchar(25) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `description` text NOT NULL,
=======
  `payment_id` varchar(25) NOT NULL,
  `amount` varchar(25) NOT NULL,
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473
  `payment_date` varchar(25) NOT NULL,
  `channel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`id`, `user_id`, `payment_id`, `amount`, `description`, `payment_date`, `channel`) VALUES
(2, 'eTech', '381970907110', '9000', 'booking', '2025-05-22 21:06:57', 'Paystack');

=======
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473
-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(4) NOT NULL,
  `name` varchar(120) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(111) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `name`, `username`, `password`, `email`, `phone`) VALUES
(1, 'Emediong Moses', 'eTech', '12345678', 'newleastpaysolution@gmail.com', '08067361023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
=======
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
<<<<<<< HEAD
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
=======
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
<<<<<<< HEAD
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
<<<<<<< HEAD
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
=======
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
>>>>>>> e9f1a5c63712200868d49c400ecf37b9f85e1473

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
