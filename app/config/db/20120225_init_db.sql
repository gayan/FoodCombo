-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2013 at 06:24 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `foodcombo`
--

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

CREATE TABLE IF NOT EXISTS `Combo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foodId2` int(11) DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foodId1` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_70FD1F4EC8A8330` (`foodId1`),
  KEY `IDX_70FD1F4E9583D28A` (`foodId2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `Food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foodName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `combo`
--
ALTER TABLE `Combo`
  ADD CONSTRAINT `FK1_FOOD` FOREIGN KEY (`foodId2`) REFERENCES `Food` (`id`),
  ADD CONSTRAINT `FK2_FOOD` FOREIGN KEY (`foodId1`) REFERENCES `Food` (`id`);
