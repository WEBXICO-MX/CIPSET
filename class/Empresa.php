<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class Empresa {

    private $id;

    /**
     * @var SectorProductivo $sectorProductivoId tipo SectorProductivo
     */
    private $sectorProductivoId;
    private $nombre;
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
        $this->sectorProductivoId = NULL;
        $this->nombre = "";
        $this->fechaRegistro = NULL;
        $this->fechaModificacion = NULL;
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    /**
     * @return SectorProductivo Devuelve tipo SectorProductivo
     */
    function getSectorProductivoId() {
        return $this->sectorProductivoId;
    }

    function getNombre() {
        return $this->nombre;
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

    function setSectorProductivoId(SectorProductivo $sectorProductivoId) {
        $this->sectorProductivoId = $sectorProductivoId;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
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
            $this->id = UtilDB::getSiguienteNumero("empresas", "id");
            $sql = "INSERT INTO empresas (id,sector_productivo_id,nombre,fecha_registro,fecha_modificacion,activo) VALUES($this->id," . ($this->sectorProductivoId->getId()) . ",'$this->nombre',NOW(),NULL,$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE empresas SET ";
            $sql.= "sector_productivo_id = " . ($this->sectorProductivoId->getId()) . ",";
            $sql.= "nombre = '$this->nombre',";
            $sql.= "fecha_modificacion = NOW(),";
            $sql.= "activo = $this->activo";
            $sql.= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM empresas WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->sectorProductivoId = new SectorProductivo($row['sector_productivo_id']);
            $this->nombre = $row['nombre'];
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
