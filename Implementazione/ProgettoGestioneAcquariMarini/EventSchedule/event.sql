DROP EVENT IF EXISTS updateValueTank;

DELIMITER $$$
CREATE EVENT updateValueTank ON SCHEDULE EVERY 7 DAY DO BEGIN
    DECLARE nomeVasca varchar(50);
    DECLARE calcioVasca INT;
    DECLARE magnesioVasca INT;
    DECLARE khVasca INT;

    DECLARE cur CURSOR FOR SELECT nome FROM vasca;

    OPEN cur;
    read_loop: LOOP
	FETCH NEXT FROM cur INTO nomeVasca;
		select magnesio into magnesioVasca from vasca where nome=nomeVasca;
        select calcio into calcioVasca from vasca where nome=nomeVasca;
        select kh into khVasca from vasca where nome=nomeVasca;
		UPDATE vasca SET kh=(khVasca-1),calcio=(calcioVasca-25),magnesio=(magnesioVasca-100) WHERE (nome=nomeVasca);

	END LOOP;
	CLOSE cur;
END $$$
DELIMITER ;