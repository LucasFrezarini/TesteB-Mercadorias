<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/mercadorias/model/mercadoria.php');

class ControllerMercadorias {

    /**
     * Retorna as linhas da tabela com os registro do banco de dados.
     */
    public function carregarTabelaMercadorias() {
        $html = "";
        $mercadorias = Mercadoria::listar();
        foreach ($mercadorias as $mercadoria) {
            $html .=  "<tr>"
                    . "<td>".$mercadoria['id']."</td>"
                    . "<td>".$mercadoria['tipo']."</td>"
                    . "<td>".$mercadoria['nome']."</td>"
                    . "<td>".$mercadoria['quantidade']."</td>"
                    . "<td>".$mercadoria['preco']."</td>"
                    . "<td>".$this->strNegocio($mercadoria['negocio'])."</td>"
                    . "<td><button type='button' class='btn btn-default center-block'>Alterar</button></td>"
                    . "<td><button type='button' class='btn btn-danger center-block'>Excluir</button></td>"
                    . "</tr>";
        }
        
        echo $html;
    }
    
    /**
     * Insere a mercadoria no banco de dados, com base dos dados recebidos do método POST.
     * @return bool TRUE caso a operação seja concluída com sucesso e FALSE em caso de falha.
     */
    public function insereMercadoria(){
        $mercadoria = new Mercadoria();
        $mercadoria->setNome($_POST['nome']);
        $mercadoria->setTipo($_POST['tipo']);
        $mercadoria->setPreco($_POST['preco']);
        $mercadoria->setQuantidade($_POST['qntd']);
        $mercadoria->setTipoDoNegocio($_POST['op']);
        
        return $mercadoria->inserir();
    }
    
    /**
     * Carrega uma mercadoria por id.
     * @param int $id O id da mercadoria
     * @return Mercadoria Uma instância da mercadoria selecionada
     */
    public function carregaMercadoriaPorId($id){
        return Mercadoria::selecionar($id);
    }
    
    /**
     * Como no banco de dados o tipo do negócio está salvo como 0 e 1, essa função irá transformar para compra e venda respectivamente.
     * @return String O nome da operação
     */
    private function strNegocio($op){
        switch($op){
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

