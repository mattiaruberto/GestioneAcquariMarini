<div class="containerDiv">
    <!-- form per aggiunta strumento -->
    <div id="newPassword">
        <h3>Inserisci la nuova password</h3>
        <form action="<?php echo URL; ?>nuovaPassword/newPassword" method="POST">
            <div class="form-group">
                <label>nuova password</label>
                <input type="password" name="newPassword" value="" required class="form-control"/>
            </div>
            <div class="form-group">
                <label>ripeti password</label>
                <input type="password" name="againNewPassword" value="" required class="form-control"/>
            </div>
            <input type="submit" name="submitNewPassword" value="Confirm" class="btn btn-default" />
        </form>
    </div>
</div>