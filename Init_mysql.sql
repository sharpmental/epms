# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.33)
# Database: epms
# Generation Time: 2016-3-18 02:25:59 +0000
# ************************************************************

use epms;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- --------------------------------------------------------
-- 
-- 表的结构 `tb_operator_info`
-- 

drop table if exists `tb_operator_info`;

create table `tb_operator_info` (
  `operator_id` int(11) not null auto_increment, 
  `operator_name` varchar(64) not null, 
  `operator_pwd` varchar(64) not null, 
  `operator_role` varchar(16) not null, 
  `operator_displayname` varchar(64) not null,
  `reg_ip` varchar(64),  
  #注册时使用的IP地址
  `reg_time` datetime not null, 
  #注册时间
  `encrypt` varchar(64), 
  #加密 现在不使用
  `last_login_ip` varchar(64), 
  #最近一次登录使用的ip地址
  `last_login_time` datetime default null, 
  #最近一次登录的时间
  `update_timestamp` datetime not null, 
  #最近一次修改的时间
  primary key  (`operator_id`)
) engine=myisam default charset=utf8 comment='操作人员信息表';

-- 
-- 导出表中的数据 `tb_operator_info`
-- 
LOCK TABLES `tb_operator_info` WRITE;

insert into `tb_operator_info` values 
	(1, 'admin',  '0002', '1', '超级管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:29:35'),
	(2, 'projadmin',  '0002', '2', '项目管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(3, 'marketadmin',  '0002', '3', '业务员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(4, 'useradmin',  '0002', '4', '客户管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(5, 'useradmin',  '0002', '5', '客户', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(6, 'useradmin',  '0002', '6', '访客', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(9, 'sysadmin',  '9999', '1', '超级管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:31:11');

UNLOCK TABLES ;

# Dump of table tb_member_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_member_role`;

CREATE TABLE `tb_member_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '组ID',
  `role_name` varchar(45) NOT NULL DEFAULT '' COMMENT '组名',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '保留',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  `url` varchar(20) NOT NULL COMMENT '访问路径',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

LOCK TABLES `tb_member_role` WRITE;
/*!40000 ALTER TABLE `tb_member_role` DISABLE KEYS */;

INSERT INTO `tb_member_role` (`role_id`, `role_name`, `type_id`, `description`, `url`)
VALUES
	(1,'超级管理员',1,'超级管理员','adminpanel'),
	(2,'项目管理员',2,'项目管理员','projadmin'),
	(3,'业务员',3,'业务员','marketadmin'),
	(4,'客户管理员',4,'客户管理员','useradmin'),
	(5,'客户',5,'客户','user'),
	(6,'访客',6,'访客','guest');

/*!40000 ALTER TABLE `tb_member_role` ENABLE KEYS */;
UNLOCK TABLES;

# Dump of table tb_module_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_module_menu`;

CREATE TABLE `tb_module_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` char(40) NOT NULL DEFAULT '',
  `parent_id` smallint(6) NOT NULL DEFAULT '0',
  `list_order` smallint(6) unsigned NOT NULL DEFAULT '0',
  `is_display` tinyint(1) NOT NULL DEFAULT '1',
  `controller` varchar(50) DEFAULT NULL,
  `folder` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `flag_id` varchar(50) NOT NULL DEFAULT '0',
  `is_side_menu` tinyint(1) DEFAULT '0',
  `is_system` tinyint(1) DEFAULT '0',
  `is_works` tinyint(1) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `css_icon` varchar(50) DEFAULT NULL,
  `arr_parentid` varchar(250) DEFAULT NULL,
  `arr_childid` varchar(250) DEFAULT NULL,
  `is_parent` tinyint(1) DEFAULT '0',
  `show_where` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`menu_id`) USING BTREE,
  KEY `list_order` (`list_order`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tb_module_menu` DISABLE KEYS */;

INSERT INTO `tb_module_menu` (`menu_id`, `menu_name`, `parent_id`, `list_order`, `is_display`, `controller`, `folder`, `method`, `flag_id`, `is_side_menu`, `is_system`, `is_works`, `user_id`, `css_icon`, `arr_parentid`, `arr_childid`, `is_parent`, `show_where`)
VALUES
	(1,'首页',0,1,1,'manage','adminpanel','index','0',1,0,1,1,'home','0','1,5,40,41,6,7,8',1,1),
	(2,'用户设置',0,2,1,'manage','adminpanel','go_2','0',1,0,1,1,'user','0','2,9,16,31,32,33,34,35,36,37,26,27,28,29,30',1,1),
	(3,'设备信息',0,3,1,'manage','adminpanel','go_3','0',1,0,1,1,'suitcase','0','3',1,1),
	(4,'报警信息',0,4,1,'manage','adminpanel','go_4','0',1,0,1,1,'warning','0','4,15,38',1,1),
	(5,'管理员',1,5,1,'manage','adminpanel','go_5','0',1,0,1,1,'','0,1','5,40,41,6,7,8',1,1),
	(6,'控制面板',5,6,1,'manage','adminpanel','controlpanel','0',1,0,1,1,'','0,1,5','6',0,1),
	(7,'修改密码',5,7,1,'profile','adminpanel','change_pwd','0',1,0,1,1,'','0,1,5','7',0,1),
	(8,'注销',5,8,1,'manage','adminpanel','logout','0',1,0,1,1,'','0,1,5','8',0,1),
	(9,'网页用户设置',2,9,1,'manage','adminpanel','go_9','0',1,0,1,1,'','0,2','9,26,31,32,33,34,35,36,37',1,1),
	(10,'服务器管理',0,10,1,'manage','adminpanel','go_10','0',1,0,1,1,'server','0','10,51,49,50',1,1),
	(11,'人员信息',0,11,1,'manage','adminpanel','go_11','0',1,0,1,1,'user-times','0','11',1,1),
	(12,'区域信息',0,12,1,'manage','adminpanel','go_12','0',1,0,1,1,'map-marker','0','12',1,1),
	(13,'其他功能',0,13,1,'manage','adminpanel','go_13','0',1,0,1,1,'gears','0','13',1,1),
	(14,'监狱地图',0,14,1,'manage','adminpanel','go_14','0',1,0,1,1,'photo','0','14',1,1),
	(16,'栏目列表',0,16,0,'moduleMenu','adminpanel','index','0',1,0,1,1,'','0','16,17,18,19,20',1,1),
	(17,'数据表',3,17,1,'edittable','adminpanel','index/0','0',1,0,1,1,'','0,3','',1,1),
	(18,'数据表',4,18,1,'edittable','adminpanel','index/1','0',1,0,1,1,'','0,4','',1,1),
	(19,'数据表',11,19,1,'edittable','adminpanel','index/3','0',1,0,1,1,'','0,11','',1,1),
	(20,'数据表',12,20,1,'edittable','adminpanel','index/4','0',1,0,1,1,'','0,12','',1,1),
	(26,'用户组列表',9,26,1,'role','adminpanel','index','0',1,0,1,1,'','0,2,9','26,27,28,29,30',1,1),
	(27,'新增',26,27,1,'role','adminpanel','add','0',1,0,1,1,'','0,2,9,26','27',0,1),
	(28,'编辑',26,28,1,'role','adminpanel','edit','0',1,0,1,1,'','0,2,9,26','28',0,1),
	(29,'删除',26,29,1,'role','adminpanel','delete_one','0',1,0,1,1,'','0,2,9,26','29',0,1),
	(30,'设置权限',26,30,1,'role','adminpanel','setting','0',1,0,1,1,'','0,2,9,26','30',0,1),
	(31,'用户列表',9,31,1,'user','adminpanel','index','0',1,0,1,1,'','0,2,9','31,32,33,34,35,36,37',1,1),
	(32,'新增',31,32,1,'user','adminpanel','add','0',1,0,1,1,'','0,2,9,31','32',0,1),
	(33,'编辑',31,33,1,'user','adminpanel','edit','0',1,0,1,1,'','0,2,9,31','33',0,1),
	(34,'检测用户名',31,34,1,'user','adminpanel','check_username','0',1,0,1,1,'','0,2,9,31','34',0,1),
	(35,'删除',31,35,1,'user','adminpanel','delete','0',1,0,1,1,'','0,2,9,31','35',0,1),
	(36,'锁定/解锁',31,36,1,'user','adminpanel','lock','0',1,0,1,1,'','0,2,9,31','36',0,1),
	(37,'上传头像',31,37,1,'user','adminpanel','upload','0',1,0,1,1,'','0,2,9,31','37',0,1),
	(38,'其他功能',13,38,1,'manage','adminpanel','go_38','0',1,0,1,1,'','0,13','38',0,1),
	(40,'全局缓存',5,40,1,'manage','adminpanel','cache','0',1,0,1,1,'','0,1,5','40',0,1),
	(41,'详细信息', 4, 41, 0, 'manage', 'adminpanel', 'detailinfo', '0', 1, 0, 1, 1, '', '0,4,41', '41', 0, 1),
	(42,'外出', 4, 42, 0, 'manage', 'adminpanel', 'leave', '0', 1, 0, 1, 1, '', '0,4,42', '42', 0, 1),
	(43,'轨迹', 4, 43, 0, 'manage', 'adminpanel', 'trace', '0', 1, 0, 1, 1, '', '0,4,43', '43', 0, 1),
	(44,'显示数据表', 19, 44, 0, 'edittable', 'adminpanel', 'viewtable', '0', 1, 0, 1, 1, '', '0,4,19', '44', 0, 1),
	(45,'添加People_info', 19, 45, 0, 'people_info', 'adminpanel', 'add', '0', 1, 0, 1, 1, '', '0,4,19', '45', 0, 1),
	(46,'修改People_info', 19, 46, 0, 'people_info', 'adminpanel', 'modify', '0', 1, 0, 1, 1, '', '0,4,19', '46', 0, 1),
	(47,'添加People_detail', 19, 47, 0, 'people_detail', 'adminpanel', 'add', '0', 1, 0, 1, 1, '', '0,4,19', '47', 0, 1),
	(48,'修改People_detail', 19, 48, 0, 'people_detail', 'adminpanel', 'modify', '0', 1, 0, 1, 1, '', '0,4,19', '48', 0, 1),
	(49,'服务器相关设置', 10, 49, 1, 'manage', 'adminpanel', 'go_49', '0', 1, 0, 1, 1, '', '0,10', '50,51', 0, 1),
	(50,'服务器设置', 49, 50, 1, 'server_info', 'adminpanel', 'index', '0', 1, 0, 1, 1, '', '0,10,49', '50', 0, 1),
	(51,'日志', 49, 51, 1, 'logging_info', 'adminpanel', 'index', '0', 1, 0, 1, 1, '', '0,10,49', '51', 1, 1),
	(52,'主地图',14,52,1,'showmap','adminpanel','index','0',1,0,1,1,'','0,14','52',0,1),
	(53,'出入记录查询',38,53,1,'people_inout','adminpanel','index','0',1,0,1,1,'','0,13,38','53',0,1),
	(54,'登录记录查询',49,54,1,'Logging_info','adminpanel','search','0',1,0,1,1,'','0,10,49','54',0,1)
	;

/*!40000 ALTER TABLE `tb_module_menu` ENABLE KEYS */;

# Dump of table tb_sessions
# ------------------------------------------------------------
#保存用户会话

DROP TABLE IF EXISTS `tb_sessions`;

CREATE TABLE `tb_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) default '' NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dump of table tb_times
# ------------------------------------------------------------
# 保存用户密码尝试次数

DROP TABLE IF EXISTS `tb_times`;

CREATE TABLE `tb_times` (
  `times_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `login_ip` char(15) DEFAULT NULL COMMENT 'ip',
  `login_time` int(10) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `failure_times` int(10) unsigned DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`times_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- 表的结构 `tb_logging`
-- 
#需要记录哪些操作？

drop table if exists `tb_logging`;

create table `tb_logging` (
  `log_id` int(11) not null auto_increment,
  #日志编号
  `operator_id` int(11) not null,
  #操作员编号
  `name` varchar(64) default null,
  #操作员名称
  `user` varchar(64) default null,
  #操作员名称
  `action` varchar(64) default null,
  #动作
  `content` varchar(100) default null,
  #内容
  `ip` varchar(20) not null,
  #IP地址
  `login_time` datetime default null,
  #登录时间
  `logout_time` datetime default null,
  #登出时间
  `update_timestamp` datetime default null,
  #更新时间
  primary key (`log_id`)
) engine=myisam default charset=utf8 comment='登录记录表';

-- 
-- 导出表中的数据 `tb_logging`
-- 

insert into `tb_logging` values (1, 1, '所长', '0001', '登录', '登录成功', '127.0.0.1', '2014-10-22 11:24:21', null, null);
insert into `tb_logging` values (2, 2, '民警', '0002', '增加', '添加帐号流水为466', '192.168.1.125', '2014-10-27 09:30:19', null, null);