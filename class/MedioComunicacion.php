<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class MedioComunicacion {

    private $id;

    /**
     * @var Persona $personaId tipo Persona
     */
    private $personaId;

    /**
     * @var TipoMedioComunicacion $tipoMedioComunicacionId tipo TipoMedioComunicacion
     */
    private $tipoMedioComunicacionId;
    private $valor;
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
        $this->personaId = NULL;
        $this->tipoMedioComunicacionId = NULL;
        $this->valor = "";
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    /**
     * @return Persona Devuelve tipo Persona
     */
    function getPersonaId() {
        return $this->personaId;
    }

    /**
     * @return TipoMedioComunicacion Devuelve tipo TipoMedioComunicacion
     */
    function getTipoMedioComunicacionId() {
        return $this->tipoMedioComunicacionId;
    }

    function getValor() {
        return $this->valor;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPersonaId(Persona $personaId) {
        $this->personaId = $personaId;
    }

    function setTipoMedioComunicacionId(TipoMedioComunicacion $tipoMedioComunicacionId) {
        $this->tipoMedioComunicacionId = $tipoMedioComunicacionId;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->id = UtilDB::getSiguienteNumero("medios_comunicacion", "id");
            $sql = "INSERT INTO medios_comunicacion (id,persona_id,tipo_medio_comunicacion_id,valor,activo) VALUES($this->id," . ($this->personaId->getId()) . "," . ($this->tipoMedioComunicacionId->getId()) . ",'$this->valor',$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE ﻿medios_comunicacion SET ";
            $sql.= "persona_id = " . ($this->personaId->getId()) . ",";
            $sql.= "tipo_medio_comunicacion_id = " . ($this->tipoMedioComunicacionId->getId()) . ",";
            $sql.= "valor = '$this->valor',";
            $sql.= "activo = $this->activo";
            $sql.= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM ﻿medios_comunicacion WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->personaId = new Persona($row['persona_id']);
            $this->tipoMedioComunicacionId = new TipoMedioComunicacion($row['tipo_medio_comunicacion_id']);
            $this->valor = $row['valor'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
