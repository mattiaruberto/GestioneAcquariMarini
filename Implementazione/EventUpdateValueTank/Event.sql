DROP EVENT IF EXISTS updateValueTank;

DELIMITER $$$
CREATE EVENT updateValueTank ON SCHEDULE EVERY 7 DAY DO BEGIN
    DECLARE nomeVasca VARCHAR(50);
    DECLARE calcioVasca INT;
    DECLARE magnesioVasca INT;
    DECLARE khVasca INT;
    
    DECLARE cur CURSOR FOR SELECT nome FROM vasca;
    
    OPEN cur;
    read_loop: LOOP
    FETCH NEXT FROM cur INTO nomeVasca;
        SELECT magnesio into magnesioVasca FROM vasca WHERE nome=nomeVasca;
        SELECT calcio into calcioVasca FROM vasca WHERE nome=nomeVasca;
        SELECT kh into khVasca FROM vasca WHERE nome=nomeVasca;
        UPDATE vasca SET kh=(khVasca-1),calcio=(calcioVasca-25),magnesio=(magnesioVasca-100) WHERE (nome=nomeVasca);
    
    END LOOP;
    CLOSE cur;
END $$$
DELIMITER;