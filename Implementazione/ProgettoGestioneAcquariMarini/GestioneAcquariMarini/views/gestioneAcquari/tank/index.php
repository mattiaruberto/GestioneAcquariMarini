<div class="containerDiv">
    <h1 align="center" style="margin: 5%">Gestione Vasche</h1>
    <button class="btn btn-primary btn-sm" <?php if($_SESSION["type"] == 'User'){ echo "disabled"; } ?> onclick="moveToAddTank()">Aggiungi vasca</button>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Magnesio</th>
                <th>Calcio</th>
                <th>Kh</th>
                <th>Cambio d'acqua</th>
                <th>Litri</th>
                <th>Abitanti</th>
                <th>Modifica</th>
                <th>Rimuovi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($aquariums as $aquarium): ?>
                <tr>
                    <?php $nameBowl = $aquarium["nome"]; ?>

                    <?php foreach ($aquarium as $row): ?>
                        <td><?php echo $row; ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="<?php echo URL; ?>habitantManagement" class="btn btn-primary btn-sm" >Abitanti</a>
                    </td>
                    <td>
                        <a href="<?php echo URL; ?>tankManagement/formModifyTank/<?php echo $nameBowl; ?>" class="btn btn-primary btn-sm" >Modifica</a>
                    </td>
                    <td>
                        <button <?php if($_SESSION["type"] == 'User'){ echo "disabled"; } ?> class="btn btn-primary btn-sm" onclick="confirmDeleteTank('<?php echo $nameBowl; ?>', '<?php echo URL; ?>')">Rimuovi</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>