<?php

    require_once "../modelos/Produto.php";

    class ProdutoDAO{

        public function salvar($produto,$conn){

            $sql = "INSERT INTO
                produtos(nome,preco,quantidade)
                VALUES (?,?,?)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$produto->getNome());
            $stmt->bindValue(2,$produto->getPreco());
            $stmt->bindValue(3,$produto->getQuantidade());

            $stmt->execute();
        }

        public function atualizar($produto,$conn){

            $sql = "UPDATE produtos
                SET nome = ?, preco = ?, quantidade = ?
                WHERE id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$produto->getNome());
            $stmt->bindValue(2,$produto->getPreco());
            $stmt->bindValue(3,$produto->getQuantidade());
            $stmt->bindValue(4,$produto->getId());

            $stmt->execute();
        }

        public function excluir($id,$conn){

            $sql = "DELETE FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$id);
            $stmt->execute();
        }

        public function buscar($conn){

            $sql = "SELECT * FROM produtos ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_OBJ);

            $produtosModelo = [];
            foreach($produtos as $produto){
                $produtoModelo = new Produto();
                $produtoModelo->setId($produto->id);
                $produtoModelo->setNome($produto->nome);
                $produtoModelo->setPreco($produto->preco);
                $produtoModelo->setQuantidade($produto->quantidade);
                array_push($produtosModelo,$produtoModelo);
            }
            return $produtosModelo;
        }

        public function buscarPorNome($nome,$conn){

            $sql = "SELECT * FROM produtos WHERE nome LIKE ? ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,"%" . $nome . "%");
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_OBJ);

            $produtosModelo = [];
            foreach($produtos as $produto){
                $produtoModelo = new Produto();
                $produtoModelo->setId($produto->id);
                $produtoModelo->setNome($produto->nome);
                $produtoModelo->setPreco($produto->preco);
                $produtoModelo->setQuantidade($produto->quantidade);
                array_push($produtosModelo,$produtoModelo);
            }
            return $produtosModelo;
        }

        public function buscarPorId($id,$conn){

            $sql = "SELECT * FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $produto = $stmt->fetch(PDO::FETCH_OBJ);

            // se não encontrar nenhum produto, retorna null
            if(!$produto){
                return null;
            }

            $produtoModelo = new Produto();
            $produtoModelo->setId($produto->id);
            $produtoModelo->setNome($produto->nome);
            $produtoModelo->setPreco($produto->preco);
            $produtoModelo->setQuantidade($produto->quantidade);
            return $produtoModelo;
        }
    }

?>
