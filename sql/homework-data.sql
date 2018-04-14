/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : homework

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-11 23:14:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for work_admin
-- ----------------------------
DROP TABLE IF EXISTS `work_admin`;
CREATE TABLE `work_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `num` varchar(20) NOT NULL DEFAULT '' COMMENT '工号',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '密码加密码',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `email` varchar(20) NOT NULL DEFAULT '' COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1正常 0删除 2禁用',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_admin
-- ----------------------------
INSERT INTO `work_admin` VALUES ('1', '0200753025', '程零儿', '3993a05d83718bac2049649aea3c49ba', '3643', '15976021214', '286863096@qq.com', '1', '1521725536', '1521951698');
INSERT INTO `work_admin` VALUES ('2', '0200753026', '张三', '69afe7ecdf8664d4080f445fe7c1d350', '2237', '13528111342', '12aa@qq.com', '1', '1521726936', '1521951675');
INSERT INTO `work_admin` VALUES ('3', 'superadmin', '程程', '3993a05d83718bac2049649aea3c49ba', '3643', '15976021214', '286863096@qq.com', '1', '1521725536', '1521951698');

-- ----------------------------
-- Table structure for work_answer
-- ----------------------------
DROP TABLE IF EXISTS `work_answer`;
CREATE TABLE `work_answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `homework_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL DEFAULT '0',
  `answerimage` varchar(20) NOT NULL DEFAULT '效果图.png',
  `answerurl` varchar(30) NOT NULL DEFAULT 'index.html',
  `remark` text NOT NULL DEFAULT '',
  `score` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `up` int(11) NOT NULL DEFAULT '0',
  `down` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `homework_id` (`homework_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_answer
-- ----------------------------
INSERT INTO `work_answer` VALUES ('1', '1', '2', '效果图.png', 'index.html', '', '0', '', '0', '0', '1', '1523112613', '1523112613');
INSERT INTO `work_answer` VALUES ('2', '1', '2', '效果图.png', 'index.html', '', '0', '', '0', '0', '1', '1523112882', '1523112882');

-- ----------------------------
-- Table structure for work_course
-- ----------------------------
DROP TABLE IF EXISTS `work_course`;
CREATE TABLE `work_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `teacher_id` int(11) NOT NULL DEFAULT '0',
  `grade_id` int(11) NOT NULL DEFAULT '0',
  `remark` text not null DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `grade_id` (`grade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_course
-- ----------------------------
INSERT INTO `work_course` VALUES ('1', '网页设计与制作', '1517414400', '1544716800', '1', '1', '网页设计', '1', '1521989621', '1521989621');
INSERT INTO `work_course` VALUES ('2', 'photoshop', '1519833600', '1556208000', '3', '3', 'photoshop', '1', '1522501152', '1522501152');
INSERT INTO `work_course` VALUES ('3', 'js框架', '1519833600', '1544112000', '4', '3', 'js技术框架', '1', '1522501346', '1522501346');

-- ----------------------------
-- Table structure for work_grade
-- ----------------------------
DROP TABLE IF EXISTS `work_grade`;
CREATE TABLE `work_grade` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `depart` varchar(20) NOT NULL DEFAULT '信息工程学院',
  `remark` text not null DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_grade
-- ----------------------------
INSERT INTO `work_grade` VALUES ('1', '17软件1班', '信息工程学院', '17软件1班的基本情况', '1', '1521767587', '1521767587');
INSERT INTO `work_grade` VALUES ('2', '16软件1班', '信息工程学院', '16软件1班的基本情况', '1', '1521767613', '1521767613');
INSERT INTO `work_grade` VALUES ('3', '17软件2班', '信息工程学院', '17软件2班的基本情况', '1', '1522500468', '1522500468');

-- ----------------------------
-- Table structure for work_homework
-- ----------------------------
DROP TABLE IF EXISTS `work_homework`;
CREATE TABLE `work_homework` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `demo` varchar(20) NOT NULL DEFAULT '效果图.png',
  `demohelp` varchar(20) NOT NULL DEFAULT '素材.zip',
  `demourl` varchar(30) NOT NULL DEFAULT 'index.html',
  `demoimage` varchar(20) NOT NULL DEFAULT 'image.html',
  `remark` text NOT NULL DEFAULT '',
  `answer` varchar(20) NOT NULL DEFAULT '参考答案.zip',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `course_id` int(11) NOT NULL DEFAULT '0',
  `teacher_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_homework
-- ----------------------------
INSERT INTO `work_homework` VALUES ('1', '网页基本标签练习', '效果图.png', '素材.zip', 'index.html', 'image.html', '做个页面', '参考答案.zip', '1522944000', '1524758400', '1', '1', '1', '1523022913', '1523022913');
INSERT INTO `work_homework` VALUES ('2', 'css入门练习', '效果图.png', '素材.zip', 'index.html', 'image.html', 'css练习', '参考答案.zip', '1522771200', '1524844800', '1', '1', '1', '1523023478', '1523023478');

-- ----------------------------
-- Table structure for work_notice
-- ----------------------------
DROP TABLE IF EXISTS `work_notice`;
CREATE TABLE `work_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `content` text NOT NULL DEFAULT '',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_notice
-- ----------------------------
INSERT INTO `work_notice` VALUES ('1', '惹味认为', '&amp;lt;div style=&amp;quot;text-align: center;&amp;quot;&amp;gt;嗡嗡嗡惹我&amp;lt;/div&amp;gt;', '1', '1', '1521821247', '1521821247');
INSERT INTO `work_notice` VALUES ('2', '&lt;h1&gt;t443&lt;/h1&gt;', '&amp;lt;div style=&amp;quot;text-align: center;&amp;quot;&amp;gt;我要居中&amp;lt;/div&amp;gt;', '1', '1', '1521821333', '1521821333');

