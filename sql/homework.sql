#管理员表
create table `work_admin`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`num` varchar(20) not null default '' COMMENT '工号',
`username` varchar(20) not null default  '' COMMENT '姓名',
`password` varchar(32) not null default '' COMMENT '密码',
`code` varchar(10) not null default ''  COMMENT '密码加密码',
`tel` varchar(20) not null default '' COMMENT '电话',
`email` varchar(20) not null default '' COMMENT '邮箱',
`status` tinyint(1)  not null default 1  COMMENT '状态 1正常 0删除 2禁用',
`create_time` int(11)  unsigned not null default 0  COMMENT '创建时间',
`update_time` int(11)  unsigned not null default 0  COMMENT '更新时间',
primary key(`id`),
unique key num(`num`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#教师表
create table `work_teacher`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`num` varchar(20) not null default '' COMMENT '工号',
`username` varchar(20) not null default '' COMMENT '姓名',
`password` varchar(32) not null default '' COMMENT '密码',
`code` varchar(10) not null default ''  COMMENT '密码加密码',
`depart` varchar(20) not null default '信息工程学院'   COMMENT '所在部门',
`tel` varchar(20) not null default '',
`email` varchar(20) not null default '',
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
unique key num(`num`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#班级表
create table `work_grade`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`name` varchar(20) not null default '',
`depart` varchar(20) not null default '信息工程学院',
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
unique key name(`name`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#课程表
create table `work_course`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`name` varchar(20) not null default '',
`start_time` int(11) not null default 0,
`end_time` int(11) not null default 0,
`teacher_id` int(11) not null default 0,
`grade_id` int(11) not null default 0,
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
key teacher_id(`teacher_id`),
key grade_id(`grade_id`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#学生表
create table `work_student`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`num` varchar(20) not null default '',
`username` varchar(20) not null default '',
`password` varchar(32) not null default '',
`code` varchar(10) not null default '',
`depart` varchar(20) not null default '信息工程学院',
`major` varchar(20) not null default '软件技术',
`grade_id` int(11) not null default 0,
`tel` varchar(20) not null default '',
`email` varchar(20) not null default '',
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
unique key num(`num`),
key grade_id(`grade_id`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#公告
create table `work_notice`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`name` varchar(50) not null default '',
`content` text not null default '',
`admin_id` int(11) not null default 0,
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
key admin_id(`admin_id`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#作业表
create table `work_homework`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`name` varchar(20) not null default '',
`demo` varchar(20) not null default '效果图.png',
`demohelp` varchar(20) not null default '素材.zip',
`demourl` varchar(30) not null default 'index.html',
`demoimage` varchar(20) not null default 'image.html',
`remark` text not null default '',
`answer` varchar(20) not null default '参考答案.zip',
`start_time` int(11) not null default 0,
`end_time` int(11) not null default 0,
`course_id` int(11) not null default 0,
`teacher_id` int(11) not null default 0,
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
key teacher_id(`teacher_id`),
key course_id(`course_id`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;

#学生答案
create table `work_answer`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`homework_id` int(11) not null default 0,
`student_id` int(11) not null default 0,
`answerimage` varchar(20) not null default '效果图.png',
`answerurl` varchar(30) not null default 'index.html',
`remark` text not null default '',
`score` int(11) not null default 0,
`comment` text not null default '',
`up` int(11) not null default 0,
`down` int(11) not null default 0,
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
key homework_id(`homework_id`),
key student_id(`student_id`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;