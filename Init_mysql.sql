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
  `operator_name` varchar(64) not null,  /* 用户名称 */
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
  `company` varchar(32) default '',
  `address` varchar(64) default '',
  `phone` varchar(32) default '',
  `email` varchar(64) default '',
  primary key  (`operator_id`)
) engine=myisam default charset=utf8 comment='操作人员信息表';

-- 
-- 导出表中的数据 `tb_operator_info`
-- 
LOCK TABLES `tb_operator_info` WRITE;

insert into `tb_operator_info` values 
	(1, 'admin',  '0002', 1, '超级管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:29:35', '', '', '', ''),
	(2, 'projadmin',  '0002', 2, '项目管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(3, 'marketadmin',  '0002', 3, '业务员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(4, 'useradmin',  '0002', 4, '客户管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(5, 'user',  '0002', 5, '客户', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(6, 'guest',  '0002', 6, '访客', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(9, 'sysadmin',  '9999', 1, '超级管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:31:11', '', '', '', '');

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
	(2,'项目-边坡管理',0,1,'project','index','0','globe','10'),
	(3,'项目管理',0,1,'manage','go_3','0','photo','0'),
	(4,'报警管理',0,1,'manage','go_4','0','warning','0'),
	(5,'用户管理',0,1,'manage','go_5','0','user','0'),
	(6,'服务器管理',0,1,'manage','go_6','0','server','0'),
	(7,'客户支持',0,1,'customer','index','0','suitcase','0'),
	(8,'其他',0,0,'manage','go_8','0','user','10'),

	(101,'项目概况',2,1,'project','general_info','0','user','0'),
	(103,'边坡概况',2,1,'project','slop_info','0','user','0'),
	(102,'建设情况',2,1,'project','construct_info','0','map-marker','0'),
	(104,'仪器数据',2,1,'project','device_info','0','map-marker','0'),
	(105,'预警报告',2,1,'project','alarm','0','map-marker','0'),
	(106,'边坡总介绍',2,0,'project','slop_general','0','user','0'),

	(1001,'检测数据和图表',104,1,'project','data_display','0','gears','0'),
	
	(30,'项目列表',3,1,'project','list_project','0','photo','0'),
	(130,'项目增加',30,1,'project','add_project','0','user','0'),
	(131,'项目修改',30,0,'project','modify_project','0','user','0'),
	(132,'项目删除',30,0,'project','delete_project','0','user','0'),
	
	(33,'边坡列表',3,1,'slop','index','0','bars','0'),
	(133,'边坡增加',33,1,'slop','add_slop','0','bars','0'),
	(134,'边坡修改',33,0,'slop','modify_slop','0','bars','0'),
	(135,'边坡删除',33,0,'slop','delete_slop','0','bars','0'),

	(36,'设备列表',3,1,'device','index','0','cog','0'),
	(136,'设备增加',36,1,'device','add','0','cog','0'),
	(137,'设备修改',36,0,'device','modify','0','cog','0'),
	(138,'设备删除',36,0,'device','delete','0','cog','0'),

	(40,'用户列表',5,1,'user','index','0','user','0'),
	(401,'添加用户',40,1,'user','add','0','user','0'),
	(402,'修改用户',40,0,'user','edit','0','user','0'),
	(403,'删除用户',40,0,'user','delete','0','user','0'),
	(404,'项目关联',40,1,'project_user','index','0','heart','0'),
	(405,'修改关联',40,0,'project_user','update','0','wrench','0'),
    
	(50,'报警模型列表',4,1,'alarm','index','0','user','0'),
	(501,'添加模型',50,1,'alarm','add','0','user','0'),
	(502,'修改模型',50,0,'alarm','modify','0','user','0'),
	(503,'删除模型',50,0,'alarm','delete','0','user','0'),

	(60,'服务器信息',6,1,'server_info','index','0','user','0'),
	(61,'登录信息',6,1,'logging_info','index','0','user','0')
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
  `update_timestamp` datetime not null default current_timestamp on update current_timestamp,
  #更新时间
  primary key (`log_id`)
) engine=myisam default charset=utf8 comment='登录记录表';

-- 
-- 导出表中的数据 `tb_logging`
-- 

insert into `tb_logging` values (1, 1, '所长', '0001', '登录', '登录成功', '127.0.0.1', '2014-10-22 11:24:21', null, '2011-01-01');
insert into `tb_logging` values (2, 2, '民警', '0002', '增加', '添加帐号流水为466', '192.168.1.125', '2014-10-27 09:30:19', null, '2011-01-01');

-- --------------------------------------------------------

--
-- 表的结构 `tb_server_info`
--
drop table if exists `tb_server_info`;

create table `tb_server_info` (
  `server_id` int(11) not null AUTO_INCREMENT,
  `server_type` tinyint(4) not null,
  `server_name` varchar(64) not null,
  `server_ip` varchar(64) not null,
  `powerlow_times` int(11) not null default '2',
  `update_timestamp` datetime not null default current_timestamp on update current_timestamp,
  primary key (`server_id`)
) engine=myisam default charset=utf8;

insert into `tb_server_info` values(1, 1, 'server A', '192.168.0.1', 0, '2000-01-01');
insert into `tb_server_info` values(2, 1, 'server B', '192.168.0.2', 0, '2000-01-01');
-- --------------------------------------------------------

--
-- 表的结构 `tb_project_info`
--

drop table if exists `tb_project_info`;

create table`tb_project_info`(
	`project_id` int(11) not null AUTO_INCREMENT, /* 项目编号*/
	`project_name` varchar(64) not null, /* 项目名称*/
	`project_description` varchar(128) not null, /* 项目描述 =projinfo */
	`start_time` datetime default null, /* 起始时间*/
	`position_char` varchar(128) default null, /* 位置信息 = roadname*/
	`picture_path` varchar(128) default null, /* 项目图片= projpic */
	`construction_char` varchar(128) default null, /* 建设信息*/
	`construction_picture_path` varchar(256) default null, /* 建设图片 = const pic*/
	`general_slop` varchar(128) default null, /* 边坡概况*/
	`type` int  not null default 100, /* 项目类型 */
	`customer_id` int not null default 0, /* 客户编号 */ 
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp, /*更新时间*/
	primary key (`project_id`)
)engine=myisam default charset=utf8;

insert into `tb_project_info` values (1, 'project A', 'AAA', '2011-01-01', 'Road A, street A, room A', '/upload/project_info/1/pic.jpg', 'building...', '/upload/project_info/1/const_pic.jpg', 'Slop General information', 10, 0, '2011-01-01');
insert into `tb_project_info` values (2, 'project B', 'BBB', '2011-01-02', 'Road B, street B, room B', '/upload/project_info/2/pic.jpg', 'building...', '/upload/project_info/2/const_pic.jpg', 'Slop General information1', 10, 0, '2011-01-02');
insert into `tb_project_info` values (3, 'project C', 'BBB', '2011-01-02', 'Road C, street B, room B', '/upload/project_info/3/pic.jpg', 'building...', '/upload/project_info/3/const_pic.jpg', 'Slop General information', 10, 0, '2011-01-02');
insert into `tb_project_info` values (4, 'project D', 'BBB', '2011-01-02', 'Road D, street B, room B', '/upload/project_info/4/pic.jpg', 'building...', '/upload/project_info/4/const_pic.jpg', 'Slop General information', 10, 0, '2011-01-02');
insert into `tb_project_info` values (5, 'project E', 'BBB', '2011-01-02', 'Road E, street B, room B', '/upload/project_info/5/pic.jpg', 'building...', '/upload/project_info/5/const_pic.jpg', 'Slop General information', 10, 0, '2011-01-02');
insert into `tb_project_info` values (6, 'project F', 'BBB', '2011-01-02', 'Road F, street B, room B', '/upload/project_info/6/pic.jpg', 'building...', '/upload/project_info/6/const_pic.jpg', 'Slop General information', 10, 0, '2011-01-02');

drop table if exists `tb_project_type`;

create table `tb_project_type` (
	`type_id` int not null AUTO_INCREMENT,
	`type_name` varchar(64) not null default 'type',
	`flag` int not null default 0,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp, /*更新时间*/
	primary key (`type_id`)
)engine=myisam default charset=utf8;


insert into `tb_project_type` values (1,  'Class A', 0, '2011-01-01');
insert into `tb_project_type` values (2,  'Class B', 0, '2011-01-01');
insert into `tb_project_type` values (3,  'Class C', 0, '2011-01-01');
insert into `tb_project_type` values (4,  'Class D', 0, '2011-01-01');
insert into `tb_project_type` values (5,  '客户项目', 0, '2011-01-01');
insert into `tb_project_type` values (6,  '演示项目', 0, '2011-01-01');

-- --------------------------------------------------------

--
-- 表的结构 `tb_slop_info`
--

drop table if exists `tb_slop_info`;

create table`tb_slop_info`(
	`slop_id` int(11) not null AUTO_INCREMENT,
	`slop_name` varchar(64) not null, /* 边坡名称 */
	`slop_description` varchar(128) default null, /* 边坡描述 */
	`start_time` datetime default null, /* 起始时间 */
	`position_char` varchar(128) default null, /* 位置描述 */
	`position_x` varchar(16) default 0, /* 地图X坐标值 */
	`position_y` varchar(16) default 0, /* 地图Y坐标值 */

	`alarm_model` int(16) default 0, /* 报警模型 */
	`slop_type` int(16) default 0, /*  边坡类型 */
	`env_id` int(16) default 0, /* 环境属性 */
	`disease_id` int(16) default 0, /* 疾病属性 */
	`sub_road_name` int(16) default 0, /* 所属路段 */
	`stake_bg` int default 0, /* 起始桩号*/
	`stake_end` int default 0, /* 终止桩号*/

	`longtitude` varchar(64),  /* 纬度*/
	`latitude` varchar(64), /* 经度*/
	`altitude` varchar(64), /*海拔高度*/
	`strength_info` varchar(64), /* 加固描述 */

	 `design_picture_path` varchar(128) default null, /* 设计图片 */
	-- `solidate_picture_path` varchar(128) default null, /* 加固图片 */
	-- `conservation_picture_path` varchar(128) default null, /* 保护图片 */
	-- `panorama_picture_path` varchar(128) default null, /* 全景图 */
	-- `install_picture_path` varchar(128) default null, /* 安装图片 */
	-- `decompose_picture_path` varchar(128) default null, /* 拆解图 */
	`3d_picture_path` varchar(128) default null, /* 3D展示图 */
	`video_path` varchar(128) default null, /* 上传视频 */

	`project_id` int(16) default 0, /* 所属项目*/
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	primary key (`slop_id`)
)engine=myisam default charset=utf8;

insert into `tb_slop_info` values (
	1, 'slop A', 'Slop AAA', '2011-01-01', '火车东站','120.218107', '30.29573', 
	0,0,0,0,0,0,0,
	'0', '0', '0', '0', 
	'/upload/slop_info/1/d.jpg',
	-- '/upload/slop_info/1/s.jpg',
	-- '/upload/slop_info/1/c.jpg',
	-- '/upload/slop_info/1/p.jpg',
	-- '/upload/slop_info/1/i.jpg',
	-- '/upload/slop_info/1/decomp.jpg',
	'/upload/slop_info/1/3d.jpg',
	'/upload/slop_info/1/video.avi',
	1,'2011-01-01'
);

insert into `tb_slop_info` values (
	2, 'slop B', 'Slop BBB', '2011-01-02', '东方丽都','120.206734', '30.298255', 
	0,0,0,0,0,0,0,
	'0', '0', '0', '0', 
	'/upload/slop_info/2/d.jpg',
	-- '/upload/slop_info/2/s.jpg',
	-- '/upload/slop_info/2/c.jpg',
	-- '/upload/slop_info/2/p.jpg',
	-- '/upload/slop_info/2/i.jpg',
	-- '/upload/slop_info/2/decomp.jpg',
	'/upload/slop_info/2/3d.jpg',
	'/upload/slop_info/2/video.avi',
	1,'2011-01-01'
);

insert into `tb_slop_info` values (
	3, 'slop C', 'Slop CCC', '2011-01-03', '闸弄口','120.199152', '30.290553', 
	0,0,0,0,0,0,0,
	'0', '0', '0', '0', 
	'/upload/slop_info/3/d.jpg',
	-- '/upload/slop_info/3/s.jpg',
	-- '/upload/slop_info/3/c.jpg',
	-- '/upload/slop_info/3/p.jpg',
	-- '/upload/slop_info/3/i.jpg',
	-- '/upload/slop_info/3/decomp.jpg',
	'/upload/slop_info/3/3d.jpg',
	'/upload/slop_info/3/video.avi',
	1,'2011-01-01'
);

insert into `tb_slop_info` values (
	4, 'slop D', 'Slop DDD', '2011-01-04', '水岸雅苑','120.196457', '30.304523', 
	0,0,0,0,0,0,0,
	'0', '0', '0', '0', 
	'/upload/slop_info/4/d.jpg',
	-- '/upload/slop_info/4/s.jpg',
	-- '/upload/slop_info/4/c.jpg',
	-- '/upload/slop_info/4/p.jpg',
	-- '/upload/slop_info/4/i.jpg',
	-- '/upload/slop_info/4/decomp.jpg',
	'/upload/slop_info/4/3d.jpg',
	'/upload/slop_info/4/video.avi',
	2,'2011-01-01'
);
-- --------------------------------------------------------

--
-- 表的结构 `tb_device_info`
--

drop table if exists `tb_device_info`;

create table`tb_device_info`(
	`device_id` int(11) not null AUTO_INCREMENT,
	`device_name` varchar(64) not null, /* 设备名称 */
	`device_description` varchar(128) not null,  /* 设备描述*/
	`device_type` int(16) default 0, /* 设备类型 */

	`device_picture_path` varchar(128) default null, /* 设备图*/
	`install_picture_path` varchar(128) default null, /* 安装图 */

	`formular` varchar(128) default null, /* 计算公式 */
	`slop_id` int(16) default 0, /* 边坡ID */
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	primary key (`device_id`)
)engine=myisam default charset=utf8;

insert into `tb_device_info` values (
	1, 'device A', 'AAA', 1,
	'/upload/device_info/1/d.jpg',
	'/upload/device_info/1/i.jpg',
	'1+1',
	1, '2011-01-01'
);

insert into `tb_device_info` values (
	2, 'device B', 'BBB', 2,
	'/upload/device_info/2/d.jpg',
	'/upload/device_info/2/i.jpg',
	'1+1',
	1, '2011-01-01'
);

insert into `tb_device_info` values (
	3, 'device C', 'CCC', 3,
	'/upload/device_info/3/d.jpg',
	'/upload/device_info/3/i.jpg',
	'1+1',
	1, '2011-01-01'
);

insert into `tb_device_info` values (
	4, 'device D', 'DDD', 4,
	'/upload/device_info/4/d.jpg',
	'/upload/device_info/4/i.jpg',
	'1+1',
	2, '2011-01-01'
);

-- --------------------------------------------------------

--
-- 表的结构 `tb_project_user`
-- 用户项目关联表

drop table if exists `tb_project_user`;

create table `tb_project_user`(
	`id` int(11) not null AUTO_INCREMENT,
	`project_id` int(16) not null,
	`user_id` int(16) not null,
	`flag` varchar(128) default null,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	 primary key (`id`)
)engine=myisam default charset=utf8;

insert into `tb_project_user` values (1, 1, 1, 0, '2011-01-01');
insert into `tb_project_user` values (2, 2, 1, 0, '2011-01-01');
insert into `tb_project_user` values (3, 1, 2, 0, '2011-01-01');
insert into `tb_project_user` values (4, 2, 3, 0, '2011-01-01');

-- --------------------------------------------------------

--
-- 表的结构 `tb_alarm_model`
-- 

drop table if exists `tb_alarm_model`;

create table`tb_alarm_model`(
	`model_id` int(11) not null AUTO_INCREMENT,
	`model_name` varchar(16) not null,
	`description` varchar(128) not null,
	`flag` varchar(128) default null,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	 primary key (`model_id`)
)engine=myisam default charset=utf8;

insert into `tb_alarm_model` values(0, 'model A', 'AAA', 0, '2011-01-01');
insert into `tb_alarm_model` values(1, 'model B', 'BBB', 0, '2011-01-01');
insert into `tb_alarm_model` values(2, 'model C', 'CCC', 0, '2011-01-01');
insert into `tb_alarm_model` values(4, 'model E', 'EEE', 0, '2011-01-01');
-- --------------------------------------------------------

--
-- 表的结构 `tb_device_type`
-- 

drop table if exists `tb_device_type`;

create table`tb_device_type`(
	`type_id` int(11) not null,
	`type_name` varchar(16) not null,
	`description` varchar(128) not null,
	`flag` varchar(128) default null,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	 primary key (`type_id`)
)engine=myisam default charset=utf8;

insert into `tb_device_type` values(1, 'type A', 'AAAA', 0, '2010-01-01');
insert into `tb_device_type` values(2, 'type B', 'BBBB', 0, '2010-01-01');
insert into `tb_device_type` values(3, 'type C', 'CCCC', 0, '2010-01-01');


drop table if exists `tb_device_data`;

/* create table`tb_device_data`(
	`id` int(11) not null,
	`device_id` varchar(16) not null,
	`collection` varchar(16) default null,
	`flag` varchar(128) default null,
	`data` varchar(128) default null,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	 primary key (`id`)
)engine=myisam default charset=utf8; */

create table`tb_device_data`(
	`id` int(11) not null,
	`device_id` varchar(16) not null,
	`flag` varchar(128) default null,
	`path` varchar(256) default null,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	 primary key (`id`)
)engine=myisam default charset=utf8;

insert into `tb_device_data` values(1, 1, 0, '/upload/device_data/1-2016-01-24.csv', '2016-01-01');
