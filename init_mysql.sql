/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE IF NOT EXISTS `epms` DEFAULT CHARACTER SET utf8;

USE `epms`;

/* SYSTEM ************************************************************************************/

/*Table structure for table `tb_logging` */

DROP TABLE IF EXISTS `tb_logging`;

CREATE TABLE `tb_logging` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `operator_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `user` varchar(64) DEFAULT NULL,
  `action` varchar(64) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='登录记录表';

insert into `tb_logging` values (1, 1, '所长', '0001', '登录', '登录成功', '127.0.0.1', '2014-10-22 11:24:21', null, '2011-01-01');
insert into `tb_logging` values (2, 2, '民警', '0002', '增加', '添加帐号流水为466', '192.168.1.125', '2014-10-27 09:30:19', null, '2011-01-01');


/*Table structure for table `tb_member_role` */

DROP TABLE IF EXISTS `tb_member_role`;

DROP TABLE IF EXISTS `tb_member_role`;
CREATE TABLE `tb_member_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '组ID',
  `role_name` varchar(45) NOT NULL DEFAULT '' COMMENT '组名',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '保留',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  `xurl` varchar(20) NOT NULL COMMENT '访问路径',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='成员角色表';

INSERT INTO `tb_member_role` 
VALUES
	(1,'超级管理员',1,'超级管理员','adminpanel'),
	(2,'项目管理员',2,'项目管理员','projectadmin'),
	(3,'业务员',3,'业务员','marketadmin'),
	(4,'客户管理员',4,'客户管理员','useradmin'),
	(5,'客户',5,'客户','user'),
	(6,'访客',6,'访客','guest');


/*Table structure for table `tb_module_menu` */

