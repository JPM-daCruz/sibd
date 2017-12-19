drop trigger if exists insert_doctor;

DELIMITER $$  
CREATE TRIGGER insert_doctor BEFORE INSERT ON study
FOR EACH ROW  
BEGIN  
    DECLARE found_number, baddata INT;
    DECLARE dt INT;
    SET baddata = 0;
    SELECT COUNT(1) INTO found_number FROM request
    WHERE number = NEW.request_number;
    IF found_number > 0 THEN
        SELECT doctor_id INTO dt FROM request
        WHERE number = NEW.request_number;
        IF NEW.doctor_id = dt THEN
            SET baddata = 1;
        END IF;
    END IF;
    IF baddata = 1 THEN  
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Same doctor';
    END IF;  
END; $$  
DELIMITER ;
