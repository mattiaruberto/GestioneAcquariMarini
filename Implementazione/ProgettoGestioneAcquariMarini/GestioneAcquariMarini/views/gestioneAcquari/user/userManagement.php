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
    <form id="formAddUser" action="<?php echo $path; ?>" method="POST">
        <div class="form-group">
            <label for="formGroupExampleInput">Email</label>
            <input class="form-control" type="text" id="email" name="email" value="<?php if(isset($tankName)){echo $tankName;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Nome</label>
            <input class="form-control" type="text" id="name" name="name" value="<?php if(isset($magnesio)){echo $magnesio;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Cognome</label>
            <input class="form-control" type="text" id="surname" name="surname" value="<?php if(isset($calcio)){echo $calcio;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Tipo</label>
            <select class="form-control" id="type" name="type" value="<?php if(isset($kh)){echo $kh;} ?>">
                <option></option>
                <option>Admin</option>
                <option>User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Numerto Telefonico</label>
            <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" value="<?php if(isset($waterChange)){echo $waterChange;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Cambio Password</label>
            <select class="form-control" id="passwordChange" name="passwordChange" value="<?php if(isset($liter)){echo $liter;} ?>">
                <option></option>
                <option>Cambiata</option>
                <option>Da cambiare</option>
            </select>
        </div>
    </form>
    <div class="form-group">
        <input type="button" class="btn btn-primary btn-sm" onclick="validateUser()" value="<?php echo $nameButton ?>"/>
    </div>
</div>