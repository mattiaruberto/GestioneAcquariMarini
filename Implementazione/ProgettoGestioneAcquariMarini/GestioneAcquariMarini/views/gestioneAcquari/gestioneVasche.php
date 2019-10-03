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
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Litraggio</th>
            <th>Rimuovi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($aquariums as $aquarium): ?>
            <tr>
                <?php foreach ($aquarium as $row): ?>
                    <td><?php echo $row; ?></td>
                <?php endforeach; ?>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="location.href='<?php echo URL; ?>gestioneVasche/delete/<?php $name; ?>'">Rimuovi</button>
                </td>
            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>
</div>