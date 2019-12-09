/*
create function fn_Check_Zone (id integer, zone text)
RETURNS integer AS $$
	DECLARE a_count integer;
	DECLARE at_zona_x integer;
	DECLARE at_zona_y integer;
	BEGIN

		SELECT COUNT(*) into a_count
			FROM anomalia WHERE a_id = id;
		RETURN a_count;
	END
$$ LANGUAGE plpgsql;*/

/* okus5161 */

drop table anomalia               cascade;
drop table anomalia_traducao      cascade;

create table anomalia (
	a_id                   serial     	not null unique,
	a_zona                 varchar(8)   not null,
	a_ts                   timestamp    default current_timestamp(0),
	a_tem_anomalia_redacao boolean      not null,
	constraint pk_anomalia primary key (a_id),
	constraint ck_zone     check   (SUBSTRING(a_zona, 1, 3)::int8 >= 0 AND SUBSTRING(a_zona, 4, 2) = ', ' AND SUBSTRING(a_zona, 6, 3)::int8 >=0)
);

create table anomalia_traducao (
	a_id       smallint    not null unique,
	at_zona2   varchar(8)  not null,
	constraint pk_anomalia_traducao primary key (a_id),
	constraint fk_at_anomalia       foreign key (a_id) references anomalia(a_id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint ck_zone2       check (SUBSTRING(at_zona2, 1, 3)::int8 >= 0 AND SUBSTRING(at_zona2, 4, 2) = ', ' AND SUBSTRING(at_zona2, 6, 3)::int8 >=0)
);

insert into anomalia(a_zona, a_tem_anomalia_redacao)
	values ('034, 012', false);
insert into anomalia(a_zona, a_tem_anomalia_redacao)
	values ('012, 054', false);

insert into anomalia_traducao(a_id, at_zona2) 
	values (1, '031, 048');
insert into anomalia_traducao(a_id, at_zona2) 
	values (2, '012, 054');

CREATE OR REPLACE FUNCTION TriggerZonasSobrepostas() RETURNS trigger as $$
	BEGIN
		if exists(SELECT * FROM anomalia WHERE a_zona = NEW.at_zona2 and a_id = NEW.a_id)
		then
			raise exception 'Existem Zonas Sobrepostas';
		end if;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER pedro AFTER INSERT ON anomalia_traducao
	FOR EACH ROW EXECUTE PROCEDURE TriggerZonasSobrepostas();