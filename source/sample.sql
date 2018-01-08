
create table user
(login varchar(20),
 password varchar(20)
);

insert into user (login,password) values('ripoche','foo');
insert into user (login,password) values('ugf','igr2002');

select *
from annot.user as au, projet.utilisateur as pu
where au.login = pu.utilisateur;

create table query
(name varchar(20),
 query text);

#//////////////////////////////////////////////////////////////

create table db_set
(id integer auto_increment not null,
 name varchar(30),
 description varchar(100),
 primary key(id),
 unique(name)
);
insert into db_set(name,description) values ("set1","premier set");
insert into db_set(name,description) values ("set2","deuxieme set");
insert into db_set(name,description) values ("set3","troisieme set");

create table db_gene
(
 id integer auto_increment not null,
 symbol varchar(10),
 description varchar(100),
 location varchar(10),
 primary key(id),
 unique(symbol)
);

create table db_set_gene
(
 id integer auto_increment not null,
 primary key(id),
 foreign key(id) references db_gene,
 foreign key(id) references db_set
);
