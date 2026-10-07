<?php
    require_once "../modelos/Produto.php";
    session_start();
    $produtos = $_SESSION['produtos'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos</h1>
    <a href="../index.html">Pagina Inicial</a>
    <br><br>

    <form action="../controladores/rota.php?acao=buscar" method="GET">
        <input type="text" name="nome" placeholder="Digite o nome do produto">
        <button>Buscar</button>
    </form>
    <br>

    <table style='border:1px solid'>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
<?php
    foreach($produtos as $produto){
        echo "<tr>";
        echo "<td>".$produto->getId()."</td>";
        echo "<td>".htmlspecialchars($produto->getNome())."</td>";
        echo "<td>R$ ".$produto->getPreco()."</td>";
        echo "<td>".$produto->getQuantidade()."</td>";
        echo "<td>";
        echo "<a href='../controladores/rota.php?acao=editar&id=".$produto->getId()."'>Editar</a> ";
        echo "<a href='../controladores/rota.php?acao=excluir&id=".$produto->getId()."'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
    }
?>
    </table>
</body>
</html>
