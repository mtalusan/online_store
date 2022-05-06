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
-- Table structure for table `order_item`
--

CREATE TABLE Ordered_Item (
  `Order_ID` int(11) NOT NULL auto_increment,
  `Customer_ID` int(11) NOT NULL,
  `Product_ID` varchar(200) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  
  Primary Key(Customer_ID, Product_ID),
  Foreign Key(Customer_ID, Product_ID) References  Customer(Customer_ID), Product(Product_ID)
  
  );
  
