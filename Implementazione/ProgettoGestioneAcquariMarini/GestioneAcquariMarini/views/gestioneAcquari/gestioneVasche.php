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
    <h1 align="center">Pagina Gestione Vasche</h1>
    <h3 id="addUser">Aggiungi vasca</h3>
    <form class="form-inline" action="<?php echo "/2018/modulo133/Compiti/Serie/Serie5/TemplateMVC/instrument/addInstrument/"; ?>" method="POST">
        <div class="form-group">
            Nome <input class="form-control" type="text" name="TankName"/>
        </div>
        <div class="form-group">
            Litraggio <input class="form-control" type="number" name="TankLitrage"/>
        </div>
        <br>
        <input type="submit" name="submit_add_strumento" value="Add" class="btn btn-default" style="margin-top: 1%"/>
    </form>
    <h3 id="addUser">Tabella vasche</h3>
</div>