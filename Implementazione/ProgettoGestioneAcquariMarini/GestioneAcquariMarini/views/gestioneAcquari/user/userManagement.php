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
    <form id="formAddUser" action="<?php echo $path; ?>" method="POST">
        <div class="form-group">
            <label for="formGroupExampleInput">Email</label>
            <input class="form-control" type="text" id="email" name="email" onchange="validateEmail(this)" value="<?php if(isset($userEmail)){echo $userEmail;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Nome</label>
            <input class="form-control" type="text" id="name" name="name" onchange="validateString(this, 0, 45)" value="<?php if(isset($userName)){echo $userName;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Cognome</label>
            <input class="form-control" type="text" id="surname" name="surname" onchange="validateString(this, 0, 45)" value="<?php if(isset($userSurname)){echo $userSurname;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Tipo</label>
            <select class="form-control" id="type" name="type" onchange="validateSelectPermission(this)">
                <option></option>
                <option <?php if(isset($userType) && $userType == 'Admin'){echo 'selected';} ?> >Admin</option>
                <option <?php if(isset($userType) && $userType == 'User'){echo 'selected';} ?>>User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Numero Telefonico</label>
            <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" onchange="validatePhone(this)" value="<?php if(isset($userPhoneNumber)){echo $userPhoneNumber;} ?>"/>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Cambio Password</label>
            <select class="form-control" id="passwordChange" name="passwordChange" onchange="validateSelectChangePassword(this)">
                <option></option>
                <option <?php if(isset($userPasswordChange) && $userPasswordChange == 0){echo 'selected';} ?> ><?php echo TOCHANGEPASSWORD ?></option>
                <option <?php if(isset($userPasswordChange) && $userPasswordChange == 1){echo 'selected';} ?> ><?php echo NOTCHANGEPASSWORD ?></option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-sm" value="<?php echo $nameButton ?>"/>
        </div>
    </form>
</div>