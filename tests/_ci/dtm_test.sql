# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: coding.ecs.lmx0536.cn (MySQL 5.5.56-MariaDB)
# Database: dtm
# Generation Time: 2018-03-02 03:23:38 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '组名',
  `is_deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX_USER_ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='任务组';

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;

INSERT INTO `group` (`id`, `user_id`, `name`, `is_deleted`, `created_at`, `updated_at`)
VALUES
	(1,1,'年后第一周',0,'2018-02-25 15:00:23','2018-02-25 15:56:38'),
	(2,1,'年后第二周',0,'2018-02-25 16:01:45','2018-02-28 14:49:58');

/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table task
# ------------------------------------------------------------

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) unsigned NOT NULL COMMENT '组ID',
  `detail` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '任务详情',
  `begin_at` datetime DEFAULT NULL COMMENT '任务开始时间',
  `end_at` datetime DEFAULT NULL COMMENT '任务结束时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '任务状态 0未开始1进行中2延期...10已完成',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX_GROUP_ID_STATUS` (`group_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='任务详情';

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;

INSERT INTO `task` (`id`, `group_id`, `detail`, `begin_at`, `end_at`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'App服务优化方案','2018-02-22 15:01:32','2018-02-25 15:48:55',10,'2018-02-25 15:01:32','2018-02-25 15:48:55'),
	(2,1,'门店微服务分页查询','2018-02-22 15:01:41','2018-02-22 15:01:41',10,'2018-02-25 15:01:41','2018-02-25 15:01:41'),
	(3,1,'PHP公用Api，增加门店分页查询接口','2018-02-22 15:05:08','2018-02-22 15:01:41',10,'2018-02-25 15:05:08','2018-02-25 15:05:08'),
	(4,1,'微信支付宝小程序优化方案','2018-02-23 15:05:31','2018-02-23 15:05:31',10,'2018-02-25 15:05:31','2018-02-25 15:05:31'),
	(5,1,'POI模块 Adm门店列表首页','2018-02-23 15:06:35','2018-02-23 15:05:31',10,'2018-02-25 15:06:35','2018-02-25 15:06:35'),
	(6,1,'新增根据Wifi名删除Wifi接口','2018-02-24 15:07:03','2018-02-24 15:07:03',10,'2018-02-25 15:07:03','2018-02-25 15:07:03'),
	(7,1,'新增PHP根据Wifi名删除Wifi接口调用方法','2018-02-24 15:07:43','2018-02-24 15:07:03',10,'2018-02-25 15:07:43','2018-02-25 15:07:43'),
	(8,1,'优化POI服务WIFI模块部分SQL','2018-02-24 15:50:19','2018-02-25 15:56:38',10,'2018-02-25 15:50:19','2018-02-25 15:56:38'),
	(9,2,'确定php web server优化架构','2018-02-25 19:45:06',NULL,0,'2018-02-25 19:45:06','2018-02-25 19:45:06'),
	(10,2,'后端调用接口 商户门店列表','2018-02-26 10:51:10','2018-02-26 10:51:12',10,'2018-02-25 19:46:04','2018-02-26 10:51:12'),
	(11,2,'后端调用接口 批量返回门店列表','2018-02-26 11:39:09','2018-02-26 11:39:11',10,'2018-02-25 19:46:31','2018-02-26 11:39:11'),
	(12,2,'后端调用接口 运维端门店列表','2018-02-26 12:07:15','2018-02-26 12:07:16',10,'2018-02-25 19:47:23','2018-02-26 12:07:16'),
	(13,2,'ADM 用户反馈','2018-02-26 12:09:22','2018-02-26 12:18:30',10,'2018-02-25 19:47:45','2018-02-26 12:18:30'),
	(14,2,'ADM 编辑门店','2018-02-26 10:00:59','2018-02-26 10:09:54',10,'2018-02-26 10:00:57','2018-02-26 10:09:54'),
	(15,2,'ADM 编辑门店保存','2018-02-26 10:10:12','2018-02-26 10:15:25',10,'2018-02-26 10:10:08','2018-02-26 10:15:25'),
	(16,2,'ADM 修改门店密码','2018-02-26 10:16:16','2018-02-26 10:19:37',10,'2018-02-26 10:16:13','2018-02-26 10:19:37'),
	(17,2,'门店微服务改造 ADM运维人员增加门店门店选择','2018-02-27 13:37:37','2018-02-27 13:37:39',10,'2018-02-27 13:37:35','2018-02-27 13:37:39'),
	(18,2,'门店微服务 ADM运维人员门店列表','2018-02-27 13:39:18','2018-02-27 14:16:21',10,'2018-02-27 13:39:15','2018-02-27 14:16:21'),
	(19,2,'门店微服务 ADM设备绑定门店','2018-02-27 14:26:51','2018-02-27 14:26:53',10,'2018-02-27 14:26:48','2018-02-27 14:26:53'),
	(20,2,'门店微服务 ADM柜机绑定','2018-02-27 14:28:43','2018-02-27 14:28:44',10,'2018-02-27 14:28:40','2018-02-27 14:28:44'),
	(21,2,'门店微服务 商户端门店更新','2018-02-27 14:36:02','2018-02-27 14:36:04',10,'2018-02-27 14:35:58','2018-02-27 14:36:04'),
	(22,2,'门店微服务 ADM 门店删除改为逻辑删','2018-02-27 15:01:52','2018-02-27 15:06:09',10,'2018-02-27 15:01:52','2018-02-27 15:06:09'),
	(23,2,'增加门店微服务删除门店接口','2018-02-27 15:06:05','2018-02-27 15:06:07',10,'2018-02-27 15:06:02','2018-02-27 15:06:07'),
	(24,2,'修复Wifi模块空指针Bug','2018-02-27 15:06:29','2018-02-27 15:06:32',10,'2018-02-27 15:06:29','2018-02-27 15:06:32'),
	(25,2,'ADM 新增设备','2018-02-27 15:09:32','2018-02-27 15:09:35',10,'2018-02-27 15:09:32','2018-02-27 15:09:35'),
	(26,2,'ADM 疑似丢失','2018-02-28 14:39:00','2018-02-28 14:39:02',10,'2018-02-28 14:38:57','2018-02-28 14:39:02'),
	(27,2,'ADM 绑定设备','2018-02-28 14:41:40','2018-02-28 14:41:43',10,'2018-02-28 14:41:40','2018-02-28 14:41:43'),
	(28,2,'ADM 解绑设备','2018-02-28 14:44:13','2018-02-28 14:49:56',10,'2018-02-28 14:44:13','2018-02-28 14:49:56'),
	(29,2,'ADM新增门店','2018-02-28 14:46:41','2018-02-28 14:49:58',10,'2018-02-28 14:46:41','2018-02-28 14:49:58'),
	(30,2,'门店微服务 门店关系导入','2018-03-01 14:43:41',NULL,0,'2018-03-01 14:43:41','2018-03-01 14:43:41');

/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '昵称',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `UNIQUE_LOGIN` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `login`, `password`, `nickname`, `created_at`, `updated_at`)
VALUES
	(1,'limx','$2y$10$cDfVNrBbqlFkPXCI7grbnOZWoS7br3d7IX6pKB7LuYWIZOW75zwKm','李铭昕','2018-02-25 14:59:40','2018-02-28 14:49:58'),
	(2,'l462441355','$2y$10$ykxU4FsUJtdTjJbFzncJr.QHEDzVq7sMLmg4FoB/Z4Q/jjRr8/fTK','小林','2018-02-25 19:52:05','2018-02-25 19:52:05');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_oauth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_oauth`;

CREATE TABLE `user_oauth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'OPENID',
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT '用户ID',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_OPENID` (`openid`),
  KEY `INDEX_USER_ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_oauth` WRITE;
/*!40000 ALTER TABLE `user_oauth` DISABLE KEYS */;

INSERT INTO `user_oauth` (`id`, `openid`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,'oB0Ua0Zv1LGssjsoeblaXVN8Hh4Q',1,'2018-02-26 15:49:25','2018-02-26 15:49:25');

/*!40000 ALTER TABLE `user_oauth` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
