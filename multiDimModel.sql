drop table d_utilizador         cascade;
drop table d_tempo              cascade;
drop table d_local              cascade;
drop table d_lingua             cascade;
drop table f_anomalia           cascade;

create table d_utilizador (
	du_id       serial        not null,
	du_email    varchar(80)   not null,
	du_tipo     varchar(80)   not null,
	constraint pk_d_utilizador primary key (du_id)
);

create table d_tempo (
	dt_id           serial      not null,
	dt_dia          integer     not null,
	dt_dia_semana   integer     not null,
	dt_semana       varchar(20) not null,
	dt_mes          varchar(20) not null,
	dt_trimestre    integer     not null,
	dt_ano          integer     not null,
	constraint pk_d_tempo primary key (dt_id)
);

create table d_local (
	dlocal_id           serial      not null,
	dlocal_latitude     integer     not null,
	dlocal_longitude    integer     not null,
	dlocal_nome         varchar(80) not null,
	constraint pk_d_local primary key (dlocal_id)
);

create table d_lingua (
	dlingua_id           serial      not null,
	dlingua_lingua       varchar(20) not null,
	constraint pk_d_lingua primary key (dlingua_id)
);

create table f_anomalia (
	du_id   integer not null,
	dt_id   integer not null,
	dlocal_id  integer not null,
	dlingua_id  integer not null,
	constraint fk_a_dutilizador foreign key (du_id)      references d_utilizador(du_id),
	constraint fk_a_dtempo      foreign key (dt_id)      references d_tempo(dt_id),
	constraint fk_a_dlocal      foreign key (dlocal_id)  references d_local(dlocal_id),
	constraint fk_a_dlingua     foreign key (dlingua_id) references d_lingua(dlingua_id)
);

/* INSERTS - MIGRATION*/

insert into d_utilizador(du_email, du_tipo)
	select u_email, 'qualificado' from (select u_email from utilizador natural join utilizador_qualificado) as uq;

insert into d_utilizador(du_email, du_tipo)
	select u_email, 'regular' from (select u_email from utilizador natural join utilizador_regular) as ur;

insert into d_tempo(dt_dia, dt_dia_semana, dt_semana, dt_mes, dt_trimestre, dt_ano)
	select DATE_PART('day',a_ts),DATE_PART('dow',a_ts),DATE_PART('week',a_ts),DATE_PART('month',a_ts),DATE_PART('quarter',a_ts),DATE_PART('year',a_ts)
		from (select distinct a_ts from anomalia);

insert into d_local(dlocal_latitude, dlocal_longitude, dlocal_nome)
	select lp_latitude, lp_longitude, lp_nome from local_publico;

insert into d_lingua(dlingua_lingua)
	select distinct lingua from
		(select a_lingua as lingua from anomalia) as anom UNION (select at_lingua2 as lingua from anomalia_traducao);

insert into f_anomalia(du_id, dt_id, dlocal_id, dlingua_id)
	select du_id, dt_id, dlocal_id, dlingua_id from (select du_id FROM d_utilizador WHERE u_email = du_email);


SELECT u_email, a_lingua, a_ts, lp_latitude, lp_longitude from
	item NATURAL JOIN local_publico NATURAL JOIN incidencia NATURAL JOIN utilizador NATURAL JOIN anomalia;