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