<div class="containerDiv">
    <h3>
        <input type="image" src="<?php echo PATH; ?>media/img/iconInfo.png" onclick="showInfo()"/>
        <?php echo $title; ?>
    </h3>
    <ul id="listRules" class="list-group small" style="display: none;">
        <li class="list-group-item active">Regole dei campi:</li>
        <li class="list-group-item">Nome: può contenere solo lettere normali, trattino basso e alto.</li>
        <li class="list-group-item">Calcio: deve essere un numero intero.</li>
        <li class="list-group-item">Magensio: deve essere un numero intero.</li>
        <li class="list-group-item">Kh: deve essere un numero intero.</li>
        <li class="list-group-item">Cambio d'acqua: deve essere una data, la date non può essere futura.</li>
        <li class="list-group-item">Litri: deve essere un numero intero.</li>
    </ul>
    <p style='color: red;margin-left: 2%;'><?php if(isset($stringErrors)){ echo $stringErrors; } ?></p>
    <form id="formAddTanke" action="<?php echo $path; ?>" method="POST">
        <div class="form-group">
            <label for="formGroupExampleInput">Nome</label>
            <input class="form-control" type="text" id="tankName" name="tankName" onchange="validateTankName()" value="<?php if(isset($tankName)){echo $tankName;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Magnesio</label>
            <input class="form-control" type="number" id="magnesium" name="magnesium" onchange="validateMagnesium()" value="<?php if(isset($magnesium)){echo $magnesium;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Calcio</label>
            <input class="form-control" type="number" id="calcium" name="calcium" onchange="validateCalcium()" value="<?php if(isset($calcium)){echo $calcium;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Kh</label>
            <input class="form-control" type="number" id="kh" name="kh" onchange="validateKh()" value="<?php if(isset($kh)){echo $kh;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Cambio d'acqua</label>
            <input class="form-control" type="date" id="waterChange" onchange="validateDate()" value="<?php if(isset($waterChange)){echo $waterChange;} ?>" name="waterChange"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Litri</label>
            <input class="form-control" type="number" id="liter" name="liter" onchange="validateLiter()" value="<?php if(isset($liter)){echo $liter;} ?>"/>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-sm" value="<?php echo $nameButton ?>"/>
        </div>
    </form>
</div>