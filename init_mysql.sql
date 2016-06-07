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
	(1,'首页',0,1,'manage','index','0','home','10'),
	(2,'项目-边坡查询',0,1,'project','index','0','globe','10'),
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
  `Road_Name` varchar(128) NOT NULL COMMENT '项目施工高速名称',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='项目信息表';


/*Table structure for table `tb_project_type` */

DROP TABLE IF EXISTS `tb_project_type`;
CREATE TABLE `tb_project_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `type_name` varchar(64) NOT NULL DEFAULT 'type' COMMENT '类型名称',
  `flag` int(11) NOT NULL DEFAULT '0' COMMENT '指针',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='项目类型表';


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
INSERT INTO `tb_project_user` values (3, 1, 2, 0, '2011-01-01');
INSERT INTO `tb_project_user` values (4, 2, 3, 0, '2011-01-01');

/* SLOP****************************************************************************************************************/

/*Table structure for table `tb_slop_info` */

DROP TABLE IF EXISTS `tb_slop_info`;
CREATE TABLE `tb_slop_info` (
  `slop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '边坡ID',
  `slop_name` varchar(64) NOT NULL COMMENT '边坡名称',
  `slop_description` varchar(256) DEFAULT NULL COMMENT '边坡描述',
  `slop_type_id` int(11) COMMENT '边坡形态ID',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间（边坡建造时间）',
  `position_char` varchar(128) DEFAULT NULL COMMENT '位置描述',
  `position_x` varchar(16) DEFAULT '0' COMMENT '坐标',
  `position_y` varchar(16) DEFAULT '0' COMMENT '坐标',
  `alarm_model` int(16) DEFAULT '0' COMMENT '报警模式',
  `slop_type` int(16) DEFAULT '0' COMMENT '边坡类型',
  `env_id` int(16) DEFAULT '0' COMMENT '环境属性ID',
  `disease_id` int(16) DEFAULT '0' COMMENT '病害属性ID',
  `subroadname` varchar(128) DEFAULT '0' COMMENT '所属路段',
  `stake_bg` varchar(128) COMMENT '起始桩号',
  `stake_end` varchar(128) COMMENT '终止桩号',  
  `longtitude` varchar(64) DEFAULT NULL COMMENT '经度（中心位置的经度（°））',
  `latitude` varchar(64) DEFAULT NULL COMMENT '纬度（中心位置的纬度（°））',
  `altitude` varchar(64) DEFAULT NULL COMMENT '海拔（中心位置的高度(m)）',
  `strength_info` varchar(64) DEFAULT NULL COMMENT '强度信息（边坡整体加固描述）',
  `design_picture_path` varchar(128) DEFAULT NULL COMMENT '设计图路径',
  `3d_picture_path` varchar(128) DEFAULT NULL COMMENT '3D图路径',
  `sendset_3d` varchar(128) COMMENT '边坡仪器安装动画（一个链接）',
  `Maintance_Pic` varchar(128) COMMENT '边坡养护图片',
  `Build_Pic` varchar(128) COMMENT '边坡施工图片',
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


/*Table structure for table `tb_customer` */

DROP TABLE IF EXISTS `tb_customer`;
CREATE TABLE `tb_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户ID',
  `project_id` int(16) NOT NULL COMMENT '项目ID',
  `user_name` varchar(128) NOT NULL COMMENT '客户名称',
  `flag` varchar(128) DEFAULT NULL COMMENT '指针',
  `cust_name` varchar(128) COMMENT '联系人',
  `addr` varchar(128) COMMENT '地址',
  `mbphone` varchar(64) NOT NULL COMMENT '移动电话',
  `Tel` varchar(128) DEFAULT NULL COMMENT '固定电话',
  `fax` varchar(128) DEFAULT NULL COMMENT '传真',
  `OtherContact` varchar(128) DEFAULT NULL COMMENT '其它联系方式',
  `Tax_Num` varchar(128) COMMENT '税号',
  `E-mail` varchar(128) DEFAULT NULL COMMENT '电子邮箱',
  `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='项目客户表';


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

/*Table structure for table `tb_anchor` */

