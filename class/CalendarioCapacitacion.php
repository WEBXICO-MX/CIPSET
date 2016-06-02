<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class CalendarioCapacitacion {

    private $id;

    /**
     * @var Capacitacion $capacitacionId tipo Capacitacion
     */
    private $capacitacionId;
    private $fechaInicio;
    private $fechaFin;

    /**
     * @var Usuario $usuarioRegistro; tipo Usuario
     */
    private $usuarioRegistro;

    /**
     * @var Usuario $usuarioModifico; tipo Usuario
     */
    private $usuarioModifico;
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
        $this->capacitacionId = NULL;
        $this->fechaInicio = NULL;
        $this->fechaFin = NULL;
        $this->usuarioRegistro = NULL;
        $this->usuarioModifico = NULL;
        $this->fechaRegistro = NULL;
        $this->fechaModificacion = NULL;
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    function getCapacitacionId() {
        return $this->capacitacionId;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getUsuarioRegistro() {
        return $this->usuarioRegistro;
    }

    function getUsuarioModifico() {
        return $this->usuarioModifico;
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

    function setCapacitacionId(Capacitacion $capacitacionId) {
        $this->capacitacionId = $capacitacionId;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setUsuarioRegistro(Usuario $usuarioRegistro) {
        $this->usuarioRegistro = $usuarioRegistro;
    }

    function setUsuarioModifico(Usuario $usuarioModifico) {
        $this->usuarioModifico = $usuarioModifico;
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
            $this->id = UtilDB::getSiguienteNumero("calendarios_capacitaciones", "id");
            $sql = "INSERT INTO calendarios_capacitaciones (id,capacitacion_id,fecha_inicio,fecha_fin,usuario_registro,usuario_modifico,fecha_registro,fecha_modificacion,activo) VALUES($this->id," . ($this->capacitacionId->getId()) . ",'$this->fechaInicio','$this->fechaFin'," . ($this->usuarioRegistro->getId()) . ",NULL,NOW(),NULL,$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE ﻿calendarios_capacitaciones SET ";
            $sql.= "capacitacion_id = " . ($this->capacitacionId->getId()) . ",";
            $sql.= "fecha_inicio = '$this->fechaInicio',";
            $sql.= "fecha_fin = '$this->fechaFin',";
            $sql.= "usuario_modifico = " . ($this->usuarioModifico->getId()) . ",";
            $sql.= "fecha_modificacion = NOW(),";
            $sql.= "activo = $this->activo";
            $sql.= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM calendarios_capacitaciones WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->capacitacionId = new Capacitacion($row['capacitacion_id']);
            $this->fechaInicio = $row['fecha_inicio'];
            $this->fechaFin = $row['fecha_fin'];
            $this->usuarioRegistro = new Usuario($row['usuario_registro']);
            $this->usuarioModifico = new Usuario($row['usuario_modifico']);
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->activo = $row['activo'];
            $this->_existe = false;
        }
        $rst->closeCursor();
    }

}
