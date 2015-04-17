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
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (1289, 'Daft Punk', 'Daft Punk is a French electronic music duo consisting of musicians Guy-Manuel de Homem-Christo and Thomas Bangalter. Daft Punk reached significant popularity in the late 1990s house movement in France and met with continued success in the years following, combining elements of house with synthpop.', 'artists/daft-punk.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (246650, 'Grateful Dead, The', 'The Grateful Dead was an American rock band formed in 1965 in Palo Alto, California. The band was known for its unique and eclectic style, which fused elements of rock, folk, bluegrass, blues, reggae, country, improvisational jazz, psychedelia, and space rock, and for live performances of long musical improvisation.', 'artists/grateful-dead.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (81013, 'Queen', 'Queen are a British rock band formed in London in 1970, originally consisting of Freddie Mercury (lead vocals, piano), Brian May (guitar, vocals), John Deacon (bass guitar), and Roger Taylor (drums, vocals). Queen\'s earliest works were influenced by progressive rock, hard rock and heavy metal, but the band gradually ventured into more conventional and radio-friendly works, incorporating further diverse styles into their music.', 'artists/queen.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (82730, 'Beatles The', 'The Beatles were an English rock band that formed in Liverpool in 1960. With members John Lennon, Paul McCartney, George Harrison and Ringo Starr, they became widely regarded as the greatest and most influential act of the rock era. Rooted in skiffle, beat and 1950s rock and roll, the Beatles later experimented with several genres, ranging from pop ballads and Indian music to psychedelic and hard rock, often incorporating classical elements in innovative ways.', 'artists/beatles.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (67156, 'Flaming Lips', 'The Flaming Lips are an American rock band formed in Oklahoma City, Oklahoma in 1983. Instrumentally, their sound contains lush, multi-layered, psychedelic rock arrangements, but lyrically their compositions show elements of space rock, including unusual song and album titles.', 'artists/flaming-lips.jpg', now(), now());
insert into {{{prefix}}}artists (id, name, description, image, date_created, date_modified) values (253281, 'NOFX', 'NOFX is an American punk rock band from Berkeley (later relocating to Los Angeles, California).[5] The band was formed in 1983 by vocalist/bassist Fat Mike and guitarist Eric Melvin.[5] Drummer Erik Sandin joined NOFX shortly after. In 1991, El Hefe joined to play lead guitar and trumpet, rounding out the current line-up. The band rose to popularity with their fifth studio album Punk in Drublic (1994).', 'artists/nofx.jpg', now(), now());
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
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Bruleé', 10, 121831, now(), now());
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

# Daft Punk Albums ##################################

insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (26629, 'Homework', 'albums/26629.jpg', 1997, 1289, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (26961, 'Alive 1997', 'albums/26961.jpg', 2001, 1289, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (26647, 'Discovery', 'albums/26647.jpg', 2001, 1289, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (26833, 'Human After All', 'albums/26833.jpg', 2005, 1289, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (27126, 'Alive 2007', 'albums/27126.jpg', 2007, 1289, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (291615, 'TRON: Legacy (Original Motion Picture Soundtrack)', 'albums/291615.jpg', 2010, 1289, now(), now());
insert into {{{prefix}}}albums (id, title, image, pubyear, artist_id, date_created, date_modified) values (556257, 'Random Access Memories', 'albums/556257.jpg', 2013, 1289, now(), now());

# Daft Punk Songs ##################################

insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Daftendirekt', 1, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Wdpk 83.7 Fm', 2, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Revolution 909', 3, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Da Funk', 4, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Phœnix', 5, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Fresh', 6, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Around The World', 7, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Rollin\' & Scratchin\'', 8, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Teachers', 9, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('High Fidelity', 10, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Rock\'n Roll', 11, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Oh Yeah', 12, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Burnin\'', 13, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Indo Silver Club', 14, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Alive', 15, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Funk Ad', 16, 26629, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Alive 1997', 1, 26961, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('One More Time', 1, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Aerodynamic', 2, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Digital Love', 3, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Harder, Better, Faster, Stronger', 4, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Crescendolls', 5, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Nightvision', 6, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Superheroes', 7, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('High Life', 8, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Something About Us', 9, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Voyager', 10, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Veridis Quo', 11, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Short Circuit', 12, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Face To Face', 13, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Too Long', 14, 26647, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Human After All', 1, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('The Prime Time Of Your Life', 2, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Robot Rock', 3, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Steam Machine', 4, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Make Love', 5, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('The Brainwasher', 6, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('On/Off', 7, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Television Rules The Nation', 8, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Technologic', 9, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Emotion', 10, 26833, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Robot Rock', 1, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Oh Yeah', 2, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Touch It', 3, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Technologic', 4, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Television Rules The Nation', 5, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Crescendolls', 6, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Too Long', 7, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Steam Machine', 8, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Around The World', 9, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Harder Better Faster Stronger', 10, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Burnin\'', 11, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Too Long', 12, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Face To Face', 13, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Short Circuit', 14, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('One More Time', 15, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Aerodynamic', 16, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Aerodynamic Beats', 17, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Forget About The World', 18, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Prime Time Of Your Life', 19, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Brainwasher', 20, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Rollin\' And Scratchin\'', 21, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Alive', 22, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Da Funk', 23, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Daftendirekt', 24, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Superheroes', 25, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Human After All', 26, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Rock\'n Roll', 27, 27126, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Overture', 1, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('The Grid', 2, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('The Son Of Flynn', 3, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Recognizer', 4, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Armory', 5, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Arena', 6, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Rinzler', 7, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('The Game Has Changed', 8, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Outlands', 9, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Adagio For TRON', 10, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Nocturne', 11, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('End Of Line', 12, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Derezzed', 13, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Fall', 14, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Solar Sailer', 15, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Rectifier', 16, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Disc Wars', 17, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('C.L.U.', 18, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Arrival', 19, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Flynn Lives', 20, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('TRON Legacy (End Titles)', 21, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Finale', 22, 291615, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Give Life Back To Music', 1, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('The Game Of Love', 2, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Giorgio By Moroder', 3, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Within', 4, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Instant Crush', 5, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Lose Yourself To Dance', 6, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Touch', 7, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Get Lucky', 8, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Beyond', 9, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Motherboard', 10, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Fragments Of Time', 11, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Doin\' It Right', 12, 556257, now(), now());
insert into {{{prefix}}}songs (title, track_no, album_id, date_created, date_modified) values ('Contact', 13, 556257, now(), now());