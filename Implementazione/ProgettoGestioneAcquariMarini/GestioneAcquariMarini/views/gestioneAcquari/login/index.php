<div class="containerDiv">
    <h1 align="center">Gestione Acquari Marini</h1>
    <h2 align="center">Benvenuto nella pagina di login</h2>
    <form action="<?php echo URL; ?>login/logIn" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="" required class="form-control"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="" required class="form-control"/>
        </div>
        <input type="submit" name="login" value="Login" class="btn btn-default" />
    </form>
</div>
