<?php

/**
 *
 * @author Roberto Eder Weiss Juárez
 * @see {@link http://webxico.blogspot.mx/}
 */
class Especialidad {

    private $id;
    private $nombre;
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
        $this->activo = false;
        $this->_existe = false;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
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

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function grabar() {
        $sql = "";
        $count = 0;

        if (!$this->_existe) {
            $this->id = UtilDB::getSiguienteNumero("especialidades", "id");
            $sql = "INSERT INTO especialidades (id,nombre,activo) VALUES($this->id,'$this->nombre',$this->activo)";
            $count = UtilDB::ejecutaSQL($sql);
            if ($count > 0) {
                $this->_existe = true;
            }
        } else {
            $sql = "UPDATE especialidades SET ";
            $sql .= "nombre = '$this->nombre',";
            $sql .= "activo = $this->activo";
            $sql .= " WHERE id = $this->id";
            $count = UtilDB::ejecutaSQL($sql);
        }

        return $count;
    }

    function cargar() {
        $sql = "SELECT * FROM especialidades WHERE id = $this->id";
        $rst = UtilDB::ejecutaConsulta($sql);

        foreach ($rst as $row) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->activo = $row['activo'];
            $this->_existe = true;
        }
        $rst->closeCursor();
    }

}
