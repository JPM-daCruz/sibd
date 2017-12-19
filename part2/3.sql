select distinct patient.name
from sensor, reading, wears, patient
where sensor.units = 'Colestrol mg/l'
and (sensor.snum, sensor.manuf) = (reading.snum, reading.manuf)
and reading.value >200
and wears.patient=patient.number
and wears.snum=reading.snum
and timestampdiff(day, reading.datetime, current_timestamp)<90 
and timestampdiff(day, wears.start, reading.datetime)>0 
and timestampdiff(day, wears.end, reading.datetime)<0;
