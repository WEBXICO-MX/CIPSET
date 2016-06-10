<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class Capacitacion {

    private $id;

    /**
     * @var CategoriaCapacitacion $categoriaCapacitacionId tipo CategoriaCapacitacion
     */
    private $categoriaCapacitacionId;

    /**
     * @var TipoCapacitacion $tipoCapacitacionId tipo TipoCapacitacion
     */
    private $tipoCapacitacionId;
    private $nombre;
    private $descripcion;
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
        $this->categoriaCapacitacionId = NULL;
        $this->tipoCapacitacionId = NULL;
        $this->nombre = "";
        $this->descripcion = "";
        $this->fechaRegistro = NULL;
        $this->fechaModificacion = NULL;
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    /**
     * @return CategoriaCapacitacion Devuelve tipo CategoriaCapacitacion
     */
    function getCategoriaCapacitacionId() {
        return $this->categoriaCapacitacionId;
    }

    /**
     * @return TipoCapacitacion Devuelve tipo TipoCapacitacion
     */
    function getTipoCapacitacionId() {
        return $this->tipoCapacitacionId;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
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

    function setCategoriaCapacitacionId(CategoriaCapacitacion $categoriaCapacitacionId) {
        $this->categoriaCapacitacionId = $categoriaCapacitacionId;
    }

    function setTipoCapacitacionId(TipoCapacitacion $tipoCapacitacionId) {
        $this->tipoCapacitacionId = $tipoCapacitacionId;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
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
            $this->id = UtilDB::getSiguienteNumero("capacitaciones", "id");
            $sql = "INSERT INTO capacitaciones (id,categoria_capacitacion_id,tipo_capacitacion_id,nombre,descripcion,fecha_registro,fecha_modificacion,activo) VALUES($this->id," . ($this->categoriaCapacitacionId->getId()) . "," . ($this->tipoCapacitacionId->getId()) . ",'$this->nombre','$this->descripcion',NOW(),NULL,$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE capacitaciones SET ";
            $sql.= "categoria_capacitacion_id = " . ($this->categoriaCapacitacionId->getId()) . ",";
            $sql.= "tipo_capacitacion_id = " . ($this->tipoCapacitacionId->getId()) . ",";
            $sql.= "nombre = '$this->nombre',";
            $sql.= "descripcion = '$this->descripcion',";
            $sql.= "fecha_modificacion = NOW(),";
            $sql.= "activo = $this->activo";
            $sql.= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM capacitaciones WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->categoriaCapacitacionId = new CategoriaCapacitacion($row['categoria_capacitacion_id']);
            $this->tipoCapacitacionId = new TipoCapacitacion($row['tipo_capacitacion_id']);
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->fechaRegistro = $row['fecha_registro'];
            $this->fechaModificacion = $row['fecha_modificacion'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
