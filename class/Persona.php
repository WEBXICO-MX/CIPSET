<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class Persona {

    private $id;
    private $nombre;
    private $apPaterno;
    private $apMaterno;
    private $fechaNacimiento;
    private $sexo;
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
        $this->nombre = "";
        $this->apPaterno = "";
        $this->apMaterno = "";
        $this->fechaNacimiento = NULL;
        $this->fechaRegistro = NULL;
        $this->fechaModificacion = NULL;
        $this->sexo = "";
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApPaterno() {
        return $this->apPaterno;
    }

    function getApMaterno() {
        return $this->apMaterno;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getSexo() {
        return $this->sexo;
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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApPaterno($apPaterno) {
        $this->apPaterno = $apPaterno;
    }

    function setApMaterno($apMaterno) {
        $this->apMaterno = $apMaterno;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
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
            $this->id = UtilDB::getSiguienteNumero("tipos_medios_comunicacion", "id");
            $sql = "INSERT INTO personas (id,nombre,ap_paterno,ap_materno,fecha_nacimiento,sexo,fecha_registro,fecha_modificacion,activo) VALUES($this->id,'$this->nombre','$this->apPaterno','$this->apMaterno','$this->fechaNacimiento','$this->sexo',NOW(),NULL,$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE personas SET ";
            $sql.= "nombre = '$this->nombre',";
            $sql.= "ap_paterno = '$this->apPaterno',";
            $sql.= "ap_materno = '$this->apMaterno',";
            $sql.= "fecha_nacimiento = '$this->fechaNacimiento',";
            $sql.= "sexo = '$this->sexo',";
            $sql.= "fecha_modificacion = NOW(),";
            $sql.= "activo = $this->activo";
            $sql.= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM personas WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->apPaterno = $row['ap_paterno'];
            $this->apMaterno = $row['ap_materno'];
            $this->fechaNacimiento = $row['fecha_nacimiento'];
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->sexo = $row['sexo'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}