drop table if exists `tb_anchor`;
CREATE TABLE `tb_anchor`(
 `anchor_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '锚喷ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `thick` float COMMENT '厚度数据(cm)',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT '该锚喷的图片信息',
 `live_pic` varchar(128) COMMENT '现场照片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`anchor_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='锚喷属性表';

/*Table structure for table `tb_bag` */

drop table if exists `tb_bag`;
CREATE TABLE `tb_bag`(
 `bag_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '生态袋ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `standard` varchar(128) COMMENT '规格',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`bag_ID`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='生态袋属性表';


/*Table structure for table `tb_break` */

drop table if exists `tb_break`;
CREATE TABLE `tb_break` (
 `break_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '断面ID',
 `slop_id` int(11) NOT NULL COMMENT '边坡ID',      
 `type` varchar (128) NOT NULL COMMENT '断面类型：工程地质断面、监测断面',
 `Start_Stake` varchar(128) COMMENT '该断面的里程桩号',
 `info` varchar(128) COMMENT '断面描述',
 `pic` varchar(128) COMMENT '断面图片',
 `Break_Serial` int(11) COMMENT '断面级数（级）',
 `Rock_Num` int(11) COMMENT '岩层数量(层)',
 `Joint_Num` int(11) COMMENT '节理数量（个）',
 `Creak_Num` int(11) COMMENT '裂隙数量（个）',
 `Fault_Num` int(11) COMMENT '断层数量（个）',
 `Water_Point` int(11) COMMENT '地下水位点位数（个）',
 `water_info` varchar(128) COMMENT '地下水位文字描述',
 `form` int(11) COMMENT '该断面的边坡形态(n级边坡)',
 `geo_struct` varchar(128) COMMENT '该断面的地质构造',
 `Strength_Info` varchar(128) COMMENT '该断面的加固设计描述',
 `Loc_X` float COMMENT '中心位置（相对于边坡中心）',
 `Loc_Y` float COMMENT '中心位置',
 `Loc_Z` float COMMENT '中心位置',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`break_id`)
 )ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='断面信息表';

/*Table structure for table `tb_break_serial` */

drop table if exists `tb_break_serial`;
CREATE TABLE `tb_break_serial`(
 `BkSerial_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '坡面级数ID（通过其寻找加固详情）',
 `Break_ID` int(11) NOT NULL COMMENT '断面ID', 
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
 `Loc_X` float COMMENT '中心位置',
 `Loc_Y` float COMMENT '中心位置',
 `Loc_Z` float COMMENT '中心位置',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`BkSerial_ID`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='N级坡面信息表';

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
  `sen_ID` int(11) NOT NULL COMMENT '传感器ID',
  `project_id` int(11) COMMENT '项目ID',
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



/*Table structure for table `tb_pastewall` */

drop table if exists `tb_pastewall`;
CREATE TABLE `tb_pastewall`(
 `pastewall_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '浆砌挡墙ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `hign` float COMMENT '挡墙高度(m)',
 `ratio` float COMMENT '挡墙坡率（1:n）填写示例中为n值',
 `top_width` float COMMENT '顶宽(m)',
 `bottom_width` float COMMENT '底宽(m)',
 `loc_info` varchar(128) COMMENT '位置(文字描述)',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '现场图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`pastewall_ID`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='浆砌挡墙属性表';


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



/*Table structure for table `tb_sensor_base` */

drop table if exists `tb_sensor_base`;
CREATE TABLE `tb_sensor_base`(
 `sen_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '传感器ID',
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
 PRIMARY KEY (`sen_ID`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='传感器基本信息表';



/*Table structure for table `tb_sns` */

drop table if exists `tb_sns`;
CREATE TABLE `tb_sns`(
 `sns_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT ' SNS主动柔性网属性ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `type` varchar(128) COMMENT '类型：GPS2型，GSS2A型，GQS型，GTS型，GS2R型',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片该柔性网的图片信息',
 `live_pic` varchar(128) COMMENT '现场照片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`sns_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='sns主动柔性网属性表';

/*Table structure for table `tb_thick` */

drop table if exists `tb_thick`;
CREATE TABLE `tb_thick`(
 `thick_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '厚层基材ID',
 `bkserial_id` int(11) COMMENT '第N级坡面ID',
 `thick` float COMMENT '厚度数据(mm)',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT '图片信息',
 `live_pic` varchar(128) COMMENT '现场照片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`thick_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='厚层基材属性表';


/*Table structure for table `tb_wall` */

drop table if exists `tb_wall`;
CREATE TABLE `tb_wall`(
 `wall_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '护面墙ID ',
 `bkserial_id` int(11) COMMENT '第N级坡面ID ',
 `type` varchar(128) COMMENT '类型',
 `thick` float COMMENT '厚度（cm）',
 `hign` float COMMENT '高度（m）',
 `ratio` float COMMENT '坡率（1：n）填写示例中为n值',
 `loc_info` varchar(128) COMMENT '位置（文字描述）',
 `cad_pic` varchar(128) COMMENT ' CAD设计图片',
 `live_pic` varchar(128) COMMENT '图片',
 `update_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`wall_ID`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='护面墙属性表';



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
