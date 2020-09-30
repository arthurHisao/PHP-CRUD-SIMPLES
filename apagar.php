<?php
    session_start();
    
    require './Conexao.php';
   
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    if (!empty($id)):
        $con = new Conexao();
        $result_delete = "DELETE FROM usuarios WHERE id=:id";
        
        $resultado_delete = $con->getConexao()->prepare($result_delete);
        $resultado_delete->bindParam(":id", $id);
        
        if($resultado_delete->execute()):
            $_SESSION['msg'] = "<p style='color: green;'>Registro apagado</p>";
            header("Location: index.php");
        endif;        
    else:
        $_SESSION['msg'] = "<p style='color: red;'>Registro não encontrado</p>";
        header("Location: index.php");
    endif;