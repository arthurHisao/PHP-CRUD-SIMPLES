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
            require './Conexao.php';
            //ini_set('display_errors', 1);
            //recebendo os dados em um array, tipo post, valor recebido string
            $Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//                echo '<pre>';
//                    var_dump($Dados);
//                echo '</pre>';
                
            if(!empty($Dados['sendCadUser'])):
                unset($Dados['sendCadUser']);
                
                $con = new Conexao();
            
                $result_cadastrar = "INSERT INTO usuarios (nome, email, usuario, senha, created) 
                    VALUES (:nome, :email, :usuario, :senha, now())"; 
                
                $cadastrar = $con->getConexao()->prepare($result_cadastrar);
                $cadastrar->bindParam(":nome", $Dados["nome"]); //, PDO::PARAM_STR);
                $cadastrar->bindParam(":email", $Dados["email"]); //, PDO::PARAM_STR);
                $cadastrar->bindParam(":usuario", $Dados["usuario"]); //, PDO::PARAM_STR);
                $cadastrar->bindParam(":senha", $Dados["senha"]); //, PDO::PARAM_STR);
                $cadastrar->execute();
                
                if($cadastrar->rowCount()):
                    $_SESSION['msg'] = "<p style='color: green;'>Registro cadastrado com sucesso</p>";
                    header("Location: index.php");
                endif;
            endif;
        ?>
        <h1>Cadastrar</h1>
        
        <form method="POST"> 
            <div class="form-group">
             <div class="col">
                <label>Nome</label>
                <input class="form-control" type="text" name="nome">
             </div>    
           
             <div class="col">
                 <label>E-mail</label>
                 <input class="form-control" type="text" name="email">                 
             </div>    
             
             <div class="col">
                <label>Usuario</label>
                <input class="form-control" type="text" name="usuario">
             </div>    
             
             <div class="col">    
                <label>Senha</label>
                <input class="form-control" type="password" name="senha">
             </div>
                <div class="text-center"><br>    
                    <input class="btn btn-primary" type="submit" value="Cadastrar" name="sendCadUser">
                </div>
            </div>
        </form>
    </body>
</html>
