/*
Navicat MySQL Data Transfer

Source Server         : 118.178.227.72
Source Server Version : 50636
Source Host           : localhost:3306
Source Database       : wnsysdemo

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2017-09-14 16:31:01
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
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

-- ----------------------------
-- Records of wn_blog_article
-- ----------------------------
INSERT INTO `wn_blog_article` VALUES ('3', '[ Laravel 5.3 文档 ] Eloquent ORM —— 起步', '1', '<h3><strong>1、简介</strong></h3><p><a href=\"http://laravelacademy.org/tags/laravel\" title=\"View all posts in Laravel\" target=\"_blank\">Laravel</a>&nbsp;自带的&nbsp;<a href=\"http://laravelacademy.org/tags/eloquent\" title=\"View all posts in Eloquent\" target=\"_blank\">Eloquent</a>&nbsp;<a href=\"http://laravelacademy.org/tags/orm\" title=\"View all posts in ORM\" target=\"_blank\">ORM</a>&nbsp;提供了一个美观、简单的与<a href=\"http://laravelacademy.org/tags/%e6%95%b0%e6%8d%ae%e5%ba%93\" title=\"View all posts in 数据库\" target=\"_blank\">数据库</a>打交道的&nbsp;ActiveRecord&nbsp;实现，每张数据表都对应一个与该表进行交互的“<a href=\"http://laravelacademy.org/tags/%e6%a8%a1%e5%9e%8b\" title=\"View all posts in 模型\" target=\"_blank\">模型</a>”，模型允许你在表中进行数据查询，以及插入、更新、删除等操作。</p><p>在开始之前，确保在<code>config/database.php</code>文件中<a href=\"http://laravelacademy.org/tags/%e9%85%8d%e7%bd%ae\" title=\"View all posts in 配置\" target=\"_blank\">配置</a>好了数据库连接。更多关于数据库配置的信息，请查看<a href=\"http://laravelacademy.org/post/6133.html#ipt_kb_toc_6133_1\" target=\"_blank\">文档</a>。</p><h3><strong>2、定义模型</strong></h3><p>作为开始，让我们创建一个 Eloquent 模型，模型通常位于<code>app</code>目录下，你也可以将其放在其他可以被<code>composer.json</code>文件自动加载的地方。所有Eloquent模型都继承自&nbsp;<code>Illuminate\\Database\\Eloquent\\Model</code>类。</p><p>创建模型实例最简单的办法就是使用 Artisan 命令<code>make:model</code>：</p><pre>php&nbsp;artisan&nbsp;make:model&nbsp;User</pre><p>如果你想要在生成模型时生成<a href=\"http://laravelacademy.org/post/6171.html\" target=\"_blank\">数据库迁移</a>，可以使用<code>--migration</code>或<code>-m</code>选项：</p><pre>php&nbsp;artisan&nbsp;make:model&nbsp;User&nbsp;--migration\r\nphp&nbsp;artisan&nbsp;make:model&nbsp;User&nbsp;-m</pre><h4><strong>Eloquent 模型约定</strong></h4><p>现在，让我们来看一个&nbsp;<code>Flight</code>&nbsp;模型类例子，我们将用该类获取和存取数据表<code>flights</code>中的信息：</p><pre>&lt;?php\r\n\r\nnamespace&nbsp;App;\r\n\r\nuse&nbsp;Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass&nbsp;Flight&nbsp;extends&nbsp;Model{\r\n&nbsp;&nbsp;&nbsp;&nbsp;//\r\n}</pre><p><strong>表名</strong></p><p>注意我们并没有告诉 Eloquent 我们的<code>Flight</code>模型使用哪张表。默认规则是模型类名的复数作为与其对应的表名，除非在模型类中明确指定了其它名称。所以，在本例中，Eloquent 认为<code>Flight</code>模型存储记录在<code>flights</code>表中。你也可以在模型中定义<code>table</code>属性来指定自定义的表名：</p><pre>&lt;?php\r\n\r\nnamespace&nbsp;App;\r\n\r\nuse&nbsp;Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass&nbsp;Flight&nbsp;extends&nbsp;Model{\r\n&nbsp;&nbsp;&nbsp;&nbsp;/**\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;关联到模型的数据表\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$table&nbsp;=&nbsp;&#39;my_flights&#39;;\r\n}</pre><p><strong>主键</strong></p><p>Eloquent 默认每张表的主键名为<code>id</code>，你可以在模型类中定义一个<code>$primaryKey</code>属性来覆盖该约定。</p><p>此外，Eloquent默认主键字段是自增的整型数据，这意味着主键将会被自动转化为<code>int</code>类型，如果你想要使用非自增或非数字类型主键，必须在对应模型中设置<code>$incrementing</code>属性为<code>false</code>。</p><p><strong>时间戳</strong></p><p>默认情况下，Eloquent 期望<code>created_at</code>和<code>updated_at</code>已经存在于数据表中，如果你不想要这些 Laravel 自动管理的列，在模型类中设置<code>$timestamps</code>属性为<code>false</code>：</p><pre>&lt;?php\r\n\r\nnamespace&nbsp;App;\r\n\r\nuse&nbsp;Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass&nbsp;Flight&nbsp;extends&nbsp;Model{\r\n&nbsp;&nbsp;&nbsp;&nbsp;/**\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;表明模型是否应该被打上时间戳\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;bool\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/\r\n&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;$timestamps&nbsp;=&nbsp;false;\r\n}</pre><p>如果你需要自定义时间戳格式，设置模型中的<code>$dateFormat</code>属性。该属性决定日期被如何存储到数据库中，以及模型被序列化为数组或 JSON 时日期的格式：</p><pre>&lt;?php\r\n\r\nnamespace&nbsp;App;\r\n\r\nuse&nbsp;Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass&nbsp;Flight&nbsp;extends&nbsp;Model{\r\n&nbsp;&nbsp;&nbsp;&nbsp;/**\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;模型日期列的存储格式\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$dateFormat&nbsp;=&nbsp;&#39;U&#39;;\r\n}</pre><p><strong>数据库连接</strong><br/><strong>&nbsp;</strong><br/>默认情况下，所有的 Eloquent 模型使用应用配置中的默认数据库连接，如果你想要为模型指定不同的连接，可以通过<code>$connection</code>&nbsp;属性来设置：</p><pre>&lt;?php\r\n\r\nnamespace&nbsp;App;\r\n\r\nuse&nbsp;Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass&nbsp;Flight&nbsp;extends&nbsp;Model{\r\n&nbsp;&nbsp;&nbsp;&nbsp;/**\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;The&nbsp;connection&nbsp;name&nbsp;for&nbsp;the&nbsp;model.\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$connection&nbsp;=&nbsp;&#39;connection-name&#39;;\r\n}</pre><p><br/></p>', '', '1', '2016-12-26 15:56:47', '2017-09-14 14:20:28', null);
INSERT INTO `wn_blog_article` VALUES ('235', '我的测试', '3', '<p>心情表情电脑上发布<br/></p>', '', '1', '2017-09-14 14:35:42', '2017-09-14 14:35:42', null);
INSERT INTO `wn_blog_article` VALUES ('236', '表情测试??', '3', '<p>手机照片上传</p>', '', '1', '2017-09-14 14:52:39', '2017-09-14 14:52:39', null);
INSERT INTO `wn_blog_article` VALUES ('237', '哦哦哦', '15', '<p>与会者<span style=\"text-decoration: underline;\">h?</span></p><p><u>?</u></p>', '', '1', '2017-09-14 15:01:25', '2017-09-14 15:01:25', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of wn_category
-- ----------------------------
INSERT INTO `wn_category` VALUES ('1', 'laravel', '0', 'blog', '0', 'list', '2016-12-26 15:55:35', '2017-05-11 18:27:12', '0');
INSERT INTO `wn_category` VALUES ('3', '随笔', '0', 'blog', '0', 'list', '2016-12-26 15:55:38', '2017-02-15 17:55:33', '0');
INSERT INTO `wn_category` VALUES ('4', 'mysql', '15', 'blog', '0,15', 'list', '2016-12-26 10:15:33', '2017-04-19 15:08:38', '0');
INSERT INTO `wn_category` VALUES ('5', '开发之路', '0', 'blog', '0', 'list', '2016-12-26 10:39:43', '2017-05-04 15:54:09', '0');
INSERT INTO `wn_category` VALUES ('6', '小和尚', '0', 'blog', '0', 'list', '2016-12-27 07:24:45', '2017-02-15 17:55:35', '0');
INSERT INTO `wn_category` VALUES ('11', '测试', '0', 'blog', '0', 'list_simple', '2017-01-15 13:37:25', '2017-02-15 17:55:36', '0');
INSERT INTO `wn_category` VALUES ('13', '佛语', '15', 'blog', '0,15', 'list', '2017-02-08 09:42:30', '2017-04-19 15:08:18', '0');
INSERT INTO `wn_category` VALUES ('14', '书籍', '0', 'shop', '0', 'list', '2017-02-20 14:40:31', '2017-02-20 14:41:51', '0');
INSERT INTO `wn_category` VALUES ('15', '文章', '0', 'blog', '0', 'list', '2017-03-01 09:01:00', '2017-03-01 09:01:00', '0');
INSERT INTO `wn_category` VALUES ('16', '英语', '15', 'blog', '0,15', 'list', '2017-03-06 08:25:06', '2017-04-19 15:08:10', '0');
INSERT INTO `wn_category` VALUES ('17', '工作', '3', 'blog', '0,3', 'list', '2017-03-06 21:06:39', '2017-04-19 15:07:46', '0');
INSERT INTO `wn_category` VALUES ('18', 'go语言', '0', 'blog', '0', 'list', '2017-07-07 10:51:40', '2017-07-07 10:51:40', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wn_image
-- ----------------------------
INSERT INTO `wn_image` VALUES ('6', 'blog', '', '/upload/image/20161230/1483069754310812.jpg', '1', '15', 'article', '1483069754310812.jpg', '0', '.jpg', 'big.jpg', '0', 'SUCCESS', '2017-01-05 10:26:36', '2017-01-05 10:26:36', '2017-01-05 10:26:36');
INSERT INTO `wn_image` VALUES ('7', 'blog', '', '/upload/image/20161230/1483069754163230.jpg', '1', '15', 'article', '1483069754163230.jpg', '0', '.jpg', 'small.jpg', '0', 'SUCCESS', '2017-01-05 10:26:36', '2017-01-05 10:26:36', '2017-01-05 10:26:36');
INSERT INTO `wn_image` VALUES ('8', 'blog', '', '/upload/image/20161230/1483069889306901.jpg', '1', '15', 'article', '1483069889306901.jpg', '0', '.jpg', 'small.jpg', '0', 'SUCCESS', '2017-01-05 15:09:18', '2017-01-05 15:09:18', '2017-01-05 15:09:18');
INSERT INTO `wn_image` VALUES ('9', 'blog', '', '/upload/image/20161230/1483070002779523.jpg', '1', '15', 'article', '1483070002779523.jpg', '90536', '.jpg', 'big.jpg', '0', 'SUCCESS', '2017-01-05 15:09:18', '2017-01-05 15:09:18', '2017-01-05 15:09:18');
INSERT INTO `wn_image` VALUES ('10', 'blog', '', '/upload/image/20161230/1483073488695133.jpg', '1', '15', 'article', '1483073488695133.jpg', '90536', '.jpg', 'big.jpg', '0', 'SUCCESS', '2016-12-30 12:54:06', '2016-12-30 12:54:06', null);
INSERT INTO `wn_image` VALUES ('11', 'blog', '', '/upload/image/20161230/1483073547412225.jpg', '1', '15', 'article', '1483073547412225.jpg', '8645', '.jpg', 'small.jpg', '0', 'SUCCESS', '2016-12-30 12:54:06', '2016-12-30 12:54:06', null);
INSERT INTO `wn_image` VALUES ('14', 'blog', '', '/upload/image/20161231/1483144354717550.jpg', '1', '15', 'article', '1483144354717550.jpg', '95520', '.jpg', 'YY图片20160713001018.jpg', '0', 'SUCCESS', '2016-12-31 08:32:36', '2016-12-31 08:32:36', null);
INSERT INTO `wn_image` VALUES ('15', '', '', '/upload/image/20161231/1483165132995566.jpg', '1', '0', '', '1483165132995566.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 14:18:52', '2016-12-31 14:18:52', null);
INSERT INTO `wn_image` VALUES ('16', '', '', '/upload/image/20161231/1483173032584162.jpg', '1', '0', '', '1483173032584162.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 16:30:32', '2016-12-31 16:30:32', null);
INSERT INTO `wn_image` VALUES ('17', '', '', '/upload/image/20161231/1483173406864568.jpg', '1', '0', '', '1483173406864568.jpg', '272625', '.jpg', 'QQ图片20160731144814.jpg', '0', 'SUCCESS', '2016-12-31 16:36:46', '2016-12-31 16:36:46', null);
INSERT INTO `wn_image` VALUES ('18', '', '', '/upload/image/20161231/1483173406905372.jpg', '1', '0', '', '1483173406905372.jpg', '84789', '.jpg', 'YY图片20160713001024.jpg', '0', 'SUCCESS', '2016-12-31 16:36:46', '2016-12-31 16:36:46', null);
INSERT INTO `wn_image` VALUES ('19', 'blog', '', '/upload/image/20161231/1483173489167961.jpg', '1', '15', 'article', '1483173489167961.jpg', '77761', '.jpg', 'YY图片20160711174624.jpg', '0', 'SUCCESS', '2016-12-31 16:38:12', '2016-12-31 16:38:12', null);
INSERT INTO `wn_image` VALUES ('20', 'blog', '', '/upload/image/20161231/1483173489642158.jpg', '1', '15', 'article', '1483173489642158.jpg', '245524', '.jpg', 'YY图片20160711230915.jpg', '0', 'SUCCESS', '2016-12-31 16:38:12', '2016-12-31 16:38:12', null);
INSERT INTO `wn_image` VALUES ('21', '', '', '/upload/image/20161231/1483174341614245.jpg', '1', '0', '', '1483174341614245.jpg', '84789', '.jpg', 'YY图片20160713001024.jpg', '0', 'SUCCESS', '2016-12-31 16:52:21', '2016-12-31 16:52:21', null);
INSERT INTO `wn_image` VALUES ('22', '', '', '/upload/image/20161231/1483175084941499.jpg', '1', '0', '', '1483175084941499.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 17:04:44', '2016-12-31 17:04:44', null);
INSERT INTO `wn_image` VALUES ('23', '', '', '/upload/image/20161231/1483179481241747.jpg', '1', '0', '', '1483179481241747.jpg', '534305', '.jpg', 'DSC_6259.JPG', '0', 'SUCCESS', '2016-12-31 18:18:01', '2016-12-31 18:18:01', null);
INSERT INTO `wn_image` VALUES ('24', '', '', '/upload/image/20161231/1483188619243394.jpg', '1', '0', '', '1483188619243394.jpg', '89834', '.jpg', 'YY图片20160713001041.jpg', '0', 'SUCCESS', '2016-12-31 20:50:19', '2016-12-31 20:50:19', null);
INSERT INTO `wn_image` VALUES ('25', '', '', '/upload/image/20161231/1483188674615847.jpg', '1', '0', '', '1483188674615847.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 20:51:14', '2016-12-31 20:51:14', null);
INSERT INTO `wn_image` VALUES ('26', '', '', '/upload/image/20161231/1483188712838943.jpg', '1', '0', '', '1483188712838943.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 20:51:52', '2016-12-31 20:51:52', null);
INSERT INTO `wn_image` VALUES ('27', '', '', '/upload/image/20161231/1483188954355828.jpg', '1', '0', '', '1483188954355828.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 20:55:54', '2016-12-31 20:55:54', null);
INSERT INTO `wn_image` VALUES ('28', '', '', '/upload/image/20161231/1483189024980210.jpg', '1', '0', '', '1483189024980210.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 20:57:04', '2016-12-31 20:57:04', null);
INSERT INTO `wn_image` VALUES ('29', '', '', '/upload/image/20161231/1483189174701166.jpg', '1', '0', '', '1483189174701166.jpg', '18403', '.jpg', '20151118175829862.jpg', '0', 'SUCCESS', '2016-12-31 20:59:34', '2016-12-31 20:59:34', null);
INSERT INTO `wn_image` VALUES ('30', '', '', '/upload/image/20170103/1483431113834733.jpg', '1', '0', '', '1483431113834733.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:11:53', '2017-01-03 16:11:53', null);
INSERT INTO `wn_image` VALUES ('31', '', '', '/upload/image/20170103/1483431985449392.jpg', '1', '0', '', '1483431985449392.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-01-03 16:26:25', '2017-01-03 16:26:25', null);
INSERT INTO `wn_image` VALUES ('32', '', '', '/upload/image/20170103/1483432005475655.jpg', '1', '0', '', '1483432005475655.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:26:45', '2017-01-03 16:26:45', null);
INSERT INTO `wn_image` VALUES ('33', '', '', '/upload/image/20170103/1483432076264178.jpg', '1', '0', '', '1483432076264178.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:27:56', '2017-01-03 16:27:56', null);
INSERT INTO `wn_image` VALUES ('34', '', '', '/upload/image/20170103/1483432076103893.jpg', '1', '0', '', '1483432076103893.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:27:56', '2017-01-03 16:27:56', null);
INSERT INTO `wn_image` VALUES ('35', '', '', '/upload/image/20170103/1483432090122796.jpg', '1', '0', '', '1483432090122796.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-01-03 16:28:10', '2017-01-03 16:28:10', null);
INSERT INTO `wn_image` VALUES ('36', '', '', '/upload/image/20170103/1483432243732469.jpg', '1', '0', '', '1483432243732469.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:30:43', '2017-01-03 16:30:43', null);
INSERT INTO `wn_image` VALUES ('37', '', '', '/upload/image/20170103/1483432243454509.jpg', '1', '0', '', '1483432243454509.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:30:43', '2017-01-03 16:30:43', null);
INSERT INTO `wn_image` VALUES ('38', '', '', '/upload/image/20170103/1483432332891185.jpg', '1', '0', '', '1483432332891185.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:32:12', '2017-01-03 16:32:12', null);
INSERT INTO `wn_image` VALUES ('39', '', '', '/upload/image/20170103/1483432369609257.jpg', '1', '0', '', '1483432369609257.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:32:49', '2017-01-03 16:32:49', null);
INSERT INTO `wn_image` VALUES ('40', '', '', '/upload/image/20170103/1483432383227204.jpg', '1', '0', '', '1483432383227204.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:33:03', '2017-01-03 16:33:03', null);
INSERT INTO `wn_image` VALUES ('41', '', '', '/upload/image/20170103/1483432438320831.jpg', '1', '0', '', '1483432438320831.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:33:58', '2017-01-03 16:33:58', null);
INSERT INTO `wn_image` VALUES ('42', '', '', '/upload/image/20170103/1483432438750349.jpg', '1', '0', '', '1483432438750349.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:33:58', '2017-01-03 16:33:58', null);
INSERT INTO `wn_image` VALUES ('43', '', '', '/upload/image/20170103/1483433411642485.jpg', '1', '0', '', '1483433411642485.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:50:11', '2017-01-03 16:50:11', null);
INSERT INTO `wn_image` VALUES ('44', '', '', '/upload/image/20170103/1483433446850955.jpg', '1', '0', '', '1483433446850955.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:50:46', '2017-01-03 16:50:46', null);
INSERT INTO `wn_image` VALUES ('45', '', '', '/upload/image/20170103/1483433447120352.jpg', '1', '0', '', '1483433447120352.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:50:47', '2017-01-03 16:50:47', null);
INSERT INTO `wn_image` VALUES ('46', '', '', '/upload/image/20170103/1483433532168496.jpg', '1', '0', '', '1483433532168496.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:52:12', '2017-01-03 16:52:12', null);
INSERT INTO `wn_image` VALUES ('47', '', '', '/upload/image/20170103/1483433532578033.jpg', '1', '0', '', '1483433532578033.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:52:12', '2017-01-03 16:52:12', null);
INSERT INTO `wn_image` VALUES ('48', '', '', '/upload/image/20170103/1483433568951639.jpg', '1', '0', '', '1483433568951639.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 16:52:48', '2017-01-03 16:52:48', null);
INSERT INTO `wn_image` VALUES ('49', '', '', '/upload/image/20170103/1483433569445069.jpg', '1', '0', '', '1483433569445069.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 16:52:49', '2017-01-03 16:52:49', null);
INSERT INTO `wn_image` VALUES ('50', '', '', '/upload/image/20170103/1483434010863389.jpg', '1', '0', '', '1483434010863389.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 17:00:10', '2017-01-03 17:00:10', null);
INSERT INTO `wn_image` VALUES ('51', '', '', '/upload/image/20170103/1483434010214648.jpg', '1', '0', '', '1483434010214648.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-03 17:00:10', '2017-01-03 17:00:10', null);
INSERT INTO `wn_image` VALUES ('52', '', '', '/upload/image/20170103/1483434620223772.jpg', '1', '0', '', '1483434620223772.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-03 17:10:20', '2017-01-03 17:10:20', null);
INSERT INTO `wn_image` VALUES ('53', '', '', '/upload/image/20170105/1483583793618755.jpg', '1', '0', '', '1483583793618755.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 10:36:33', '2017-01-05 10:36:33', null);
INSERT INTO `wn_image` VALUES ('54', '', '', '/upload/image/20170105/1483583794717406.jpg', '1', '0', '', '1483583794717406.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-05 10:36:34', '2017-01-05 10:36:34', null);
INSERT INTO `wn_image` VALUES ('55', '', '', '/upload/image/20170105/1483583795513141.jpg', '1', '0', '', '1483583795513141.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-01-05 10:36:35', '2017-01-05 10:36:35', null);
INSERT INTO `wn_image` VALUES ('56', '', '', '/upload/image/20170105/1483584051548146.jpg', '1', '0', '', '1483584051548146.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 10:40:51', '2017-01-05 10:40:51', null);
INSERT INTO `wn_image` VALUES ('57', '', '', '/upload/image/20170105/1483584051960413.jpg', '1', '0', '', '1483584051960413.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-05 10:40:51', '2017-01-05 10:40:51', null);
INSERT INTO `wn_image` VALUES ('58', '', '', '/upload/image/20170105/1483584285440790.jpg', '1', '0', '', '1483584285440790.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 10:44:45', '2017-01-05 10:44:45', null);
INSERT INTO `wn_image` VALUES ('59', '', '', '/upload/image/20170105/1483584285768113.jpg', '1', '0', '', '1483584285768113.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-05 10:44:45', '2017-01-05 10:44:45', null);
INSERT INTO `wn_image` VALUES ('60', '', '', '/upload/image/20170105/1483584801466669.jpg', '1', '0', '', '1483584801466669.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 10:53:21', '2017-01-05 10:53:21', null);
INSERT INTO `wn_image` VALUES ('61', '', '', '/upload/image/20170105/1483586542278445.jpg', '1', '0', '', '1483586542278445.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 11:22:22', '2017-01-05 11:22:22', null);
INSERT INTO `wn_image` VALUES ('62', '', '', '/upload/image/20170105/1483599845102872.jpg', '1', '0', '', '1483599845102872.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 15:04:05', '2017-01-05 15:04:05', null);
INSERT INTO `wn_image` VALUES ('63', '', '', '/upload/image/20170105/1483599845402265.jpg', '1', '0', '', '1483599845402265.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-05 15:04:05', '2017-01-05 15:04:05', null);
INSERT INTO `wn_image` VALUES ('64', '', '', '/upload/image/20170105/1483600011422220.jpg', '1', '0', '', '1483600011422220.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 15:06:51', '2017-01-05 15:06:51', null);
INSERT INTO `wn_image` VALUES ('65', 'blog', '', '/upload/image/20170105/1483600143432901.jpg', '1', '15', 'article', '1483600143432901.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-05 15:09:05', '2017-01-05 15:09:05', null);
INSERT INTO `wn_image` VALUES ('66', '', '', '/upload/image/20170113/1484320641435757.jpg', '1', '0', '', '1484320641435757.jpg', '436158', '.jpg', 'image.jpg', '0', 'SUCCESS', '2017-01-13 23:17:21', '2017-01-13 23:17:21', null);
INSERT INTO `wn_image` VALUES ('67', 'blog', '', '/upload/image/20170113/1484321611154664.jpg', '1', '21', 'article', '1484321611154664.jpg', '219960', '.jpg', 'IMG_2198.JPG', '0', 'SUCCESS', '2017-01-13 23:33:37', '2017-01-13 23:33:37', null);
INSERT INTO `wn_image` VALUES ('68', '', '', '/upload/image/20170115/1484490750198086.jpg', '1', '0', '', '1484490750198086.jpg', '647826', '.jpg', 'IMG_2161.JPG', '0', 'SUCCESS', '2017-01-15 22:32:30', '2017-01-15 22:32:30', null);
INSERT INTO `wn_image` VALUES ('69', '', '', '/upload/image/20170115/1484490750978779.jpg', '1', '0', '', '1484490750978779.jpg', '647419', '.jpg', 'IMG_2162.JPG', '0', 'SUCCESS', '2017-01-15 22:32:30', '2017-01-15 22:32:30', null);
INSERT INTO `wn_image` VALUES ('70', '', '', '/upload/image/20170115/1484490750616299.jpg', '1', '0', '', '1484490750616299.jpg', '602111', '.jpg', 'IMG_2165.JPG', '0', 'SUCCESS', '2017-01-15 22:32:30', '2017-01-15 22:32:30', null);
INSERT INTO `wn_image` VALUES ('71', '', '', '/upload/image/20170115/1484490750756781.jpg', '1', '0', '', '1484490750756781.jpg', '632497', '.jpg', 'IMG_2167.JPG', '0', 'SUCCESS', '2017-01-15 22:32:30', '2017-01-15 22:32:30', null);
INSERT INTO `wn_image` VALUES ('72', '', '', '/upload/image/20170115/1484490750421882.jpg', '1', '0', '', '1484490750421882.jpg', '694460', '.jpg', 'IMG_2166.JPG', '0', 'SUCCESS', '2017-01-15 22:32:30', '2017-01-15 22:32:30', null);
INSERT INTO `wn_image` VALUES ('73', '', '', '/upload/image/20170115/1484490751492449.jpg', '1', '0', '', '1484490751492449.jpg', '735105', '.jpg', 'IMG_2168.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('74', '', '', '/upload/image/20170115/1484490751985507.jpg', '1', '0', '', '1484490751985507.jpg', '697312', '.jpg', 'IMG_2169.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('75', '', '', '/upload/image/20170115/1484490751215910.jpg', '1', '0', '', '1484490751215910.jpg', '649844', '.jpg', 'IMG_2170.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('76', '', '', '/upload/image/20170115/1484490751238815.jpg', '1', '0', '', '1484490751238815.jpg', '654868', '.jpg', 'IMG_2172.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('77', '', '', '/upload/image/20170115/1484490751339239.jpg', '1', '0', '', '1484490751339239.jpg', '562538', '.jpg', 'IMG_2173.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('78', '', '', '/upload/image/20170115/1484490751385246.jpg', '1', '0', '', '1484490751385246.jpg', '613401', '.jpg', 'IMG_2174.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('79', '', '', '/upload/image/20170115/1484490751924770.jpg', '1', '0', '', '1484490751924770.jpg', '453400', '.jpg', 'IMG_2184.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('80', '', '', '/upload/image/20170115/1484490751149168.jpg', '1', '0', '', '1484490751149168.jpg', '590619', '.jpg', 'IMG_2175.JPG', '0', 'SUCCESS', '2017-01-15 22:32:31', '2017-01-15 22:32:31', null);
INSERT INTO `wn_image` VALUES ('81', 'blog', '', '/upload/image/20170115/1484490814520130.jpg', '1', '29', 'article', '1484490814520130.jpg', '647826', '.jpg', 'IMG_2161.JPG', '0', 'SUCCESS', '2017-01-15 22:33:37', '2017-01-15 22:33:37', null);
INSERT INTO `wn_image` VALUES ('82', '', '', '/upload/image/20170115/1484491006919915.jpg', '1', '0', '', '1484491006919915.jpg', '647826', '.jpg', 'IMG_2161.JPG', '0', 'SUCCESS', '2017-01-15 22:36:46', '2017-01-15 22:36:46', null);
INSERT INTO `wn_image` VALUES ('83', '', '', '/upload/image/20170115/1484491007189301.jpg', '1', '0', '', '1484491007189301.jpg', '647419', '.jpg', 'IMG_2162.JPG', '0', 'SUCCESS', '2017-01-15 22:36:47', '2017-01-15 22:36:47', null);
INSERT INTO `wn_image` VALUES ('84', 'blog', '', '/upload/image/20170115/1484491141171740.jpg', '1', '32', 'article', '1484491141171740.jpg', '647826', '.jpg', 'IMG_2161.JPG', '0', 'SUCCESS', '2017-01-15 22:39:36', '2017-01-15 22:39:36', null);
INSERT INTO `wn_image` VALUES ('85', 'blog', '', '/upload/image/20170116/1484530829400414.jpg', '1', '37', 'article', '1484530829400414.jpg', '680419', '.jpg', 'IMG_2200.JPG', '0', 'SUCCESS', '2017-01-16 09:40:33', '2017-01-16 09:40:33', null);
INSERT INTO `wn_image` VALUES ('86', 'blog', '', '/upload/image/20170116/1484568772194730.jpg', '1', '40', 'article', '1484568772194730.jpg', '598873', '.jpg', 'image.jpg', '0', 'SUCCESS', '2017-01-16 20:12:54', '2017-01-16 20:12:54', null);
INSERT INTO `wn_image` VALUES ('87', 'blog', '', '/upload/image/20170117/1484660744772467.jpg', '1', '50', 'article', '1484660744772467.jpg', '657246', '.jpg', 'IMG_2216.JPG', '0', 'SUCCESS', '2017-01-17 21:47:25', '2017-01-17 21:47:25', null);
INSERT INTO `wn_image` VALUES ('88', 'blog', '', '/upload/image/20170119/1484791406527685.jpg', '1', '56', 'article', '1484791406527685.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-01-19 14:59:09', '2017-01-19 14:59:09', '2017-01-19 14:59:09');
INSERT INTO `wn_image` VALUES ('89', 'blog', '', '/upload/image/20170119/1484791436421954.jpg', '1', '56', 'article', '1484791436421954.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-01-19 14:59:09', '2017-01-19 14:59:09', '2017-01-19 14:59:09');
INSERT INTO `wn_image` VALUES ('90', 'blog', '', '/upload/image/20170119/1484791713511155.jpg', '1', '56', 'article', '1484791713511155.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-01-19 14:59:09', '2017-01-19 14:59:09', '2017-01-19 14:59:09');
INSERT INTO `wn_image` VALUES ('91', 'blog', '', '/upload/image/20170119/1484809143953669.jpg', '1', '56', 'article', '1484809143953669.jpg', '229031', '.jpg', 'IMG_2217.JPG', '0', 'SUCCESS', '2017-01-19 16:39:49', '2017-01-19 16:39:49', '2017-01-19 16:39:49');
INSERT INTO `wn_image` VALUES ('92', 'blog', '', '/upload/image/20170119/1484809417299161.jpg', '1', '56', 'article', '1484809417299161.jpg', '736746', '.jpg', 'IMG_2218.JPG', '0', 'SUCCESS', '2017-01-19 16:39:49', '2017-01-19 16:39:49', '2017-01-19 16:39:49');
INSERT INTO `wn_image` VALUES ('93', 'blog', '', '/upload/image/20170122/1485057763827776.jpg', '1', '68', 'article', '1485057763827776.jpg', '509395', '.jpg', 'IMG_2283.JPG', '0', 'SUCCESS', '2017-01-22 12:02:46', '2017-01-22 12:02:46', null);
INSERT INTO `wn_image` VALUES ('94', '', '', '/upload/image/20170220/1487573898567609.jpg', '1', '0', '', '1487573898567609.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 14:58:18', '2017-02-20 14:58:18', null);
INSERT INTO `wn_image` VALUES ('95', '', '', '/upload/image/20170220/1487574115571407.jpg', '1', '0', '', '1487574115571407.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:01:55', '2017-02-20 15:01:55', null);
INSERT INTO `wn_image` VALUES ('96', '', '', '/upload/image/20170220/1487574235346861.jpg', '1', '0', '', '1487574235346861.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:03:55', '2017-02-20 15:03:55', null);
INSERT INTO `wn_image` VALUES ('97', '', '', '/upload/image/20170220/1487574484347938.jpg', '1', '0', '', '1487574484347938.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:08:04', '2017-02-20 15:08:04', null);
INSERT INTO `wn_image` VALUES ('98', '', '', '/upload/image/20170220/1487574880401087.jpg', '1', '0', '', '1487574880401087.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:14:40', '2017-02-20 15:14:40', null);
INSERT INTO `wn_image` VALUES ('99', '', '', '/upload/image/20170220/1487574990820949.jpg', '1', '0', '', '1487574990820949.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:16:30', '2017-02-20 15:16:30', null);
INSERT INTO `wn_image` VALUES ('100', '', '', '/upload/image/20170220/1487575287812547.jpg', '1', '0', '', '1487575287812547.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:21:27', '2017-02-20 15:21:27', null);
INSERT INTO `wn_image` VALUES ('101', '', '', '/upload/image/20170220/1487575523242239.jpg', '1', '0', '', '1487575523242239.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:25:23', '2017-02-20 15:25:23', null);
INSERT INTO `wn_image` VALUES ('102', 'shop', '', '/upload/image/20170220/1487575629472375.jpg', '1', '2', 'product', '1487575629472375.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-21 10:47:14', '2017-02-21 10:47:14', '2017-02-21 10:47:14');
INSERT INTO `wn_image` VALUES ('103', 'blog', '', '/upload/image/20170220/1487576209988299.jpg', '1', '109', 'article', '1487576209988299.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-20 15:36:50', '2017-02-20 15:36:50', null);
INSERT INTO `wn_image` VALUES ('104', 'shop', '', '/upload/image/20170221/1487644089919715.jpg', '1', '2', 'product', '1487644089919715.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-02-21 10:47:33', '2017-02-21 10:47:33', '2017-02-21 10:47:33');
INSERT INTO `wn_image` VALUES ('105', 'shop', '', '/upload/image/20170221/1487644093636914.jpg', '1', '2', 'product', '1487644093636914.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-02-21 10:47:33', '2017-02-21 10:47:33', '2017-02-21 10:47:33');
INSERT INTO `wn_image` VALUES ('106', '', '', '/upload/image/20170221/1487645266429184.jpg', '1', '0', '', '1487645266429184.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-21 10:47:46', '2017-02-21 10:47:46', null);
INSERT INTO `wn_image` VALUES ('107', '', '', '/upload/image/20170221/1487645397852020.jpg', '1', '0', '', '1487645397852020.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-21 10:49:57', '2017-02-21 10:49:57', null);
INSERT INTO `wn_image` VALUES ('108', '', '', '/upload/image/20170221/1487645917229520.jpg', '1', '0', '', '1487645917229520.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-21 10:58:37', '2017-02-21 10:58:37', null);
INSERT INTO `wn_image` VALUES ('109', 'shop', 'http://www.baidu.com', '/upload/image/20170221/1487646097358937.jpg', '1', '2', 'product', '第一张', '8645', '.jpg', 'a1.jpg', '3', 'SUCCESS', '2017-02-22 11:21:07', '2017-02-22 11:21:07', null);
INSERT INTO `wn_image` VALUES ('110', '', '', '/upload/image/20170221/1487646097358937.jpg', '0', '0', '', '1487646097358937.jpg', '0', '', '', '2', '', '2017-02-22 10:59:17', '2017-02-22 10:59:17', null);
INSERT INTO `wn_image` VALUES ('111', '', '', '/upload/image/20170221/1487646097358937.jpg', '0', '0', '', '1487646097358937.jpg', '0', '', '', '2', '', '2017-02-22 11:05:37', '2017-02-22 11:05:37', null);
INSERT INTO `wn_image` VALUES ('112', '', '', '/upload/image/20170221/1487646097358937.jpg', '0', '0', '', '1487646097358937.jpg', '0', '', '', '2', '', '2017-02-22 11:06:09', '2017-02-22 11:06:09', null);
INSERT INTO `wn_image` VALUES ('113', 'shop', '', '/upload/image/20170222/1487734411404460.jpg', '1', '2', 'product', '第二张', '90536', '.jpg', 'a2.jpg', '4', 'SUCCESS', '2017-02-22 11:34:01', '2017-02-22 11:34:01', null);
INSERT INTO `wn_image` VALUES ('114', '', '', '/upload/image/20170222/1487734455451389.jpg', '1', '0', '', '1487734455451389.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-02-22 11:34:15', '2017-02-22 11:34:15', null);
INSERT INTO `wn_image` VALUES ('115', '', '', '/upload/image/20170222/1487734753306303.jpg', '1', '0', '', '1487734753306303.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-22 11:39:13', '2017-02-22 11:39:13', null);
INSERT INTO `wn_image` VALUES ('116', 'shop', '', '/upload/image/20170222/1487734987402442.jpg', '1', '2', 'product', '1487734987402442.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-02-22 11:43:09', '2017-02-22 11:43:09', null);
INSERT INTO `wn_image` VALUES ('117', '', '', '/upload/image/20170222/1487735215546236.jpg', '1', '0', '', '1487735215546236.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-22 11:46:55', '2017-02-22 11:46:55', null);
INSERT INTO `wn_image` VALUES ('118', '', '', '/upload/image/20170222/1487758135667183.jpg', '1', '0', '', '1487758135667183.jpg', '74152', '.jpg', 'IMG_2675.JPG', '0', 'SUCCESS', '2017-02-22 18:08:55', '2017-02-22 18:08:55', null);
INSERT INTO `wn_image` VALUES ('119', '', '', '/upload/image/20170222/1487758135873607.jpg', '1', '0', '', '1487758135873607.jpg', '75054', '.jpg', 'IMG_2676.JPG', '0', 'SUCCESS', '2017-02-22 18:08:55', '2017-02-22 18:08:55', null);
INSERT INTO `wn_image` VALUES ('120', '', '', '/upload/image/20170222/1487758135910077.jpg', '1', '0', '', '1487758135910077.jpg', '77998', '.jpg', 'IMG_2674.JPG', '0', 'SUCCESS', '2017-02-22 18:08:55', '2017-02-22 18:08:55', null);
INSERT INTO `wn_image` VALUES ('121', '', '', '/upload/image/20170222/1487758136476924.jpg', '1', '0', '', '1487758136476924.jpg', '73592', '.jpg', 'IMG_2677.JPG', '0', 'SUCCESS', '2017-02-22 18:08:56', '2017-02-22 18:08:56', null);
INSERT INTO `wn_image` VALUES ('122', '', '', '/upload/image/20170222/1487758136716243.jpg', '1', '0', '', '1487758136716243.jpg', '76168', '.jpg', 'IMG_2678.JPG', '0', 'SUCCESS', '2017-02-22 18:08:56', '2017-02-22 18:08:56', null);
INSERT INTO `wn_image` VALUES ('123', '', '', '/upload/image/20170222/1487758136826605.jpg', '1', '0', '', '1487758136826605.jpg', '76998', '.jpg', 'IMG_2679.JPG', '0', 'SUCCESS', '2017-02-22 18:08:56', '2017-02-22 18:08:56', null);
INSERT INTO `wn_image` VALUES ('124', '', '', '/upload/image/20170222/1487758137973575.jpg', '1', '0', '', '1487758137973575.jpg', '71007', '.jpg', 'IMG_2682.JPG', '0', 'SUCCESS', '2017-02-22 18:08:57', '2017-02-22 18:08:57', null);
INSERT INTO `wn_image` VALUES ('125', '', '', '/upload/image/20170222/1487758138449622.jpg', '1', '0', '', '1487758138449622.jpg', '77012', '.jpg', 'IMG_2681.JPG', '0', 'SUCCESS', '2017-02-22 18:08:58', '2017-02-22 18:08:58', null);
INSERT INTO `wn_image` VALUES ('126', '', '', '/upload/image/20170222/1487758139605897.jpg', '1', '0', '', '1487758139605897.jpg', '72211', '.jpg', 'IMG_2680.JPG', '0', 'SUCCESS', '2017-02-22 18:08:59', '2017-02-22 18:08:59', null);
INSERT INTO `wn_image` VALUES ('127', 'blog', '', '/upload/image/20170222/1487762334426280.jpg', '1', '114', 'article', '1487762334426280.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-02-22 19:22:00', '2017-02-22 19:22:00', null);
INSERT INTO `wn_image` VALUES ('128', 'blog', '', '/upload/image/20170222/1487770132337722.jpg', '1', '111', 'article', '1487770132337722.jpg', '77998', '.jpg', 'IMG_2674.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('129', 'blog', '', '/upload/image/20170222/1487770132821164.jpg', '1', '111', 'article', '1487770132821164.jpg', '74152', '.jpg', 'IMG_2675.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('130', 'blog', '', '/upload/image/20170222/1487770132868634.jpg', '1', '111', 'article', '1487770132868634.jpg', '73592', '.jpg', 'IMG_2677.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('131', 'blog', '', '/upload/image/20170222/1487770132641076.jpg', '1', '111', 'article', '1487770132641076.jpg', '75054', '.jpg', 'IMG_2676.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('132', 'blog', '', '/upload/image/20170222/1487770132958615.jpg', '1', '111', 'article', '1487770132958615.jpg', '76168', '.jpg', 'IMG_2678.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('133', 'blog', '', '/upload/image/20170222/1487770132928506.jpg', '1', '111', 'article', '1487770132928506.jpg', '72211', '.jpg', 'IMG_2680.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('134', 'blog', '', '/upload/image/20170222/1487770132358814.jpg', '1', '111', 'article', '1487770132358814.jpg', '76998', '.jpg', 'IMG_2679.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('135', 'blog', '', '/upload/image/20170222/1487770132525589.jpg', '1', '111', 'article', '1487770132525589.jpg', '77012', '.jpg', 'IMG_2681.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('136', 'blog', '', '/upload/image/20170222/1487770132379247.jpg', '1', '111', 'article', '1487770132379247.jpg', '71007', '.jpg', 'IMG_2682.JPG', '0', 'SUCCESS', '2017-02-22 21:28:56', '2017-02-22 21:28:56', null);
INSERT INTO `wn_image` VALUES ('137', '', '', '/upload/image/20170321/1490094456283691.jpg', '1', '0', '', '1490094456283691.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-03-21 19:07:36', '2017-03-21 19:07:36', null);
INSERT INTO `wn_image` VALUES ('138', '', '', '/upload/image/20170321/1490094456106868.jpg', '1', '0', '', '1490094456106868.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-03-21 19:07:36', '2017-03-21 19:07:36', null);
INSERT INTO `wn_image` VALUES ('139', '', '', '/upload/image/20170321/1490094458215488.jpg', '1', '0', '', '1490094458215488.jpg', '766844', '.jpg', 'a3.jpg', '0', 'SUCCESS', '2017-03-21 19:07:38', '2017-03-21 19:07:38', null);
INSERT INTO `wn_image` VALUES ('140', 'shop', '', '/upload/image/20170321/1490103521267124.jpg', '1', '3', 'product', '1490103521267124.jpg', '149201', '.jpg', 'YY图片20161208233154.jpg', '0', 'SUCCESS', '2017-03-21 21:38:43', '2017-03-21 21:38:43', null);
INSERT INTO `wn_image` VALUES ('141', 'blog', '', '/upload/image/20170326/1490531327612851.jpg', '1', '155', 'article', '1490531327612851.jpg', '51707', '.jpg', 'IMG_2721.JPG', '0', 'SUCCESS', '2017-03-26 20:28:49', '2017-03-26 20:28:49', null);
INSERT INTO `wn_image` VALUES ('142', 'blog', '', '/upload/image/20170326/1490533180180485.jpg', '1', '156', 'article', '1490533180180485.jpg', '23101', '.jpg', 'IMG_2722.JPG', '0', 'SUCCESS', '2017-03-26 20:59:44', '2017-03-26 20:59:44', null);
INSERT INTO `wn_image` VALUES ('143', 'blog', '', '/upload/image/20170326/1490535442304261.jpg', '1', '157', 'article', '1490535442304261.jpg', '52929', '.jpg', 'IMG_2723.JPG', '0', 'SUCCESS', '2017-03-26 21:38:02', '2017-03-26 21:38:02', null);
INSERT INTO `wn_image` VALUES ('144', 'blog', '', '/upload/image/20170326/1490535645211263.jpg', '1', '158', 'article', '1490535645211263.jpg', '190434', '.jpg', 'IMG_2724.JPG', '0', 'SUCCESS', '2017-03-26 21:40:50', '2017-03-26 21:40:50', null);
INSERT INTO `wn_image` VALUES ('145', 'blog', '', '/upload/image/20170328/1490670177285180.jpg', '1', '159', 'article', '1490670177285180.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-03-28 11:02:58', '2017-03-28 11:02:58', null);
INSERT INTO `wn_image` VALUES ('146', 'blog', '', '/upload/image/20170328/1490697893784119.jpg', '1', '160', 'article', '1490697893784119.jpg', '96106', '.jpg', 'IMG_2732.JPG', '0', 'SUCCESS', '2017-03-28 18:44:56', '2017-03-28 18:44:56', null);
INSERT INTO `wn_image` VALUES ('147', '', '', '/upload/image/20170329/1490745072951454.jpg', '1', '0', '', '1490745072951454.jpg', '37581', '.jpg', 'IMG_2730.JPG', '0', 'SUCCESS', '2017-03-29 07:51:12', '2017-03-29 07:51:12', null);
INSERT INTO `wn_image` VALUES ('148', 'blog', '', '/upload/image/20170329/1490745155622114.jpg', '1', '161', 'article', '1490745155622114.jpg', '37581', '.jpg', 'IMG_2730.JPG', '0', 'SUCCESS', '2017-03-29 07:52:38', '2017-03-29 07:52:38', null);
INSERT INTO `wn_image` VALUES ('149', '', '', '/upload/image/20170405/1491387241357741.jpg', '1', '0', '', '1491387241357741.jpg', '74116', '.jpg', 'IMG_2764.JPG', '0', 'SUCCESS', '2017-04-05 18:14:01', '2017-04-05 18:14:01', null);
INSERT INTO `wn_image` VALUES ('150', '', '', '/upload/image/20170405/1491387401574961.jpg', '1', '0', '', '1491387401574961.jpg', '74116', '.jpg', 'IMG_2764.JPG', '0', 'SUCCESS', '2017-04-05 18:16:41', '2017-04-05 18:16:41', null);
INSERT INTO `wn_image` VALUES ('151', '', '', '/upload/image/20170405/1491388194151965.jpg', '1', '0', '', '1491388194151965.jpg', '74116', '.jpg', 'IMG_2764.JPG', '0', 'SUCCESS', '2017-04-05 18:29:54', '2017-04-05 18:29:54', null);
INSERT INTO `wn_image` VALUES ('152', 'blog', '', '/upload/image/20170405/1491388349674257.jpg', '1', '172', 'article', '1491388349674257.jpg', '74116', '.jpg', 'IMG_2764.JPG', '0', 'SUCCESS', '2017-04-05 18:32:31', '2017-04-05 18:32:31', null);
INSERT INTO `wn_image` VALUES ('153', 'blog', '', '/upload/image/20170405/1491389991184794.jpg', '1', '177', 'article', '1491389991184794.jpg', '74116', '.jpg', 'IMG_2764.JPG', '0', 'SUCCESS', '2017-04-05 18:59:53', '2017-04-05 18:59:53', null);
INSERT INTO `wn_image` VALUES ('154', 'shop', '', '/upload/image/20170410/1491803446114854.jpg', '1', '5', 'product', '1491803446114854.jpg', '12727', '.jpg', '69cb65e2jw8ex2q4ngmbmj20e80e8756.jpg', '0', 'SUCCESS', '2017-04-10 13:54:04', '2017-04-10 13:54:04', null);
INSERT INTO `wn_image` VALUES ('155', 'blog', '', '/upload/image/20170502/1493693003832133.jpg', '1', '192', 'article', '1493693003832133.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 10:52:27', '2017-05-02 10:52:27', '2017-05-02 10:52:27');
INSERT INTO `wn_image` VALUES ('156', 'blog', '', '/upload/image/20170502/1493693251591145.jpg', '1', '192', 'article', '1493693251591145.jpg', '784949', '.jpg', 'IMG_2899.JPG', '0', 'SUCCESS', '2017-05-02 10:47:56', '2017-05-02 10:47:56', null);
INSERT INTO `wn_image` VALUES ('157', 'blog', '', '/upload/image/20170502/1493693254719059.jpg', '1', '192', 'article', '1493693254719059.jpg', '1108968', '.jpg', 'IMG_2904.JPG', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', '2017-05-02 19:09:45');
INSERT INTO `wn_image` VALUES ('158', 'blog', '', '/upload/image/20170502/1493693256455089.jpg', '1', '192', 'article', '1493693256455089.jpg', '1012399', '.jpg', 'IMG_2900.JPG', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', '2017-05-02 19:09:45');
INSERT INTO `wn_image` VALUES ('159', '', '', '/upload/image/20170502/1493703889995151.jpg', '1', '0', '', '1493703889995151.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:44:49', '2017-05-02 13:44:49', null);
INSERT INTO `wn_image` VALUES ('160', '', '', '/upload/image/20170502/1493703910687917.jpg', '1', '0', '', '1493703910687917.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:45:10', '2017-05-02 13:45:10', null);
INSERT INTO `wn_image` VALUES ('161', '', '', '/upload/image/20170502/1493703942850370.jpg', '1', '0', '', '1493703942850370.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:45:42', '2017-05-02 13:45:42', null);
INSERT INTO `wn_image` VALUES ('162', '', '', '/upload/image/20170502/1493704000887869.jpg', '1', '0', '', '1493704000887869.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:46:40', '2017-05-02 13:46:40', null);
INSERT INTO `wn_image` VALUES ('163', '', '', '/upload/image/20170502/1493704122428809.jpg', '1', '0', '', '1493704122428809.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:48:42', '2017-05-02 13:48:42', null);
INSERT INTO `wn_image` VALUES ('164', '', '', '/upload/image/20170502/1493704272978471.jpg', '1', '0', '', '1493704272978471.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:51:12', '2017-05-02 13:51:12', null);
INSERT INTO `wn_image` VALUES ('165', '', '', '/upload/image/20170502/1493704421994380.jpg', '1', '0', '', '1493704421994380.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:53:41', '2017-05-02 13:53:41', null);
INSERT INTO `wn_image` VALUES ('166', 'blog', '', '/upload/image/20170502/1493704621398241.jpg', '1', '192', 'article', '1493704621398241.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:57:26', '2017-05-02 13:57:26', '2017-05-02 13:57:26');
INSERT INTO `wn_image` VALUES ('167', 'blog', '', '/upload/image/20170502/1493704665149623.jpg', '1', '193', 'article', '1493704665149623.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 13:57:48', '2017-05-02 13:57:48', null);
INSERT INTO `wn_image` VALUES ('168', 'shop', '', '/upload/image/20170502/1493704694295049.jpg', '1', '5', 'product', '1493704694295049.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 14:01:40', '2017-05-02 14:01:40', '2017-05-02 14:01:40');
INSERT INTO `wn_image` VALUES ('169', 'shop', '', '/upload/image/20170502/1493704929363113.jpg', '1', '6', 'product', '1493704929363113.jpg', '90536', '.jpg', 'a2.jpg', '0', 'SUCCESS', '2017-05-02 14:02:10', '2017-05-02 14:02:10', null);
INSERT INTO `wn_image` VALUES ('170', 'blog', '', '/upload/image/20170502/1493722526285141.jpg', '1', '192', 'article', '1493722526285141.jpg', '1053187', '.jpg', 'IMG_3010.JPG', '0', '文件保存时出错', '2017-05-02 19:02:56', '2017-05-02 19:02:56', '2017-05-02 19:02:56');
INSERT INTO `wn_image` VALUES ('171', 'blog', '', '/upload/image/20170502/1493722972135408.jpg', '1', '192', 'article', '1493722972135408.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', '2017-05-02 19:09:45');
INSERT INTO `wn_image` VALUES ('172', 'blog', '', '/upload/image/20170502/1493723204150948.jpg', '1', '192', 'article', '1493723204150948.jpg', '513155', '.jpg', 'IMG_3016.JPG', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', '2017-05-02 19:09:45');
INSERT INTO `wn_image` VALUES ('173', 'blog', '', '/upload/image/20170502/1493723271813827.jpg', '1', '192', 'article', '1493723271813827.jpg', '1075688', '.jpg', 'IMG_2921.JPG', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', '2017-05-02 19:09:45');
INSERT INTO `wn_image` VALUES ('174', 'blog', '', '/upload/image/20170502/1493723382404975.jpg', '1', '192', 'article', '1493723382404975.jpg', '1012399', '.jpg', 'IMG_2900.JPG', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', null);
INSERT INTO `wn_image` VALUES ('175', 'blog', '', '/upload/image/20170502/1493723382919385.jpg', '1', '192', 'article', '1493723382919385.jpg', '640481', '.jpg', 'IMG_2931.JPG', '0', 'SUCCESS', '2017-05-02 19:09:45', '2017-05-02 19:09:45', null);
INSERT INTO `wn_image` VALUES ('176', 'blog', '', '/upload/image/20170503/1493804897710941.jpg', '1', '195', 'article', '1493804897710941.jpg', '8645', '.jpg', 'a1.jpg', '0', 'SUCCESS', '2017-05-03 17:48:37', '2017-05-03 17:48:37', '2017-05-03 17:48:37');
INSERT INTO `wn_image` VALUES ('177', 'blog', '', '/upload/image/20170503/1493804932323218.jpg', '1', '195', 'article', '1493804932323218.jpg', '581858', '.jpg', 'IMG_3024.JPG', '0', 'SUCCESS', '2017-05-03 17:49:40', '2017-05-03 17:49:40', null);
INSERT INTO `wn_image` VALUES ('178', 'blog', '', '/upload/image/20170503/1493806199247282.png', '1', '195', 'article', '1493806199247282.png', '633769', '.png', 'IMG_3027.PNG', '0', 'SUCCESS', '2017-05-03 18:18:33', '2017-05-03 18:18:33', null);
INSERT INTO `wn_image` VALUES ('179', 'blog', '', '/upload/image/20170503/1493806711780065.png', '1', '195', 'article', '1493806711780065.png', '589236', '.png', 'IMG_3029.PNG', '0', 'SUCCESS', '2017-05-03 18:18:33', '2017-05-03 18:18:33', null);
INSERT INTO `wn_image` VALUES ('180', 'blog', '', '/upload/image/20170503/1493806711536906.png', '1', '195', 'article', '1493806711536906.png', '592738', '.png', 'IMG_3028.PNG', '0', 'SUCCESS', '2017-05-03 18:18:33', '2017-05-03 18:18:33', null);
INSERT INTO `wn_image` VALUES ('181', 'blog', '', '/upload/image/20170503/1493824542844869.jpg', '1', '197', 'article', '1493824542844869.jpg', '99489', '.jpg', 'IMG_3025.JPG', '0', 'SUCCESS', '2017-05-03 23:15:47', '2017-05-03 23:15:47', null);
INSERT INTO `wn_image` VALUES ('182', 'blog', '', '/upload/image/20170504/1493882593438858.jpg', '1', '198', 'article', '1493882593438858.jpg', '559046', '.jpg', 'IMG_3033.JPG', '0', 'SUCCESS', '2017-05-04 15:23:15', '2017-05-04 15:23:15', null);
INSERT INTO `wn_image` VALUES ('183', 'blog', '', '/upload/image/20170504/1493882593774816.jpg', '1', '198', 'article', '1493882593774816.jpg', '508944', '.jpg', 'IMG_3034.JPG', '0', 'SUCCESS', '2017-05-04 15:23:15', '2017-05-04 15:23:15', null);
INSERT INTO `wn_image` VALUES ('184', 'blog', '', '/upload/image/20170506/1494051831581871.jpg', '1', '200', 'article', '1494051831581871.jpg', '543572', '.jpg', 'IMG_3047.JPG', '0', 'SUCCESS', '2017-05-06 14:23:53', '2017-05-06 14:23:53', null);
INSERT INTO `wn_image` VALUES ('185', 'blog', '', '/upload/image/20170506/1494051831551531.jpg', '1', '200', 'article', '1494051831551531.jpg', '771051', '.jpg', 'IMG_3046.JPG', '0', 'SUCCESS', '2017-05-06 14:23:53', '2017-05-06 14:23:53', null);
INSERT INTO `wn_image` VALUES ('186', 'blog', '', '/upload/image/20170506/1494051831326103.jpg', '1', '200', 'article', '1494051831326103.jpg', '772252', '.jpg', 'IMG_3040.JPG', '0', 'SUCCESS', '2017-05-06 14:23:53', '2017-05-06 14:23:53', null);
INSERT INTO `wn_image` VALUES ('187', 'blog', '', '/upload/image/20170511/1494502188835384.jpg', '1', '202', 'article', '1494502188835384.jpg', '77209', '.jpg', 'IMG_3030.JPG', '0', 'SUCCESS', '2017-05-11 19:29:49', '2017-05-11 19:29:49', null);
INSERT INTO `wn_image` VALUES ('188', 'blog', '', '/upload/image/20170511/1494502188346390.jpg', '1', '202', 'article', '1494502188346390.jpg', '126640', '.jpg', 'IMG_3031.JPG', '0', 'SUCCESS', '2017-05-11 19:29:49', '2017-05-11 19:29:49', null);
INSERT INTO `wn_image` VALUES ('189', 'blog', '', '/upload/image/20170525/1495715744341054.jpg', '1', '205', 'article', '1495715744341054.jpg', '507262', '.jpg', 'IMG_3120.JPG', '0', 'SUCCESS', '2017-05-25 20:35:46', '2017-05-25 20:35:46', null);
INSERT INTO `wn_image` VALUES ('190', 'blog', '', '/upload/image/20170812/1502537873374422.jpg', '1', '229', 'article', '1502537873374422.jpg', '539609', '.jpg', 'IMG_3428.JPG', '0', 'SUCCESS', '2017-08-12 19:37:56', '2017-08-12 19:37:56', null);
INSERT INTO `wn_image` VALUES ('191', '', '', '/upload/image/20170906/1504692672126886.jpg', '1', '0', '', '1504692672126886.jpg', '186277', '.jpg', '307415.jpg', '0', 'SUCCESS', '2017-09-06 18:11:12', '2017-09-06 18:11:12', null);
INSERT INTO `wn_image` VALUES ('192', 'blog', '', '/upload/image/20170914/1505370026869371.jpg', '1', '3', 'article', '1505370026869371.jpg', '28524', '.jpg', '微信公众号二维码.jpg', '0', 'SUCCESS', '2017-09-14 14:20:28', '2017-09-14 14:20:28', null);
INSERT INTO `wn_image` VALUES ('193', 'blog', '', '/upload/image/20170914/1505370941856402.jpg', '1', '235', 'article', '1505370941856402.jpg', '187452', '.jpg', '官网视频上的图片.jpg', '0', 'SUCCESS', '2017-09-14 14:35:42', '2017-09-14 14:35:42', null);
INSERT INTO `wn_image` VALUES ('194', 'blog', '', '/upload/image/20170914/1505371942627294.jpg', '1', '236', 'article', '1505371942627294.jpg', '668341', '.jpg', 'IMG_3592.JPG', '0', 'SUCCESS', '2017-09-14 14:52:39', '2017-09-14 14:52:39', null);
INSERT INTO `wn_image` VALUES ('195', 'blog', '', '/upload/image/20170914/1505372456192044.jpg', '1', '237', 'article', '1505372456192044.jpg', '865691', '.jpg', 'IMG_0588.JPG', '0', 'SUCCESS', '2017-09-14 15:01:25', '2017-09-14 15:01:25', null);

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
-- Records of wn_permission
-- ----------------------------
INSERT INTO `wn_permission` VALUES ('1', 'blog', '博客管理', '0', '0', '2017-01-13 11:42:45', '2017-01-13 15:32:58', null);
INSERT INTO `wn_permission` VALUES ('2', 'blog_article', '文章', '1', '0,1', '2017-01-13 11:43:02', '2017-01-13 16:09:24', null);
INSERT INTO `wn_permission` VALUES ('3', 'blog_category', '栏目', '1', '0,1', '2017-01-13 11:45:17', '2017-01-13 16:09:54', null);
INSERT INTO `wn_permission` VALUES ('4', 'blog_article_add', '新增', '2', '0', '2017-01-13 16:10:19', '2017-01-13 16:10:19', null);
INSERT INTO `wn_permission` VALUES ('5', 'blog_article_edit', '编辑', '2', '0', '2017-01-13 16:10:41', '2017-01-13 16:10:41', null);
INSERT INTO `wn_permission` VALUES ('6', 'blog_article_delete', '删除', '2', '0', '2017-01-13 16:11:07', '2017-01-13 16:11:07', null);
INSERT INTO `wn_permission` VALUES ('7', 'blog_category_add', '新增', '3', '0', '2017-01-13 16:11:35', '2017-01-13 16:11:35', null);
INSERT INTO `wn_permission` VALUES ('8', 'blog_category_edit', '编辑', '3', '0', '2017-01-13 16:11:57', '2017-01-13 16:11:57', null);
INSERT INTO `wn_permission` VALUES ('9', 'blog_category_delete', '删除', '3', '0', '2017-01-13 16:12:17', '2017-01-13 16:12:17', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wn_permission_relate
-- ----------------------------
INSERT INTO `wn_permission_relate` VALUES ('1', '1,2,4,5,6,3,7,8,9', '5', 'role', '2017-01-13 22:01:59', '2017-01-13 22:15:58', null);
INSERT INTO `wn_permission_relate` VALUES ('3', '2,4,5', '2', 'role', '2017-01-13 22:17:06', '2017-01-13 22:17:06', null);
INSERT INTO `wn_permission_relate` VALUES ('4', '1,2,4,5', '1', 'role', '2017-05-04 15:52:24', '2017-05-04 15:52:24', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wn_role
-- ----------------------------
INSERT INTO `wn_role` VALUES ('1', '管理员', '2017-01-10 18:04:22', '2017-01-13 16:57:35');
INSERT INTO `wn_role` VALUES ('2', '站长', '2017-01-10 18:32:14', '2017-01-10 18:32:14');
INSERT INTO `wn_role` VALUES ('8', '会员', '2017-03-28 10:41:31', '2017-03-28 10:41:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wn_role_user
-- ----------------------------
INSERT INTO `wn_role_user` VALUES ('1', '2', '3', '2017-02-02 10:13:36', '2017-03-28 10:41:15', null);
INSERT INTO `wn_role_user` VALUES ('2', '1', '1', '2017-02-02 10:16:36', '2017-02-02 10:16:36', null);
INSERT INTO `wn_role_user` VALUES ('3', '2', '2', '2017-02-02 10:16:46', '2017-02-02 10:16:46', null);
INSERT INTO `wn_role_user` VALUES ('4', '2', '5', '2017-03-28 10:25:25', '2017-03-28 10:25:25', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='购物车';

-- ----------------------------
-- Records of wn_shop_cart
-- ----------------------------
INSERT INTO `wn_shop_cart` VALUES ('34', '3', '花千骨', '1', '3', '3', '', '1', '2017-09-14 15:09:36', '2017-09-14 15:09:41', '2017-09-14 15:09:41');

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
-- Records of wn_shop_order
-- ----------------------------
INSERT INTO `wn_shop_order` VALUES ('15', '1', '韦宁', '352', '', '15001764308', '浦东上南地区', '2017-07-28 10:57:55', '2017-07-28 10:57:55', '2017-07-28 10:57:55');
INSERT INTO `wn_shop_order` VALUES ('16', '1', '韦宁', '352', '', '15001764308', '浦东上南地区', '2017-07-28 18:35:04', '2017-07-28 18:35:04', '2017-07-28 10:57:55');
INSERT INTO `wn_shop_order` VALUES ('17', '1', '韦宁', '352', '', '15001764308', '浦东上南地区', '2017-07-28 18:35:31', '2017-07-28 18:35:31', '0000-00-00 00:00:00');
INSERT INTO `wn_shop_order` VALUES ('18', '1', '韦宁', '352', '', '15001764308', '浦东上南地区', '2017-03-26 18:28:52', '2017-03-26 18:28:52', null);
INSERT INTO `wn_shop_order` VALUES ('19', '1', '韦宁', '352', '', '15001764308', '浦东上南地区', '2017-07-28 18:35:33', '2017-07-28 18:35:33', '2017-07-28 10:57:55');

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
-- Records of wn_shop_order_detail
-- ----------------------------
INSERT INTO `wn_shop_order_detail` VALUES ('17', '18', '2', '16', '2017-03-26 18:28:52', '2017-03-26 18:28:52', null);
INSERT INTO `wn_shop_order_detail` VALUES ('18', '18', '3', '16', '2017-03-26 18:29:07', '2017-07-28 18:48:04', '2017-07-28 18:48:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wn_shop_product
-- ----------------------------
INSERT INTO `wn_shop_product` VALUES ('2', '14', '平凡的一生', '电脑节抢券减200！7代i5搭配GTX1050TI 上万好评品质主机', '1', '<p><img src=\"//img10.360buyimg.com/imgzone/jfs/t4096/271/2560124045/63289/2f6e8dba/58abaeb8N4da82761.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t4054/200/2515985533/69149/ea12d510/58aa8936Nccd9fe62.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3106/294/5570340586/97307/7c57a7c9/5875a7e0N07aefe94.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3745/71/1757944096/111622/496b8806/58316eecNb92ae127.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3133/97/4153625493/53316/3706eafc/58363c7fN70aae313.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3055/202/5575626249/83098/5fee0894/5875a7deN755d2a9b.jpg\" alt=\"\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3202/292/5502194651/68757/4889b7d1/5875a7dfNe3ee9e4c.jpg\" alt=\"\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3133/305/5971296020/19256/65d3b46f/5897d186Nb3fbfc29.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3136/320/6920104514/184815/8e8863e1/58ae3c42N6f1e5ed4.jpg\" alt=\"\"/><a href=\"http://item.jd.com/1699787144.html\" target=\"_blank\"><img src=\"//img10.360buyimg.com/imgzone/jfs/t3982/247/2094532560/138718/8ca71397/58a4025cN5317aa3b.jpg\" alt=\"\"/></a><img src=\"//img10.360buyimg.com/imgzone/jfs/t4015/125/2702239331/111263/b75b3b3a/58ad5840N2f98023a.jpg\" alt=\"\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3904/51/2231230420/174979/fe6edd78/58a53d3bNfd254586.jpg\" alt=\"\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t4009/199/1562131930/175557/adf801c6/587dc5edN9a8d4317.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t4111/324/1517246934/137522/8d854ac0/587ca421N4f6ece63.jpg\" alt=\"\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3835/65/4151058342/64613/5a385356/58aa8948Nbbc93095.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3058/188/6743420504/205462/c742c387/58aa65a9Na9bb0812.jpg\" alt=\"\" width=\"990\" height=\"764\"/><img alt=\"\" src=\"https://img10.360buyimg.com/imgzone/jfs/t3241/67/5508546804/123005/96937e68/58747f7dN8ad4fb5e.jpg\"/><img alt=\"\" src=\"https://img10.360buyimg.com/imgzone/jfs/t3277/150/5570398489/69492/1e6e6e75/58747f7dN8e0369dd.jpg\"/><img alt=\"\" src=\"https://img10.360buyimg.com/imgzone/jfs/t3910/91/1324246751/331178/cbba72f4/58747f7eN83925b29.jpg\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3436/235/1791007451/92058/f6723109/58316668Nff9aad71.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3325/41/1684178221/136944/3e838b4b/58316668N2b2e48ca.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3340/223/2006742262/157737/5a532519/583bbf4bN985157ee.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3088/107/4300944193/104259/df41379/583bbf4bNfac1a83d.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3949/235/190302478/103680/d5fb72fe/5841374cNa7cbc1b6.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3607/177/1968121835/147376/44e2c7ba/583bbf4cN30642bb1.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3946/313/74980484/161675/c43b68b8/583bbf4cNe1e5ea8d.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t4018/56/2446431920/68440/ec80eb60/58aa8a26N275163a5.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3139/26/6701951576/72499/658fcf46/58aa8938N2c7ffb1f.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3169/172/6632912090/173158/1cbd7dcd/58aa47b1N902bd850.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3187/214/6718703839/169628/8f68a1e/58aa47afNfe9ff0ce.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t4117/212/2476372045/82713/747cc317/58aa47b0Naa988fb8.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t2806/22/4079402511/158653/c1725891/57aab9b6Ne63aeac0.gif\" alt=\"\" width=\"990\" height=\"548\"/><img alt=\"\" src=\"//img10.360buyimg.com/imgzone/jfs/t3592/175/2216072057/293707/a392b634/5848bba0N5e9c259d.jpg\" width=\"990\"/><img alt=\"\" src=\"//img10.360buyimg.com/imgzone/jfs/t3967/103/302707228/331316/180af29d/5848b668N368db1cc.jpg\" width=\"990\"/><img alt=\"\" src=\"https://img10.360buyimg.com/imgzone/jfs/t3076/87/4538758597/71506/d279d47b/5848b669N5272ea3b.jpg\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3085/183/1911512391/436775/e7510f81/57d677c5N0c50b663.png\" alt=\"\" width=\"990\" height=\"622\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3244/137/1883646516/450520/2e28cc8f/57d677c6Ndef06f06.png\" alt=\"\" width=\"990\" height=\"796\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3532/241/1762004017/159176/faef519b/583170c4N482b9e62.jpg\" alt=\"\"/><img alt=\"\" src=\"https://img10.360buyimg.com/imgzone/jfs/t3979/243/1408948603/100788/92838345/5875aaa8N68d6147b.jpg\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3136/347/1251813762/73089/755b90dd/57c8e2a2N0a51b84f.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3169/87/4529278353/110083/ba929dd6/5848c268N24e65c8a.jpg\" alt=\"\" id=\"f0844eef1a214cf583b61ff3643ef31b\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3829/119/1512184402/114229/f8fa3fff/58316666N5b00f041.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3277/321/6637197107/59133/d52c41ca/58aa65acN9d36f866.jpg\" alt=\"\"/><img alt=\"\" src=\"//img10.360buyimg.com/imgzone/jfs/t3238/94/6679147490/64715/9aa836d3/58aa8939Nccf8522d.jpg\" width=\"990\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3043/214/1686783585/83263/3a249ff5/57c8e2a3Nfcab576a.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t4027/133/3189415/164734/6adf99d2/58abe7a4N69762e9b.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3250/280/5276052029/471277/a26e960d/5869be66N736e4725.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3970/78/1065549621/704393/4f3680fd/5869be67Nfb6a1c8f.jpg\" alt=\"\"/><img src=\"//img10.360buyimg.com/imgzone/jfs/t3937/110/1080482838/387880/5a52cd33/5869be69Na340e320.jpg\" alt=\"\"/></p>', '2017-04-10 13:49:42', '2017-04-10 13:49:42', '2017-04-10 13:49:42');
INSERT INTO `wn_shop_product` VALUES ('3', '14', '花千骨', '白子画与花千骨', '1', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;白子画与花千骨\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '2017-04-10 13:49:52', '2017-04-10 13:49:52', '2017-04-10 13:49:52');
INSERT INTO `wn_shop_product` VALUES ('5', '14', '曾经苍海难为水', '曾经苍海难为水，除去巫山不是云', '1', null, '2017-04-10 13:54:04', '2017-04-10 13:54:04', null);
INSERT INTO `wn_shop_product` VALUES ('6', '14', 'test2', '222', '12', null, '2017-05-02 14:08:11', '2017-05-02 14:08:11', '2017-05-02 14:08:11');
INSERT INTO `wn_shop_product` VALUES ('7', '14', '美的热水器2', '12', '12', '<p>test2</p>', '2017-05-10 13:59:38', '2017-05-10 13:59:38', '2017-05-10 13:59:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of wn_user
-- ----------------------------
INSERT INTO `wn_user` VALUES ('1', 'admin', '$2y$10$bRCnQP1QmlARzf201gEEhOvytCN4ZPPjWON8V.dvRQb7dHhezGBwq', '', '', 'Y99cvCttUnyMJ0yGsMcLtAmWhn3yZ1EhxXpUSTfsUHTrho5HIdeObomSnwcq', '2016-12-22 12:00:06', '2017-03-02 16:34:49', '2017-09-14 15:07:19');
INSERT INTO `wn_user` VALUES ('3', 'wn', '$2y$10$cR7C9TvnR6CaoCUIA7KPRu4sbHM8.hE4kazuCgxBp4ccNk2g2Fu9y', '', '', 'ET89LjNnAMxf8q4BF4SI7qRFMeza9Q5kYC9HTzaPYFBz6MACEIN0kZGaXEtr', '2016-12-26 07:42:35', '2017-02-02 10:19:45', '2017-03-28 22:26:00');
