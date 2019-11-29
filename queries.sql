-- 1.
SELECT lp_nome, lp_latitude, lp_longitude FROM (
	local_publico NATURAL JOIN (
		SELECT lp_latitude, lp_longitude FROM (
			item NATURAL JOIN (SELECT a_id, i_id FROM incidencia) AS A
		) GROUP BY lp_latitude, lp_longitude
		HAVING
		count(*) = (
			SELECT MAX(D.CNT) FROM (
				SELECT COUNT(*) AS CNT FROM (
					item NATURAL JOIN (SELECT a_id, i_id FROM incidencia) AS B
				) AS C GROUP BY (lp_latitude, lp_longitude)
			) AS D
		)
	) as E
);

-- 2.
SELECT u_email FROM (
  SELECT u_email FROM (
    incidencia NATURAL JOIN anomalia NATURAL JOIN anomalia_traducao NATURAL JOIN utilizador_regular
  ) AS A WHERE a_ts >= '2019-01-01 00:00:00' AND a_ts < '2019-07-01 00:00:00' GROUP BY u_email
HAVING
COUNT(*) = (
  SELECT MAX(C.cnt) FROM (
    SELECT COUNT(*) AS cnt FROM (
      incidencia NATURAL JOIN anomalia NATURAL JOIN anomalia_traducao NATURAL JOIN utilizador_regular
    ) AS B WHERE a_ts >= '2019-01-01 00:00:00' AND a_ts < '2019-07-01 00:00:00' GROUP BY (u_email)
  ) AS C
  )
) as E;

-- 3.
SELECT DISTINCT u_email FROM (
  incidencia
  NATURAL JOIN
  (SELECT MAX(i_id) AS i_id, lp_latitude, lp_longitude FROM item WHERE lp_latitude > 39.336775 GROUP BY lp_latitude, lp_longitude) as locals
  NATURAL JOIN
  (SELECT * FROM anomalia WHERE a_ts >= '2019-01-01 00:00:00' AND a_ts < '2020-01-01 00:00:00') as dates
) AS A GROUP BY (u_email)
HAVING
COUNT(*) = (
  SELECT COUNT(*) as cnt FROM local_publico WHERE lp_latitude > 39.336775
);

-- 4.
SELECT A.u_email FROM 
  (correcao NATURAL JOIN proposta_correcao) AS correcoes INNER JOIN 
  (SELECT * FROM (
    incidencia NATURAL JOIN anomalia NATURAL JOIN utilizador_qualificado NATURAL JOIN item
  ) WHERE lp_latitude < 39.336775 AND a_ts >= '2019-01-01 00:00:00' AND a_ts < '2020-01-01 00:00:00') as A
ON correcoes.a_id = A.a_id AND correcoes.u_email != A.u_email;

