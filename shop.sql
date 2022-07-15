-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-12-18 13:37:15
-- 服务器版本： 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `shop_banner`
--

DROP TABLE IF EXISTS `shop_banner`;
CREATE TABLE IF NOT EXISTS `shop_banner` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `imgurl` varchar(255) NOT NULL COMMENT '图片',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `orderid` tinyint(2) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `type` tinyint(2) NOT NULL COMMENT '类型',
  `is_del` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_banner`
--

INSERT INTO `shop_banner` (`id`, `title`, `imgurl`, `url`, `orderid`, `status`, `type`, `is_del`, `deltime`, `createtime`) VALUES
(1, 'banner', '/public/uploads/img/20181006\\cc956d7469a55702353b5635796fc5fd.jpg', 'https://www.baidu.com', 10, 0, 1, 0, NULL, 1538800092),
(2, '首页banner', '/public/uploads/img/20181006\\7e981ee343d8f660ebc6e85edf42c909.jpg', 'https://www.baidu.com', 10, 0, 1, 0, NULL, 1538800082),
(3, 'banner3', '/public/uploads/img/20181006\\e3e8fd56cf112482fcfe2da75bdc829f.jpg', 'https://www.baidu.com', 10, 0, 2, 0, NULL, 1540210025);

-- --------------------------------------------------------

--
-- 表的结构 `shop_bannertype`
--

DROP TABLE IF EXISTS `shop_bannertype`;
CREATE TABLE IF NOT EXISTS `shop_bannertype` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(50) NOT NULL COMMENT '分类名称',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_bannertype`
--

INSERT INTO `shop_bannertype` (`id`, `title`, `status`) VALUES
(1, '首页Banner', 0),
(2, '首页中部轮播', 0);

-- --------------------------------------------------------

--
-- 表的结构 `shop_danye`
--

DROP TABLE IF EXISTS `shop_danye`;
CREATE TABLE IF NOT EXISTS `shop_danye` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT '标题/公司名称',
  `entitle` varchar(255) DEFAULT NULL COMMENT '英文标题/名称',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `telphone` varchar(255) DEFAULT NULL COMMENT '电话',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `wurl` varchar(255) DEFAULT NULL COMMENT '网址',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '图片/二维码',
  `content` text COMMENT '详情',
  `actor` varchar(255) DEFAULT NULL COMMENT '发布人',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_phone` int(2) NOT NULL DEFAULT '0' COMMENT '是否手机',
  `tj` int(2) NOT NULL DEFAULT '0' COMMENT '是否推荐 0为否',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `orderid` int(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `mid` int(3) NOT NULL COMMENT '菜单Id',
  `cid` int(3) NOT NULL COMMENT '列表/分类Id',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `lat` varchar(255) DEFAULT NULL COMMENT '纬度',
  `lon` varchar(255) DEFAULT NULL COMMENT '经度',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_danye`
--