DROP TABLE IF EXISTS `tb_module_menu`;
CREATE TABLE `tb_module_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `menu_name` char(40) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `is_display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `controller` varchar(50) DEFAULT NULL COMMENT '管控者',
  `method` varchar(50) DEFAULT NULL COMMENT '方法',
  `flag_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '指针ID',
  `css_icon` varchar(50) DEFAULT NULL COMMENT 'CSS图标',
  `priv` smallint(6) DEFAULT '0' COMMENT '权限',
  PRIMARY KEY (`menu_id`) USING BTREE,
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8 COMMENT='模式菜单表';

INSERT INTO `tb_module_menu` 
VALUES
	(1,'项目-边坡查询',0,1,'project','index','0','globe','10'),
	(2,'项目管理',0,1,'manage','go_2','0','photo','0'),
	(3,'设备管理',0,1,'device_list','index','0','cog','0'),
	(4,'防护设备管理',0,1,'pt_list','index','0','cog','0'),
	(5,'用户管理',0,1,'manage','go_5','0','server','0'),
	(6,'报警管理',0,0,'manage','go_7','0','warning','0'),
	(7,'客户支持',0,1,'customer','index','0','suitcase','0'),
	(999,'公司信息',7,1,'manage','index','0','home','10'),

	(101,'项目概况',1,1,'project','general_info','0','user','0'),
	(102,'边坡概况',1,1,'project','slop_info','0','user','0'),
	(103,'建设情况',1,1,'project','construct_info','0','map-marker','0'),
	(104,'仪器数据',1,1,'project','device_info','0','map-marker','0'),
	(105,'预警报告',1,1,'project','alarm','0','map-marker','0'),
	(106,'边坡总介绍',1,0,'project','slop_general','0','user','0'),

	(1001,'检测数据和图表',104,1,'project','data_display','0','gears','0'),
	
	(20,'项目列表',2,1,'project','list_project','0','photo','0'),
	(130,'项目增加',20,1,'project','add_project','0','user','0'),
	(131,'项目修改',20,0,'project','modify_project','0','user','0'),
	(132,'项目删除',20,0,'project','delete_project','0','user','0'),
	
	(21,'边坡列表',2,1,'slop','index','0','bars','0'),
	(133,'边坡增加',21,1,'slop','add_slop','0','bars','0'),
	(134,'边坡修改',21,0,'slop','modify_slop','0','bars','0'),
	(135,'边坡删除',21,0,'slop','delete_slop','0','bars','0'),

	(22,'断面列表',2,1,'break_t','index','0','cog','0'),
	(139,'断面增加',22,1,'break_t','add','0','cog','0'),
	(140,'断面修改',22,0,'break_t','modify','0','cog','0'),
	(141,'断面删除',22,0,'break_t','delete','0','cog','0'),

	(23,'N级断面列表',2,1,'breakserial','index','0','cog','0'),
	(142,'N级断面增加',22,1,'breakserial','add','0','cog','0'),
	(143,'N级断面修改',22,0,'breakserial','modify','0','cog','0'),
	(144,'N级断面删除',22,0,'breakserial','delete','0','cog','0'),

	(24,'环境列表',2,1,'env_t','index','0','cog','0'),
	(145,'环境信息增加',24,1,'env_t','add','0','cog','0'),
	(146,'环境信息修改',24,0,'env_t','modify','0','cog','0'),
	(147,'环境信息删除',24,0,'env_t','delete','0','cog','0'),

	(25,'疾病属性列表',2,1,'disease','index','0','cog','0'),
	(148,'疾病属性增加',25,1,'disease','add','0','cog','0'),
	(149,'疾病属性修改',25,0,'disease','modify','0','cog','0'),
	(150,'疾病属性删除',25,0,'disease','delete','0','cog','0'),

	(31,'传感器列表',3,1,'device','index','0','cog','0'),
	(301,'传感器增加',31,1,'device','add','0','cog','0'),
	(302,'传感器修改',31,0,'device','modify','0','cog','0'),
	(303,'传感器删除',31,0,'device','delete','0','cog','0'),

	(32,'传感器数据列表',3,1,'device_data','index','0','cog','0'),
	(304,'传感器数据增加',32,1,'device_data','add','0','cog','0'),
	(305,'传感器数据修改',32,0,'device_data','modify','0','cog','0'),
	(306,'传感器数据删除',32,0,'device_data','delete','0','cog','0'),

	(33,'传感器基础数据列表',3,1,'sensor_base','index','0','cog','0'),
	(307,'传感器基础数据增加',33,1,'sensor_base','add','0','cog','0'),
	(308,'传感器基础数据修改',33,0,'sensor_base','modify','0','cog','0'),
	(309,'传感器基础数据删除',33,0,'sensor_base','delete','0','cog','0'),

	(34,'设备类型列表',3,1,'device_type','index','0','cog','0'),
	(310,'设备类型增加',34,1,'device_type','add','0','cog','0'),
	(311,'设备类型修改',34,0,'device_type','modify','0','cog','0'),
	(312,'设备类型删除',34,0,'device_type','delete','0','cog','0'),

	(40,'柔性网列表',4,1,'sns','index','0','cog','0'),
	(401,'柔性网增加',40,1,'sns','add','0','cog','0'),
	(402,'柔性网修改',40,0,'sns','modify','0','cog','0'),
	(403,'柔性网删除',40,0,'sns','delete','0','cog','0'),

	(41,'锚喷列表',4,1,'anchor','index','0','cog','0'),
	(404,'锚喷增加',41,1,'anchor','add','0','cog','0'),
	(405,'锚喷修改',41,0,'anchor','modify','0','cog','0'),
	(406,'锚喷删除',41,0,'anchor','delete','0','cog','0'),

	(42,'厚层基材列表',4,1,'thick','index','0','cog','0'),
	(407,'厚层基材增加',42,1,'thick','add','0','cog','0'),
	(408,'厚层基材修改',42,0,'thick','modify','0','cog','0'),
	(409,'厚层基材删除',42,0,'thick','delete','0','cog','0'),

	(43,'抗滑桩列表',4,1,'antiskid','index','0','cog','0'),
	(410,'抗滑桩增加',43,1,'antiskid','add','0','cog','0'),
	(411,'抗滑桩修改',43,0,'antiskid','modify','0','cog','0'),
	(412,'抗滑桩删除',43,0,'antiskid','delete','0','cog','0'),

	(44,'锚杆列表',4,1,'prestress_rod','index','0','cog','0'),
	(413,'锚杆增加',44,1,'prestress_rod','add','0','cog','0'),
	(414,'锚杆修改',44,0,'prestress_rod','modify','0','cog','0'),
	(415,'锚杆删除',44,0,'prestress_rod','delete','0','cog','0'),

	(45,'预应力锚索列表',4,1,'prestress_cable','index','0','cog','0'),
	(416,'预应力锚索增加',45,1,'prestress_cable','add','0','cog','0'),
	(417,'预应力锚索修改',45,0,'prestress_cable','modify','0','cog','0'),
	(418,'预应力锚索删除',45,0,'prestress_cable','delete','0','cog','0'),

	(46,'生态袋列表',4,1,'bag','index','0','cog','0'),
	(419,'生态袋增加',46,1,'bag','add','0','cog','0'),
	(420,'生态袋修改',46,0,'bag','modify','0','cog','0'),
	(421,'生态袋删除',46,0,'bag','delete','0','cog','0'),

	(47,'护面墙列表',4,1,'wall','index','0','cog','0'),
	(422,'护面墙增加',47,1,'wall','add','0','cog','0'),
	(423,'护面墙修改',47,0,'wall','modify','0','cog','0'),
	(424,'护面墙删除',47,0,'wall','delete','0','cog','0'),

	(48,'浆砌挡墙列表',4,1,'paste_wall','index','0','cog','0'),
	(425,'浆砌挡墙增加',48,1,'paste_wall','add','0','cog','0'),
	(426,'浆砌挡墙修改',48,0,'paste_wall','modify','0','cog','0'),
	(427,'浆砌挡墙删除',48,0,'paste_wall','delete','0','cog','0'),

	(50,'用户列表',5,1,'user','index','0','user','0'),
	(501,'添加用户',50,1,'user','add','0','user','0'),
	(502,'修改用户',50,0,'user','edit','0','user','0'),
	(503,'删除用户',50,0,'user','delete','0','user','0'),
	(51,'项目关联',5,1,'project_user','index','0','heart','0'),
	(505,'修改关联',50,0,'project_user','update','0','wrench','0'),
	(52,'服务器信息',5,1,'server_info','index','0','user','0'),
	(53,'登录信息',5,1,'logging_info','index','0','user','0'),

	(60,'报警模型列表',6,0,'alarm','index','0','user','0'),
	(601,'添加模型',60,0,'alarm','add','0','user','0'),
	(602,'修改模型',60,0,'alarm','modify','0','user','0'),
	(603,'删除模型',60,0,'alarm','delete','0','user','0')
	;


/*Table structure for table `tb_operator_info` */

DROP TABLE IF EXISTS `tb_operator_info`;
CREATE TABLE `tb_operator_info` (
  `operator_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '操作者ID',
  `operator_name` varchar(64) NOT NULL COMMENT '名字',
  `operator_pwd` varchar(64) NOT NULL COMMENT '密码',
  `operator_role` int(10) NOT NULL COMMENT '角色',
  `operator_displayname` varchar(64) NOT NULL COMMENT '显示名字',
  `reg_ip` varchar(64) DEFAULT NULL COMMENT '登录IP',
  `reg_time` datetime NOT NULL COMMENT '登录时间',
  `encrypt` varchar(64) DEFAULT NULL COMMENT '加密',
  `last_login_ip` varchar(64) DEFAULT NULL COMMENT '最后登录IP',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `company` varchar(32) DEFAULT '' COMMENT '公司',
  `address` varchar(64) DEFAULT '' COMMENT '地址',
  `phone` varchar(32) DEFAULT '' COMMENT '电话',
  `email` varchar(64) DEFAULT '' COMMENT '电邮',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`operator_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='操作人员信';

INSERT INTO `tb_operator_info` values 
	(1, 'admin',  '0002', 1, '超级管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:29:35', '', '', '', ''),
	(2, 'projectadmin',  '0002', 2, '项目管理员',  '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(3, 'marketadmin',  '0002', 3, '业务员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(4, 'useradmin',  '0002', 4, '客户管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(5, 'user',  '0002', 5, '客户', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(6, 'guest',  '0002', 6, '访客', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:30:28', '', '', '', ''),
	(9, 'sysadmin',  '9999', 1, '超级管理员', '127.0.0.1', '2011-01-01 12:30:30', '',  '127.0.0.1', '2011-01-01 12:30:30', '2015-10-22 14:31:11', '', '', '', '');


/*Table structure for table `tb_server_info` */

DROP TABLE IF EXISTS `tb_server_info`;
CREATE TABLE `tb_server_info` (
  `server_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服务器ID',
  `server_type` tinyint(4) NOT NULL COMMENT '服务器类型',
  `server_name` varchar(64) NOT NULL COMMENT '服务器名称',
  `server_ip` varchar(64) NOT NULL COMMENT '服务器IP',	
  `powerlow_times` int(11) NOT NULL DEFAULT '2' COMMENT '低压次数',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`server_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='服务器信息表';

insert into `tb_server_info` values(1, 1, 'server A', '192.168.0.1', 0, '2000-01-01');
insert into `tb_server_info` values(2, 1, 'server B', '192.168.0.2', 0, '2000-01-01');

/*Table structure for table `tb_sessions` */

DROP TABLE IF EXISTS `tb_sessions`;
CREATE TABLE `tb_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'ID',
  `ip_address` varchar(16) NOT NULL DEFAULT '0' COMMENT 'IP地址',
  `user_agent` varchar(120) NOT NULL DEFAULT '' COMMENT '代理用户',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后活动',
  `data` text NOT NULL COMMENT '数据',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0', 
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会话表';

