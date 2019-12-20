<div class="containerDiv">
    <h1 align="center">Gestione Acquari Marini</h1>
    <h2 align="center">Benvenuto nella pagina di login</h2>
    <form action="<?php echo URL; ?>login/logIn" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php if(isset($email)){ echo $email; } ?>" required class="form-control"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required class="form-control"/>
        </div>
        <input type="submit" name="login" value="Login" class="btn btn-default" />
        <br><br>
    </form>
    <p style='color: red;'><?php if(isset($_SESSION['errorLogin'])){ if($_SESSION['errorLogin']){ echo "Username o password sono sbagliati"; } } ?></p>
    <button class="btn btn-primary btn-sm" onclick="changePassword()">Ho dimenticato la password</button>
</div>
<?php
if(isset($_SESSION[ERROR_REQUEST_NEW_PASSWORD])  && $_SESSION[ERROR_REQUEST_NEW_PASSWORD] != 0){
    if($_SESSION[ERROR_REQUEST_NEW_PASSWORD] == 1){
        echo "<script type='text/javascript'>alert('La nuova password ti sarà inviata per email')</script>";
    }else{
        echo "<script type='text/javascript'>alert('L\'email inserita o è sbagliata o non è presente un account con questa email')</script>";
    }
    $_SESSION["errorRequestNewPassword"] = "";
}
?>
