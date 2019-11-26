-- 1.
SELECT * FROM (
  SELECT lp_latitude, lp_longitude, COUNT(*) as cnt FROM (
    SELECT a_id, lp_latitude, lp_longitude FROM (
      Item NATURAL JOIN (SELECT a_id, i_id FROM Incidencia)
    )
  ) group by lp_latitude, lp_longitude
) HAVING cnt=max(cnt);

-- 2.


-- 3.


-- 4.



SELECT a_id, lp_latitude, lp_longitude FROM Item NATURAL JOIN (SELECT a_id, i_id FROM Incidencia) as A;