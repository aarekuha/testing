drop table if exists `#__test_documents`;
create table if not exists `#__test_documents`
(
    `id`        int(5) unsigned NOT NULL AUTO_INCREMENT,
    `name`      varchar(255)    NOT NULL,
    `value`     varchar(255)    NOT NULL,
    primary key (`id`)
) engine=innodb;

drop table if exists `#__test_questions`;
create table if not exists `#__test_questions`
(
    `id`            int(5) unsigned NOT NULL AUTO_INCREMENT,
    `document_id`   int(5) unsigned NOT NULL,
    `answers`       text,
    `question`      text,
    `type`          tinyint(1) default '2',
    primary key (`id`)
) engine=innodb;

drop table if exists `#__test_users`;
create table if not exists `#__test_users`
(
    `id`        int(5) unsigned NOT NULL AUTO_INCREMENT,
    `fio`       varchar(255),
    `email`     varchar(255),
    `password`  varchar(255),
    `token`     varchar(20),
    primary key (`id`)
) engine=innodb;

drop table if exists `#__test_users_tickets`;
create table if not exists `#__test_users_tickets`
(
    `id`            int(5) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`       int(5) unsigned NOT NULL,
    `rating`        tinyint(1) default '0',
    `status`        tinyint(1) default '0',
    primary key (`id`)
) engine=innodb;

drop table if exists `#__test_users_answers`;
create table if not exists `#__test_users_answers`
(
    `id`                int(5) unsigned NOT NULL AUTO_INCREMENT,
    `users_ticket_id`   int(5) unsigned NOT NULL,
    `question_id`       int(5) unsigned NOT NULL,
    `answer`            text,
    `rating`            tinyint(1) default '0',
    primary key (`id`)
) engine=innodb;


