<?php
require_once '../class/UtilDB.php';

$sql = "";
$rst = NULL;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Agregar empresa</h4>
</div>
<div class="modal-body">
    <div class="te">
        <!--  Empresa -->
        <form action="" method="post" id="frmRegistroEmpresa" name="frmRegistroEmpresa">
            <div class="form-group">
                <label for="txtNombreEmpresa">Nombre:</label>
                <input type="text" name="txtNombreEmpresa" id="txtNombreEmpresa" maxlength="50" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="cmbSectorProductivo">Sector productivo</label>
                <select name="cmbSectorProductivo" id="cmbSectorProductivo" class="form-control">
                    <option value="0">----- Seleccione una opción -----</option>
                    <?php
                    $sql = "SELECT * FROM sectores_productivos WHERE activo = 1 ORDER BY nombre";
                    $rst = UtilDB::ejecutaConsulta($sql);
                    foreach ($rst as $row) {
                        echo("<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>");
                    }
                    $rst->closeCursor();
                    ?>
                </select>

            </div> 
            <button type="submit" class="btn btn-success" id="btnGrabar" name="btnGrabar">Guardar</button>
        </form>
        <!--  Empresa -->

        <div class="alert fade in" id="div_mensaje2" style="display:none; margin-top: 25px;">
            <a href="#" class="close" onclick="$('.alert').hide()" aria-label="close">&times;</a> 
            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <span id="mensaje2"></span>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
</div>