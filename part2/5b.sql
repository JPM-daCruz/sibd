drop trigger if exists link_w;

DELIMITER $$  
CREATE TRIGGER link_w BEFORE INSERT ON wears
FOR EACH ROW  
BEGIN  
    DECLARE found_link,baddata INT;
    DECLARE dt DATETIME;
    SET baddata = 0;
    SELECT COUNT(1) INTO found_link FROM wears
    WHERE snum = NEW.snum
    and NEW.patient != wears.patient
    and wears.end > NEW.start
    and NEW.end > wears.start;
    IF found_link > 0 THEN
            SET baddata = 1;
    END IF;
    IF baddata = 1 THEN  
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Overlapping dates';
    END IF;  
END; $$  
DELIMITER ;



