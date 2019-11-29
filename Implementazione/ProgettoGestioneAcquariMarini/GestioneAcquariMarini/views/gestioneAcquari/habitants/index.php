<div class="containerDiv">
    <h1 style="margin-top: 3%;" align="center">Pagina Gestione Abitanti</h1>
    <h3 style="margin-bottom: 3%" align="center">Nome Vasca: <?php if(isset($habitants[0]["nome_vasca"])){ echo $habitants[0]["nome_vasca"]; } ?></h3>
    <a onclick="changeStateFormHabitant()" class="btn btn-primary btn-sm">Form gestione abitante</a>
    <br><br>
    <div id="divFormGestioneAbitante">
        <form id="formAddTanke" action="<?php echo $path; ?>" class="form-inline" method="POST">
            <div class="form-group">
                <label for="formGroupExampleInput">Specie</label>
                <input class="form-control" type="text" id="tankName" name="tankName" onchange="validateTankName()" value="<?php if(isset($tankName)){echo $tankName;} ?>"/>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Sesso</label>
                <input class="form-control" type="number" id="calcium" name="calcium" onchange="validateNumber(this, 0, 1000)" value="<?php if(isset($calcium)){echo $calcium;} ?>"/>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Tipo</label>
                <input class="form-control" type="number" id="kh" name="kh" onchange="validateNumber(this, 0, 20)" value="<?php if(isset($kh)){echo $kh;} ?>"/>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Numero</label>
                <input class="form-control" type="number" id="kh" name="kh" onchange="validateNumber(this, 0, 20)" value="<?php if(isset($kh)){echo $kh;} ?>"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" value="<?php echo $nameButton ?>"/>
            </div>
        </form>
    </div>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nome Specie</th>
                <th>Sesso</th>
                <th>Tipo</th>
                <th>Numero</th>
                <th>Modifica</th>
                <th>Rimuovi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($habitants as $habitant): ?>
                <tr>
                    <?php $species = $habitant["specie"]; ?>
                    <?php $sex = $habitant["genere"]; ?>
                    <?php foreach ($habitant as $key => $row): ?>
                        <?php if ($key != "nome_vasca"): ?>
                            <td><?php echo $row; ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <td>
                        <a href="<?php echo URL; ?>userManagement/formModifyUser/<?php echo $species; ?>/<?php echo $sex; ?>" class="btn btn-primary btn-sm" >Modifica</a>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="confirmDeleteHabitants('<?php echo $species; ?>', '<?php echo $sex; ?>', '<?php echo URL; ?>')">Rimuovi</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>