<?php

/**
 * Summary of SeccionesDao
 */
class UsuariosDao {
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
    public function registarUsuario($nombre, $apellidos, $email){
        $insert="INSERT INTO usuarios(id, ";
        $values="VALUES(NULL,";

        if(!empty($nombre)){
            $insert.="nombre, ";
            $values.="'$nombre', ";
        }

        if(!empty($apellidos)){
            $insert.="apellidos, ";
            $values.="'$apellidos', ";
        }

        if(!empty($email)){
            $insert.="email, ";
            $values.="'$email', ";
        }

        $insert.="fechahora_registro)  ";
        $values.="(NOW()))";  

        $sentence = $insert.$values;

        return $this->bd->ejecutar($sentence);
    }

    public function getUsuarioByEmail($email){
        $que = "SELECT * FROM usuarios WHERE email='$email' ";
        return $this->bd->ObtenerConsulta($que);
    }  
}

?>