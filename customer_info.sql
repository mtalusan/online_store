-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2022 at 12:00 PM
-- Server version: 5.6.40
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE Customer(
  `Customer_ID` int(11) auto_increment,
  `Phone_Number` varchar(200),
  `Shipping_Address` varchar(200) NOT NULL,
  `Customer_Name` varchar(200) NOT NULL,
  `Card_Number` varchar(200) NOT NULL,
  
  Primary Key(Customer_ID)
);

