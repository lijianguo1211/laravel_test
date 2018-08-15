/*添加user表字段*/
alter table `ui_user` add `user_img` varchar(100) not null default 1 comment '用户上传头像';
alter table `ui_user` add `user_key` varchar(5) not null default 1 comment '用户加密密钥';
alter table `ui_user` add `user_updatetime` timestamp not null default '0000-00-00 00:00:00' comment '用户修改时间';