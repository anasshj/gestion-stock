create database stock;
use stock ;
create table produits(
id int  primary key auto_increment  unique ,
nom varchar(50),
description varchar(25),
prix double  ,
quantite int 
)

