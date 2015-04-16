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
);

create table if not exists {{{prefix}}}albums (
  id bigint(1) not null auto_increment,
  title text,
  image text,
  pubyear smallint(4),
  artist_id bigint(1),
  date_created datetime,
  date_modified datetime,
  primary key (id)
);

create table if not exists {{{prefix}}}songs (
  id bigint(1) not null auto_increment,  
  title text,
  track_no tinyint(1),
  album_id bigint(1),
  date_created datetime,
  date_modified datetime,
  primary key (id)
);

# Artists

insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (158120, 'Ratatat', 'Ratatat is a New York City experimental electronic rock duo consisting of Mike Stroud (guitar, melodica, synthesizers, percussion) and producer Evan Mast (bass, synthesizers, percussion).', 'artists/ratatat.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (246650, 'Grateful Dead, The', 'The Grateful Dead was an American rock band formed in 1965 in Palo Alto, California. The band was known for its unique and eclectic style, which fused elements of rock, folk, bluegrass, blues, reggae, country, improvisational jazz, psychedelia, and space rock, and for live performances of long musical improvisation.', 'artists/grateful-dead.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (81013, 'Queen', 'Queen are a British rock band formed in London in 1970, originally consisting of Freddie Mercury (lead vocals, piano), Brian May (guitar, vocals), John Deacon (bass guitar), and Roger Taylor (drums, vocals). Queen\'s earliest works were influenced by progressive rock, hard rock and heavy metal, but the band gradually ventured into more conventional and radio-friendly works, incorporating further diverse styles into their music.', 'artists/queen.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (82730, 'Beatles The', 'The Beatles were an English rock band that formed in Liverpool in 1960. With members John Lennon, Paul McCartney, George Harrison and Ringo Starr, they became widely regarded as the greatest and most influential act of the rock era. Rooted in skiffle, beat and 1950s rock and roll, the Beatles later experimented with several genres, ranging from pop ballads and Indian music to psychedelic and hard rock, often incorporating classical elements in innovative ways.', 'artists/beatles.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (67156, 'Flaming Lips', 'The Flaming Lips are an American rock band formed in Oklahoma City, Oklahoma in 1983. Instrumentally, their sound contains lush, multi-layered, psychedelic rock arrangements, but lyrically their compositions show elements of space rock, including unusual song and album titles.', 'artists/flaming-lips.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (253281, 'NOFX', 'NOFX is an American punk rock band from Berkeley (later relocating to Los Angeles, California).[5] The band was formed in 1983 by vocalist/bassist Fat Mike and guitarist Eric Melvin.[5] Drummer Erik Sandin joined NOFX shortly after. In 1991, El Hefe joined to play lead guitar and trumpet, rounding out the current line-up. The band rose to popularity with their fifth studio album Punk in Drublic (1994).', 'artists/nofx.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (1289, 'Daft Punk', 'Daft Punk is a French electronic music duo consisting of musicians Guy-Manuel de Homem-Christo and Thomas Bangalter. Daft Punk reached significant popularity in the late 1990s house movement in France and met with continued success in the years following, combining elements of house with synthpop.', 'artists/daft-punk.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (10263, 'David Bowie', 'David Bowie (born David Robert Jones, 8 January 1947) is an English singer, songwriter, multi-instrumentalist, record producer, arranger, and actor. He is also a painter and collector of fine art. Bowie, has been a major figure in the world of popular music for over four decades, and is renowned as an innovator, particularly for his work in the 1970s. He is known for his distinctive voice as well as the intellectual depth and eclecticism of his work. Aside from his musical abilities, he is recognised for his androgynous beauty, which was an iconic element to his image, particularly in the 1970s and 1980s.', 'artists/david-bowie.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (50183, 'Ween', 'Ween was an American experimental rock band from New Hope, Pennsylvania that formed in 1984. The key members were vocalist and songwriter Aaron Freeman (a.k.a. Gene Ween) and guitarist Mickey Melchiondo Jr. (a.k.a. Dean Ween), and the two performed as a duo backed by a Digital Audio Tape for the band\'s first ten years of existence before expanding to a four (and later five) piece act.', 'artists/ween.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (110593, 'Jimi Hendrix', 'James Marshall "Jimi" Hendrix (born Johnny Allen Hendrix; November 27, 1942 - September 18, 1970) was an American musician, guitarist, singer, and songwriter. Although his mainstream career spanned only four years, he is widely regarded as one of the most influential electric guitarists in the history of popular music, and one of the most celebrated musicians of the 20th century.', 'artists/jimi-hendrix.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (252354, 'Phish', 'Phish is an American rock band noted for their musical improvisation, extended jams, blending of musical genres, and dedicated fan base. Formed at the University of Vermont in 1983, the band\'s four members- Trey Anastasio (guitars, lead vocals), Mike Gordon (bass, vocals), Jon Fishman (drums, percussion, vacuum, vocals), and Page McConnell (keyboards, vocals)- performed together for nearly 20 years before going on hiatus in August 2004. They reunited in March 2009 and have since resumed performing regularly. Phish\'s music blends elements of a wide variety of genres, including rock, progressive rock, psychedelic rock, hard rock, funk, folk and blues.', 'artists/phish.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (251595, 'Iron Maiden', 'Iron Maiden are an English heavy metal band formed in Leyton, east London, in 1975 by bassist and primary songwriter Steve Harris. The band\'s discography has grown to thirty-seven albums, including fifteen studio albums, eleven live albums, four EPs, and seven compilations.', 'artists/iron-maiden.jpg', now(), now());

# Ratatat Albums ##################################

insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (121826, 'Ratatat', 'albums/121826.jpg', 2004, 158120, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (121827, 'Classics', 'albums/121827.jpg', 2006, 158120, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (121831, 'LP3', 'albums/121831.jpg', 2008, 158120, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (264782, 'LP4', 'albums/264782.jpg', 2010, 158120, now(), now());

# Ratatat Songs ###################################

insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Seventeen Years', 1, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('El Pico', 2, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Crips', 3, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Desert Eagle', 4, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Everest', 5, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Bustelo', 6, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Breaking Away', 7, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Lapland', 8, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Germany To Germany', 9, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Spanish Armada', 10, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Cherry', 11, 121826, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Montanita', 1, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Lex', 2, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Gettysburg', 3, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Wildcat', 4, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Tropicana', 5, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Loud Pipes', 6, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Kennedy', 7, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Swisha', 8, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Nostrand', 9, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Tacobel Canon', 10, 121827, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Shiller', 1, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Falcon Jab', 2, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Mi Viejo', 3, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Mirando', 4, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Flynn', 5, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Bird-Priest', 6, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Shempi', 7, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Imperials', 8, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Dura', 9, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('BruleÃ©', 10, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Mumtaz Khan', 11, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Gipsy Threat', 12, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Black Heroes', 13, 121831, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Bilar', 1, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Drugs', 2, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Neckbrace', 3, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('We Can\'t Be Stopped', 4, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Bob Gandhi', 5, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Mandy', 6, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Mahalo', 7, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Party With Children', 8, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Sunblocks', 9, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Bare Feast', 10, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Grape Juice City', 11, 264782, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Alps', 12, 264782, now(), now());
  
  