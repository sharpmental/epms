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
  `operator_role` int(10) not null, 
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
	(1, 'admin',  '0002', 1, '超级管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:29:35'),
	(2, 'projadmin',  '0002', 2, '项目管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(3, 'marketadmin',  '0002', 3, '业务员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(4, 'useradmin',  '0002', 4, '客户管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(5, 'user',  '0002', 5, '客户', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(6, 'guest',  '0002', 6, '访客', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28'),
	(9, 'sysadmin',  '9999', 1, '超级管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:31:11');

UNLOCK TABLES ;

# Dump of table tb_member_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_member_role`;

CREATE TABLE `tb_member_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '组ID',
  `role_name` varchar(45) NOT NULL DEFAULT '' COMMENT '组名',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '保留',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  `xurl` varchar(20) NOT NULL COMMENT '访问路径',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

LOCK TABLES `tb_member_role` WRITE;
/*!40000 ALTER TABLE `tb_member_role` DISABLE KEYS */;

INSERT INTO `tb_member_role` 
VALUES
	(1,'超级管理员',1,'超级管理员','adminpanel'),
	(2,'项目管理员',2,'项目管理员','projectadmin'),
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
  `is_display` tinyint(1) NOT NULL DEFAULT '1',
  `controller` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `flag_id` varchar(50) NOT NULL DEFAULT '0',
  `css_icon` varchar(50) DEFAULT NULL,
  `priv` smallint DEFAULT 0,  /* priv >= role_id = OK */
  PRIMARY KEY (`menu_id`) USING BTREE,
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tb_module_menu` DISABLE KEYS */;

INSERT INTO `tb_module_menu` 
VALUES
	(1,'首页',0,1,'manage','index','0','home','10'),
	(2,'公司项目',0,1,'manage','go_2','0','suitcase','10'),
	(3,'报警管理',0,1,'manage','go_3','0','warning','0'),
	(4,'用户管理',0,1,'manage','go_4','0','user','0'),
	(5,'服务器管理',0,1,'manage','go_5','0','server','0'),
	(6,'其他',0,1,'manage','go_6','0','user','10'),

	(20,'查询项目',2,1,'project','index','0','user','0'),

	(201,'工程概况',20,1,'project','general_info','0','user','0'),
	(202,'边坡概况',20,1,'project','slop_info','0','user','0'),
	(203,'建设情况',20,1,'project','construct_info','0','server','0'),
	(204,'仪器数据',20,1,'project','device_info','0','user-times','0'),
	(205,'预警报告',20,1,'project','alarm','0','map-marker','0'),

	(1001,'检测数据和图表',204,1,'project','data_display','0','gears','0'),

	(30,'项目管理',2,1,'project','list_project','0','photo','0'),

	(301,'项目增加',30,1,'project','add_project','0','user','0'),
	(302,'项目修改',30,1,'project','modify_project','0','user','0'),
	(303,'项目删除',30,1,'project','delete_project','0','user','0'),

	(40,'用户列表',4,1,'user','index','0','user','0'),
	(401,'添加用户',40,1,'user','add','0','user','0'),
	(402,'修改用户',40,1,'user','edit','0','user','0'),
	(403,'删除用户',40,1,'user','delete','0','user','0'),

	(50,'报警模型列表',3,1,'alarm','index','0','user','0'),
	(501,'添加模型',50,1,'alarm','add','0','user','0'),
	(502,'修改模型',50,1,'alarm','modify','0','user','0'),
	(503,'删除模型',50,1,'alarm','delete','0','user','0'),

	(60,'服务器信息',5,1,'server_info','index','0','user','0'),
	(61,'登录信息',5,1,'logging_info','index','0','user','0')
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

-- --------------------------------------------------------

--
-- 表的结构 `tb_server_info`
--
drop table if exists `tb_server_info`;

create table `tb_server_info` (
  `server_id` int(11) not null,
  `server_type` tinyint(4) not null,
  `server_name` varchar(64) not null,
  `server_ip` varchar(64) not null,
  `powerlow_times` int(11) not null default '2',
  `update_timestamp` datetime not null default current_timestamp on update current_timestamp
) engine=myisam default charset=utf8;
