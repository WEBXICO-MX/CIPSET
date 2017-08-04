<?php
require_once '../class/UtilDB.php';
require_once '../class/Persona.php';
require_once '../class/Especialidad.php';
require_once '../class/Instructor.php';
$id = isset($_GET['i']) ? ((int) $_GET['i']) : 0;
$instructor = new Instructor($id);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Acerca del instructor</h4>
</div>
<div class="modal-body">
    <div class="te">
        <?php if($instructor->getRutaFoto() !== ""){
            echo('<p style="text-align:center"><img src="../'.$instructor->getRutaFoto().'" alt="'.$instructor->getCvePersona()->getNombreCompleto().'" widht="100px" height="100px"/></p>');
        } ?>        
        <p><b>Nombre completo:</b> <?php echo($instructor->getCvePersona()->getNombreCompleto());?></p>
        <p><b>Especilidad:</b> <?php echo($instructor->getCveEspecialidad()->getNombre());?></p>
        <p><b>Experiencia:</b> <?php echo($instructor->getExperiencia());?></p>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
</div>