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
	SELECT * from incidencia NATURAL JOIN anomalia

-- 3.


-- 4.
