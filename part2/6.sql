drop function if exists region_overlaps_element;

DELIMITER $$

create function region_overlaps_element(e_series_id int, e_index int, xb1 float, yb1 float, xb2 float, yb2 float)
returns int
BEGIN
	DECLARE xa1, ya1, xa2, ya2 float;
	SELECT region.x1, region.y1, region.x2, region.y2 INTO xa1, ya1, xa2, ya2 
	from region 
	where e_series_id = region.series_id
	and e_index = region.elem_index;
	IF ((xb1 between xa1 and xa2) OR (xb1 between xa2 and xa1))
	AND ((yb1 between ya1 and ya2) OR (yb1 between ya2 and ya1)) 
	THEN
		return 1;
	end IF;
	IF ((xb2 between xa1 and xa2) OR (xb2 between xa2 and xa1))
	AND ((yb2 between ya1 and ya2) OR (yb2 between ya2 and ya1)) 
	THEN
		return 1;
	end IF;

	IF ((xa1 between xb1 and xb2) OR (xa1 between xb2 and xb1))
	AND ((ya1 between yb1 and yb2) OR (ya1 between yb2 and yb1)) 
	THEN
		return 1;
	end IF;
	IF ((xa2 between xb1 and xb2) OR (xa2 between xb2 and xb1))
	AND ((ya2 between yb1 and yb2) OR (ya2 between yb2 and yb1)) 
	THEN
		return 1;
	end IF;
	return 0;
	
end $$

delimiter ;
