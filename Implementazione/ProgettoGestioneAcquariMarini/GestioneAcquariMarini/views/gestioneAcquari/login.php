<div class="containerDiv">
    <!-- form per aggiunta strumento -->
    <div id="login">
        <h2>Benvenuto</h2>
        <h3>Login</h3>
        <form action="<?php echo URL; ?>login/checkLogin" method="POST">
            <div class="form-group">
                <label>e-mail</label>
                <input type="text" name="email" value="" required class="form-control"/>
            </div>
            <div class="form-group">
                <label>password</label>
                <input type="password" name="password" value="" required class="form-control"/>
            </div>
            <input type="submit" name="submit_login" value="Login" class="btn btn-default" />
        </form>
    </div>
</div>
