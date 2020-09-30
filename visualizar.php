<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Visualisar user</h1>
        <?php
            //mostrar registros
            require './Conexao.php';
            
            //filter_input obtem os valores do link 
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $limit = 1;
            $con = new Conexao();
            $result_user = "SELECT * FROM usuarios WHERE id=:id LIMIT :limit";
            
            $resultado_user = $con->getConexao()->prepare($result_user);
            $resultado_user->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado_user->bindParam(':limit', $limit, PDO::PARAM_INT);
            $resultado_user->execute();
            
            $row_user = $resultado_user->fetch(PDO::FETCH_ASSOC);
                echo "ID: " .$row_user['id'] ."<br>";
                echo "email: " .$row_user['email'] ."<br>";
                echo "nome: " .$row_user['nome'] ."<br>";
                //este traz o resultado da hora no formato do banco
                //echo "inserido: " .$row_user['created'] ."<br>";
                echo "inserido: " .date('d/m/y H:i:s', strtotime($row_user['created'])) ."<br>";
                if(!empty($row_user['modified'])):
                    echo "alterado: " .date('d/m/y H:i:s', strtotime($row_user['modified'])) ."<br><hr>";
                endif;
                echo '<hr>';
            
        ?>
    </body>
</html>
