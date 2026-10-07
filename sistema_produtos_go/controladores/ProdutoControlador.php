<?php

    require_once "../ProdutoException.php";
    require_once "../servicos/ProdutoServico.php";
    require_once "../DTOs/ProdutoDTO.php";
    require_once "../modelos/Produto.php";

    class ProdutoControlador{

        public function salvar($produtoDTO){
            try{

                $produto = new Produto();
                $produto->setNome($produtoDTO->nome);
                $produto->setPreco($produtoDTO->preco);
                $produto->setQuantidade($produtoDTO->quantidade);

                $produtoServico = new ProdutoServico();
                $produtoServico->salvar($produto);

                echo "Produto cadastrado com sucesso ";
                echo "<a href='rota.php?acao=buscar'>Voltar para produtos</a>";

            }catch(PDOException $erro){
                echo "Erro: Erro na base de dados ";
                echo $erro->getMessage();
            }catch(ProdutoException $erro){
                echo "Dados inválidos! ";
                echo $erro->getMessage();
            }
        }

        public function atualizar($produtoDTO){
            try{

                $produto = new Produto();
                $produto->setId($produtoDTO->id);
                $produto->setNome($produtoDTO->nome);
                $produto->setPreco($produtoDTO->preco);
                $produto->setQuantidade($produtoDTO->quantidade);

                $produtoServico = new ProdutoServico();
                $produtoServico->atualizar($produto);

                echo "Produto atualizado com sucesso ";
                echo "<a href='rota?acao=buscar'>Voltar para produtos</a>";

            }catch(PDOException $erro){
                echo "Erro: Erro na base de dados ";
                echo $erro->getMessage();
            }catch(ProdutoException $erro){
                echo "Dados inválidos! ";
                echo $erro->getMessage();
            }
        }

        public function excluir($id){
            $produtoServico = new ProdutoServico();
            $produtoServico->excluir($id);
        }

        public function buscar(){
            $produtoServico = new ProdutoServico();
            return $produtoServico->buscar();
        }

        public function buscarPorNome($nome){
            $produtoServico = new ProdutoServico();
            return $produtoServico->buscarPorNome($nome);
        }

        public function buscarPorId($id){
            $produtoServico = new ProdutoServico();
            return $produtoServico->buscarPorId($id);
        }
    }

?>
