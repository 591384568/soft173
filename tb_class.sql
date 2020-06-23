-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-06-11 03:02:48
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `tb_class`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE IF NOT EXISTS `tp_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(33) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `propic` varchar(255) DEFAULT NULL,
  `role_id` enum('1','2','3') NOT NULL COMMENT '1是系统管理员, 2是教师, 3是学生',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0是不可用, 1是可用',
  `is_super` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0是普通管理员, 1是超级管理员',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`id`, `username`, `password`, `nickname`, `email`, `propic`, `role_id`, `status`, `is_super`, `create_time`, `update_time`, `delete_time`) VALUES
(9, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '591384568@qq.com', '/static/photos/admin.jpg', '1', '1', '1', 1587553518, 1589759926, NULL),
(46, 'qiuqiu', 'ce799224c384aaf05dba5711846607b5', 'qiuqiu', '1261613201@qq.com', '/static/photos/0.jpg', '2', '0', '0', 1590033572, 1590156416, 1590156416),
(38, 'xusong', 'e10adc3949ba59abbe56e057f20f883e', 'xusong', '2736408141@qq.com', '/static/photos/0.jpg', '3', '0', '0', 1589762421, 1589762421, NULL),
(34, '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456_hahha', '2859085829@qq.com', '/static/photos/123456.jpg', '3', '1', '0', 1587865604, 1590158056, NULL),
(47, 'zhangzhenqiu', 'e10adc3949ba59abbe56e057f20f883e', 'zhangzhenqiu', '470469042@qq.com', '/static/photos/zhangzhenqiu.jpg', '2', '1', '0', 1590196265, 1590196396, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_article`
--

DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE IF NOT EXISTS `tp_article` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `point` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1是显示, 0是隐藏',
  `num` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) UNSIGNED NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_article`
--

INSERT INTO `tp_article` (`id`, `nickname`, `content`, `point`, `status`, `num`, `like`, `create_time`, `update_time`, `delete_time`) VALUES
(11, '9', 'yuyu', '26', '1', 7, 0, 1587800602, 1589294011, NULL),
(17, '35', '1234565546556456456456456456456456_test1', '9', '1', 296, 0, 1587897160, 1589427964, NULL),
(16, '26', 'jyj', '-1', '1', 10, 0, 1587823882, 1589434994, NULL),
(21, '34', '2020.04.30', '-1', '1', 4, 0, 1588233840, 1589243918, NULL),
(22, '9', '2020.5.10, 天气晴', '', '1', 18, 0, 1589076150, 1590018447, NULL),
(23, '9', 'test2', '', '1', 12, 0, 1589076366, 1590031689, NULL),
(24, '9', 'this is 2020.05.11', '-1', '1', 383, 0, 1589164541, 1590971698, NULL),
(25, '9', 'enenen', '34', '0', 0, 0, 1589536557, 1589536557, NULL),
(26, '47', '12345678', '-1', '1', 6, 0, 1590196637, 1590378305, NULL),
(27, '47', 'dfdf', '', '1', 7, 0, 1590196915, 1590974847, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_bio`
--

DROP TABLE IF EXISTS `tp_bio`;
CREATE TABLE IF NOT EXISTS `tp_bio` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sex` enum('2','1') DEFAULT NULL COMMENT '1是男, 2是女',
  `phone` varchar(11) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `wechat` varchar(50) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` double(255,0) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dorm` enum('216','306','310','314','315') DEFAULT NULL COMMENT '宿舍',
  `birthday` date DEFAULT NULL,
  `nation` varchar(10) DEFAULT NULL,
  `pol_sta` enum('1','2','3') DEFAULT NULL COMMENT '1是群众, 2是团员, 3是党员',
  `photos` varchar(255) DEFAULT NULL,
  `career` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_bio`
--

