-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 03 月 26 日 23:47
-- 服务器版本: 5.5.47
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `borrowsite`
--

-- --------------------------------------------------------

--
-- 表的结构 `borrow_info`
--

CREATE TABLE IF NOT EXISTS `borrow_info` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `period` varchar(11) NOT NULL,
  `borrow_id` varchar(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `contact` char(11) NOT NULL,
  `reason` varchar(1024) NOT NULL,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- 转存表中的数据 `borrow_info`
--

INSERT INTO `borrow_info` (`pk_id`, `site_id`, `date`, `period`, `borrow_id`, `name`, `contact`, `reason`) VALUES
(69, 2, '2017-04-01', '1', '988793', '如太', '范文峰', '峰峰');

-- --------------------------------------------------------

--
-- 表的结构 `site_info`
--

CREATE TABLE IF NOT EXISTS `site_info` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `site_info`
--

INSERT INTO `site_info` (`site_id`, `name`) VALUES
(1, '场地1'),
(2, '场地2'),
(3, '场地3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