INSERT INTO `shop_danye` (`id`, `title`, `entitle`, `keywords`, `description`, `telphone`, `email`, `wurl`, `imgurl`, `content`, `actor`, `is_del`, `deltime`, `is_phone`, `tj`, `createtime`, `orderid`, `mid`, `cid`, `status`, `lat`, `lon`) VALUES
(1, '村上丽撒谎', '撒  得  上  发  射  点', 'lajsdlfkjasdlf', '加拉加斯的浪费空间撒旦', '15806850547', '2563413545@qq.com', 'www.baidu.com', '/public/uploads/img/20181021\\95adc5e6cff4503e9015853b2750c019.jpg', '<p>发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发发射点发射点发</p>', '啊士大夫十大', 1, 1541904604, 1, 0, 1540085830, 2, 25, 26, 0, '36.13213213212', '120.3564561'),
(2, 'afds', 'afsdfa', 'fasdfasdf', 'afdsfasdfasd', '15806850547', '2639541704@qq.com', '', '/public/uploads/img/20181021\\5ac43102a1679d0ea786b24cf5fbad98.jpg', '<p>fasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasddddddddddfasdfasdddddddddd</p>', 'afsdf', 1, 1541904600, 0, 0, 1540085895, 10, 25, 26, 0, '36.34651321', '120.356465456'),
(3, 'afds', 'afsdfa', 'fasdfasdf', 'afdsfasdfasd', '15806850547', '2639541704@qq.com', '', '/public/uploads/img/20181207\\e4c0e8dfb3c7ae85e09c52e165b90134.jpg', '<p><br/></p><p>2018-11-13<img width=\"300\" height=\"200\" src=\"http://img.baidu.com/hi/youa/y_0034.gif\"/>图文混排方法</p><p>1. 图片居左，文字围绕图片排版</p><p>方法：在文字前面插入图片，设置居左对齐，然后即可在右边输入多行文本</p><p><br/></p><p>2. 图片居右，文字围绕图片排版</p><p>方法：在文字前面插入图片，设置居右对齐，然后即可在左边输入多行文本</p><p><br/></p><p>3. 图片居中环绕排版</p><p>方法：亲，这个真心没有办法。。。</p><p><br/></p><p><br/></p><p><img width=\"300\" height=\"300\" src=\"http://img.baidu.com/hi/youa/y_0040.gif\"/></p><p>还有没有什么其他的环绕方式呢？这里是居右环绕</p><p><br/></p><p>欢迎大家多多尝试，为UEditor提供更多高质量模板！</p><p><br/></p><p>占位</p><p><br/></p><p>占位</p><p><br/></p><p>占位</p><p><br/></p><p>占位</p><p><br/></p><p>占位</p><p><br/></p><pre class=\"brush:php;toolbar:false\"><br/></pre><p><br/></p>', 'afsdf', 0, NULL, 1, 0, 1544184129, 10, 25, 26, 0, '36.34651321', '120.356465456');

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods_attr`
--

DROP TABLE IF EXISTS `shop_goods_attr`;
CREATE TABLE IF NOT EXISTS `shop_goods_attr` (
  `attr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '规格ID',
  `goods_id` int(10) UNSIGNED DEFAULT '0' COMMENT '产品ID',
  `attr_name` varchar(50) NOT NULL COMMENT '规格名称',
  PRIMARY KEY (`attr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_goods_attr`
--

INSERT INTO `shop_goods_attr` (`attr_id`, `goods_id`, `attr_name`) VALUES
(51, 1, '大小'),
(52, 1, '颜色');

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods_attr_val`
--

DROP TABLE IF EXISTS `shop_goods_attr_val`;
CREATE TABLE IF NOT EXISTS `shop_goods_attr_val` (
  `attr_val_id` int(10) NOT NULL AUTO_INCREMENT,
  `attr_id` int(10) UNSIGNED DEFAULT NULL COMMENT '规格ID',
  `goods_id` int(10) UNSIGNED DEFAULT '0' COMMENT '产品ID',
  `attr_value` varchar(255) DEFAULT NULL COMMENT '属性值',
  PRIMARY KEY (`attr_val_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_goods_attr_val`
--

INSERT INTO `shop_goods_attr_val` (`attr_val_id`, `attr_id`, `goods_id`, `attr_value`) VALUES
(33, 51, 1, '大'),
(34, 51, 1, '小'),
(35, 52, 1, '八色'),
(36, 52, 1, '觉得');

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods_brand`
--

DROP TABLE IF EXISTS `shop_goods_brand`;
CREATE TABLE IF NOT EXISTS `shop_goods_brand` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(2) NOT NULL DEFAULT '0' COMMENT '父级品牌',
  `brandname` varchar(100) NOT NULL COMMENT '品牌名',
  `enbrandname` varchar(255) NOT NULL COMMENT '英文品牌名',
  `content` text COMMENT '品牌描述',
  `imgurl` varchar(255) NOT NULL COMMENT '品牌图片',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否禁用 0为不禁用',
  `orderid` int(3) NOT NULL DEFAULT '0' COMMENT '排序ID ',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `mid` int(3) NOT NULL COMMENT '菜单Id',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_goods_brand`
--

INSERT INTO `shop_goods_brand` (`id`, `pid`, `brandname`, `enbrandname`, `content`, `imgurl`, `is_del`, `deltime`, `status`, `orderid`, `createtime`, `mid`) VALUES
(9, 0, '古龙', 'kulong', '<p>古龙香水 起源于21世纪中期的欧洲</p>', '/public/uploads/img/20181214\\2e1e382ad13c95346cad12a6dca192f9.jpg', 0, NULL, 0, 1, 1544789981, 27),
(10, 0, '库奇', 'cooke', '<p><img title=\"1544790034467023.jpg\" src=\"/public/uploads/img/20181214/1544790034467023.jpg\"/></p><p><img title=\"1544790034135025.jpg\" src=\"/public/uploads/img/20181214/1544790034135025.jpg\"/></p><p></p>', '/public/uploads/img/20181214\\692c4693cff61dd5b7fe31fed992a096.jpg', 0, NULL, 0, 2, 1544790038, 27);

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods_flag`
--

DROP TABLE IF EXISTS `shop_goods_flag`;
CREATE TABLE IF NOT EXISTS `shop_goods_flag` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '属性Id',
  `title` varchar(100) NOT NULL COMMENT '属性名称',
  `sign` varchar(255) NOT NULL COMMENT '属性标志',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '属性图片',
  `entitle` varchar(255) DEFAULT NULL COMMENT '导属性文名',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用0为否',
  `sort_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_goods_flag`
--

INSERT INTO `shop_goods_flag` (`id`, `title`, `sign`, `imgurl`, `entitle`, `status`, `sort_id`) VALUES
(5, '首页热卖推荐', 'ht', '/public/uploads/img/20181214\\cfcfbfabe541b5976a0a384a0be19b53.jpg', 'Home T', 0, 1),
(6, '精品推荐', 'jt', '/public/uploads/img/20181214\\a912241c0d288712c2ad5e63db5bd60c.jpg', 'JT', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods_type`
--

DROP TABLE IF EXISTS `shop_goods_type`;
CREATE TABLE IF NOT EXISTS `shop_goods_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(2) NOT NULL DEFAULT '0' COMMENT '上级分类',
  `typename` varchar(100) NOT NULL COMMENT '分类名',
  `entypename` varchar(255) NOT NULL COMMENT '英文分类名',
  `imgurl` varchar(255) NOT NULL COMMENT '分类图片',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否禁用 0为不禁用',
  `orderid` int(3) NOT NULL DEFAULT '0' COMMENT '排序ID ',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `mid` int(3) NOT NULL COMMENT '菜单Id',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_goods_type`
--

INSERT INTO `shop_goods_type` (`id`, `pid`, `typename`, `entypename`, `imgurl`, `is_del`, `deltime`, `status`, `orderid`, `createtime`, `mid`) VALUES
(16, 15, '定制手机', 'Change mobile', '/public/uploads/img/20181212\\c4dc5f3c29a111d3f8822be4fca0a3a7.jpg', 0, NULL, 0, 3, 1544618943, 27),
(13, 0, '手机', 'mobile', '/public/uploads/img/20181212\\8d5d05f4bd5f5d7624ad977a7eac1740.jpg', 0, NULL, 0, 1, 1544618746, 27),
(15, 13, '仿真手机', 'True mobile', '/public/uploads/img/20181212\\ab06e819080a091a09e2957d25f2446d.jpg', 0, NULL, 0, 2, 1544618875, 27);

-- --------------------------------------------------------

--
-- 表的结构 `shop_menu`
--

DROP TABLE IF EXISTS `shop_menu`;
CREATE TABLE IF NOT EXISTS `shop_menu` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '菜单Id',
  `sort_id` int(2) NOT NULL DEFAULT '0' COMMENT '排序 数字越大越靠前',
  `menuname` varchar(32) NOT NULL COMMENT '菜单名称',
  `controller` varchar(32) NOT NULL COMMENT '控制其名称',
  `method` varchar(32) NOT NULL COMMENT '方法',
  `ishidden` int(2) NOT NULL DEFAULT '0' COMMENT '是否隐藏 0为正常 1为隐藏',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '是否可用 0可用 1不可用',
  `pid` int(2) DEFAULT '0' COMMENT '上级菜单 0为1及菜单',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_menu`
--

INSERT INTO `shop_menu` (`id`, `sort_id`, `menuname`, `controller`, `method`, `ishidden`, `status`, `pid`) VALUES
(1, 0, '系统设置', '', '', 0, 0, 0),
(2, 4, '菜单管理', 'Menu', 'index', 0, 0, 1),
(3, 2, '管理员管理', 'User', 'index', 0, 0, 1),
(4, 3, '管理员角色管理', 'Roes', 'index', 0, 0, 1),
(5, 1, '网站信息设置', 'Webconfig', 'index', 0, 0, 1),
(6, 9, '图片上传管理', 'Upload', 'upload_img', 1, 0, 1),
(7, 2, '文章管理', '', '', 0, 0, 0),
(8, 4, '视频管理', '', '', 0, 0, 0),
(9, 0, '文章列表', 'News', 'index', 0, 0, 7),
(10, 0, '文章类别', 'News', 'type', 0, 0, 7),
(11, 0, '视频列表', 'Videos', 'index', 0, 0, 8),
(12, 0, '频道管理', 'Flag', 'pindao', 0, 0, 8),
(13, 0, '资费管理', 'Flag', 'charge', 0, 0, 8),
(14, 0, '地区管理', 'Flag', 'area', 0, 0, 8),
(15, 5, '导航管理', '', '', 0, 0, 0),
(16, 0, '导航列表', 'Nav', 'index', 0, 0, 15),
(17, 3, '图文管理', '', '', 0, 0, 0),
(18, 0, '图文列表', 'Product', 'index', 0, 0, 17),
(19, 0, '图文分类', 'Product', 'type', 0, 0, 17),
(20, 6, 'Banner管理', '', '', 0, 0, 0),
(21, 0, 'Banner列表', 'Banner', 'index', 0, 0, 20),
(22, 0, 'Banner分类', 'Banner', 'type', 0, 0, 20),
(26, 0, '关于我们', 'About', 'index', 0, 0, 25),
(25, 1, '单页管理', '', '', 0, 0, 0),
(27, 7, '商城', '', '', 0, 0, 0),
(28, 0, '商品管理', 'Goods', 'index', 0, 0, 27),
(29, 1, '商品分类管理', 'Goodstype', 'index', 0, 0, 27),
(30, 2, '商品属性管理', 'Goodsflag', 'index', 0, 0, 27),
(32, 3, '商品规格管理', 'Goodsattr', 'index', 0, 0, 27),
(33, 4, '商品订单管理', 'Goodsorder', 'index', 0, 0, 27),
(34, 5, '商城会员管理', 'Shopvip', 'index', 0, 0, 27);

-- --------------------------------------------------------

--
-- 表的结构 `shop_nav`
--

DROP TABLE IF EXISTS `shop_nav`;
CREATE TABLE IF NOT EXISTS `shop_nav` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '导航Id',
  `title` varchar(100) NOT NULL COMMENT '导航名称',
  `url` varchar(255) NOT NULL COMMENT '导航链接',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '导航图片',
  `entitle` varchar(255) DEFAULT NULL COMMENT '导航英文名',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用0为否',
  `sort_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_nav`
--

INSERT INTO `shop_nav` (`id`, `title`, `url`, `imgurl`, `entitle`, `status`, `sort_id`, `pid`) VALUES
(4, '公司新闻', '/public/index.php/index/News/index', '/public/uploads/img/20181006\\635c7d229a7b65dc0a8b5ae01db7f8a4.jpg', 'CNews', 0, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `shop_news`
--

DROP TABLE IF EXISTS `shop_news`;
CREATE TABLE IF NOT EXISTS `shop_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `entitle` varchar(255) DEFAULT NULL COMMENT '英文标题',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '图片',
  `imgarr` text COMMENT '多图  以‘，’进行分割',
  `type` int(3) NOT NULL COMMENT '分类Iid',
  `keywords` text COMMENT '关键词',
  `actor` varchar(255) DEFAULT NULL COMMENT '发布人',
  `description` text COMMENT '描述',
  `content` text COMMENT '内容',
  `phone_content` text COMMENT '手机版内容',
  `is_phone` int(1) NOT NULL DEFAULT '0' COMMENT '是否显示手机 0为不显示',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否发布 0为发布',
  `is_del` int(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0为不删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `createtime` int(11) NOT NULL COMMENT '创建或修改时间',
  `orderid` int(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `mid` int(3) NOT NULL COMMENT '菜单Id',
  `tj` int(2) NOT NULL DEFAULT '0' COMMENT '推荐 默认为0 不推荐',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_news`
--

INSERT INTO `shop_news` (`id`, `title`, `entitle`, `imgurl`, `imgarr`, `type`, `keywords`, `actor`, `description`, `content`, `phone_content`, `is_phone`, `status`, `is_del`, `deltime`, `createtime`, `orderid`, `mid`, `tj`) VALUES
(1, '村上里沙', 'CunShangLiSha', '/public/uploads/img/20181005\\889a20c091aef9ac8f7729265af932e4.jpg', '/public/uploads/img/20181018\\eb115b659ff8095a102a907174e31318.jpg,/public/uploads/img/20181018\\8b19b71347c2d6161a40e56a15381ddd.jpg,/public/uploads/img/20181018\\6becad6e7dc7b7a5f4867a7465cb3d6d.jpg', 2, '色情/暴力/无限制', '123', '村上里沙最新作品', '<p><img src=\"/public/uploads/img/20181005/1538729747241709.jpg\" title=\"1538729747241709.jpg\" alt=\"u=2443251995,2948456154&amp;fm=27&amp;gp=0.jpg\"/></p><p>村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品村上里沙最新作品</p>', NULL, 0, 0, 1, 1541904502, 1539866401, 1, 7, 0),
(2, '音羽雷恩', 'Reom Len', '/public/uploads/img/20181014\\37df7b3f6a59938d26a0bb291b61069e.jpg', '', 3, '色情/暴力/无限制', NULL, '村上里沙最新作品', '<p><img src=\"/public/uploads/img/20181014/1539502605673877.jpg\" title=\"1539502605673877.jpg\"/></p><p><img src=\"/public/uploads/img/20181014/1539502605978499.jpg\" title=\"1539502605978499.jpg\"/></p><p><img src=\"/public/uploads/img/20181014/1539502605485312.jpg\" title=\"1539502605485312.jpg\"/></p><p><br/></p><p><br/></p>', NULL, 1, 0, 1, 1541904506, 1539505405, 1, 7, 1),
(8, '村上里沙2', 'CunShangLiSha', '/public/uploads/img/20181014\\2f30a81b83fb0633347d0fc7f0bd8d97.jpg', '', 3, '色情/暴力/无限制', NULL, '村上里沙最新作品', '<p><img src=\"/public/uploads/img/20181006/84917e3a122f21c6cec1f386b3558aea.jpg\"/></p><p><img src=\"/public/uploads/img/20181006/7e981ee343d8f660ebc6e85edf42c909.jpg\"/></p><p><br/></p>', NULL, 0, 0, 1, 1541904510, 1539504810, 10, 7, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shop_newstype`
--

DROP TABLE IF EXISTS `shop_newstype`;
CREATE TABLE IF NOT EXISTS `shop_newstype` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(2) NOT NULL DEFAULT '0' COMMENT '上级分类',
  `title` varchar(100) NOT NULL COMMENT '分类名',
  `imgurl` varchar(255) NOT NULL COMMENT '分类图片',
  `entitle` varchar(255) DEFAULT NULL COMMENT '英文分类名',
  `description` varchar(255) NOT NULL COMMENT '分类描述',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否禁用 0为不禁用',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `mid` int(3) NOT NULL COMMENT '菜单Id',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_newstype`
--

INSERT INTO `shop_newstype` (`id`, `pid`, `title`, `imgurl`, `entitle`, `description`, `is_del`, `deltime`, `status`, `createtime`, `mid`) VALUES
(2, 0, '村上里沙', '/public/uploads/img/20181005\\394066404ebfc9693fae1bad602ff637.jpg', 'CunShangLiSha', '村上里沙最新作品', 1, 1541904483, 0, 1538726896, 7),
(3, 0, '音羽雷恩', '/public/uploads/img/20181005\\0d17b6f84fdb7ae77185b080164729d7.jpg', 'Reom Len', '音羽雷恩最新作品', 1, 1541904487, 0, 1538727343, 7),
(5, 3, '村上里沙图片', '/public/uploads/img/20181005\\c2de347bc6ba296b3196d0d442eda51a.jpg', 'CunShangLiShaPIC', '村上里沙最新作品', 1, 1541904491, 0, 1538733665, 7),
(6, 2, '村上里沙2', '/public/uploads/img/20181014\\8f7abb9249ddee8c358afd4ca59d8a03.jpg', 'CunShangLiSha', '村上里沙最新作品', 1, 1541904495, 0, 1539506190, 7),
(8, 0, '新闻动态', '', 'News', '这是一条新闻动态', 0, NULL, 0, 1544097006, 7);

-- --------------------------------------------------------

--
-- 表的结构 `shop_product`
--

DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE IF NOT EXISTS `shop_product` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `entitle` varchar(255) DEFAULT NULL COMMENT '英文标题',
  `imgurl` text COMMENT '缩略图',
  `imgarr` text COMMENT '多图数组 ‘，’分割',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `actor` varchar(255) DEFAULT NULL COMMENT '发布人',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `type` int(3) NOT NULL COMMENT '分类ID',
  `mid` int(3) NOT NULL COMMENT '菜单ID',
  `createtime` int(11) NOT NULL COMMENT '创建/更新时间',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_phone` int(2) NOT NULL DEFAULT '0' COMMENT '是否手机',
  `tj` int(2) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '是否发布 0为发布',
  `orderid` int(4) NOT NULL DEFAULT '0' COMMENT '排序id',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_product`
--

INSERT INTO `shop_product` (`id`, `title`, `entitle`, `imgurl`, `imgarr`, `keywords`, `actor`, `description`, `content`, `type`, `mid`, `createtime`, `is_del`, `deltime`, `is_phone`, `tj`, `status`, `orderid`) VALUES
(1, '村上里沙', 'CunShangLiSha', '/public/uploads/img/20181018\\c0bb9f61ff02f4a6184f915ad9bb03fd.jpg', '/public/uploads/img/20181018\\7722e5a33eb3938e6877350f7372e9c6.jpg,/public/uploads/img/20181018\\f2292a0f116e586182adf392f60fbf03.jpg,/public/uploads/img/20181018\\78e0207d5f36010fa711cc7e203c921f.jpg,/public/uploads/img/20181018\\65f9eb2a5223e9a1e7efd5d49867b747.jpg,/public/uploads/img/20181018\\d3c9ada2ba66a40675822a3692e6b22a.jpg', '色情/暴力/无限制', '阿迪斯发士大夫撒旦', '村上里沙最新作品', '<p><img src=\"/public/uploads/img/20181004/dad8e3d5ff7c659ca80ec74b83c9d294.jpg\"/></p><p><img src=\"/public/uploads/img/20181004/d4998542a3e46fd0704c2039406d6d80.jpg\"/></p><p><img src=\"/public/uploads/img/20181006/196fc7b468643a0692427ddb298b1afd.jpg\"/></p><p><img src=\"/public/uploads/img/20181006/cc956d7469a55702353b5635796fc5fd.jpg\"/></p><p><img src=\"/public/uploads/img/20181006/cb889857a515e73ca2ed886912f31adc.jpg\"/></p><p><br/></p>', 1, 17, 1539866021, 1, 1541904522, 1, 0, 0, 10);

-- --------------------------------------------------------

--
-- 表的结构 `shop_protype`
--

DROP TABLE IF EXISTS `shop_protype`;
CREATE TABLE IF NOT EXISTS `shop_protype` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT '分类标题',
  `entitle` varchar(255) DEFAULT NULL COMMENT '英文标题',
  `pid` int(3) NOT NULL DEFAULT '0' COMMENT '分类IID',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `description` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `mid` int(3) NOT NULL COMMENT '菜单ID',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_protype`
--

INSERT INTO `shop_protype` (`id`, `title`, `entitle`, `pid`, `imgurl`, `description`, `is_del`, `deltime`, `mid`, `createtime`, `status`) VALUES
(1, '村上里沙', 'CunShangLiSha', 0, '/public/uploads/img/20181018\\f0fe29f3e992e1b48486c9d13061e689.jpg', '村上里沙最新作品', 1, 1541904529, 17, 1539864148, 0),
(2, '音羽雷恩', 'Reom Len', 1, '/public/uploads/img/20181018\\9b9841611c37e35fc3833dc9bfab8bbb.jpg', '村上里沙最新作品', 1, 1541904533, 17, 1539864278, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shop_user`
--

DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE IF NOT EXISTS `shop_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) DEFAULT NULL COMMENT '用户密码',
  `gid` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' COMMENT '0为正常1为禁用',
  `truename` varchar(20) NOT NULL COMMENT '真实姓名',
  `is_del` int(2) DEFAULT '0' COMMENT '是否删除',
  `deltime` int(12) DEFAULT NULL COMMENT '删除时间',
  `createtime` int(12) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_user`
--

INSERT INTO `shop_user` (`id`, `name`, `password`, `gid`, `status`, `truename`, `is_del`, `deltime`, `createtime`) VALUES
(1, 'xingkong', '4a865da7dacd14996805e7bb998adb8c', 1, 0, '张洪刚', 0, NULL, 1537068070),
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, 0, '张洪刚', 0, NULL, 1539493955);

-- --------------------------------------------------------

--
-- 表的结构 `shop_user_group`
--

DROP TABLE IF EXISTS `shop_user_group`;
CREATE TABLE IF NOT EXISTS `shop_user_group` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '管理员分类ID',
  `typename` varchar(32) NOT NULL COMMENT '管理员角色名称',
  `status` json NOT NULL COMMENT '管理员权限 json格式',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除 0为否',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_edit` int(2) NOT NULL DEFAULT '0' COMMENT '是否可编辑',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_user_group`
--

INSERT INTO `shop_user_group` (`id`, `typename`, `status`, `is_del`, `deltime`, `is_edit`) VALUES
(1, '超级管理员', '[1, 3, 4, 5, 13, 2, 12, 6, 8, 9]', 0, NULL, 1),
(2, '管理员', '[1, 2, 6, 7, 9, 8, 14, 15, 16, 17, 18, 19, 20, 21, 22, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34]', 0, NULL, 0),
(3, '特殊管理', '[1, 3, 4, 5]', 1, 1539494800, 0),
(4, '管理员管理', '[1, 3, 4, 5, 2]', 0, 1537356101, 0),
(5, '特殊管理', '[3, 4, 5, 9, 11, 12, 13, 16, 26]', 0, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shop_videos`
--

DROP TABLE IF EXISTS `shop_videos`;
CREATE TABLE IF NOT EXISTS `shop_videos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  `imgurl` varchar(255) NOT NULL COMMENT '图片',
  `videourl` varchar(255) NOT NULL COMMENT '视频地址',
  `pindao` int(10) NOT NULL COMMENT '频道ID',
  `charge` int(10) NOT NULL COMMENT '资费ID',
  `area` int(10) NOT NULL COMMENT '地区ID',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `userstatus` int(3) NOT NULL DEFAULT '0' COMMENT '允许观看的用户等级 0为所有 1为会员 2 vip会员',
  `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否禁用 0正常 1为禁用',
  `store` int(3) NOT NULL DEFAULT '100' COMMENT '影片评分',
  `pv` int(25) NOT NULL DEFAULT '0' COMMENT '点击量',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态 0正常 1禁用',
  `mid` int(3) NOT NULL COMMENT '菜单Id',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_videos`
--

INSERT INTO `shop_videos` (`id`, `title`, `keywords`, `description`, `imgurl`, `videourl`, `pindao`, `charge`, `area`, `updatetime`, `userstatus`, `deltime`, `is_del`, `store`, `pv`, `createtime`, `status`, `mid`) VALUES
(1, '色戒', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\7848d9b99f4a92a9dc425f6225c7a86d.jpg', '/public/uploads/video/20181021\\dfd86dc77b05ef645aaa6a9d22c64f33.mp4', 1, 4, 7, NULL, 0, 1541904550, 1, 100, 0, 1540086216, 0, 8),
(12, '特务', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\6671c354736649ead04c74d4e36b120c.jpg', '/public/uploads/video/20181005\\b201089e683223bc56eef966110698db.mp4', 1, 3, 6, NULL, 0, 1541904565, 1, 100, 0, 1538710569, 0, 8),
(13, '活力', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\2e23c425a0eb4604100728d1a3749834.jpg', '/public/uploads/video/20181005\\49c25887177f9c581a72ec5a80f5695a.mp4', 1, 3, 7, NULL, 0, 1541904568, 1, 100, 0, 1538710862, 0, 8),
(14, '青春期', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\8ec91526818b4c0c9786c460478d0df3.jpg', '/public/uploads/video/20181005\\83b7400849766f7e22487d0f665a05d7.mp4', 1, 3, 6, NULL, 0, 1541904572, 1, 100, 0, 1538710975, 0, 8),
(10, '色戒2', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\cfe49d365000eb136786c868c61e71f1.jpg', '/public/uploads/video/20181005\\36248af74572eb068972dbb0c2a79e4d.mp4', 1, 3, 5, NULL, 0, 1541904557, 1, 100, 0, 1538710306, 0, 8),
(11, 'AIKA', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\d204ba18a3b5979aba09df419d2607ae.jpg', '/public/uploads/video/20181005\\c2c8eeec91303d20a137a9dd817d6853.mp4', 1, 3, 9, NULL, 0, 1541904561, 1, 100, 0, 1538710395, 0, 8),
(9, '玉蒲团', '色情/暴力/无限制', '不可描述的画面在本网站始终存在！！', '/public/uploads/img/20181004\\7c54fcd0d2805203bf352422841df781.jpg', '/public/uploads/video/20181016\\34a99dacb8877c3918d257188c16aebe.mp4', 1, 4, 5, NULL, 0, 1541904554, 1, 100, 0, 1539691062, 0, 8);

-- --------------------------------------------------------

--
-- 表的结构 `shop_videotype`
--

DROP TABLE IF EXISTS `shop_videotype`;
CREATE TABLE IF NOT EXISTS `shop_videotype` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '分类Id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否禁用 0 正常 1禁用',
  `flag` varchar(255) NOT NULL COMMENT '标签分类',
  `sort_id` int(10) NOT NULL DEFAULT '0' COMMENT '排序Id',
  `mid` int(3) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_videotype`
--

INSERT INTO `shop_videotype` (`id`, `title`, `status`, `flag`, `sort_id`, `mid`) VALUES
(1, '电影', 0, 'pindao', 0, 8),
(2, '电视剧', 0, 'pindao', 0, 8),
(3, '免费', 0, 'charge', 0, 8),
(4, '付费', 0, 'charge', 0, 8),
(5, '内地', 0, 'area', 0, 8),
(6, '美国', 0, 'area', 0, 8),
(7, '韩国', 0, 'area', 0, 8),
(8, '欧洲', 0, 'area', 0, 8),
(9, '其他', 0, 'area', 0, 8);

-- --------------------------------------------------------

--
-- 表的结构 `shop_webconfig`
--

DROP TABLE IF EXISTS `shop_webconfig`;
CREATE TABLE IF NOT EXISTS `shop_webconfig` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(50) NOT NULL,
  `web_cs` varchar(255) NOT NULL COMMENT '变量参数',
  `web_value` text,
  `web_type` varchar(255) NOT NULL COMMENT '相关的文本类型 0为输入框 1为多行文本 2图片 3选择框 4',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_webconfig`
--

INSERT INTO `shop_webconfig` (`id`, `web_name`, `web_cs`, `web_value`, `web_type`) VALUES
(1, '网站名称', 'webname', 'Shop商城', '0'),
(2, '网站电话', 'webtel', '15806850547', '0'),
(3, '网站描述', 'webdescription', '这是一个正在搭建中的网站。具体信息请联系官网！！！', '1'),
(4, 'logo', 'weblogo', '/public/uploads/img/20181113\\956eeaa551686ef1bec0d124469e5dc0.jpg', '2'),
(5, '网站邮箱', 'webemail', '2639547104@qq.com', '0'),
(6, '网站关键词', 'webkeywords', '自定义关键词', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
