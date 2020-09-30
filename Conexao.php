<?php

/**
 * Description of Conexao
 *
 * @author arthur
 */
class Conexao { //conexao com banco

    public static $Host = "localhost";
    public static $User = "root";
    public static $Pass = "sua senha";
    public static $Dbname = "aula";
    private static $Connect = null;
    
    private static function Conectar() {
        try {
            if(self::$Connect == null):
                self::$Connect = new PDO('mysql:localhost='.self::$Host.';dbname='.self::$Dbname, self::$User, self::$Pass);
            endif;
        } catch (Exception $ex) {
            echo "Erro: " .$ex->getMessage();
            die;
        }
        return self::$Connect;
    }
   
    public function getConexao() {
        return self::Conectar();
    }
}
