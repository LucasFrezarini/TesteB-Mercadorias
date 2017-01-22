<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/mercadorias/model/mercadoria.php');


class ControllerMercadorias {

    /**
     * Retorna as linhas da tabela com os registro do banco de dados.
     */
    public function carregarTabelaMercadorias() {
        $html = ""; //Variável que vai armazenar todas as linhas da tabela
        $mercadorias = Mercadoria::listar();
        foreach ($mercadorias as $mercadoria) {
            $html .= "<tr>"
                    . "<td>" . $mercadoria['id'] . "</td>"
                    . "<td>" . $mercadoria['tipo'] . "</td>"
                    . "<td>" . $mercadoria['nome'] . "</td>"
                    . "<td>" . $mercadoria['quantidade'] . "</td>"
                    . "<td>" . $mercadoria['preco'] . "</td>"
                    . "<td>" . $this->strNegocio($mercadoria['negocio']) . "</td>"
                    . "<td><a class='btn btn-warning btn-alterar center-block' href='view/view-mercadoria.php?id=" . $mercadoria['id'] . "'>Alterar</a></td>"
                    . "<td><a class='btn btn-danger btn-excluir center-block btn-deletar' id='".$mercadoria['id']."'>Excluir</a></td>"
                    . "</tr>";
        }

        echo $html; //Dá echo em tudo de uma vez só.
    }

    /**
     * Insere a mercadoria no banco de dados, com base dos dados recebidos do método POST.
     * @return bool TRUE caso a operação seja concluída com sucesso e FALSE em caso de falha.
     */
    public function insereMercadoria() {
        $mercadoria = new Mercadoria();
        $mercadoria->setNome($_POST['nome']);
        $mercadoria->setTipo($_POST['tipo']);
        $mercadoria->setPreco($_POST['preco']);
        $mercadoria->setQuantidade($_POST['qntd']);
        $mercadoria->setTipoDoNegocio($_POST['op']);

        return $mercadoria->inserir();
    }

    /**
     * Altera a mercadoria no banco de dados, com base dos dados recebidos do método POST e pegando o ID do método GET.
     * @return bool TRUE caso a operação seja concluída com sucesso e FALSE em caso de falha.
     */
    public function alteraMercadoria() {
        $mercadoria = new Mercadoria();
        $mercadoria->setNome($_POST['nome']);
        $mercadoria->setTipo($_POST['tipo']);
        $mercadoria->setPreco($_POST['preco']);
        $mercadoria->setQuantidade($_POST['qntd']);
        $mercadoria->setTipoDoNegocio($_POST['op']);
        $mercadoria->setId($_GET['id']);

        return $mercadoria->alterar();
    }

    /**
     * Deleta a mercadoria no banco de dados, pegando o ID do método POST.
     * @return bool TRUE caso a operação seja concluída com sucesso e FALSE em caso de falha.
     */
    public function deletarMercadoria() {
        $mercadoria = new Mercadoria();
        $mercadoria->setId($_POST['delete_id']);
        return $mercadoria->excluir();
    }
        
    /**
     * Carrega uma mercadoria por id.
     * @param int $id O id da mercadoria
     * @return Mercadoria Uma instância da mercadoria selecionada
     */
    public function carregaMercadoriaPorId($id) {
        return Mercadoria::selecionar($id);
    }

    /**
     * Como no banco de dados o tipo do negócio está salvo como 0 e 1, essa função irá transformar para compra e venda respectivamente.
     * @return String O nome da operação
     */
    private function strNegocio($op) {
        switch ($op) {
            case 0:
                return "Compra";
                break;
            case 1:
                return "Venda";
                break;
            default:
                return "Valor inválido!";
        }
    }
    
    

}
?>

