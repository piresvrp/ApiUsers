create database api;
use api;
create table users(
    id int primary key,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) null);