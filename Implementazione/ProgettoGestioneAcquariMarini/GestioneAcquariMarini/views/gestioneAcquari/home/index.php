<div class="containerDiv">
    <h1 align="center" style="margin-top: 7%">Pagina Riassuntiva</h1>
    <div class="table-responsive">
        <table class="table table-bordered" style="margin-top: 7%">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Magnesio</th>
                <th>Calcio</th>
                <th>Kh</th>
                <th>Cambio d'acqua</th>
                <th>Litri</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($aquariums as $aquarium): ?>
                <tr>
                    <?php foreach ($aquarium as $row): ?>
                        <td><?php echo $row; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>