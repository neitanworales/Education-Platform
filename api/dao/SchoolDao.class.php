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

    public function getTemas(){
        $que = "SELECT * FROM temas WHERE estatus<>0";
        return $this->bd->ObtenerConsulta($que);
    }

    public function getTemasById($id){
        $que = "SELECT * FROM temas WHERE id=$id AND estatus<>0";
        return $this->bd->ObtenerConsulta($que);
    }

    public function guardarTema($titulo,$descripcion,$presentador,$categoria){
        $insert = "INSERT INTO temas(id,titulo,descripcion,presentador,categoria,estatus,fecha_creacion)"
        ."VALUES (null,'$titulo','$descripcion','$presentador','$categoria','1',NOW());";
        return $this->bd->ejecutar($insert);
    }

    public function actualizarTema($id,$titulo,$descripcion,$presentador,$categoria,$estatus){
        $update = "UPDATE temas SET ";

        if (!empty($titulo)) {
            $update .= "titulo = '$titulo', ";
        }

        if (!empty($descripcion)) {
            $update .= "descripcion='$descripcion', ";
        }

        if (!empty($presentador)) {
            $update .= "presentador = '$presentador', ";
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

    public function desactivarTema($id){
        $update = "UPDATE temas SET estatus=0, deleted_date=NOW() WHERE id=$id";
        return $this->bd->ejecutar($update);
    }

    public function validarCursoTema($curso_id, $tema_id){
        $que = "SELECT id FROM cursos_temas
        WHERE curso_id=$curso_id AND tema_id=$tema_id";
        return empty($this->bd->ObtenerConsulta($que));
    }

    public function agregarTema($curso_id, $tema_id){
        $insert = "INSERT INTO cursos_temas(id,curso_id,tema_id)"
        ." VALUES (null,$curso_id,$tema_id);";
        return $this->bd->ejecutar($insert);
    }

    public function quitarTema($curso_id, $tema_id){
        $delete = "DELETE FROM cursos_temas WHERE curso_id=$curso_id AND tema_id=$tema_id";
        return $this->bd->ejecutar($delete);
    }

    public function obtenerTemasByCurso($curso_id){
        $que = "SELECT T.id, T.titulo, T.descripcion, CONCAT(U.nombre,' ',U.apellido) presentador FROM cursos_temas CT 
        INNER JOIN temas T ON CT.tema_id=T.id
        INNER JOIN usuarios U ON U.id=T.presentador
        WHERE CT.curso_id=$curso_id";
        return $this->bd->ObtenerConsulta($que);
    }

    public function obtenerCursosBtTema($tema_id){
        $que = "SELECT C.id, C.nombre FROM cursos_temas CT 
        INNER JOIN cursos C ON CT.curso_id=C.id
        WHERE CT.tema_id=$tema_id";
        return $this->bd->ObtenerConsulta($que);
    }

    public function getClases(){
        $que = "SELECT * FROM clases WHERE estatus<>0";
        return $this->bd->ObtenerConsulta($que);
    }

    public function getClasesById($id){
        $que = "SELECT * FROM clases WHERE id=$id AND estatus<>0";
        return $this->bd->ObtenerConsulta($que);
    }

    public function guardarClase($tema_id,$titulo,$descripcion){
        $insert = "INSERT INTO clases(id,tema_id,titulo,descripcion,estatus,fecha_creacion)"
        ."VALUES (null,'$tema_id','$titulo','$descripcion','1',NOW());";
        return $this->bd->ejecutar($insert);
    }

    public function actualizar($id,$tema_id,$titulo,$descripcion,$estatus){
        $update = "UPDATE clases SET ";

        if (!empty($tema_id)) {
            $update .= "tema_id = '$tema_id', ";
        }

        if (!empty($titulo)) {
            $update .= "titulo = '$titulo', ";
        }

        if (!empty($descripcion)) {
            $update .= "descripcion='$descripcion', ";
        }

        if (!empty($estatus)) {
            $update .= "estatus='$estatus', ";
        }

        $update .= " fecha_updated=NOW()";
        $update .= " WHERE id=$id";
        return $this->bd->ejecutar($update);
    }

    public function desactivarClase($id){
        $update = "UPDATE clases SET estatus=0, deleted_date=NOW() WHERE id=$id";
        return $this->bd->ejecutar($update);
    }
}

?>