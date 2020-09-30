<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script src="css/bootstrap/bootstrap.min.js"></script>
        <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    </head>-->
    <body>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col"></th>
                <th scope="col">ID</th>
            <th scope="col"></th>
                <th scope="col">E-mail</th>
                <th scope="col">Nome</th>
                <th scope="col">Inserido</th>
                <th scope="col">Alterado</th>
                <th scope="col">Links</th>
                <th scope="col"></th>
                <th scope="col"><a href="cadastrar.php" style="color: white; text-decoration: none">Cadastrar</a></th>
            <th scope="col"></th>
        </thead>
            
        <?php
            if(isset($_SESSION['msg'])):
                echo  $_SESSION['msg'];
                unset($_SESSION['msg']);
            endif;
        
            //mostrar registros
            ini_set('display_errors', 1);
            
            require './Conexao.php';
            $con = new Conexao();
            $result_user = "SELECT * FROM usuarios";
            
            $resultado_user = $con->getConexao()->prepare($result_user);
            $resultado_user->execute();
            
            while($row_user = $resultado_user->fetch(PDO::FETCH_ASSOC)): 
                echo "<tbody>";
                echo "<tr>";
                echo "<th scope='row'></th>";
                echo "<td>" .$row_user['id'] ."</td>";
                echo "<td>" .$row_user['nome'] ."</td>";
                echo "<td>" .$row_user['email'] ."</td>";
                echo "<td>" .$row_user['senha'] ."</td>";
                echo "<td>:" .date('d/m/y H:i:s', strtotime($row_user['created'])) ."</td>";
                if(!empty($row_user['modified'])):
                    echo "<td>:".date('d/m/y H:i:s', strtotime($row_user['modified'])) ."</td>";
                else:
                    echo "<td>Vazio</td>";
                endif;
//                echo "<td><a href='visualizar.php?id=".$row_user['id']."'>Visualizar</a></td>";
//                echo "<td><a href='cadastrar.php'>Cadastrar</a></td>";
                echo "<td><a href='editar.php?id=".$row_user['id']."'>Editar</a></td>";
                echo "<td><a href='apagar.php?id=".$row_user['id']."'>Apagar</a></td>";
            endwhile; 
        ?>
        </table>       
    </body>
</html>
