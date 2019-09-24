<div class="containerDiv">
    <!-- form per aggiunta strumento -->
    <div id="newPassword">
        <h3>Plese, insert your new password</h3>
        <form action="<?php echo URL; ?>login/checkLogin" method="POST">
            <div class="form-group">
                <label>new password</label>
                <input type="password" name="password" value="" required class="form-control"/>
            </div>
            <div class="form-group">
                <label>repeat password</label>
                <input type="password" name="password" value="" required class="form-control"/>
            </div>
            <input type="submit" name="submit_login" value="Confirm" class="btn btn-default" />
        </form>
    </div>
</div>