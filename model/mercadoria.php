<?php

require_once('conector.php');

class Mercadoria {

    private $id;
    private $tipo;
    private $nome;
    private $quantidade;
    private $preco;

    /**
     * O tipo do negócio pode ser 0 para compra ou 1 para venda.
     * @var int 
     */
    private $tipoDoNegocio;

    /**
     * inicializa uma nova instância da classe Mercadoria.
     */
    public function __construct() {
        $this->id = null;
        $this->tipo = null;
        $this->nome = null;
        $this->quantidade = 1;
        $this->preco = null;
        $this->tipoDoNegocio = 0;
    }

    //-----------Operações do banco de dados--------------

    /**
     * Lista todos os registros de mercadoria no banco de dados.
     * @return array Um array com todas as mercadorias.
     */
    public static function listar() {
        $con = Conector::getConexao();
        $resultado = $con->query("SELECT * FROM mercadoria ORDER BY id DESC");
        $mercadorias = array();

        //coloca os registros no array mercadorias
        while ($linha = $resultado->fetch_assoc()) {
            array_push($mercadorias, $linha);
        }

        $resultado->close();
        $con->close();

        return $mercadorias;
    }

    /**
     * Seleciona uma determinada mercadoria pelo ID.
     * @param int $id O id da mercadoria.
     * @return Mercadoria uma instância da mercadoria selecionada.
     */
    public static function selecionar($id) {
        $con = Conector::getConexao();
        $stmt = $con->prepare("SELECT * FROM mercadoria WHERE id = ? LIMIT 1");
        $stmt->bind_param('i', $id);

        $stmt->execute();

        $mercadoria = new Mercadoria();

        $resultado = $stmt->bind_result($id_col, $tipo, $nome, $qntd, $preco, $op);



        while ($stmt->fetch()) {
            $mercadoria->setId($id_col);
            $mercadoria->setTipo($tipo);
            $mercadoria->setNome($nome);
            $mercadoria->setQuantidade($qntd);
            $mercadoria->setPreco($preco);
            $mercadoria->setTipoDoNegocio($op);
        }

        $stmt->close();
        $con->close();

        return $mercadoria;
    }

    /**
     * Insere a instância atual da mercadoria no banco de dados.
     * @return bool True se a operação foi concluída com sucesso e False em caso de falha.
     */
    public function inserir() {
        $con = Conector::getConexao();
        $stmt = $con->prepare("INSERT INTO mercadoria VALUES (null, ?, ?, ?, ?, ?)"); //O primeiro argumento é null por causa do auto_increment

        $stmt->bind_param("ssiss", $this->tipo, $this->nome, $this->quantidade, $this->preco, $this->tipoDoNegocio);

        $resultado = $stmt->execute();
        $stmt->close();
        $con->close();

        return $resultado;
    }

    /**
     * Altera o registro que a instancia atual representa no banco de dados.
     * @return bool True se a operação foi concluída com sucesso e False em caso de falha.
     */
    public function alterar() {
        $con = Conector::getConexao();
        $stmt = $con->prepare("UPDATE mercadoria SET tipo = ?, nome = ?, quantidade = ?, preco = ?, negocio = ? WHERE id = ?"); //O primeiro argumento é null por causa do auto_increment

        $stmt->bind_param("ssissi", $this->tipo, $this->nome, $this->quantidade, $this->preco, $this->tipoDoNegocio, $this->id);

        $resultado = $stmt->execute();
        $stmt->close();
        $con->close();

        return $resultado;
    }

    
    /**
     * Exclui o registro que a instancia atual representa no banco de dados. Somente o ID precisa estar "setado"
     * @return bool True se a operação foi concluída com sucesso e False em caso de falha.
     */
    public function excluir() {
        $con = Conector::getConexao();
        $stmt = $con->prepare("DELETE FROM mercadoria WHERE id = ?"); //O primeiro argumento é null por causa do auto_increment

        $stmt->bind_param("i",$this->id);

        $resultado = $stmt->execute();
        $stmt->close();
        $con->close();

        return $resultado;
    }

    //----Gets e Sets-----

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getTipoDoNegocio() {
        return $this->tipoDoNegocio;
    }

    public function setTipoDoNegocio($tipoDoNegocio) {
        $this->tipoDoNegocio = $tipoDoNegocio;
    }

}

?>