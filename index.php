<?php
require('./controller/mercadorias-controller.php');
$controle = new ControllerMercadorias();
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
        <link href="view/estilo.css" type="text/css" rel="stylesheet"/>

        <script type="text/javascript">
            $(document).ready(function () {

                //Passa o ID da mercadoria para o botão e abre o modal.
                $('.btn-deletar').click(function () {
                    $('.btn-confirmar-exclusao').attr('id', this.id); //pega o id do btn deletar e coloca no botão de exclusão, para uso posterior.
                    $('#modal-exclusao').modal('toggle');
                });

                //Faz a lógica de exclusão com ajax.
                $('.btn-confirmar-exclusao').click(function () {
                    var id = $('.btn-confirmar-exclusao').attr('id'); //pega o id que foi passado do btn_deletar para o de confirmar.

                    $.ajax({
                        method: 'POST',
                        url: 'controller/deleta-mercadoria.php',
                        data: {delete_id: id}
                    }).done(function () {
                        $('#modal-msg-titulo').html("Sucesso!"); //Muda o titulo da modal msg
                        $('#modal-msg-msg').html("Registro excluído com sucesso!"); //Muda o conteúdo da modal msg
                        $('#modal-msg').modal('toggle');
                    })
                });

                $('#modal-msg').on('hidden.bs.modal', function () {
                    window.location.reload(true); //recarrega a página depois da mensagem
                });
            });
        </script>
    </head>
    <body>

        <!-- Barra de navegação -->    
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Mercadorias Web</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="view/view-mercadoria.php">Nova Negociação</a></li>
                </ul>
            </div>
        </nav>    

        <div class="container">
            <!-- Tabela de mercadorias -->
            <h2>Lista de Negociações</h2>
            <br/>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Operacao</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $controle->carregarTabelaMercadorias(); //Carrega as linhas ?>
                </tbody>
            </table>
            <a href="view/view-mercadoria.php" class="btn btn-success btn-novo pull-right"><span class="glyphicon glyphicon-plus-sign"></span>Nova Negociação</a>

        </div>

        <!-- Modal de confirmação de exclusão -->
        <div class="modal fade" id="modal-exclusao" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Confirmar Exclusão</h4>
                    </div>
                    <div class="modal-body">
                        <p>Você tem certeza que deseja excluir o registro selecionado?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger btn-confirmar-exclusao" id=""  data-dismiss="modal">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal de mensagens -->
        <?php include('./view/modal-msg.php') ?>
    </body>
</html>
