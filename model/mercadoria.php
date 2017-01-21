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
    public function __construct(){
        $this->id = 0;
        $this->tipo = null;
        $this->nome = null;
        $this->quantidade = 0;
        $this->preco = 0;
        $this->tipoDoNegocio = 0;
    }
    
    /**
     * Lista todos os registros de mercadoria no banco de dados.
     * @return array Um array com todas as mercadorias.
     */
    public static function listar(){
        $con = Conector::getConexao();
        $resultado = $con->query("SELECT * FROM mercadoria");
        $mercadorias = array();
        
        //coloca os registros no array mercadorias
        while($linha = $resultado->fetch_assoc()){
            array_push($mercadorias, $linha);
        }
        
        $resultado->close();
        $con->close();
        
        return $mercadorias;
    }
    
    //----Gets e Sets-----
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getTipo(){
        return $this->tipo;
    }
    
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getQuantidade(){
        return $this->quantidade;
    }
    
    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }
    
    public function getPreco(){
        return $this->preco;
    }
    
    public function setPreco($preco){
        $this->preco = $preco;
    }
    
    public function getTipoDoNegocio(){
        return $this->tipoDoNegocio;
    }
    
    public function setTipoDoNegocio($tipoDoNegocio){
        $this->tipoDoNegocio = $tipoDoNegocio;
    }
}


?>