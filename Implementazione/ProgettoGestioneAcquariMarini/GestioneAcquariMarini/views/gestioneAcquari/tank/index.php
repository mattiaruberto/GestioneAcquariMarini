<div class="containerDiv">
    <h1 align="center" style="margin: 5%">Gestione Vasche</h1>
    <a href="<?php echo URL; ?>tankManagement/formAddTank" class="btn btn-primary btn-sm">Aggiungi vasca</a>
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
                        <a class="btn btn-primary btn-sm" onclick="confirmDeleteTank('<?php echo $nameBowl; ?>')">Abitanti</a>
                    </td>
                    <td>
                        <a href="<?php echo URL; ?>tankManagement/formModifyTank/<?php echo $nameBowl; ?>" class="btn btn-primary btn-sm" >Modifica</a>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="confirmDeleteTank('<?php echo $nameBowl; ?>', '<?php echo URL; ?>')">Rimuovi</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>