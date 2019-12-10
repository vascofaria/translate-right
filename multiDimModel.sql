drop table d_utilizador         cascade;
drop table d_tempo              cascade;
drop table d_local              cascade;
drop table d_lingua             cascade;
drop table f_anomalia           cascade;

create table d_utilizador (
	du_id       serial        not null,
	du_email    varchar(80)   not null,
	du_tipo     varchar(80)   not null,
	constraint pk_utilizador primary key (du_email)
);

create table d_tempo (
	dt_id           serial      not null,
	dt_dia          integer     not null,
	dt_dia_semana   integer     not null,
	dt_semana       varchar(20) not null,
	dt_mes          varchar(20) not null,
	dt_trimestre    integer     not null,
	dt_ano          integer     not null,
	constraint pk_tempo primary key (dt_id)
);

create table d_local (
	dlocal_id           serial      not null,
	dlocal_latitude     integer     not null,
	dlocal_longitude    integer     not null,
	dlocal_nome         varchar(80) not null,
	constraint pk_local primary key (dlocal_id)
);

create table d_lingua (
	dlingua_id           serial      not null,
	dlingua_lingua       varchar(20) not null,
	constraint pk_lingua primary key (dlingua_id)
);

create table f_anomalia (
	du_id   integer not null,
	dt_id   integer not null,
	dlocal_id  integer not null,
	dlingua_id  integer not null,
	constraint fk_a_utilizador foreign key (du_id)      references utilizador(du_id),
	constraint fk_a_tempo      foreign key (dt_id)      references tempo(dt_id),
	constraint fk_a_local      foreign key (dlocal_id)  references local(dlocal_id),
	constraint fk_a_lingua     foreign key (dlingua_id) references lingua(dlingua_id)
);

/* INSERTS - MIGRATION*/

insert into d_utilizador(du_email, du_password, du_tipo)
	Select u_email, u_password, 'qualificado' from (Select u_email, u_password from utilizador natural join utilizador_qualificado);

insert into d_utilizador(du_email, du_password, du_tipo)
	Select u_email, u_password, 'regular' from (Select u_email, u_password from utilizador natural join utilizador_regular);

insert into d_tempo(dt_dia, dt_dia_semana, dt_semana, dt_mes, dt_trimestre, dt_ano)
	Select DATEPART(day,a_ts),DATEPART(weekday,a_ts),DATEPART(week,a_ts),DATEPART(mounth,a_ts),DATEPART(quarter,a_ts),DATEPART(year,a_ts) from anomalia;

insert into d_local(dlocal_latitude, dlocal_longitude, dlocal_nome)
	Select lp_latitude, lp_longitude, lp_nome From local_publico;

insert into d_lingua(dlingua_lingua)
	select distinct lingua from
		(select a_lingua as lingua from anomalia) as anom UNION (select at_lingua2 as lingua from anomalia_traducao);