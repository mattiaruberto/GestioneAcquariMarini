<div class="containerDiv">
    <h1 style="margin-top: 3%; margin-bottom: 3%" align="center">Pagina Gestione Utenti</h1>
    <a href="<?php echo URL; ?>userManagement/formAddUser" class="btn btn-primary btn-sm">Aggiungi utente</a>
    <br>
    <h3 id="addUser">Tabella Utenti</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Email</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Tipo</th>
                <th>Numero Telefono</th>
                <th>CambioPassword</th>
                <th>Modifica</th>
                <th>Rimuovi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <?php $emailUser = $user["email"]; ?>
                    <?php foreach ($user as $row): ?>
                        <td><?php echo $row; ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="<?php echo URL; ?>tankManagement/formModifyTank/<?php echo $emailUser; ?>" class="btn btn-primary btn-sm" >Modifica</a>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="confirmDeleteUser('<?php echo $emailUser; ?>', '<?php echo URL; ?>')">Rimuovi</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>