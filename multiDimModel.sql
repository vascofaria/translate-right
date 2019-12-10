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
	dt_semana       integer     not null,
	dt_mes          integer     not null,
	dt_trimestre    integer     not null,
	dt_ano          integer     not null,
	constraint pk_d_tempo primary key (dt_id)
);

create table d_local (
	dlocal_id           serial        not null,
	dlocal_latitude     decimal(8, 6) not null,
	dlocal_longitude    decimal(9, 6) not null,
	dlocal_nome         varchar(80)   not null,
	constraint pk_d_local primary key (dlocal_id)
);

create table d_lingua (
	dlingua_id           serial      not null,
	dlingua_lingua       varchar(20) not null,
	constraint pk_d_lingua primary key (dlingua_id)
);
/*
create table f_anomalia (
	du_id       integer not null,
	dt_id       integer not null,
	dlocal_id   integer not null,
	dlingua_id  integer not null,
	constraint fk_a_dutilizador foreign key (du_id)      references d_utilizador(du_id),
	constraint fk_a_dtempo      foreign key (dt_id)      references d_tempo(dt_id),
	constraint fk_a_dlocal      foreign key (dlocal_id)  references d_local(dlocal_id),
	constraint fk_a_dlingua     foreign key (dlingua_id) references d_lingua(dlingua_id)
);*/

create table f_anomalia (
	du_id           integer     not null,
	dt_id           integer     not null,
	dlocal_id       integer     not null,
	dlingua_id      integer     not null,
	fa_tipo         varchar(20) not null,
	fa_com_proposta boolean     not null,
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
		from (select distinct a_ts from anomalia) as anomalia_ts;

insert into d_local(dlocal_latitude, dlocal_longitude, dlocal_nome)
	select lp_latitude, lp_longitude, lp_nome from local_publico;

insert into d_lingua(dlingua_lingua)
	select distinct lingua from
		(select a_lingua as lingua from anomalia) as anom UNION (select at_lingua2 as lingua from anomalia_traducao);

/*
insert into f_anomalia(du_id, dt_id, dlocal_id, dlingua_id)
	SELECT du_id, dt_id, dlocal_id, dlingua_id FROM
	item NATURAL JOIN local_publico NATURAL JOIN incidencia NATURAL JOIN utilizador
	NATURAL JOIN anomalia NATURAL JOIN d_utilizador NATURAL JOIN d_tempo NATURAL JOIN d_local NATURAL JOIN d_lingua
		WHERE du_email = u_email AND dt_dia = DATE_PART('day', a_ts) AND dt_dia_semana = DATE_PART('dow',a_ts)
			AND dt_semana = DATE_PART('week',a_ts) AND dt_mes = DATE_PART('month',a_ts) AND dt_trimestre = DATE_PART('quarter',a_ts)
			AND dt_ano = DATE_PART('year',a_ts)	AND dlocal_latitude = lp_latitude AND dlocal_longitude = lp_longitude AND dlingua_lingua = a_lingua;
*/

insert into f_anomalia(du_id, dt_id, dlocal_id, dlingua_id, fa_tipo, fa_com_proposta)
	select du_id, dt_id, dlocal_id, dlingua_id, 'redacao', true from
		item natural join local_publico natural join incidencia natural join utilizador
		natural join anomalia natural join d_utilizador natural join d_tempo natural join d_local
		natural join d_lingua natural join correcao
			WHERE du_email = u_email and dt_dia = DATE_PART('day', a_ts) and dt_dia_semana = DATE_PART('dow',a_ts)
				and dt_semana = DATE_PART('week',a_ts) and dt_mes = DATE_PART('month',a_ts) and dt_trimestre = DATE_PART('quarter',a_ts)
				and dt_ano = DATE_PART('year',a_ts)	and dlocal_latitude = lp_latitude and dlocal_longitude = lp_longitude and dlingua_lingua = a_lingua
				and a_tem_anomalia_redacao;

insert into f_anomalia(du_id, dt_id, dlocal_id, dlingua_id, fa_tipo, fa_com_proposta)
	select du_id, dt_id, dlocal_id, dlingua_id, 'redacao', false from
		item natural join local_publico natural join incidencia natural join utilizador
		natural join anomalia natural join d_utilizador natural join d_tempo natural join d_local
		natural join d_lingua
			WHERE du_email = u_email and dt_dia = DATE_PART('day', a_ts) and dt_dia_semana = DATE_PART('dow',a_ts)
				and dt_semana = DATE_PART('week',a_ts) and dt_mes = DATE_PART('month',a_ts) and dt_trimestre = DATE_PART('quarter',a_ts)
				and dt_ano = DATE_PART('year',a_ts)	and dlocal_latitude = lp_latitude and dlocal_longitude = lp_longitude and dlingua_lingua = a_lingua
				and a_tem_anomalia_redacao and not exists(select correcao.a_id from correcao where a_id = correcao.a_id);

insert into f_anomalia(du_id, dt_id, dlocal_id, dlingua_id, fa_tipo, fa_com_proposta)
	select du_id, dt_id, dlocal_id, dlingua_id, 'traducao', true from
		item natural join local_publico natural join incidencia natural join utilizador
		natural join anomalia natural join d_utilizador natural join d_tempo natural join d_local
		natural join d_lingua natural join anomalia_traducao natural join correcao
			WHERE du_email = u_email and dt_dia = DATE_PART('day', a_ts) and dt_dia_semana = DATE_PART('dow',a_ts)
				and dt_semana = DATE_PART('week',a_ts) and dt_mes = DATE_PART('month',a_ts) and dt_trimestre = DATE_PART('quarter',a_ts)
				and dt_ano = DATE_PART('year',a_ts)	and dlocal_latitude = lp_latitude and dlocal_longitude = lp_longitude and dlingua_lingua = a_lingua;

insert into f_anomalia(du_id, dt_id, dlocal_id, dlingua_id, fa_tipo, fa_com_proposta)
	select du_id, dt_id, dlocal_id, dlingua_id, 'traducao', false from
		item natural join local_publico natural join incidencia natural join utilizador
		natural join anomalia natural join d_utilizador natural join d_tempo natural join d_local
		natural join d_lingua natural join anomalia_traducao
			WHERE du_email = u_email and dt_dia = DATE_PART('day', a_ts) and dt_dia_semana = DATE_PART('dow',a_ts)
				and dt_semana = DATE_PART('week',a_ts) and dt_mes = DATE_PART('month',a_ts) and dt_trimestre = DATE_PART('quarter',a_ts)
				and dt_ano = DATE_PART('year',a_ts)	and dlocal_latitude = lp_latitude and dlocal_longitude = lp_longitude and dlingua_lingua = a_lingua
				and not exists(select correcao.a_id from correcao where a_id = correcao.a_id);