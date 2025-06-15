create database db_test
with
    owner postgres;

alter user postgres
with
    password 'postgres';
