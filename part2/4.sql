select distinct name
from patient as p
where not exists(
	select serialnum
	from device as d
	where manufacturer = 'Medtronic'
	and serialnum not in(
		select distinct serial_number
		from study as s, request as r, patient as p2
		where s.request_number=r.number
		and r.patient_id=p2.number
		and year(s.date) = (year(current_date)-1)
		and p.name=p2.name));

