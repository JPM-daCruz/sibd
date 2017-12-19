drop table if exists region;
drop table if exists element;
drop table if exists series;
drop table if exists study;
drop table if exists request;
drop table if exists wears;
drop table if exists period;
drop table if exists reading;
drop table if exists sensor;
drop table if exists device;
drop table if exists doctor;
drop table if exists patient;


create table patient(
	number integer,
	name varchar(255),
	birthday date,
	adress varchar(255),
	primary key(number));

create table doctor(
	number integer,
	doctor_id integer,
	primary key(doctor_id),
	foreign key(number) references patient(number));

create table device(
	serialnum integer,
	manufacturer varchar(255),
	model varchar(255),
	primary key(serialnum, manufacturer));

create table sensor(
	snum integer,
	manuf varchar(255),
	units varchar(255),
	primary key(snum, manuf),
	foreign key(snum, manuf) references device(serialnum, manufacturer));

create table reading(
	snum integer,
	manuf varchar(255),
	datetime timestamp,
	value numeric(20,2),
	primary key (snum, manuf, datetime),
	foreign key (snum, manuf) references sensor(snum, manuf));

create table period(
	start timestamp,
	end timestamp,
	primary key (start, end));

create table wears(
	start timestamp,
	end timestamp,
	patient integer,
	snum integer,
	manuf varchar(255),
	primary key (start, end, patient),
	foreign key (start, end) references period(start, end),
	foreign key (patient) references patient(number),
	foreign key (snum, manuf) references device(serialnum, manufacturer));

create table request(
	number integer,
	patient_id integer,
	doctor_id integer,
	request_date date,
	primary key (number),
	foreign key (patient_id) references patient(number),
	foreign key (doctor_id) references doctor(doctor_id));

create table study(
	request_number integer,
	description varchar(255),
	date date,
	doctor_id integer,
	manufacturer varchar(255),
	serial_number integer,
	primary key (request_number, description),
	foreign key (request_number) references  request(number),
	foreign key (doctor_id) references doctor(doctor_id),
	foreign key (serial_number, manufacturer) references device(serialnum, manufacturer));

create table series(
	series_id integer,
	name varchar(255),
	base_url varchar(255),
	request_number integer,
	description varchar(255),
	primary key (series_id),
	foreign key (request_number, description) references study(request_number, description));

create table element(
	series_id integer,
	elem_index integer,
	primary key (series_id, elem_index),
	foreign key (series_id) references series(series_id));

create table region(
	series_id integer,
	elem_index integer,
	x1 decimal(10,2),
	y1 decimal(5,2),
	x2 decimal(5,2),
	y2 decimal(5,2),
	primary key (series_id, elem_index, x1, y1, x2, y2),
	foreign key (series_id, elem_index) references element(series_id, elem_index));

insert into patient values (1001, 'Pedro', '1996-12-01', 'Avenida Afonso Costa');
insert into patient values (1002, 'Maria', '1996-12-02', 'Avenida Afonso III');
insert into patient values (1003, 'Bruno', '1996-12-03', 'Avenida da Liberdade');
insert into patient values (1004, 'Joana', '1996-12-04', 'Avenida das Descobertas');
insert into patient values (1005, 'Mariana', '1996-12-05', 'Avenida de Ceuta');
insert into patient values (1006, 'Rui', '1996-12-06', 'Avenida de Roma');
insert into patient values (1007, 'Tiago', '1996-12-07', 'Avenida Rio de Janeiro');
insert into patient values (1008, 'Tatiana', '1996-12-08', 'Avenida Padre Cruz');

insert into doctor values (1001,2001);
insert into doctor values (1002,2002);
insert into doctor values (1003,2003);
insert into doctor values (1004,2004);
insert into doctor values (1005,2005);
insert into doctor values (1006,2006);
insert into doctor values (1007,2007);
insert into doctor values (1008,2008);

insert into device values (9810,'ROS','L749');
insert into device values (9801,'ROS','L750');
insert into device values (9811,'ROS','L751');
insert into device values (9802,'SQL','L755');
insert into device values (9803,'C','10Z');
insert into device values (9804,'Java','C50D');
insert into device values (9805,'Python','A30');
insert into device values (9806,'Matlab','R50D');
insert into device values (9807,'Android','R40C');
insert into device values (9808,'Android','XY33');
insert into device values (7801, 'Medtronic', 'S1');
insert into device values (7802, 'Medtronic', 'S2');
insert into device values (7803, 'Medtronic', 'S3');
insert into device values (7804, 'Xico', 'S4');
insert into device values (7805, 'Pic', 'S5');

