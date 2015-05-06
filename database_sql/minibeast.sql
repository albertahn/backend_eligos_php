-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 15-05-06 09:52
-- 서버 버전: 5.5.41-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minibeast`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
`index` int(11) NOT NULL,
  `my_index` int(11) NOT NULL,
  `friend_index` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `timestamp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `has_device`
--

CREATE TABLE IF NOT EXISTS `has_device` (
`index` int(11) NOT NULL,
  `device_type` text,
  `gcm_reg_code` text,
  `notify` enum('wait','no','yes') DEFAULT NULL,
  `status` enum('good','ban') DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `members_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `has_item`
--

CREATE TABLE IF NOT EXISTS `has_item` (
`index` int(11) NOT NULL,
  `timestamp` varchar(45) DEFAULT NULL,
  `items_index` int(11) NOT NULL,
  `members_index` int(11) NOT NULL,
  `purchase_code` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `has_room`
--

CREATE TABLE IF NOT EXISTS `has_room` (
`index` int(11) NOT NULL,
  `rooms_index` int(11) NOT NULL,
  `members_index` int(11) NOT NULL,
  `status` enum('admin','norm') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `index` int(11) NOT NULL,
  `item_name` text,
  `price` text,
  `what_it_does` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`index` int(11) NOT NULL,
  `username` text,
  `email` text,
  `password` text,
  `profile_pic` text,
  `FID` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `gold` varchar(45) DEFAULT NULL,
  `cash` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
`index` int(11) NOT NULL,
  `room_name` text,
  `type` text,
  `timestamp` text,
  `room_state` enum('on','off') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `friends`
--
ALTER TABLE `friends`
 ADD PRIMARY KEY (`index`), ADD KEY `fk_friends_members1_idx` (`my_index`), ADD KEY `fk_friends_members2_idx` (`friend_index`);

--
-- 테이블의 인덱스 `has_device`
--
ALTER TABLE `has_device`
 ADD PRIMARY KEY (`index`), ADD KEY `fk_has_device_members_idx` (`members_index`);

--
-- 테이블의 인덱스 `has_item`
--
ALTER TABLE `has_item`
 ADD PRIMARY KEY (`index`), ADD KEY `fk_has_item_items1_idx` (`items_index`), ADD KEY `fk_has_item_members1_idx` (`members_index`);

--
-- 테이블의 인덱스 `has_room`
--
ALTER TABLE `has_room`
 ADD PRIMARY KEY (`index`), ADD KEY `fk_has_room_rooms1_idx` (`rooms_index`), ADD KEY `fk_has_room_members1_idx` (`members_index`);

--
-- 테이블의 인덱스 `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`index`);

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`index`);

--
-- 테이블의 인덱스 `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`index`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `friends`
--
ALTER TABLE `friends`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `has_device`
--
ALTER TABLE `has_device`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `has_item`
--
ALTER TABLE `has_item`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `has_room`
--
ALTER TABLE `has_room`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `rooms`
--
ALTER TABLE `rooms`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `friends`
--
ALTER TABLE `friends`
ADD CONSTRAINT `fk_friends_members1` FOREIGN KEY (`my_index`) REFERENCES `members` (`index`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_friends_members2` FOREIGN KEY (`friend_index`) REFERENCES `members` (`index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `has_device`
--
ALTER TABLE `has_device`
ADD CONSTRAINT `fk_has_device_members` FOREIGN KEY (`members_index`) REFERENCES `members` (`index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `has_item`
--
ALTER TABLE `has_item`
ADD CONSTRAINT `fk_has_item_items1` FOREIGN KEY (`items_index`) REFERENCES `items` (`index`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_has_item_members1` FOREIGN KEY (`members_index`) REFERENCES `members` (`index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `has_room`
--
ALTER TABLE `has_room`
ADD CONSTRAINT `fk_has_room_rooms1` FOREIGN KEY (`rooms_index`) REFERENCES `rooms` (`index`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_has_room_members1` FOREIGN KEY (`members_index`) REFERENCES `members` (`index`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
