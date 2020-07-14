<?php
    require("conexao.php");

    $conexaoClasse = new Conexao();
    $conexao = $conexaoClasse->conectar();

    if(isset($_GET["t"])){
        $query = $conexao->prepare("SELECT confirmado FROM usuarios WHERE token = ?");
        $query->execute(array($_GET["t"]));

        if($query->rowCount() == 1){
            $confirmado = $query->fetchAll(PDO::FETCH_ASSOC)[0]["confirmado"];

            if(!$confirmado){
                try{
                    $query2 = $conexao->prepare("UPDATE usuarios SET confirmado = ? WHERE token = ?");
                    $query2->execute(array(1, $_GET["t"]));

                    echo "Sua conta foi confirmada";
                }catch(PDOException $erro){
                    echo "Erro";
                }
            }else{
                echo "Sua conta ja foi confirmada";
            }
        }else{
            echo "Token não encontrado";
        }
    }
?>