<?php
require_once 'ChromePhp.php';
/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class InstructorCapacitacion {

    /**
     * @var Instructor $cveInstructor tipo Instructor
     */
    private $cveInstructor;

    /**
     * @var Capacitacion $cveCapacitacion tipo Capacitacion
     */
    private $cveCapacitacion;
    private $fechaRegistro;
    private $fechaModificacion;
    private $activo;
    private $_existe;

    function __construct() {
        $this->limpiar();

        $args = func_get_args();
        $nargs = func_num_args();

        switch ($nargs) {
            case 2:
                self::__construct1($args[0], $args[1]);
                break;
            //case 2:
            //self::__construct2($args[0], $args[1]);
            //break;
        }
    }

    function __construct1($xCveInstructor, $xCveCapacitacion) {
        $this->limpiar();
        $this->cveInstructor = $xCveInstructor;
        $this->cveCapacitacion = $xCveCapacitacion;
        $this->cargar();
    }

    private function limpiar() {
        $this->cveInstructor = NULL;
        $this->cveCapacitacion = NULL;
        $this->fechaRegistro = "";
        $this->fechaModificacion = "";
        $this->activo = false;
        $this->_existe = false;
    }

    /**
     * @return Instructor Devuelve Instructor
     */
    function getCveInstructor() {
        return $this->cveInstructor;
    }

    /**
     * @return Capacitacion Devuelve Capacitacion
     */
    function getCveCapacitacion() {
        return $this->cveCapacitacion;
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

    function setCveInstructor(Instructor $cveInstructor) {
        $this->cveInstructor = $cveInstructor;
    }

    function setCveCapacitacion(Capacitacion $cveCapacitacion) {
        $this->cveCapacitacion = $cveCapacitacion;
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
            $sql = "INSERT INTO instructores_capacitaciones VALUES(";
            $sql .= $this->cveInstructor->getId() . ",";
            $sql .= $this->cveCapacitacion->getId() . ",";
            $sql .= "NOW(),";
            $sql .= "NULL,";
            $sql .= "$this->activo";
            $sql .= ")";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE instructores_capacitaciones SET ";
            $sql .= "fecha_modificacion = NOW(),";
            $sql .= "activo = $this->activo";
            $sql .= " WHERE cve_instructor = ".$this->cveInstructor->getId()." AND cve_capacitacion = ".$this->cveCapacitacion->getId();
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM instructores_capacitaciones WHERE cve_instructor = ".$this->cveInstructor->getId()." AND cve_capacitacion = ".$this->cveCapacitacion->getId();
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->cveInstructor = new Instructor((int) $row['cve_instructor']);
            $this->cveCapacitacion = new Capacitacion((int) $row['cve_capacitacion']);
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
