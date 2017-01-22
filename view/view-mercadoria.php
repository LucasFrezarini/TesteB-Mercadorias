<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/mercadorias-controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/mercadoria.php');
$controle = new ControllerMercadorias();

//Essa página pode ser utilizada tanto para alterar quanto para inserir novas negociações
//Para isso, é testado se a variável "id" do método get está "setada".
if (isset($_GET['id'])) {
    $mercadoria = $controle->carregaMercadoriaPorId($_GET['id']);
} else {
    $mercadoria = new Mercadoria();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CDN do JQuery  -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <!-- CDN do Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- CDN do Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- CSS Customizado -->
        <link href="estilo.css" type="text/css" rel="stylesheet"/>
        
        <script type="text/javascript">
            $(document).ready(function(){
                
               $('button[name=btn_cancelar]').click(function(){
                   window.location.replace("../index.php");
               })

            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">Mercadorias Web</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li <?php if(null == $mercadoria->getNome()){ echo "class='active'";} //Se for para adiconar uma nova mercadoria a aba vai ficar ativa?>><a href="view-mercadoria.php">Nova Negociação</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <h2><?php
                if (null !== $mercadoria->getNome()) { //Se tiver algo no nome da mercadoria, vai aparecer "Alterar Negociação", caso contrário, "Nova Negociação".
                    echo "Alterar Negociação";
                    $nomeBotao = "btn_alterar"; //Aproveitando o if para definir se a função do botão deve ser a de inserir ou alterar, alterando seu nome.
                } else {
                    echo "Nova Negociação";
                    $nomeBotao = "btn_inserir"; //Aproveitando o if para definir se a função do botão deve ser a de inserir ou alterar, alterando seu nome.
                }
                ?>
            </h2><br/>
            <form method="post" name="frm_nova_mercadoria">
                <div class="form-group col-md-12">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome do produto" value="<?php echo $mercadoria->getNome(); ?>" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="tipo">Tipo: </label>
                    <input type="text" class="form-control" name="tipo" placeholder="Digite o tipo do produto" value="<?php echo $mercadoria->getTipo(); ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="preco">Preço: </label>
                    <input type="text" class="form-control" name="preco" placeholder="Digite o preço do produto" value="<?php echo $mercadoria->getPreco(); ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="qntd">Quantidade: </label>
                    <input type="number" min="1" class="form-control" name="qntd" value="<?php echo $mercadoria->getQuantidade(); ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="op">Operação: </label>
                    <select class="form-control" name="op">
                        <option value="0" <?php if ($mercadoria->getTipoDoNegocio() == 0) {echo "selected";} ?>>Compra</option>
                        <option value="1" <?php if ($mercadoria->getTipoDoNegocio() == 1) {echo "selected";} ?>>Venda</option>
                    </select>
                </div>
                <br/>
                <div class="pull-right">    
                    <button type="submit" class="btn btn-primary" name="<?php echo $nomeBotao; ?>">Confirmar</button>
                    <button type="button" class="btn btn-default" name="btn_cancelar">Cancelar</button>
                </div>
                <?php
                if (isset($_POST['btn_inserir'])) {
                    if ($controle->insereMercadoria()) { //Se a operação for realizada com sucesso...
                        echo "<script>"
                            . "alert('Negociação inserida com sucesso!');"
                            . "window.location.replace('../index.php');" //Redireciona para a página inicial
                            ."</script>";
                    } else {
                        echo "<script>alert('Erro ao inserir a negociação.');</script>";
                    }
                }
                
                if (isset($_POST['btn_alterar'])) {
                    if($controle->alteraMercadoria()){
                        echo   "<script>"
                                . "alert('Negociação alterada com sucesso!');"
                                . "window.location.replace('../index.php');" //Redireciona para a página inicial
                              ."</script>";
                        
                    } else {
                        echo "<script>alert('Erro ao alterar a negociação.');</script>";
                    }
                      
                }
                ?>
            </form>
        </div>
    </body>
</html>
