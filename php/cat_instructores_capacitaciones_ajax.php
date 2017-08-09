<?php
require_once '../class/Especialidad.php';
require_once '../class/Persona.php';
require_once '../class/Instructor.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/Capacitacion.php';
require_once '../class/InstructorCapacitacion.php';
require_once '../class/UtilDB.php';
require_once '../class/ChromePhp.php';

if (isset($_POST["xAccion"])) {
    if ($_POST["xAccion"] === "grabar") {
        $ic = new InstructorCapacitacion(new Instructor(isset($_POST['xCveInstructor']) ? ((int) $_POST['xCveInstructor']) : 0), new Capacitacion(isset($_POST['xCveCapacitacion']) ? ((int) $_POST['xCveCapacitacion']) : 0));
        $ic->setActivo($_POST['xSeAgrega']);
        $resultado = $ic->grabar();
        echo($resultado);
        return;
    }
    if ($_POST["xAccion"] === "getTablaCapacitaciones") {
        $instructor = new Instructor(isset($_POST['xCveInstructor']) ? ((int) $_POST['xCveInstructor']) : 0);
        ?>
        <h3 class="text-center"><strong>Instructor:</strong> <span style="color:#286090"><?php echo($instructor->getCvePersona() != NULL ? $instructor->getCvePersona()->getNombreCompleto() : "") ?></span></h3>
        <h3 class="text-center"><strong>Especialidad:</strong> <span style="color:#286090"><?php echo($instructor->getCvePersona() != NULL ? $instructor->getCveEspecialidad()->getNombre() : "") ?></span></h3>
        <p>Desde aqui puede agregar o eliminar capacitaciones a un instructor especifico usando los botones "<span style="color:#449D44">Agregar</span>" y "<span style="color:#C9302C">Eliminar</span>".</p>
        <br/>
        <br/>
        <table id="tabla-intructores-capacitaciones" class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Capacitación</th>
                    <th>Categoría</th>
                    <th>Tipo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT c.id,cc.nombre AS categoria,t.nombre AS tipo, c.nombre , (SELECT cve_instructor FROM instructores_capacitaciones WHERE activo = 1 AND cve_instructor = " . $instructor->getId() . " AND cve_capacitacion = c.id) AS accion ";
                $sql .= "FROM capacitaciones AS c ";
                $sql .= "INNER JOIN categorias_capacitaciones AS cc ON cc.id = c.categoria_capacitacion_id ";
                $sql .= "INNER JOIN tipos_capacitaciones AS t ON t.id = c.tipo_capacitacion_id ";
                $sql .= "ORDER BY c.fecha_registro DESC";
                $rst = UtilDB::ejecutaConsulta($sql);
                foreach ($rst as $row) {
                    ?>
                    <tr>
                        <td><?php echo($row['id']); ?></td>
                        <td><?php echo($row['nombre']); ?></td>
                        <td><?php echo($row['categoria']); ?></td>
                        <td><?php echo($row['tipo']); ?></td>                                    
                        <td>
                            <?php
                            if ($row['accion'] == "") {
                                echo("<a href=\"javascript:void(0);\" onclick=\"agregarCapacitacion(" . $row['id'] . ",'" . $row['nombre'] . "'," . $instructor->getId() . ",'" . $instructor->getCvePersona()->getNombreCompleto() . "',true);\" class=\"btn btn-success\">Agregar</a>");
                            } else {
                                echo("<a href=\"javascript:void(0);\" onclick=\"agregarCapacitacion(" . $row['id'] . ",'" . $row['nombre'] . "'," . $instructor->getId() . ",'" . $instructor->getCvePersona()->getNombreCompleto() . "',false);\" class=\"btn btn-danger\">Eliminar</a>");
                            }
                            ?>
                        </td>                                    
                    </tr>
                <?php } $rst->closeCursor(); ?>
            </tbody>
        </table>
        <?php
        return;
    }
}
?>