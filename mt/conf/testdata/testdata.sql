drop table if exists {{{prefix}}}artists;
drop table if exists {{{prefix}}}albums;
drop table if exists {{{prefix}}}songs;

create table if not exists {{{prefix}}}artists (
  id bigint(1) not null auto_increment,
  name text,
  description text,
  image text,
  date_created datetime,
  date_modified datetime,
  primary key (id)
) auto_increment = 1000;

create table if not exists {{{prefix}}}albums (
  id bigint(1) not null auto_increment,
  title text,
  image text,
  year smallint(4),
  date_created datetime,
  date_modified datetime,
  primary key (id)
) auto_increment = 1000;

create table if not exists {{{prefix}}}songs (
  id bigint(1) not null auto_increment,
  title text,
  track_no tinyint(1),
  album_id bigint(1),
  date_created datetime,
  date_modified datetime,
  primary key (id)
) auto_increment = 1000;