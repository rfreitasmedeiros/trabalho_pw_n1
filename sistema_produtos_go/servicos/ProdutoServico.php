<?php

    require_once "../DAOs/ProdutoDAO.php";
    require_once "../conexao.php";

    class ProdutoServico{

        public function salvar($produto){

            $this->validar($produto);

            $conn = Conexao::criar();
            $produtoDAO = new ProdutoDAO();
            $produtoDAO->salvar($produto,$conn);
        }

        public function atualizar($produto){

            $this->validar($produto);

            $conn = Conexao::criar();
            $produtoDAO = new ProdutoDAO();
            $produtoDAO->atualizar($produto,$conn);
        }

        public function excluir($id){
            $conn = Conexao::criar();
            $produtoDAO = new ProdutoDAO();
            $produtoDAO->excluir($id,$conn);
        }

        public function buscar(){
            $conn = Conexao::criar();
            $produtoDAO = new ProdutoDAO();
            $produtos = $produtoDAO->buscar($conn);
            return $produtos;
        }

        public function buscarPorNome($nome){
            $conn = Conexao::criar();
            $produtoDAO = new ProdutoDAO();
            $produtos = $produtoDAO->buscarPorNome($nome,$conn);
            return $produtos;
        }

        public function buscarPorId($id){
            $conn = Conexao::criar();
            $produtoDAO = new ProdutoDAO();
            $produto = $produtoDAO->buscarPorId($id,$conn);

            if($produto == null){
                throw new ProdutoException("Produto não encontrado");
            }
            return $produto;
        }

        private function validar($produto){

            if(trim($produto->getNome()) == ""){
                throw new ProdutoException("Campo nome inválido");
            }
            if($produto->getPreco() < 0){
                throw new ProdutoException("Campo preço inválido");
            }
            if($produto->getQuantidade() < 0){
                throw new ProdutoException("Campo quantidade inválido");
            }
        }
    }

?>
