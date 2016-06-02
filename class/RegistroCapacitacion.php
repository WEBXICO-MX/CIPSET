<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class RegistroCapacitacion {

    private $id;

    /**
     * @var CalendarioCapacitacion $calendarioCapacitacionId CalendarioCapacitacion
     */
    private $calendarioCapacitacionId;

    /**
     * @var Persona $personaId Persona 
     */
    private $personaId;

    /**
     * @var Empresa $empresaId Empresa 
     */
    private $empresaId;

    /**
     * @var Estatus $estatusId Estatus 
     */
    private $estatusId;
    private $fechaRegistro;
    private $fechaModificacion;
    private $activo;
    private $_existe;

    function __construct() {
        $this->limpiar();

        $args = func_get_args();
        $nargs = func_num_args();

        switch ($nargs) {
            case 1:
                self::__construct1($args[0]);
                break;
            //case 2:
            //self::__construct2($args[0], $args[1]);
            //break;
        }
    }

    function __construct1($id) {
        $this->limpiar();
        $this->id = $id;
        $this->cargar();
    }

    private function limpiar() {
        $this->id = 0;
        $this->calendarioCapacitacionId = NULL;
        $this->personaId = NULL;
        $this->empresaId = NULL;
        $this->estatusId = NULL;
        $this->fechaRegistro = NULL;
        $this->fechaModificacion = NULL;
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    function getCalendarioCapacitacionId() {
        return $this->calendarioCapacitacionId;
    }

    function getPersonaId() {
        return $this->personaId;
    }

    function getEmpresaId() {
        return $this->empresaId;
    }

    function getEstatusId() {
        return $this->estatusId;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaModificacion() {
        return $this->fechaModificacion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCalendarioCapacitacionId(CalendarioCapacitacion $calendarioCapacitacionId) {
        $this->calendarioCapacitacionId = $calendarioCapacitacionId;
    }

    function setPersonaId(Persona $personaId) {
        $this->personaId = $personaId;
    }

    function setEmpresaId(Empresa $empresaId) {
        $this->empresaId = $empresaId;
    }

    function setEstatusId(Estatus $estatusId) {
        $this->estatusId = $estatusId;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaModificacion($fechaModificacion) {
        $this->fechaModificacion = $fechaModificacion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->id = UtilDB::getSiguienteNumero("registros_capacitaciones", "id");
            $sql = "INSERT INTO registros_capacitaciones (id,calendario_capacitacion_id,persona_id,empresa_id,estatus_id,fecha_registro,fecha_modificacion,activo) VALUES($this->id," . ($this->calendarioCapacitacionId->getId()) . "," . ($this->personaId->getId()) . "," . ($this->empresaId->getId()) . "," . ($this->estatusId->getId()) . ",NOW(),NULL,$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE registros_capacitaciones SET ";
            $sql.= "calendario_capacitacion_id = " . ($this->calendarioCapacitacionId->getId()) . ",";
            $sql.= "persona_id = " . ($this->personaId->getId()) . ",";
            $sql.= "empresa_id = " . ($this->empresaId->getId()) . ",";
            $sql.= "estatus_id = " . ($this->estatusId->getId()) . ",";
            $sql.= "fecha_modificacion = NOW(),";
            $sql.= "activo = $this->activo";
            $sql.= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM registros_capacitaciones WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->calendarioCapacitacionId = new CalendarioCapacitacion($row['calendario_capacitacion_id']);
            $this->personaId = new Persona($row['persona_id']);
            $this->empresaId = new Empresa($row['empresa_id']);
            $this->estatusId = new Estatus($row['estatus_id']);
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->activo = $row['activo'];
            $this->_existe = false;
        }
        $rst->closeCursor();
    }

}
