/*
Navicat MySQL Data Transfer

Source Server         : wnsys
Source Server Version : 50635
Source Host           : localhost:3306
Source Database       : nn

Target Server Type    : MYSQL
Target Server Version : 50635
File Encoding         : 65001

Date: 2017-03-26 18:57:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wn_blog_article`
-- ----------------------------
DROP TABLE IF EXISTS `wn_blog_article`;
CREATE TABLE `wn_blog_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `catid` int(11) NOT NULL DEFAULT '0' COMMENT '栏目id',
  `content` text,
  `attach` varchar(500) NOT NULL DEFAULT '' COMMENT '附件路径',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

-- ----------------------------
-- Table structure for `wn_category`
-- ----------------------------
DROP TABLE IF EXISTS `wn_category`;
CREATE TABLE `wn_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `parentid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `module` varchar(255) NOT NULL DEFAULT '' COMMENT '模块名',
  `parentids` varchar(255) NOT NULL DEFAULT '' COMMENT '所有父id',
  `template` varchar(255) NOT NULL DEFAULT '' COMMENT '模板',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Table structure for `wn_image`
-- ----------------------------
DROP TABLE IF EXISTS `wn_image`;
CREATE TABLE `wn_image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL DEFAULT '' COMMENT '模块',
  `jump_url` varchar(255) DEFAULT '' COMMENT '跳转地址',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `pk_id` int(11) NOT NULL DEFAULT '0' COMMENT '外键id',
  `pk_type` varchar(255) NOT NULL DEFAULT '' COMMENT '外键类型',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `type` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `original` varchar(255) NOT NULL DEFAULT '' COMMENT '源文件名',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `state` varchar(255) NOT NULL DEFAULT '' COMMENT '上传状态',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `wn_permission`
-- ----------------------------
DROP TABLE IF EXISTS `wn_permission`;
CREATE TABLE `wn_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(255) NOT NULL DEFAULT '' COMMENT '模块代码',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '权限名称',
  `parentid` int(20) NOT NULL DEFAULT '0' COMMENT '父id',
  `parentids` varchar(255) NOT NULL DEFAULT '0' COMMENT '父id路径',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for `wn_permission_relate`
-- ----------------------------
DROP TABLE IF EXISTS `wn_permission_relate`;
CREATE TABLE `wn_permission_relate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` varchar(500) NOT NULL DEFAULT '0' COMMENT '权限id',
  `pk_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联id',
  `pk_type` varchar(255) NOT NULL DEFAULT 'role' COMMENT '权限类型',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for `wn_role`
-- ----------------------------
DROP TABLE IF EXISTS `wn_role`;
CREATE TABLE `wn_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '角色名',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `wn_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `wn_role_user`;
CREATE TABLE `wn_role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wn_role_user
-- ----------------------------
INSERT INTO `wn_role_user` VALUES ('1', '5', '3', '2017-02-02 10:13:36', '2017-02-02 10:13:36', null);
INSERT INTO `wn_role_user` VALUES ('2', '1', '1', '2017-02-02 10:16:36', '2017-02-02 10:16:36', null);
INSERT INTO `wn_role_user` VALUES ('3', '2', '2', '2017-02-02 10:16:46', '2017-02-02 10:16:46', null);

-- ----------------------------
-- Table structure for `wn_shop_cart`
-- ----------------------------
DROP TABLE IF EXISTS `wn_shop_cart`;
CREATE TABLE `wn_shop_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品id',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '产品名称',
  `price` float NOT NULL DEFAULT '0' COMMENT '价格',
  `qty` int(11) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '总金额=price*qty',
  `commet` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='购物车';

-- ----------------------------
-- Table structure for `wn_shop_order`
-- ----------------------------
DROP TABLE IF EXISTS `wn_shop_order`;
CREATE TABLE `wn_shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `amount` float NOT NULL DEFAULT '0' COMMENT '订单金额',
  `remarks` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for `wn_shop_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `wn_shop_order_detail`;
CREATE TABLE `wn_shop_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品id',
  `qty` int(11) NOT NULL DEFAULT '0' COMMENT '产品数量',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for `wn_shop_product`
-- ----------------------------
DROP TABLE IF EXISTS `wn_shop_product`;
CREATE TABLE `wn_shop_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0' COMMENT '类别',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '产品名称',
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `price` float NOT NULL DEFAULT '0' COMMENT '价格',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for `wn_user`
-- ----------------------------
DROP TABLE IF EXISTS `wn_user`;
CREATE TABLE `wn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '' COMMENT '手机号',
  `remember_token` varchar(255) NOT NULL DEFAULT '' COMMENT '记住我',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';
