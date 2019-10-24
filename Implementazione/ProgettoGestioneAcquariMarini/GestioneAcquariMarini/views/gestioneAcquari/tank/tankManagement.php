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
    <form id="formAddTanke" action="<?php echo $path; ?>" method="POST">
        <div class="form-group">
            <label for="formGroupExampleInput">Nome</label>
            <input class="form-control" type="text" id="tankName" name="tankName" value="<?php if(isset($tankName)){echo $tankName;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Magnesio</label>
            <input class="form-control" type="number" id="magnesio" name="magnesio" value="<?php if(isset($magnesio)){echo $magnesio;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Calcio</label>
            <input class="form-control" type="number" id="calcio" name="calcio" value="<?php if(isset($calcio)){echo $calcio;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Kh</label>
            <input class="form-control" type="number" id="kh" name="kh" value="<?php if(isset($kh)){echo $kh;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Cambio d'acqua</label>
            <input class="form-control" type="date" id="waterChange" value="<?php if(isset($waterChange)){echo $waterChange;} ?>" name="waterChange"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Litri</label>
            <input class="form-control" type="number" id="liter" name="liter" value="<?php if(isset($liter)){echo $liter;} ?>"/>
        </div>
    </form>
    <div class="form-group">
        <input type="button" class="btn btn-primary btn-sm" onclick="validateTank()" value="<?php echo $nameButton ?>"/>
    </div>
</div>