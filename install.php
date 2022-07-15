<?php
/**
 * 旨在创建写入数据库相关事件
 * 通过写入相关数据库文件 建立网站后台初始化
 * @xingkong
 * zhonghuaxinxing@sina.cn
 */
 /*创建商品分类数据表*/
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
 ) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
 /*创建商品属性数据库表*/
 CREATE TABLE IF NOT EXISTS `shop_goods_flag` (
   `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '属性Id',
   `title` varchar(100) NOT NULL COMMENT '属性名称',
   `sign` varchar(255) NOT NULL COMMENT '属性标志',
   `imgurl` varchar(255) DEFAULT NULL COMMENT '属性图片',
   `entitle` varchar(255) DEFAULT NULL COMMENT '导属性文名',
   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用0为否',
   `sort_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
   UNIQUE KEY `id` (`id`)
 ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
 /*创建商品品牌数据表*/
 CREATE TABLE IF NOT EXISTS `shop_goods_brand` (
   `id` int(3) NOT NULL AUTO_INCREMENT,
   `pid` int(2) NOT NULL DEFAULT '0' COMMENT '父级品牌',
   `brandname` varchar(100) NOT NULL COMMENT '品牌名',
   `enbrandname` varchar(255) NOT NULL COMMENT '英文品牌名',
   `imgurl` varchar(255) NOT NULL COMMENT '品牌图片',
   `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
   `deltime` int(11) DEFAULT NULL COMMENT '删除时间',
   `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否禁用 0为不禁用',
   `orderid` int(3) NOT NULL DEFAULT '0' COMMENT '排序ID ',
   `createtime` int(11) NOT NULL COMMENT '创建时间',
   `content` TEXT NULL COMMENT '品牌描述',
   `mid` int(3) NOT NULL COMMENT '菜单Id',
   UNIQUE KEY `id` (`id`)
 ) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

 /**
  * 商品规格表
  */
  CREATE TABLE `shop_goods_attr` (
   `attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规格ID',
   `goods_id` int(10) unsigned DEFAULT '0' COMMENT '产品ID',
   `attr_name` varchar(50) NOT NULL COMMENT '规格名称',
   PRIMARY KEY (`attr_id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
/**
 * 规格属性值
 * @var [type]
 */
 CREATE TABLE `shop_goods_attr_val` (
  `symbol` int(10) NOT NULL AUTO_INCREMENT,
  `attr_id` int(10) unsigned DEFAULT NULL COMMENT '规格ID',
  `goods_id` int(10) unsigned DEFAULT '0' COMMENT '产品ID',
  `attr_value` varchar(255) DEFAULT NULL COMMENT '属性值',
  PRIMARY KEY (`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
/**
 * 普通商品sku
 *
 */

 CREATE TABLE `shop_goods_sku` (
   `sku_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'skuID',
   `goods_id` int(10) unsigned DEFAULT '0' COMMENT '产品ID',
   `attr_key` varchar(255) NOT NULL COMMENT '属性ID key值',
   `old_price` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
   `price` double(15,2) DEFAULT '0.00' COMMENT '现价',
   `housnum` double(15,2) DEFAULT '0.00' COMMENT '库存',
   `picurl` varchar(255)  NULL COMMENT '产品图片',
   PRIMARY KEY (`sku_id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
 /**
  * 积分商品sku
  *
  */

  CREATE TABLE `shop_goods_jf_sku` (
    `sku_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'skuID',
    `goods_id` int(10) unsigned DEFAULT '0' COMMENT '产品ID',
    `attr_key` varchar(255) NOT NULL COMMENT '属性ID key值',
    `jf` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
    `housnum` double(15,2) DEFAULT '0.00' COMMENT '库存',
    `picurl` varchar(255)  NULL COMMENT '产品图片',
    PRIMARY KEY (`sku_id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
/**
 * 普通商品表
 */
 CREATE TABLE `shop_goods` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
   `typeid` int(10) NOT NULL DEFAULT '0' COMMENT '分类ID',
   `typename` varchar(255) NULL COMMENT '分类名称',
   `flag` TEXT NULL COMMENT '属性',
   `brand` int(10) NOT NULL DEFAULT '0' COMMENT '品牌ID 默认',
   `title` varchar(255) NOT NULL COMMENT '商品名称',
   `entitle` varchar(255) NOT NULL COMMENT '商品英文名称',
   `ftitle` TEXT NULL COMMENT '商品副标题',
   `old_price` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
   `price` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '现价',
   `vip_price` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '会员价',
   `housnum` int(15) NOT NULL DEFAULT '0' COMMENT '库存',
   `sellnum` int(10) NOT NULL DEFAULT '0' COMMENT '销量',
   `commentnum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数量',
   `likenum` int(10) NOT NULL DEFAULT '0' COMMENT '收藏数量',
   `picurl` varchar(255)  NULL COMMENT '产品缩略图',
   `picarr` TEXT NULL COMMENT '产品组图',
   `content` TEXT NULL COMMENT '产品详情',
   `shcontent` TEXT NULL COMMENT '售后信息',
   `is_vip` int(2) NOT NULL DEFAULT '0' COMMENT '是否设定购买权限',
   `is_phone` int(2) NOT NULL DEFAULT '0' COMMENT '是否手机展示',
   `is_tj` int(2) NOT NULL DEFAULT '0' COMMENT '是否推荐',
   `is_time` int(2) NOT NULL DEFAULT '0' COMMENT '是否为限时产品',
   `is_post` int(2) NOT NULL DEFAULT '0' COMMENT '是否包邮',
   `point` int(12) NOT NULL DEFAULT '0' COMMENT '购买是否赠送积分',
   `postmoney` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
   `start` int(2) NOT NULL DEFAULT '0' COMMENT '是否为星标产品',
   `starttime` int(12) NULL COMMENT '开始时间',
   `endtime` int(12) NULL COMMENT '结束时间',
   `orderid` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
   `status` int(2) NOT NULL DEFAULT '0' COMMENT  '是否上架 默认不上架',
   `creattime` int(12) NOT NULL DEFAULT '0' COMMENT '创建/更新时间',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
 /**
  * 积分商品表
  */
  CREATE TABLE `shop_goods_jf` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
    `typeid` int(10) NOT NULL DEFAULT '0' COMMENT '分类ID',
    `typename` varchar(255) NULL COMMENT '分类名称',
    `flag` TEXT NULL COMMENT '属性',
    `brand` int(10) NOT NULL DEFAULT '0' COMMENT '品牌ID 默认',
    `title` varchar(255) NOT NULL COMMENT '商品名称',
    `entitle` varchar(255) NOT NULL COMMENT '商品英文名称',
    `ftitle` TEXT NULL COMMENT '商品副标题',
    `jf` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '会员价',
    `housnum` int(15) NOT NULL DEFAULT '0' COMMENT '库存',
    `sellnum` int(10) NOT NULL DEFAULT '0' COMMENT '销量',
    `commentnum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数量',
    `likenum` int(10) NOT NULL DEFAULT '0' COMMENT '收藏数量',
    `picurl` varchar(255)  NULL COMMENT '产品缩略图',
    `picarr` TEXT NULL COMMENT '产品组图',
    `content` TEXT NULL COMMENT '产品详情',
    `shcontent` TEXT NULL COMMENT '售后信息',
    `is_vip` int(2) NOT NULL DEFAULT '0' COMMENT '是否设定购买权限',
    `is_phone` int(2) NOT NULL DEFAULT '0' COMMENT '是否手机展示',
    `is_tj` int(2) NOT NULL DEFAULT '0' COMMENT '是否推荐',
    `is_time` int(2) NOT NULL DEFAULT '0' COMMENT '是否为限时产品',
    `is_post` int(2) NOT NULL DEFAULT '0' COMMENT '是否包邮',
    `point` int(12) NOT NULL DEFAULT '0' COMMENT '购买是否赠送积分',
    `postmoney` double(15,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
    `start` int(2) NOT NULL DEFAULT '0' COMMENT '是否为星标产品',
    `starttime` int(12) NULL COMMENT '开始时间',
    `endtime` int(12) NULL COMMENT '结束时间',
    `orderid` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
    `status` int(2) NOT NULL DEFAULT '0' COMMENT  '是否上架 默认不上架',
    `creattime` int(12) NOT NULL DEFAULT '0' COMMENT '创建/更新时间',
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
 ?>
