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
                <li><a href="#">Gestione vasche</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="containerDiv">
    <h1 align="center">Pagina Gestione Vasca</h1>
    <h3 id="addUser">Aggiungi pesce</h3>
    <form class="form-inline" action="<?php echo "/2018/modulo133/Compiti/Serie/Serie5/TemplateMVC/instrument/addInstrument/"; ?>" method="POST">
        <div class="form-group">
            Specie <input class="form-control" type="text" name="TankName"/>
        </div>
        <div class="form-group">
            Numero <input class="form-control" type="text" name="TankName"/>
        </div>
        <div class="form-group">
            Sesso
            <select class="form-control">
                <option></option>
                <option>Altro</option>
                <option>Maschio</option>
                <option>Femmina</option>
            </select>
        </div>
        <div class="form-group">
            Tipo
            <select class="form-control">
                <option></option>
                <option>Corallo</option>
                <option>Pesce</option>
                <option>Crostaceo</option>
            </select>
        </div>
        <br>
        <input type="submit" name="submit_add_strumento" value="Add" class="btn btn-default" style="margin-top: 1%"/>
    </form>
    <h3 id="addUser">Tabella pesci</h3>
    <p>...</p>

    <h3 id="addUser">Tabella valori</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Magnesio</th>
                <th scope="col">Calcio</th>
                <th scope="col">Kh</th>
                <th scope="col">Modifica</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td><button>Modifica</button></td>
            </tr>
        </tbody>
    </table>
</div>