/*Table structure for table `tb_times` */

DROP TABLE IF EXISTS `tb_times`;
CREATE TABLE `tb_times` (
  `times_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '次数ID',
  `username` varchar(45) DEFAULT NULL COMMENT '用户名称',
  `login_ip` char(15) DEFAULT NULL COMMENT 'ip' COMMENT '登录IP',
  `login_time` int(10) unsigned DEFAULT NULL COMMENT '登录时间',
  `group_id` int(10) unsigned DEFAULT NULL COMMENT '组ID',
  `failure_times` int(10) unsigned DEFAULT NULL COMMENT '出错次数',
  `is_admin` tinyint(1) DEFAULT NULL COMMENT '是否管理者',
  PRIMARY KEY (`times_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='次数表';


/* PROJECT ************************************************************************************/

/*Table structure for table `tb_project_info` */

DROP TABLE IF EXISTS `tb_project_info`;
CREATE TABLE `tb_project_info` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '项目ID',
  `project_name` varchar(64) NOT NULL COMMENT '项目名称',
  `project_description` varchar(256) NOT NULL COMMENT '项目描述 （项目工程概况）',
  `start_time` datetime DEFAULT NULL COMMENT '项目开始时间（项目添加时间）',
  `position_char` varchar(128) DEFAULT NULL COMMENT '位置描述',
  `picture_path` varchar(128) DEFAULT NULL COMMENT '图片路径（项目概况的图片文件）',
  `construction_char` varchar(128) DEFAULT NULL COMMENT '建造情况',
  `construction_picture_path` varchar(256) DEFAULT NULL COMMENT '建造图片（项目建设情况的图片文件）', 
  `general_slop` varchar(128) DEFAULT NULL COMMENT '边坡描述',
  `type` int(11) NOT NULL DEFAULT '100' COMMENT '类型',
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT '客户公司ID ',
  `road_name` varchar(128) NOT NULL COMMENT '项目施工高速名称',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='项目信息表';

INSERT INTO `tb_project_info` VALUES ('1', 'project-1', '干线公路', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/1/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/1/const_pic.jpg', '边坡描述如下：100多个边坡', '1', '1', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('2', 'project-2', '干线公路', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/2/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/2/const_pic.jpg', '边坡描述如下：100多个边坡', '1', '1', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('3', 'project-3', '干线公路', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/3/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/3/const_pic.jpg', '边坡描述如下：100多个边坡', '1', '1', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('4', 'project-4', '干线公路', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/4/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/4/const_pic.jpg', '边坡描述如下：100多个边坡', '1', '1', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('5', 'project-5', '干线公路', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/5/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/5/const_pic.jpg', '边坡描述如下：100多个边坡', '1', '1', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('6', 'project-6', '干线公路', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/6/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/6/const_pic.jpg', '边坡描述如下：100多个边坡', '1', '1', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('7', '杭徽高速公路高边坡监测预警', 'G56杭瑞高速公路是国家“7918”高速公路网中“18条横线”中的第12条横线。杭瑞高速公路（G56）浙江段又称为杭徽高速公路，是杭瑞高速的起点路段，是浙江省公路网规划“二纵二横十八连”中的“一连”和杭州市旅游西进“三线三进”中的“一线”，是连接安徽黄山和浙江杭州两大著名风景旅游胜地的重要干线公路。', '2016-04-25 00:00:00', '安微浙江交界', '/upload/project_info/1/pic.jpg', '全线于2006年12月26日正式通车', '/upload/project_info/1/const_pic.jpg', '边坡描述如下：100多个边坡', '100', '0', '杭徽高速公路', '2016-06-06 18:29:41');
INSERT INTO `tb_project_info` VALUES ('8', '上三高速公路高边坡监测预警', '上三高速公路是国家高速公路“7918网”中G15沈海线之并行线G15w常台（常熟～台州）高速的重要组成部分，是沟通浙江省沿海地区和浙中、浙南腹地的一条重要通道，是沪杭甬和甬台温两条高速公路的重要连接线，全长142.3km。', '2016-04-25 11:15:35', '天台内', '/upload/project_info/2/pic.jpg', '全线于2000年12正式通车', '/upload/project_info/2/const_pic.jpg', '边坡复杂', '100', '0', '上三高速公路', '2016-06-06 18:29:16');

/*Table structure for table `tb_project_type` */

DROP TABLE IF EXISTS `tb_project_type`;
CREATE TABLE `tb_project_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `type_name` varchar(64) NOT NULL DEFAULT 'type' COMMENT '类型名称',
  `flag` int(11) NOT NULL DEFAULT '0' COMMENT '指针',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='项目类型表';
-- ----------------------------
-- Records of tb_project_type
-- ----------------------------
insert into `tb_project_type` values (1,  'Class A', 0, '2011-01-01');
insert into `tb_project_type` values (2,  'Class B', 0, '2011-01-01');
insert into `tb_project_type` values (3,  'Class C', 0, '2011-01-01');
insert into `tb_project_type` values (4,  'Class D', 0, '2011-01-01');
insert into `tb_project_type` values (5,  '客户项目', 0, '2011-01-01');
insert into `tb_project_type` values (6,  '演示项目', 0, '2011-01-01');

/*Table structure for table `tb_project_user` */
DROP TABLE IF EXISTS `tb_project_user`;

CREATE TABLE `tb_project_user`(
	`id` int(11) not null AUTO_INCREMENT,
	`project_id` int(16) not null,
	`user_id` int(16) not null,
	`flag` varchar(128) default null,
	`update_timestamp` datetime not null default current_timestamp on update current_timestamp,
	 primary key (`id`)
)ENGINE=MYISAM DEFAULT CHARSET=UTF8 COMMENT='项目用户对应表';

INSERT INTO `tb_project_user` values (1, 1, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (2, 2, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (3, 3, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (4, 4, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (5, 5, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (6, 6, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (7, 7, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (8, 8, 1, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (9, 1, 2, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (10, 2, 2, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (11, 3, 2, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (12, 4, 2, 0, '2011-01-01');

/*Table structure for table `tb_customer` */

DROP TABLE IF EXISTS `tb_customer`;
CREATE TABLE `tb_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户ID',
  /* `project_id` int(16) NOT NULL COMMENT '项目ID', 删除:一个客户可能对应多个项目 */
  `user_name` varchar(128) NOT NULL COMMENT '客户名称',
  `flag` varchar(128) DEFAULT NULL COMMENT '指针',
  `cust_name` varchar(128) COMMENT '联系人',
  `addr` varchar(128) COMMENT '地址',
  `mbphone` varchar(64) NOT NULL COMMENT '移动电话',
  `tel` varchar(128) DEFAULT NULL COMMENT '固定电话',
  `fax` varchar(128) DEFAULT NULL COMMENT '传真',
  `othercontact` varchar(128) DEFAULT NULL COMMENT '其它联系方式',
  `tax_num` varchar(128) COMMENT '税号',
  `e-mail` varchar(128) DEFAULT NULL COMMENT '电子邮箱',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='项目客户表';

-- ----------------------------
-- Records of tb_project_user
-- ----------------------------
INSERT INTO `tb_customer` VALUES ('1',  '杭徽高速公路杭徽管理处', '0', '张三', '浙江杭州', '15267001234', '83826596', '无', '无', '无', '1254611@163.com', '2016-06-06 18:31:18');
INSERT INTO `tb_customer` VALUES ('2',  '上三高速公路绍兴管理处', '0', '李四', '浙江杭州', '13913345678', '86545124', '无', '无', '无', '25461132@qq.com', '2016-06-06 18:31:21');


/* SLOP****************************************************************************************************************/

/*Table structure for table `tb_slop_info` */

DROP TABLE IF EXISTS `tb_slop_info`;
CREATE TABLE `tb_slop_info` (
  `slop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '边坡ID',
  `slop_name` varchar(64) NOT NULL COMMENT '边坡名称',
  `slop_description` varchar(256) DEFAULT NULL COMMENT '边坡描述',
  /* `slop_type_id` int(11) COMMENT '边坡形态ID', */
  `start_time` datetime DEFAULT NULL COMMENT '开始时间（边坡建造时间）',
  `position_char` varchar(128) DEFAULT NULL COMMENT '位置描述',
  `position_x` varchar(16) DEFAULT '0' COMMENT '经度坐标',
  `position_y` varchar(16) DEFAULT '0' COMMENT '纬度坐标',
  `alarm_model` int(16) DEFAULT '0' COMMENT '报警模式',
  `slop_type` int(16) DEFAULT '0' COMMENT '边坡类型',
  `env_id` int(16) DEFAULT '0' COMMENT '环境属性ID',
  `disease_id` int(16) DEFAULT '0' COMMENT '病害属性ID',
  `subroadname` varchar(128) DEFAULT '0' COMMENT '所属路段',
  `stake_bg` varchar(128) COMMENT '起始桩号',
  `stake_end` varchar(128) COMMENT '终止桩号',  
/*  `longtitude` varchar(64) DEFAULT NULL COMMENT '经度（中心位置的经度（°））', */
/*  `latitude` varchar(64) DEFAULT NULL COMMENT '纬度（中心位置的纬度（°））', */
  `altitude` varchar(64) DEFAULT NULL COMMENT '海拔（中心位置的高度(m)）',
  `strength_info` varchar(64) DEFAULT NULL COMMENT '强度信息（边坡整体加固描述）',
  `design_picture_path` varchar(128) DEFAULT NULL COMMENT '设计图路径',
  `3d_picture_path` varchar(128) DEFAULT NULL COMMENT '3D图路径',
  `sendset_3d` varchar(128) COMMENT '边坡仪器安装动画（一个链接）',
  `maintance_pic` varchar(128) COMMENT '边坡养护图片',
  `build_pic` varchar(128) COMMENT '边坡施工图片',
  `video_path` varchar(128) DEFAULT NULL COMMENT '视频路径',
  `project_id` int(16) DEFAULT '0' COMMENT '项目ID（所属项目ID ）',
  `rock_num` int(11) COMMENT '岩层数量（层）', 
  `joint_num` int(11) COMMENT '节理数量（个）',
  `crack_num` int(11) COMMENT '裂隙数量（个）',
  `fault_num` int(11) COMMENT '断层数量（个）',
  `struc_surface_num` int(11) COMMENT '结构面数量（个）',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='边坡信息表';

-- ----------------------------
-- Records of tb_slop_info
-- ----------------------------
INSERT INTO `tb_slop_info` VALUES ('1', '杭徽高速公路G56101号边坡-1', '坡高5.0m。',  '2006-12-26 15:29:54', '浙江安徽交界', '120.218107', '30.29573',  '0', '0', '1', '1', '杭徽高速公路藻溪至於潜段', 'k57+550', 'K57+650',  '20.0', '第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', '/upload/slop_info/1/design.jpg', null, null, null, '/upload/slop_info/1/build.jpg', null, '1', '3', '2', '1', '1', '1', '2016-06-06 18:35:22');
INSERT INTO `tb_slop_info` VALUES ('2', '杭徽高速公路G56101号边坡-2', '坡高5.0m。',  '2006-12-26 15:29:54', '浙江安徽交界', '120.206734', '30.298255',  '0', '0', '1', '1', '杭徽高速公路藻溪至於潜段', 'k57+550', 'K57+650',  '20.0', '第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', '/upload/slop_info/1/design.jpg', null, null, null, '/upload/slop_info/1/build.jpg', null, '1', '3', '2', '1', '1', '1', '2016-06-06 18:35:22');
INSERT INTO `tb_slop_info` VALUES ('3', '杭徽高速公路G56101号边坡-3', '坡高5.0m。',  '2006-12-26 15:29:54', '浙江安徽交界', '120.199152', '30.290553',  '0', '0', '1', '1', '杭徽高速公路藻溪至於潜段', 'k57+550', 'K57+650',  '20.0', '第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', '/upload/slop_info/1/design.jpg', null, null, null, '/upload/slop_info/1/build.jpg', null, '1', '3', '2', '1', '1', '1', '2016-06-06 18:35:22');
INSERT INTO `tb_slop_info` VALUES ('4', '杭徽高速公路G56101号边坡-4', '坡高5.0m。',  '2006-12-26 15:29:54', '浙江安徽交界', '120.196457', '30.304523',  '0', '0', '1', '1', '杭徽高速公路藻溪至於潜段', 'k57+550', 'K57+650',  '20.0', '第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', '/upload/slop_info/1/design.jpg', null, null, null, '/upload/slop_info/1/build.jpg', null, '2', '3', '2', '1', '1', '1', '2016-06-06 18:35:22');
INSERT INTO `tb_slop_info` VALUES ('5', '杭徽高速公路G56101号边坡', '该边坡为二级边坡，第一级边坡坡率1:0.75，坡高29.6m；第二级边坡坡率1:1，坡高5.0m。', '1', '2006-12-26 15:29:54', '浙江安徽交界',  '120.196457', '30.304623',  '0', '0', '1', '1', '杭徽高速公路藻溪至於潜段', 'k57+550', 'K57+650', '120.2', '30.3', '20.0', '第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', '/upload/slop_info/1/design.jpg', null, null, null, '/upload/slop_info/1/build.jpg', null, '2', '3', '2', '1', '1', '1', '2016-06-06 18:35:22');
INSERT INTO `tb_slop_info` VALUES ('6', '上三高速公路G15w071号边坡', '该边坡为二级边坡，第一级边坡坡率1:0.47，坡高7.9m；第二级边坡坡率1:0.31，坡高18.1m。', '2', '2000-12-06 15:33:38', '天台县',  '120.196457', '30.304723',  '0', '0', '2', '2', '上三高速公路新昌至天台段', 'K290+320', 'K290+436', '121.2', '29.3', '20.0', '第一级护面墙防护；第二级预应力锚索+格构梁防护。', '/upload/slop_info/2/design.jpg', null, null, null, '/upload/slop_info/2/build.jpg', null, '3', '3', '2', '1', '1', '1', '2016-06-06 18:35:32');

/*Table structure for table `tb_break` */

drop table if exists `tb_break`;
CREATE TABLE `tb_break` (
 `break_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '断面ID',
 `slop_id` int(11) NOT NULL COMMENT '边坡ID',      
 `type` varchar (128) NOT NULL COMMENT '断面类型：工程地质断面、监测断面',
 `start_stake` varchar(128) COMMENT '该断面的里程桩号',
 `info` varchar(128) COMMENT '断面描述',
 `pic` varchar(128) COMMENT '断面图片',
 `break_serial` int(11) COMMENT '断面级数（级）',
 `rock_num` int(11) COMMENT '岩层数量(层)',
 `joint_num` int(11) COMMENT '节理数量（个）',
 `creak_num` int(11) COMMENT '裂隙数量（个）',
 `fault_num` int(11) COMMENT '断层数量（个）',
 `water_point` int(11) COMMENT '地下水位点位数（个）',
 `water_info` varchar(128) COMMENT '地下水位文字描述',
 `form` int(11) COMMENT '该断面的边坡形态(n级边坡)',
 `geo_struct` varchar(128) COMMENT '该断面的地质构造',
 `strength_info` varchar(128) COMMENT '该断面的加固设计描述',
 `loc_x` float COMMENT '中心位置（相对于边坡中心）',
 `loc_y` float COMMENT '中心位置',
 `loc_z` float COMMENT '中心位置',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`break_id`)
 )ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='断面信息表';

-- ----------------------------
-- Records of tb_break
-- ----------------------------
INSERT INTO `tb_break` VALUES ('1', '5', '监测断面', 'K50+550', '监测断面为2级边坡，第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', null, '5', '2', '1', '1', '1', '5', null, '5', '坡体由奥陶系于潜组粉砂质泥岩（O3y）组成,地层产状100°∠10°，为切向坡；粉砂质泥岩为青灰色薄～中厚层状，抗风化能力弱，节理裂隙较发育，岩石较破碎，强风化层厚3～5m，上覆第四系残坡积碎石土，为土黄色，松散，层厚1～2', '第一级SNS主动网+预应力锚杆（8m）防护；第二级SNS主动网+预应力锚杆（6m）防护。', '124', '54', '57', '2016-06-06 18:36:23');
INSERT INTO `tb_break` VALUES ('2', '6', '监测断面', 'K290+380', '监测断面为2级边坡，第一级护面墙防护；第二级预应力锚索+格构梁防护。', null, '5', '2', '1', '1', '1', '5', null, '2', '边坡区土体主要为残坡积层和全风化基岩层，残坡积层厚度在上部山坡上一般1.4~3.2m，局部较厚。强风化玄武岩厚度一般1.9~4.4m，中风化玄武岩厚度在7.8~10.3m，中风化玄武岩厚度在5.5~10.6m，微风化玄武岩层厚4.0m~11.3m。', '第一级护面墙防护；第二级预应力锚索+格构梁防护。', '245', '54', '25', '2016-06-06 18:36:32');

/*Table structure for table `tb_break_serial` */

drop table if exists `tb_break_serial`;
CREATE TABLE `tb_break_serial`(
 `bkserial_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '坡面级数ID（通过其寻找加固详情）',
 `break_id` int(11) NOT NULL COMMENT '断面ID', 
 `slop_type_id` int(11) NOT NULL COMMENT '形态的编号ID', 
 `fortype` int(11) NOT NULL COMMENT '上级类型（边坡/断面）',   
 `sns_id` int(11) COMMENT '指向SNS防护,可以为空',
 `anchor_id` int(11) COMMENT '指向锚喷防护,可以为空',
 `thick_id` int(11) COMMENT '指向厚层基材防护,可以为空',
 `antiskid_id` int(11) COMMENT '指向抗滑桩防护,可以为空',
 `prestress_road_id` int(11) COMMENT '指向锚杆防护,可以为空',
 `prestress_cable_id` int(11) COMMENT '指向预应力锚索防护,可以为空',
 `bag_id` int(11) COMMENT '指向生态袋防护,可以为空',
 `wall_id` int(11) COMMENT '指向护面墙防护,可以为空',
 `paste_wall_id` int(11) COMMENT '指向浆砌挡墙防护,可以为空',
 `high` float COMMENT '该级边坡对应的坡高（m）',
 `ratio` float COMMENT '该级边坡对应的坡率(1:n)示例为n值',
 `long` float COMMENT '该级边坡对应的平台宽度(m)',
 `loc_x` float COMMENT '中心位置',
 `loc_y` float COMMENT '中心位置',
 `loc_z` float COMMENT '中心位置',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`bkserial_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='N级坡面信息表';

-- ----------------------------
-- Records of tb_break_serial
-- ----------------------------
INSERT INTO `tb_break_serial` VALUES ('1', '1', '1', '2', '2', '1', '1', '1', '1', '1', '1', '1', '2', '5', '2', '0.75', '123', '54', '52', '2016-06-06 18:40:08');
INSERT INTO `tb_break_serial` VALUES ('2', '2', '2', '2', '1', '2', '2', '2', '2', '2', '2', '2', '1', '5', '2', '0.75', '123', '25', '35', '2016-06-06 18:40:08');

/*Table structure for table `tb_env` */

drop table if exists `tb_env`;
CREATE TABLE `tb_env`(
 `env_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '环境ID',
 `slop_id` int(11) NOT NULL COMMENT '边坡ID',
 `temp` varchar(128) COMMENT '年平均气温（℃）',
 `max_temp` varchar(128) COMMENT '极端最高气温（℃）',
 `min_temp` varchar(128) COMMENT '极端最低气温（℃）',
 `rain_fall` varchar(128) COMMENT '年平均降雨量（mm）',
 `rain_day` varchar(128) COMMENT '平均降雨日数（d）',
 `water_info` varchar(128) COMMENT '地下水位线 文字描述',
 `wind_speed` varchar(128) COMMENT '年平均风速（m/s）',
 `max_wind` varchar(128) COMMENT '最高风速(m/s)',
 `pic` varchar(128) COMMENT '该环境属性的图片信息',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`env_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='环境属性表';

-- ----------------------------
-- Records of tb_env
-- ----------------------------
INSERT INTO `tb_env` VALUES ('1', '5', '25', '35', '5', '300', '50', '水位低', '25', '80', null, '2016-06-06 18:22:09');
INSERT INTO `tb_env` VALUES ('2', '6', '20', '25', '-5', '200', '20', '水位低', '35', '100', null, '2016-06-06 18:22:43');

/*Table structure for table `tb_disease` */

drop table if exists `tb_disease`;
CREATE TABLE `tb_disease`(
 `disease_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '病害ID',
 `slop_id` int(11) COMMENT '边坡ID（自动填写，可以不用）',
 `type` varchar(128) COMMENT '病害类型，坡面渗水、坡面坍塌、裂缝等',
 `pos_X` float COMMENT '位置',
 `pos_Y` float COMMENT '位置',
 `pos_Z` float COMMENT '位置',
 `info` varchar(128) COMMENT '规模（具体信息待定）病害的规模信息',
 `pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`disease_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='病害属性表';

-- ----------------------------
-- Records of tb_disease
-- ----------------------------
INSERT INTO `tb_disease` VALUES ('1', '5', '坡面渗水', '125', '25', '52', '病害规模大', null, '2016-06-06 18:24:09');
INSERT INTO `tb_disease` VALUES ('2', '6', '坡面坍塌', '125', '25', '42', '规模减轻', null, '2016-06-06 18:24:33');

/* DEVICE****************************************************************************************************************/

/*Table structure for table `tb_device_info` */

DROP TABLE IF EXISTS `tb_device_info`;
CREATE TABLE `tb_device_info` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '设备ID',
  `device_name` varchar(64) NOT NULL COMMENT '设备名称',
  `device_description` varchar(128) NOT NULL COMMENT '设备描述（传感器作用简介）',
  `type_id` int(11) DEFAULT '0' COMMENT '传感器类型ID',   
  `device_picture_path` varchar(128) DEFAULT NULL COMMENT '设备图路径（传感器图片）',
  `install_picture_path` varchar(128) DEFAULT NULL COMMENT '设备安装图路径',
  `formular` varchar(128) DEFAULT NULL COMMENT '公式',
  `slop_id` int(16) DEFAULT '0' COMMENT '边坡ID',
  `sen_id` int(11) NOT NULL COMMENT '传感器ID',
  `project_id` int(11) COMMENT '项目ID not used',
  `group_type` varchar(128) COMMENT '分组类型',
  `gptype_id` int(11) COMMENT '分组ID', 
  `unit_id` int(11) COMMENT '单元编号',
  `unit_num` varchar(128) COMMENT '单元通道',
  `sen_locX` float COMMENT '传感器位置坐标X',
  `sen_locY` float COMMENT '传感器位置坐标Y',
  `sen_locZ` float COMMENT '传感器位置坐标Z',
  `data_id` int(11) COMMENT '原始数据ID',   
  `acq_id` int(11) COMMENT '采集通道ID',  
  `horiz_angle` float COMMENT '传感器姿势水平面角度',
  `break_angle` float COMMENT '传感器姿势断面角度',
  `orient` varchar(128) COMMENT '传感器姿势朝向',
  `wk_ok` bit COMMENT '是否正常工作',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`device_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='设备信息表';

-- ----------------------------
-- Records of tb_device_info
-- ----------------------------
INSERT INTO `tb_device_info` VALUES ('5', '集成箱1', '传感器作用收集长度', '1', null, null, 'v=a+b', '5', '1', '7', '分组类型?', '100', '1', '2', '120', '30', '20', '20', '1', '30', '45', '朝北', 'Y', '2016-06-06 18:51:11');
INSERT INTO `tb_device_info` VALUES ('6', '集成箱2', '收集重量', '2', null, null, 'm=a*b', '6', '2', '8', '分组类型？', '100', '2', '2', '120', '30', '25', '12', '5', '45', '0', '朝南', 'Y', '2016-06-06 18:51:43');

/*Table structure for table `tb_device_type` */

DROP TABLE IF EXISTS `tb_device_type`;
CREATE TABLE `tb_device_type` (
  `type_id` int(11) NOT NULL COMMENT '类型ID',
  `type_name` varchar(16) NOT NULL COMMENT '类型名称',
  `description` varchar(128) NOT NULL COMMENT '描述',
  `flag` varchar(128) DEFAULT NULL COMMENT '指针',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设备类型表';

-- ----------------------------
-- Records of tb_device_type
-- ----------------------------
INSERT INTO `tb_device_type` VALUES ('1', '类型一', '具体描述111111', '0', '2016-06-06 18:06:45');
INSERT INTO `tb_device_type` VALUES ('2', '类型二', '具体描述22222', '0', '2016-06-06 18:07:03');

/*Table structure for table `tb_device_data` */

DROP TABLE IF EXISTS `tb_device_data`;
CREATE TABLE `tb_device_data` (
  `id` int(11) NOT NULL COMMENT '数据ID(原始数据ID )',
  `device_id` int(11) NOT NULL COMMENT '设备ID',
  `flag` varchar(128) DEFAULT NULL COMMENT '指针',
  `path` varchar(256) DEFAULT NULL COMMENT '路径',
  `acq_date` date COMMENT '数据采集时间',
  `acq_value` float COMMENT '数值',
  `last_value` float COMMENT '最新数值',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设备数据表';

-- ----------------------------
-- Records of tb_device_data
-- ----------------------------
INSERT INTO `tb_device_data` VALUES ('1', '5', '0', null, '2016-06-06', '1250.25', '1205.45', '2016-06-06 18:55:48');
INSERT INTO `tb_device_data` VALUES ('2', '6', '0', null, '2016-06-06', '12', '13', '2016-06-06 18:56:03');

/*Table structure for table `tb_sensor_base` */

drop table if exists `tb_sensor_base`;
CREATE TABLE `tb_sensor_base`(
 `sen_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '传感器ID',
 `type_id` int(11) COMMENT '传感器类型ID',  
 `manufacture` varchar(128) COMMENT '生产厂家',
 `contact_info` varchar(128) COMMENT '联系方式',
 `raw_unit` varchar(128) COMMENT '原始数据单位',
 `sim_type` varchar(128) COMMENT '激励形式',
 `meas_type` varchar(64) COMMENT '测量物理量',
 `unit` varchar(128) COMMENT '测量值单位',
 `calcrule` varchar(128) COMMENT '计算公式',
 `sn` varchar(128) COMMENT '出厂编号',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`sen_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='传感器基本信息表';

-- ----------------------------
-- Records of tb_sensor_base
-- ----------------------------
INSERT INTO `tb_sensor_base` VALUES ('1', '1', '天台县仪器厂', '83865456', 'cm', '激励形式', null, 'cm', 'v=a+b', '3125426511', '2016-06-06 18:18:18');
INSERT INTO `tb_sensor_base` VALUES ('2', '2', '杭州仪表厂', '88656254', 'kg', '激励形式', null, 'kg', 'm=a*b', '36443112', '2016-06-06 18:19:17');

/* DEFENDER****************************************************************************************************************/

/*Table structure for table `tb_sns` */

drop table if exists `tb_sns`;
CREATE TABLE `tb_sns`(
 `sns_id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' SNS主动柔性网属性ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `type` varchar(128) COMMENT '类型：GPS2型，GSS2A型，GQS型，GTS型，GS2R型',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片该柔性网的图片信息',
 `live_pic` varchar(128) COMMENT '现场照片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`sns_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='sns主动柔性网属性表';

-- ----------------------------
-- Records of tb_sns
-- ----------------------------
INSERT INTO `tb_sns` VALUES ('1', '2', 'GSS2A型', '开始处', null, null, '2016-06-06 17:57:27');
INSERT INTO `tb_sns` VALUES ('2', '1', 'GPS2型', '中间', null, null, '2016-06-06 17:57:21');


/*Table structure for table `tb_anchor` */

drop table if exists `tb_anchor`;
CREATE TABLE `tb_anchor`(
 `anchor_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '锚喷ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `thick` float COMMENT '厚度数据(cm)',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT '该锚喷的图片信息',
 `live_pic` varchar(128) COMMENT '现场照片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`anchor_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='锚喷属性表';

-- ----------------------------
-- Records of tb_anchor
-- ----------------------------
INSERT INTO `tb_anchor` VALUES ('1', '1', '20', '顶部', null, null, '2016-06-06 17:58:29');
INSERT INTO `tb_anchor` VALUES ('2', '2', '123', '底部', null, null, '2016-06-06 17:58:36');

/*Table structure for table `tb_thick` */

drop table if exists `tb_thick`;
CREATE TABLE `tb_thick`(
 `thick_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '厚层基材ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `thick` float COMMENT '厚度数据(mm)',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT '图片信息',
 `live_pic` varchar(128) COMMENT '现场照片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`thick_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='厚层基材属性表';

-- ----------------------------
-- Records of tb_thick
-- ----------------------------
INSERT INTO `tb_thick` VALUES ('1', '2', '21', '杭州', null, null, '2016-06-06 17:59:41');
INSERT INTO `tb_thick` VALUES ('2', '1', '54', '安徽', null, null, '2016-06-06 17:59:45');

/*Table structure for table `tb_prestress_cable` */

drop table if exists `tb_prestress_cable`;
CREATE TABLE `tb_prestress_cable`(
 `prestress_cable_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '预应力锚索ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `type` varchar(128) COMMENT '锚索类型：拉力型、压力型、拉压结合型',
 `long` float COMMENT '长度（m）',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`prestress_cable_ID`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='预应力锚索属性表';

-- ----------------------------
-- Records of tb_prestress_cable
-- ----------------------------
INSERT INTO `tb_prestress_cable` VALUES ('1', '1', '拉力型', '20', '中间', null, null, '2016-06-06 18:01:57');
INSERT INTO `tb_prestress_cable` VALUES ('2', '2', '压力型', '30', '位置', null, null, '2016-06-06 18:02:11');

/*Table structure for table `tb_prestress_rod` */

drop table if exists `tb_prestress_rod`;
CREATE TABLE `tb_prestress_rod`(
 `prestress_rod_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '锚杆ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `type` varchar(128) COMMENT '锚杆的类型：GY型预应力锚杆、普通砂浆锚杆、预应力中空注浆锚杆等',
 `long` float COMMENT '锚杆长度（m）',
 `standard` varchar(128) COMMENT '锚杆规格（文字描述）',
 `dis` float COMMENT '布置间距（m）',
 `prestress` float COMMENT '锚杆预应力（KN）',
 `diameter` float COMMENT '锚杆直径(mm)',
 `loc_info` varchar(128) COMMENT '锚杆位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`prestress_rod_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='锚杆属性表';

-- ----------------------------
-- Records of tb_prestress_rod
-- ----------------------------
INSERT INTO `tb_prestress_rod` VALUES ('1', '1', 'GY型预应力锚杆', '100', '规格多少？', '10', '50', '20', '中间', null, null, '2016-06-06 18:00:52');
INSERT INTO `tb_prestress_rod` VALUES ('2', '2', '预应力中空注浆锚杆', '200', '不清楚', '20', '50', '20', '位置', null, null, '2016-06-06 18:39:16');

/*Table structure for table `tb_bag` */

drop table if exists `tb_bag`;
CREATE TABLE `tb_bag`(
 `bag_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '生态袋ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `standard` varchar(128) COMMENT '规格',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`bag_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='生态袋属性表';

-- ----------------------------
-- Records of tb_bag
-- ----------------------------
INSERT INTO `tb_bag` VALUES ('1', '1', '100千克', '中间', null, null, '2016-06-06 17:54:08');
INSERT INTO `tb_bag` VALUES ('2', '2', 's型', '开始处', null, null, '2016-06-06 17:54:30');

/*Table structure for table `tb_pastewall` */

drop table if exists `tb_pastewall`;
CREATE TABLE `tb_pastewall`(
 `pastewall_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '浆砌挡墙ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `hign` float COMMENT '挡墙高度(m)',
 `ratio` float COMMENT '挡墙坡率（1:n）填写示例中为n值',
 `top_width` float COMMENT '顶宽(m)',
 `bottom_width` float COMMENT '底宽(m)',
 `loc_info` varchar(128) COMMENT '位置(文字描述)',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '现场图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`pastewall_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='浆砌挡墙属性表';

-- ----------------------------
-- Records of tb_pastewall
-- ----------------------------
INSERT INTO `tb_pastewall` VALUES ('1', '2', '2', '3', '0.5', '0.8', '位置100', null, null, '2016-06-06 18:04:25');
INSERT INTO `tb_pastewall` VALUES ('2', '1', '2', '3', '0.2', '0.5', '位置200', null, null, '2016-06-06 18:04:45');


/*Table structure for table `tb_wall` */

drop table if exists `tb_wall`;
CREATE TABLE `tb_wall`(
 `wall_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '护面墙ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `type` varchar(128) COMMENT '类型',
 `thick` float COMMENT '厚度（cm）',
 `hign` float COMMENT '高度（m）',
 `ratio` float COMMENT '坡率（1：n）填写示例中为n值',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`wall_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='护面墙属性表';

-- ----------------------------
-- Records of tb_wall
-- ----------------------------
INSERT INTO `tb_wall` VALUES ('1', '1', '类型一', '10', '200', '2', '靠外', null, null, '2016-06-06 18:03:14');
INSERT INTO `tb_wall` VALUES ('2', '2', '类型二', '20', '200', '2', '靠里', null, null, '2016-06-06 18:03:39');

/* UNUSED****************************************************************************************************************/

/*Table structure for table `tb_alarm_model` */

DROP TABLE IF EXISTS `tb_alarm_model`;
CREATE TABLE `tb_alarm_model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '报警模式ID',
  `model_name` varchar(16) NOT NULL COMMENT '报警模式名称',
  `description` varchar(128) NOT NULL COMMENT '描述',
  `flag` varchar(128) DEFAULT NULL COMMENT '指针',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='报警模式表';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
