<div class="containerDiv">
    <h3>Inserisci la nuova password</h3>
    <form action="<?php echo URL; ?>newPassword/changePassword" method="POST">
        <div class="form-group">
            <label>Nuova password</label>
            <input type="password" name="newPassword" value="" required class="form-control"/>
        </div>
        <div class="form-group">
            <label>Ripeti password</label>
            <input type="password" name="againNewPassword" value="" required class="form-control"/>
        </div>
        <input type="submit" name="submitNewPassword" value="Cambia" class="btn btn-default" />
    </form>
</div>