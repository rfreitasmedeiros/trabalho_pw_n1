<?php

    require_once "ProdutoControlador.php";

    try{

        $produtoControlador = new ProdutoControlador();

        if(isset($_GET['nome']) && $_GET['nome'] != ""){
            $produtos = $produtoControlador->buscarPorNome($_GET['nome']);
        }else{
            $produtos = $produtoControlador->buscar();
        }

        session_start();
        $_SESSION['produtos'] = $produtos;

        header('Location:../views/mostrarProdutos.php');

    }catch(PDOException $erro){
        echo $erro->getMessage();
    }

?>
