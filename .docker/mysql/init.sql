/** DATABASES */
CREATE DATABASE IF NOT EXISTS `auth`;

CREATE DATABASE IF NOT EXISTS `atenea`;

    /** GRANTS */
CREATE USER 'root'@'%' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON `auth`.* TO 'root'@'%';
GRANT ALL PRIVILEGES ON `atenea`.* TO 'root'@'%';





-- create table author
-- (
--     id       int auto_increment
--         primary key,
--     name     varchar(50)  not null,
--     username varchar(70)  not null,
--     website  varchar(255) not null,
--     email    varchar(255) not null
-- );
--
-- create table post
-- (
--     id        int auto_increment
--         primary key,
--     title     varchar(100)   not null,
--     content   varchar(10000) null,
--     author_id int            not null,
--     constraint post_author_id_fk
--         foreign key (author_id) references author (id)
-- );

