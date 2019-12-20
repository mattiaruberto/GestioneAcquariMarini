<div class="containerDiv">
    <h1 style="margin-top: 3%;" align="center">Pagina Gestione Abitanti</h1>
    <h3 style="margin-bottom: 3%" align="center">Nome Vasca: <?php if(isset($_SESSION["referencesTankName"])){ echo $_SESSION["referencesTankName"]; } ?></h3>
    <a onclick="changeStateFormHabitant()" class="btn btn-primary btn-sm">Form gestione abitante</a>
    <br><br>
    <div id="divFormGestioneAbitante"  <?php if(isset($habitantForm) && $habitantForm){ ?> style="display: block" <?php }else{ ?> style="display: none" <?php } ?>>
        <p style='color: red;margin-left: 2%;'><?php if(isset($stringErrors)){ echo $stringErrors; } ?></p>
        <form id="formAddTanke" action="<?php echo $path; ?>" class="form-inline" method="POST">
            <div class="form-group">
                <label for="formGroupExampleInput">Specie</label>
                <input class="form-control" type="text" id="species" name="species" onchange="validateTankName(this)" value="<?php if(isset($habitantManagement["species"])){echo $habitantManagement["species"]; } ?>"/>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Sesso</label>
                <select class="form-control" id="sex" name="sex" onchange="validateSelectPermission(this)">
                    <option></option>
                    <option <?php if(isset($habitantManagement[HABITANT_SEX]) && $habitantManagement[HABITANT_SEX] == 'M'){echo 'selected';} ?>>M</option>
                    <option <?php if(isset($habitantManagement[HABITANT_SEX]) && $habitantManagement[HABITANT_SEX] == 'F'){echo 'selected';} ?>>F</option>
                    <option <?php if(isset($habitantManagement[HABITANT_SEX]) && $habitantManagement[HABITANT_SEX] == 'Altro'){echo 'selected';} ?>>Altro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Tipo</label>
                <select class="form-control" id="type" name="type" onchange="validateSelectPermission(this)">
                    <option></option>
                    <option <?php if(isset($habitantManagement[HABITANT_TYPE]) && $habitantManagement[HABITANT_TYPE] == 'Pesce'){echo 'selected';} ?>>Pesce</option>
                    <option <?php if(isset($habitantManagement[HABITANT_TYPE]) && $habitantManagement[HABITANT_TYPE] == 'Crostaceo'){echo 'selected';} ?>>Crostaceo</option>
                    <option <?php if(isset($habitantManagement[HABITANT_TYPE]) && $habitantManagement[HABITANT_TYPE] == 'Corallo'){echo 'selected';} ?>>Corallo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Numero</label>
                <input class="form-control" type="number" id="number" name="number" onchange="validateNumber(this, 0, 1000)" value="<?php if(isset($habitantManagement["habitantNumber"])){echo $habitantManagement["habitantNumber"]; } ?>"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" value="<?php if(isset($nameButton)){echo $nameButton;} ?>"/>
            </div>
        </form>
    </div>
    <br>
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
                        <a href="<?php echo URL; ?>habitantManagement/modifyHabitant/<?php echo $species; ?>/<?php echo $sex; ?>" class="btn btn-primary btn-sm" >Modifica</a>
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