insert into sensor values (9801,'ROS','Colestrol mg/l');
insert into sensor values (9802,'SQL','Temperatura graus');
insert into sensor values (9803,'C','Batimentos bpm');
insert into sensor values (9804,'Java','Colestrol mg/l');
insert into sensor values (9805,'Python','Batimentos bpm');
insert into sensor values (9806,'Matlab','Colestrol mg/l');
insert into sensor values (9807,'Android','Temperatura graus');
insert into sensor values (9808,'Android','Batimentos bpm');

insert into reading values (9801,'ROS','2017-11-10 12:00:00',250);
insert into reading values (9803,'C','2017-11-01 12:00:00',300);
insert into reading values (9806,'Matlab','2017-01-01 12:00:00', 270);
insert into reading values (9802,'SQL','2017-10-25 12:00:00',35);
insert into reading values (9805,'Python','2017-09-17 12:00:00',60);
insert into reading values (9805,'Python','2017-09-18 12:00:00',59);
insert into reading values (9805,'Python','2017-09-19 12:00:00',70);
insert into reading values (9801,'ROS','2016-12-25 12:00:00',230);

insert into period values ('2017-10-01 00:00:00','2017-12-31 23:59:59');
insert into period values ('2015-01-01 00:00:00','2017-12-31 23:59:59');
insert into period values ('2017-10-02 00:00:00','2017-12-31 23:59:59');
insert into period values ('2016-01-02 00:00:00','2017-12-31 23:59:59');
insert into period values ('2017-09-01 00:00:00','2017-12-31 23:59:59');
insert into period values ('2016-12-20 00:00:00','2016-12-31 23:59:59');
insert into period values ('2016-12-22 00:00:00','2016-12-31 23:59:59');

insert into wears values ('2017-10-01 00:00:00', '2017-12-31 23:59:59', 1001 , 9801 , 'ROS');
insert into wears values ('2015-01-01 00:00:00', '2017-12-31 23:59:59', 1001 , 9803 , 'C');
insert into wears values ('2017-10-02 00:00:00', '2017-12-31 23:59:59', 1001 , 9802 , 'SQL');
insert into wears values ('2016-01-02 00:00:00', '2017-12-31 23:59:59', 1004 , 9806 , 'Matlab');
insert into wears values ('2017-09-01 00:00:00', '2017-12-31 23:59:59', 1005 , 9805 , 'Python');
insert into wears values ('2016-12-20 00:00:00', '2016-12-31 23:59:59', 1006 , 9801 , 'ROS');
insert into wears values ('2016-12-22 00:00:00', '2016-12-31 23:59:59', 1006 , 9811 , 'ROS');

insert into request values (1,1001,2001,'2016-11-01');
insert into request values (2,1001,2001,'2016-10-25');
insert into request values (3,1001,2001,'2016-10-01');
insert into request values (4,1004,2004,'2016-09-01');
insert into request values (5,1005,2005,'2016-10-09');
insert into request values (6,1006,2006,'2016-12-20');

insert into study values (1, 'Nivel de Colestrol', '2016-11-02', 2006, 'Medtronic', 7801);
insert into study values (2, 'Nivel do Coracao', '2016-10-26', 2005, 'Medtronic', 7802 );
insert into study values (3, 'Temperaturas altas', '2016-10-02', 2003, 'Medtronic', 7803);
insert into study values (4, 'Nivel de colestrol', '2016-09-02', 2001, 'Xico', 7804);
insert into study values (5, 'Batimentos acelerados', '2016-09-11', 2002, 'Pic', 7805);
insert into study values (6, 'Colestrol alto', '2016-12-21', 2003, 'Medtronic', 7801);

insert into series values (1, 'serie 1', 'www.serie1.pt', 1, 'Nivel de Colestrol');
insert into series values (2, 'serie 2', 'www.serie2.pt', 2, 'Nivel do Coracao');

insert into element values (1 , 1);
insert into element values (1 , 2);
insert into element values (2 , 1);
insert into element values (2 , 2);

insert into region values (1, 1, 1, 1, 3, 3);
insert into region values (1, 1, 2, 2, 4, 5);
insert into region values (2, 1, 0, 0, 5, 1);
insert into region values (2, 2, 5, 5, 6, 6);

