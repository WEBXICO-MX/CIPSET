<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class Instructor {

    private $id;

    /**
     * @var Persona $cvePersona tipo Persona
     */
    private $cvePersona;

    /**
     * @var Especialidad $tipoCapacitacionId tipo Especialidad
     */
    private $cveEspecialidad;
    private $rutaFoto;
    private $experiencia;
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
        $this->cvePersona = NULL;
        $this->cveEspecialidad = NULL;
        $this->rutaFoto = "";
        $this->experiencia = "";
        $this->fechaRegistro = "";
        $this->fechaModificacion = "";
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    /**
     * @return Persona Devuelve Persona
     */
    function getCvePersona() {
        return $this->cvePersona;
    }

    /**
     * @return Especialidad Devuelve Especialidad
     */
    function getCveEspecialidad() {
        return $this->cveEspecialidad;
    }

    function getRutaFoto() {
        return $this->rutaFoto;
    }

    function getExperiencia() {
        return $this->experiencia;
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

    function setCvePersona(Persona $cvePersona) {
        $this->cvePersona = $cvePersona;
    }

    function setCveEspecialidad(Especialidad $cveEspecialidad) {
        $this->cveEspecialidad = $cveEspecialidad;
    }

    function setRutaFoto($rutaFoto) {
        $this->rutaFoto = $rutaFoto;
    }

    function setExperiencia($experiencia) {
        $this->experiencia = $experiencia;
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
            $this->id = UtilDB::getSiguienteNumero("instructores", "id");
            $sql = "INSERT INTO instructores VALUES(";
            $sql .= "$this->id,";
            $sql .= $this->cvePersona->getId() . ",";
            $sql .= $this->cveEspecialidad->getId() . ",";
            $sql .= "'$this->rutaFoto',";
            $sql .= "'$this->experiencia',";
            $sql .= "NOW(),";
            $sql .= "NULL,";
            $sql .= "$this->activo";
            $sql .= ")";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE instructores SET ";
            $sql .= "cve_persona = " . ($this->cvePersona->getId()) . ",";
            $sql .= "cve_especialidad = " . ($this->cveEspecialidad->getId()) . ",";
            $sql .= "ruta_foto = '$this->rutaFoto',";
            $sql .= "experiencia = '$this->experiencia',";
            $sql .= "fecha_modificacion = NOW(),";
            $sql .= "activo = $this->activo";
            $sql .= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM instructores WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->cvePersona = new Persona((int) $row['cve_persona']);
            $this->cveEspecialidad = new Especialidad((int) $row['cve_especialidad']);
            $this->rutaFoto = $row['ruta_foto'];
            $this->experiencia = $row['experiencia'];
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
