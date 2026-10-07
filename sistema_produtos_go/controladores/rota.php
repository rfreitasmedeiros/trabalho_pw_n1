<?php
    require_once "ProdutoControlador.php";

    $acao = $_GET['acao'];
    $produtoControlador = new ProdutoControlador();

    if($acao == 'salvar'){

        $produtoDTO = new ProdutoDTO();
        $produtoDTO->nome = $_POST['nome'];
        $produtoDTO->preco = $_POST['preco'];
        $produtoDTO->quantidade = $_POST['quantidade'];
        
        $produtoControlador->salvar($produtoDTO);

    }else if($acao == 'atualizar'){

        $produtoDTO = new ProdutoDTO();
        $produtoDTO->id = $_POST['id'];
        $produtoDTO->nome = $_POST['nome'];
        $produtoDTO->preco = $_POST['preco'];
        $produtoDTO->quantidade = $_POST['quantidade'];

        $produtoControlador->atualizar($produtoDTO);

    }else if($acao == 'excluir'){

        $id = $_GET['id'];
        try{
            $produtoControlador->excluir($id);
            header('Location:rota.php?acao=buscar');
        }catch(Exception $erro){
            echo "Erro: " . $erro->getMessage();
        }

    }else if($acao == 'editar'){

        $id = $_GET['id'];
        try{
            $produto = $produtoControlador->buscarPorId($id);
            session_start();
            $_SESSION['produto'] = $produto;
            header('Location:../views/formEditarProduto.php');
        }catch(Exception $erro){
            echo "Erro: " . $erro->getMessage();
        }
    }else if($acao == 'buscar'){
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
    }

?>
