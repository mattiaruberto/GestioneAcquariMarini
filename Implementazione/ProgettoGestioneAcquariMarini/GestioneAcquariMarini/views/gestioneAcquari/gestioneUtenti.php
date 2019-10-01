<!-- form per aggiunta strumento -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Gestione Acquari Marini</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="#">Riassuntiva</a></li>
                <li><a href="#">Gestione vasche</a></li>
                <li><a href="#">Gestione utenti</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="containerDiv">
        <h1 align="center">Pagina Gestione Utenti</h1>
    <h3 id="addUser">Gestione Utente</h3>
    <form class="form-inline" action="<?php echo "/2018/modulo133/Compiti/Serie/Serie5/TemplateMVC/instrument/addInstrument/"; ?>" method="POST">
        <div class="form-group">
            Email <input class="form-control" type="email" email="email"/>
        </div>
        <div class="form-group">
            Password <input class="form-control" type="password" name="password"/>
        </div>
        <div class="form-group">
            Permesso
            <select class="form-control">
                <option></option>
                <option>Admin</option>
                <option>User</option>
            </select>
        </div>
        <br>
        <input type="submit" name="submit_add_strumento" value="Add" class="btn btn-default" style="margin-top: 1%"/>
    </form>
    <h3 id="addUser">Tabella Utenti</h3>
</div>