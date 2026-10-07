<?php
    require_once "../modelos/Produto.php";
    session_start();

    if(!isset($_SESSION['produto'])){
        header('Location:../index.php');
        exit;
    }
    $produto = $_SESSION['produto'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <form action="../controladores/rota.php?acao=atualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($produto->getNome()); ?>" required><br>
        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" value="<?php echo $produto->getPreco(); ?>" required><br>
        <label>Quantidade:</label>
        <input type="number" name="quantidade" value="<?php echo $produto->getQuantidade(); ?>" required><br>
        <button>Atualizar</button>
    </form>
    <br>
    <a href="../controladores/rota.php?acao=buscar">Voltar para produtos</a>
</body>
</html>