-- ----------------------------
-- Table structure for work_student
-- ----------------------------
DROP TABLE IF EXISTS `work_student`;
CREATE TABLE `work_student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `num` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `code` varchar(10) NOT NULL DEFAULT '',
  `depart` varchar(20) NOT NULL DEFAULT '信息工程学院',
  `major` varchar(20) NOT NULL DEFAULT '软件技术',
  `grade_id` int(11) NOT NULL DEFAULT '0',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `num` (`num`),
  KEY `grade_id` (`grade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_student
-- ----------------------------
INSERT INTO `work_student` VALUES ('1', '10086001', '阮小仪', 'a5346f9fa6817874a670412c1da43228', '2960', '信息工程学院', '软件技术', '2', '10086', '10086@qq.com', '1', '1521909037', '1521909037');
INSERT INTO `work_student` VALUES ('2', '10086002', '阮小二', '76ec7f00e2b19cca4ba5ecba8a87646c', '7057', '信息工程学院', '', '1', '1000', '100@qq.com', '1', '1521961244', '1521961244');
INSERT INTO `work_student` VALUES ('3', '10086003', '阮小三', '2b4422f9a8032911f9e70198758c1c8a', '2269', '信息工程学院', '', '1', '1100', '1100@qq.com', '1', '1521961536', '1521961536');
INSERT INTO `work_student` VALUES ('5', '1002', '张二1', '54d554d9de79457e7b6832df64115dfe', '4344', '信息工程学院', '2', '2', '', '2@q.com', '1', '1522252454', '1522252454');
INSERT INTO `work_student` VALUES ('6', '1003', '张三1', '7771bfa197b8ab688f81433d52a69035', '5950', '信息工程学院', '', '2', '1232433', '', '1', '1522252454', '1522252454');
INSERT INTO `work_student` VALUES ('7', '1004', '张四1', 'e3aa7c9309bd6d40c9ce7a417e2f3f58', '5107', '信息工程学院', '', '2', '1232434', '4@q.com', '1', '1522252454', '1522252454');
INSERT INTO `work_student` VALUES ('8', '1005', '张一5', 'c53ab7dc766fbc7d34eb563b678af66c', '5523', '信息工程学院', '', '1', '43434', '1@q.com', '1', '1522414320', '1522414320');
INSERT INTO `work_student` VALUES ('9', '1006', '张二6', '4e3026064c82cb18d508c5748f0531de', '1726', '信息工程学院', '2', '1', '', '2@q.com', '1', '1522414320', '1522414320');
INSERT INTO `work_student` VALUES ('10', '1007', '张三7', '8f43fda9dbf656127cc3a461df4f6179', '162', '信息工程学院', '', '1', '1232433', '', '1', '1522414320', '1522414320');
INSERT INTO `work_student` VALUES ('11', '1008', '张四8', 'eb7cc5f2b1e6066166f08b97d719d134', '8741', '信息工程学院', '', '1', '1232434', '4@q.com', '1', '1522414320', '1522414320');

-- ----------------------------
-- Table structure for work_teacher
-- ----------------------------
DROP TABLE IF EXISTS `work_teacher`;
CREATE TABLE `work_teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `num` varchar(20) NOT NULL DEFAULT '' COMMENT '工号',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '密码加密码',
  `depart` varchar(20) NOT NULL DEFAULT '信息工程学院' COMMENT '所在部门',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_teacher
-- ----------------------------
INSERT INTO `work_teacher` VALUES ('1', '0200753025', '程程', '638a2412145c05c3f0a0730a98cf0a07', '189', '信息工程学院', '10086', '10086@qq.com', '1', '1521733156', '1521733156');
INSERT INTO `work_teacher` VALUES ('2', '0200753028', '李四', '57446aa3aee3adffd50763a47037c519', '4326', '艺术设计学院', '1000', '1000@qq.com', '1', '1521733207', '1521733207');
INSERT INTO `work_teacher` VALUES ('3', '0200753029', '晓玖', '7abd9ce3b76a447644884a97bb9ff665', '579', '信息工程学院', '009', '', '1', '1522492401', '1522492401');
INSERT INTO `work_teacher` VALUES ('4', '0200753030', '小诗', 'd48bb1240ec90229f97f06fa891e73f7', '1477', '信息工程学院', '', '', '1', '1522492464', '1522492464');
INSERT INTO `work_teacher` VALUES ('5', '0200753001', '小一', 'b0024f3a949e2f9636e738d9fe8c7bbc', '2942', '信息工程学院', '', '', '1', '1522492485', '1522492485');
INSERT INTO `work_teacher` VALUES ('6', '0200753002', '小二', '541afc79439d1ddb441a270f2ee3947f', '1028', '信息工程学院', '', '', '1', '1522492506', '1522492506');
