<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script src="css/bootstrap/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            //editarar registros
            //ini_set('display_errors', 1);
            require './Conexao.php';
            
            $con = new Conexao();
            $Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if(!empty($Dados['sendEditUser'])):
                unset($Dados['sendEditUser']);
            
            $result_alterar = "UPDATE usuarios SET nome=:nome, email=:email, usuario=:usuario, 
                 senha=:senha, modified=NOW() WHERE id=:id";
  
                $resultado_alterar = $con->getConexao()->prepare($result_alterar);
                $resultado_alterar->bindParam(":nome", $Dados['nome']);
                $resultado_alterar->bindParam(":email", $Dados['email']);
                $resultado_alterar->bindParam(":usuario", $Dados['usuario']);
                $resultado_alterar->bindParam(":senha", $Dados['senha']);
                $resultado_alterar->bindParam(":id", $Dados['id']);
           
                if($resultado_alterar->execute()):
                    $_SESSION['msg'] = "<p style='color: green;'>Registro editado com sucesso</p>";
                    header("Location: index.php");
                    else:
                        echo "<p style='color:red'>Registro não foi editado</p>";
                endif;
            endif;
            
            //Pesquisando os dados do usuario
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $limit = 1;
            
            $result_user = "SELECT * FROM usuarios WHERE id=:id LIMIT :limit";
            $resultado_user = $con->getConexao()->prepare($result_user);
            $resultado_user->bindParam("id", $id, PDO::PARAM_INT);
            $resultado_user->bindParam("limit", $limit, PDO::PARAM_INT);
            $resultado_user->execute();
            $row_user = $resultado_user->fetch(PDO::FETCH_ASSOC);
        ?>
        <h1>Edit user</h1>
          <form method="POST"> 
            <div class="form-group">
             <div class="col">
                <label>Nome</label>
                <input type="hidden" name="id" value="<?php echo $row_user['id']?>">
                <input class="form-control" type="text" name="nome" value="<?php echo $row_user['nome']?>">
             </div>    
           
             <div class="col">
                 <label>E-mail</label>
                 <input class="form-control" type="text" name="email" value="<?php echo $row_user['email']?>">                 
             </div>    
             
             <div class="col">
                <label>Usuario</label>
                <input class="form-control" type="text" name="usuario" value="<?php echo $row_user['usuario']?>">
             </div>    
             
             <div class="col">    
                <label>Senha</label>
                <input class="form-control" type="password" name="senha">
             </div>
                <div class="text-center"><br>    
                    <input class="btn btn-primary" type="submit" value="Editar" name="sendEditUser">
                </div>
            </div>
        </form>
    </body>
</html>
