-- 1.


-- 2.
SELECT * FROM anomalia WHERE a_ts >= '2019-01-01 00:00:00' AND a_ts < '2019-07-01 00:00:00';

-- 3.


-- 4.




-- MAX ONE
SELECT MAX(cnt) as cnt FROM (
  SELECT lp_latitude, lp_longitude, COUNT(*) AS cnt FROM (
    SELECT a_id, lp_latitude, lp_longitude FROM (
      item NATURAL JOIN (SELECT a_id, i_id FROM incidencia) as b
    )
  ) as c GROUP BY lp_latitude, lp_longitude
) as maxed;

-- GROUP ONE
SELECT lp_latitude, lp_longitude, COUNT(*) AS cnt FROM (
  SELECT a_id, lp_latitude, lp_longitude FROM (
    item NATURAL JOIN (SELECT a_id, i_id FROM incidencia) as b
  )
) as c GROUP BY lp_latitude, lp_longitude;

-- MERGED ONE
SELECT * FROM (

  (SELECT MAX(cnt) as cnt FROM (
    SELECT lp_latitude, lp_longitude, COUNT(*) AS cnt FROM (
      SELECT a_id, lp_latitude, lp_longitude FROM (
        item NATURAL JOIN (SELECT a_id, i_id FROM incidencia) as b)
      ) as c GROUP BY lp_latitude, lp_longitude
    ) as maxed
  ) as MA

  NATURAL JOIN

  (SELECT lp_latitude, lp_longitude, COUNT(*) AS cnt FROM (
    SELECT a_id, lp_latitude, lp_longitude FROM (
      item NATURAL JOIN (SELECT a_id, i_id FROM incidencia) as d)
    ) as e GROUP BY lp_latitude, lp_longitude
  ) AS DIA

);
