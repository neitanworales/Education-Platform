<?php

/**
 * Summary of SeccionesDao
 */
class SchoolDao{
    private $bd;
    static $_instance;

    private function __construct(){
        require '../db/Db.class.php';
        $this->bd=Db::getInstance(1);
    }

    public static function getInstance(){
        if (!(self::$_instance instanceof self)){
            self::$_instance=new self();
        }
        return self::$_instance;
    }

    /**
     * Summary of getSecciones
     * @return array<array>
     */
    public function getCursos(){
        $que = "SELECT * FROM cursos WHERE estatus<>0";
        return $this->bd->ObtenerConsulta($que);
    }

    public function getCursosById($id){
        $que = "SELECT * FROM cursos WHERE id=$id AND estatus<>0";
        return $this->bd->ObtenerConsulta($que);
    }

    public function guardarCurso($nombre,$descripcion,$instructor,$fecha_inicio,$fecha_fin,$cupo_maximo,$precio,$nivel,$categoria){

        $insert = "INSERT INTO cursos(id,nombre,descripcion,instructor,fecha_inicio,fecha_fin,cupo_maximo,precio,nivel,categoria,fecha_creacion,estatus)"
        ."VALUES (null,'$nombre','$descripcion','$instructor','$fecha_inicio','$fecha_fin','$cupo_maximo','$precio','$nivel','$categoria',NOW(),'1');";
        return $this->bd->ejecutar($insert);
    }

    public function actualizarCurso($id,$nombre,$descripcion,$instructor,$fecha_inicio,$fecha_fin,$cupo_maximo,$precio,$nivel,$categoria,$estatus){
        $update = "UPDATE cursos SET ";

        if (!empty($nombre)) {
            $update .= "nombre = '$nombre', ";
        }

        if (!empty($descripcion)) {
            $update .= "descripcion='$descripcion', ";
        }

        if (!empty($instructor)) {
            $update .= "instructor = '$instructor', ";
        }

        if (!empty($fecha_inicio)) {
            $update .= "fecha_inicio='$fecha_inicio', ";
        }

        if (!empty($fecha_fin)) {
            $update .= "fecha_fin = '$fecha_fin', ";
        }

        if (!empty($cupo_maximo)) {
            $update .= "cupo_maximo='$cupo_maximo', ";
        }

        if (!empty($precio)) {
            $update .= "precio = '$precio', ";
        }

        if (!empty($nivel)) {
            $update .= "nivel='$nivel', ";
        }

        if (!empty($categoria)) {
            $update .= "categoria = '$categoria', ";
        }

        if (!empty($estatus)) {
            $update .= "estatus='$estatus', ";
        }

        $update .= " fecha_updated=NOW()";
        $update .= " WHERE id=$id";
        return $this->bd->ejecutar($update);
    }

    public function desactivarCurso($id){
        $update = "UPDATE cursos SET estatus=0, deleted_date=NOW() WHERE id=$id";
        return $this->bd->ejecutar($update);
    }
}

?>