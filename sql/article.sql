#管理员表
create table `work_admin`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`username` varchar(20) not null default  '' COMMENT '姓名',
`realrname` varchar(20) not null default  '' COMMENT '真实姓名',
`password` varchar(32) not null default '' COMMENT '密码',
`code` varchar(10) not null default ''  COMMENT '密码加密码',
`status` tinyint(1)  not null default 1  COMMENT '状态 1正常 0删除 2私有 3禁用 ',
`create_time` int(11)  unsigned not null default 0  COMMENT '创建时间',
`update_time` int(11)  unsigned not null default 0  COMMENT '更新时间',
primary key(`id`),
unique key username(`username`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;


#用户表
create table `work_author`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`username` varchar(20) not null default  '' COMMENT '姓名',
`realrname` varchar(20) not null default  '' COMMENT '真实姓名',
`password` varchar(32) not null default '' COMMENT '密码',
`code` varchar(10) not null default ''  COMMENT '密码加密码',
`tel` varchar(20) not null default '' COMMENT '电话',
`email` varchar(20) not null default '' COMMENT '邮箱',
`status` tinyint(1)  not null default 1  COMMENT '状态 1正常 0删除 2私有 3禁用 ',
`create_time` int(11)  unsigned not null default 0  COMMENT '创建时间',
`update_time` int(11)  unsigned not null default 0  COMMENT '更新时间',
primary key(`id`),
unique key username(`username`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;


#课程表
create table `work_course`(
`id` int(11) unsigned not null AUTO_INCREMENT,
`title` varchar(50) not null default '',
`author_id` int(11) not null default 0,
`description` varchar(250) not null default '',
`content` text not null default '',
`status` tinyint(1)  not null default 1,
`create_time` int(11)  unsigned not null default 0,
`update_time` int(11)  unsigned not null default 0,
primary key(`id`),
key author_id(`author_id`)
)engine=innodb AUTO_INCREMENT=1 default charset=utf8;