INSERT INTO `tp_bio` (`id`, `user_id`, `sex`, `phone`, `qq`, `wechat`, `height`, `weight`, `hobby`, `address`, `dorm`, `birthday`, `nation`, `pol_sta`, `photos`, `career`) VALUES
(1, 34, '1', '15162004270', '591384568', '', '180', 145, '唱, 跳, rap, 篮球', '徐州邳州', '306', NULL, '汉', '2', NULL, '学生'),
(2, 9, '2', '15162004270', '15162004270', '', '', 0, '', '', '216', '2020-05-13', '', '1', NULL, ''),
(4, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_comment`
--

DROP TABLE IF EXISTS `tp_comment`;
CREATE TABLE IF NOT EXISTS `tp_comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_comment`
--

INSERT INTO `tp_comment` (`id`, `content`, `article_id`, `member_id`, `create_time`, `update_time`, `delete_time`) VALUES
(6, '这片文章不错', 11, 34, 0, 1589097879, NULL),
(2, 'hahah', 17, 34, 0, 1588773526, NULL),
(7, 'xixixixi', 17, 34, 0, 0, NULL),
(8, 'hahah', 17, 9, 1589333565, 1589333565, NULL),
(9, 'this is 2020-5-13', 17, 9, 1589333659, 1589333659, NULL),
(10, 'enene', 17, 9, 1589333751, 1589333751, NULL),
(11, 'text', 17, 9, 1589333767, 1589333767, NULL),
(12, 'text2', 17, 9, 1589333816, 1589333816, NULL),
(13, 'text3', 17, 9, 1589333827, 1589333827, NULL),
(14, 'enen ', 17, 9, 1589333881, 1589333881, NULL),
(15, 'enheng~', 22, 34, 1589418511, 1589418511, NULL),
(16, 'haha', 24, 34, 1589434979, 1589434979, NULL),
(17, 'xixi', 24, 9, 1589512877, 1589512877, NULL),
(18, 'enen', 23, 9, 1589718250, 1589718250, NULL),
(19, '1111', 24, 9, 1590028887, 1590028887, NULL),
(20, 'enen', 24, 9, 1590056949, 1590056949, NULL),
(21, '123', 26, 47, 1590196669, 1590196669, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_log`
--

DROP TABLE IF EXISTS `tp_log`;
CREATE TABLE IF NOT EXISTS `tp_log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip` varchar(12) NOT NULL,
  `browser` varchar(10) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_log`
--

INSERT INTO `tp_log` (`id`, `user_id`, `ip`, `browser`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 9, '127.0.0.1', '', 1588309289, 1588310125, NULL),
(2, 34, '127.0.0.1', '', 1588310160, 1588310160, NULL),
(3, 9, '127.0.0.1', '', 1588390730, 1588390730, NULL),
(4, 9, '127.0.0.1', '', 1588548412, 1588548412, NULL),
(5, 9, '127.0.0.1', '', 1588728972, 1588728972, NULL),
(6, 9, '127.0.0.1', '', 1588730537, 1588730537, NULL),
(7, 9, '127.0.0.1', '', 1588752827, 1588752827, NULL),
(8, 9, '127.0.0.1', 'Chrome', 1588772822, 1588772822, NULL),
(9, 9, '127.0.0.1', 'Firefox', 1588772946, 1588772946, NULL),
(10, 9, '127.0.0.1', 'Chrome', 1588818607, 1588818607, NULL),
(11, 9, '127.0.0.1', 'Chrome', 1588903745, 1588903745, NULL),
(12, 9, '127.0.0.1', 'Chrome', 1588903964, 1588903964, NULL),
(13, 9, '127.0.0.1', 'Chrome', 1588904069, 1588904069, NULL),
(14, 9, '127.0.0.1', 'Chrome', 1588904752, 1588904752, NULL),
(15, 9, '127.0.0.1', 'Chrome', 1588913532, 1588913532, NULL),
(16, 9, '127.0.0.1', 'Chrome', 1589001689, 1589001689, NULL),
(17, 9, '127.0.0.1', 'Chrome', 1589002565, 1589002565, NULL),
(18, 9, '127.0.0.1', 'Chrome', 1589003564, 1589003564, NULL),
(19, 9, '127.0.0.1', 'Chrome', 1589003719, 1589003719, NULL),
(20, 9, '127.0.0.1', 'Chrome', 1589003744, 1589003744, NULL),
(21, 9, '127.0.0.1', 'Chrome', 1589003842, 1589003842, NULL),
(22, 9, '127.0.0.1', 'Chrome', 1589003925, 1589003925, NULL),
(23, 9, '127.0.0.1', 'Chrome', 1589003948, 1589003948, NULL),
(24, 9, '127.0.0.1', 'Chrome', 1589004091, 1589004091, NULL),
(25, 9, '127.0.0.1', 'Chrome', 1589004126, 1589004126, NULL),
(26, 9, '127.0.0.1', 'Chrome', 1589004164, 1589004164, NULL),
(27, 9, '127.0.0.1', 'Chrome', 1589004196, 1589004196, NULL),
(28, 9, '127.0.0.1', 'Chrome', 1589014585, 1589014585, NULL),
(29, 9, '127.0.0.1', 'Chrome', 1589014726, 1589014726, NULL),
(30, 9, '127.0.0.1', 'Chrome', 1589014763, 1589014763, NULL),
(31, 9, '127.0.0.1', 'Chrome', 1589014846, 1589014846, NULL),
(32, 9, '127.0.0.1', 'Chrome', 1589014971, 1589014971, NULL),
(33, 9, '127.0.0.1', 'Chrome', 1589015148, 1589015148, NULL),
(34, 9, '127.0.0.1', 'Chrome', 1589015203, 1589015203, NULL),
(35, 9, '127.0.0.1', 'Chrome', 1589015470, 1589015470, NULL),
(36, 9, '127.0.0.1', 'Chrome', 1589015530, 1589015530, NULL),
(37, 9, '127.0.0.1', 'Chrome', 1589017784, 1589017784, NULL),
(38, 9, '127.0.0.1', 'Chrome', 1589023373, 1589023373, NULL),
(39, 9, '127.0.0.1', 'Chrome', 1589024919, 1589024919, NULL),
(40, 9, '127.0.0.1', 'Chrome', 1589024949, 1589024949, NULL),
(41, 34, '127.0.0.1', 'Chrome', 1589025554, 1589025554, NULL),
(42, 9, '127.0.0.1', 'Chrome', 1589025883, 1589025883, NULL),
(43, 9, '127.0.0.1', 'Chrome', 1589026271, 1589026271, NULL),
(44, 9, '127.0.0.1', 'Chrome', 1589026598, 1589026598, NULL),
(45, 9, '127.0.0.1', 'Chrome', 1589075286, 1589075286, NULL),
(46, 9, '127.0.0.1', 'Chrome', 1589075339, 1589075339, NULL),
(47, 9, '127.0.0.1', 'Chrome', 1589098430, 1589098430, NULL),
(48, 9, '127.0.0.1', 'Chrome', 1589098453, 1589098453, NULL),
(49, 9, '127.0.0.1', 'Chrome', 1589098753, 1589098753, NULL),
(50, 9, '127.0.0.1', 'Chrome', 1589098846, 1589098846, NULL),
(51, 9, '127.0.0.1', 'Chrome', 1589117304, 1589117304, NULL),
(52, 9, '127.0.0.1', 'Chrome', 1589117727, 1589117727, NULL),
(53, 9, '127.0.0.1', 'Chrome', 1589122499, 1589122499, NULL),
(54, 9, '127.0.0.1', 'Chrome', 1589123718, 1589123718, NULL),
(55, 9, '127.0.0.1', 'Chrome', 1589156441, 1589156441, NULL),
(56, 9, '127.0.0.1', 'Chrome', 1589243553, 1589243553, NULL),
(57, 9, '127.0.0.1', 'Chrome', 1589244582, 1589244582, NULL),
(58, 9, '127.0.0.1', 'Chrome', 1589266280, 1589266280, NULL),
(59, 34, '127.0.0.1', 'Chrome', 1589330987, 1589330987, NULL),
(60, 9, '127.0.0.1', 'Chrome', 1589331001, 1589331001, NULL),
(61, 9, '127.0.0.1', 'Chrome', 1589417590, 1589417590, NULL),
(62, 34, '127.0.0.1', 'Chrome', 1589418495, 1589418495, NULL),
(63, 9, '127.0.0.1', 'Chrome', 1589418539, 1589418539, NULL),
(64, 34, '127.0.0.1', 'Chrome', 1589434961, 1589434961, NULL),
(65, 9, '127.0.0.1', 'Chrome', 1589466066, 1589466066, NULL),
(66, 9, '127.0.0.1', 'Chrome', 1589466100, 1589466100, NULL),
(67, 9, '127.0.0.1', 'Chrome', 1589466155, 1589466155, NULL),
(68, 9, '127.0.0.1', 'Chrome', 1589466510, 1589466510, NULL),
(69, 9, '127.0.0.1', 'Chrome', 1589466527, 1589466527, NULL),
(70, 9, '127.0.0.1', 'Chrome', 1589466569, 1589466569, NULL),
(71, 9, '127.0.0.1', 'Chrome', 1589466812, 1589466812, NULL),
(72, 9, '127.0.0.1', 'Chrome', 1589466823, 1589466823, NULL),
(73, 9, '127.0.0.1', 'Chrome', 1589512842, 1589512842, NULL),
(74, 9, '127.0.0.1', 'Chrome', 1589536373, 1589536373, NULL),
(75, 9, '127.0.0.1', 'Chrome', 1589536508, 1589536508, NULL),
(76, 34, '127.0.0.1', 'Chrome', 1589554800, 1589554800, NULL),
(77, 9, '127.0.0.1', 'Chrome', 1589554994, 1589554994, NULL),
(78, 9, '127.0.0.1', 'Chrome', 1589555511, 1589555511, NULL),
(79, 9, '127.0.0.1', 'Chrome', 1589589041, 1589589041, NULL),
(80, 9, '127.0.0.1', 'Chrome', 1589589305, 1589589305, NULL),
(81, 9, '127.0.0.1', 'Chrome', 1589699087, 1589699087, NULL),
(82, 9, '127.0.0.1', 'Chrome', 1589709151, 1589709151, NULL),
(83, 9, '127.0.0.1', 'Firefox', 1589759088, 1589759088, NULL),
(84, 9, '127.0.0.1', 'Firefox', 1589759738, 1589759738, NULL),
(85, 9, '127.0.0.1', 'Chrome', 1589760571, 1589760571, NULL),
(86, 9, '127.0.0.1', 'Chrome', 1589761542, 1589761542, NULL),
(87, 9, '127.0.0.1', 'Chrome', 1589771458, 1589771458, NULL),
(88, 9, '127.0.0.1', 'Chrome', 1589771602, 1589771602, NULL),
(89, 9, '127.0.0.1', 'Chrome', 1589771651, 1589771651, NULL),
(90, 9, '127.0.0.1', 'Chrome', 1589846407, 1589846407, NULL),
(91, 9, '127.0.0.1', 'Chrome', 1589850678, 1589850678, NULL),
(92, 9, '127.0.0.1', 'Chrome', 1589851902, 1589851902, NULL),
(93, 34, '127.0.0.1', 'Chrome', 1589859221, 1589859221, NULL),
(94, 9, '127.0.0.1', 'Chrome', 1589859250, 1589859250, NULL),
(95, 9, '127.0.0.1', 'Chrome', 1589859556, 1589859556, NULL),
(96, 34, '127.0.0.1', 'Chrome', 1589871533, 1589871533, NULL),
(97, 9, '127.0.0.1', 'Chrome', 1589937302, 1589937302, NULL),
(98, 34, '127.0.0.1', 'Chrome', 1589956140, 1589956140, NULL),
(99, 9, '127.0.0.1', 'Chrome', 1589958524, 1589958524, NULL),
(100, 34, '127.0.0.1', 'Chrome', 1589961510, 1589961510, NULL),
(101, 9, '127.0.0.1', 'Chrome', 1589962041, 1589962041, NULL),
(102, 9, '127.0.0.1', 'Chrome', 1589974187, 1589974187, NULL),
(103, 34, '127.0.0.1', 'Chrome', 1589974202, 1589974202, NULL),
(104, 9, '127.0.0.1', 'Chrome', 1589974432, 1589974432, NULL),
(105, 9, '127.0.0.1', 'Chrome', 1590017977, 1590017977, NULL),
(106, 9, '127.0.0.1', 'Chrome', 1590018604, 1590018604, NULL),
(107, 9, '127.0.0.1', 'Chrome', 1590024124, 1590024124, NULL),
(108, 39, '127.0.0.1', 'Chrome', 1590024153, 1590024153, NULL),
(109, 9, '127.0.0.1', 'Chrome', 1590031704, 1590031704, NULL),
(110, 9, '127.0.0.1', 'Chrome', 1590056935, 1590056935, NULL),
(111, 34, '127.0.0.1', 'Chrome', 1590061043, 1590061043, NULL),
(112, 34, '127.0.0.1', 'Chrome', 1590105241, 1590105241, NULL),
(113, 9, '127.0.0.1', 'Chrome', 1590133818, 1590133818, NULL),
(114, 34, '127.0.0.1', 'Chrome', 1590158032, 1590158032, NULL),
(115, 9, '127.0.0.1', 'Chrome', 1590192142, 1590192142, NULL),
(116, 9, '127.0.0.1', 'Chrome', 1590194054, 1590194054, NULL),
(117, 9, '127.0.0.1', 'Chrome', 1590196316, 1590196316, NULL),
(118, 47, '127.0.0.1', 'Chrome', 1590196380, 1590196380, NULL),
(119, 47, '127.0.0.1', 'Chrome', 1590196507, 1590196507, NULL),
(120, 9, '127.0.0.1', 'Chrome', 1590198007, 1590198007, NULL),
(121, 34, '127.0.0.1', 'Chrome', 1590198430, 1590198430, NULL),
(122, 9, '127.0.0.1', 'Chrome', 1590198609, 1590198609, NULL),
(123, 47, '127.0.0.1', 'Chrome', 1590365676, 1590365676, NULL),
(124, 9, '127.0.0.1', 'Chrome', 1590365719, 1590365719, NULL),
(125, 9, '127.0.0.1', 'Chrome', 1590459295, 1590459295, NULL),
(126, 9, '127.0.0.1', 'Chrome', 1590461767, 1590461767, NULL),
(127, 9, '127.0.0.1', 'Chrome', 1590807566, 1590807566, NULL),
(128, 9, '127.0.0.1', 'Chrome', 1590971679, 1590971679, NULL),
(129, 9, '127.0.0.1', 'Chrome', 1591783904, 1591783904, NULL),
(130, 9, '127.0.0.1', 'Chrome', 1591786288, 1591786288, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_notice`
--

DROP TABLE IF EXISTS `tp_notice`;
CREATE TABLE IF NOT EXISTS `tp_notice` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_notice`
--

INSERT INTO `tp_notice` (`id`, `user_name`, `content`, `file`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 'admin', '33333', NULL, 1588066282, 1588073818, NULL),
(10, 'admin', 'testestestestest', '/static/notice/admin20200430085921.zip', 1588208361, 1588208361, NULL),
(11, '123456_hahha', '123456', '/static/notice/123456_hahha20200430090615.zip', 1588208775, 1588208775, NULL),
(12, '123456_hahha', '456789', '/static/notice/123456_hahha20200430091142.zip', 1588209102, 1588209102, NULL),
(7, 'admin', 'hah', '', 1588066693, 1588066693, NULL),
(13, '123456_hahha', '7777777', '/static/notice/123456_hahha20200430105002.zip', 1588215002, 1588215002, NULL),
(14, 'admin', '版式设计作业素材', '/static/notice/admin20200518111505.zip', 1589771705, 1589771705, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_phoall`
--

DROP TABLE IF EXISTS `tp_phoall`;
CREATE TABLE IF NOT EXISTS `tp_phoall` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dorm` enum('216','306','310','314','315') DEFAULT NULL,
  `photos` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_phoall`
--

INSERT INTO `tp_phoall` (`id`, `user_id`, `dorm`, `photos`, `create_time`, `update_time`, `delete_time`) VALUES
(4, 9, NULL, '/static/photo_album/920200502101508.jpg', 1588428908, 1588430535, NULL),
(5, 9, NULL, '/static/photo_album/920200506041530.jpg', 1588752930, 1588752930, NULL),
(6, 9, NULL, '/static/photo_album/920200507095519.jpg', 1588859719, 1588859719, NULL),
(7, 9, NULL, '/static/photo_album/920200507095530.jpg', 1588859730, 1588859730, NULL),
(8, 9, NULL, '/static/photo_album/920200510095003.jpg', 1589075403, 1589075403, NULL),
(9, 9, '306', '/static/photo_album/920200515060309.png', 1589536989, 1589536989, NULL),
(10, 9, '216', '/static/photo_album/920200515095138.png', 1589550698, 1589550698, NULL),
(11, 9, '216', '/static/photo_album/920200515102503.png', 1589552703, 1589552703, NULL),
(12, 9, '306', '/static/photo_album/920200515102551.jpg', 1589552751, 1589552751, NULL),
(13, 34, '306', '/static/photo_album/3420200515110026.jpg', 1589554826, 1589554826, NULL),
(14, 9, NULL, '/static/photo_album/920200515110831.jpg', 1589555311, 1589555311, NULL),
(15, 9, NULL, '/static/photo_album/920200515110958.jpg', 1589555398, 1589555398, NULL),
(16, 9, '306', '/static/photo_album/920200517055252.jpg', 1589709172, 1589709172, NULL),
(17, 9, NULL, '/static/photo_album/920200518111141.png', 1589771501, 1589771501, NULL),
(18, 9, '306', '/static/photo_album/920200521074006.jpg', 1590018006, 1590018006, NULL),
(19, 47, '306', '/static/photo_album/4720200523091542.jpg', 1590196542, 1590196542, NULL),
(20, 9, NULL, '/static/photo_album/920200530105940.jpg', 1590807580, 1590807580, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_reply`
--

DROP TABLE IF EXISTS `tp_reply`;
CREATE TABLE IF NOT EXISTS `tp_reply` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_reply`
--

INSERT INTO `tp_reply` (`id`, `content`, `comment_id`, `member_id`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '回复评论', 2, 9, 0, 1588223734, NULL),
(2, '回复评论2', 7, 34, 0, 0, NULL),
(3, '回复评论3', 6, 34, 0, 0, NULL),
(4, 'eeee', 9, 9, 1589427838, 1589427838, NULL),
(5, 'xixi', 9, 9, 1589427857, 1589427857, NULL),
(6, 'iiiii', 14, 9, 1589427959, 1589427959, NULL),
(7, 'enen', 15, 9, 1589433200, 1589433200, NULL),
(8, 'heiheio', 16, 34, 1589434983, 1589434983, NULL),
(9, 'enen \n', 16, 9, 1589512870, 1589512870, NULL),
(10, 'ee', 18, 9, 1589718254, 1589718254, NULL),
(11, '2222', 19, 9, 1590028891, 1590028891, NULL),
(12, 'ege', 20, 9, 1590056953, 1590056953, NULL),
(13, 'en', 17, 9, 1590192156, 1590192156, NULL),
(14, 'ygyg', 21, 47, 1590196686, 1590196686, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_role`
--

DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE IF NOT EXISTS `tp_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rolename` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_role`
--

INSERT INTO `tp_role` (`id`, `rolename`) VALUES
(1, '系统管理员'),
(2, '教师'),
(3, '学生');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
