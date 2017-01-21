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
                    . "</tr>";
        }
        
        echo $html;
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

