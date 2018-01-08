create database annot_user;

use annot_user;

create table array_info
(array_id integer NOT NULL auto_increment,
 user_name text,
 user_description text,
 filename text,
 type text,
 blockcount integer,
 blocktype text,
 url text,
 supplier text,
 array_name text,
 primary key(array_id));

create table array_reporter
(array_id integer NOT NULL,
 reporter_id integer NOT NULL auto_increment,
 block integer,
 array_column integer,
 array_row integer,
 name text,
 gal_id text,
 ref_number text,
 control_type text,
 gene_name text,
 top_hit text,
 description text,
 key(array_id),
 primary key(reporter_id));
