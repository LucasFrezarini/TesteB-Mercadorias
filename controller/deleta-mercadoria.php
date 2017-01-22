<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/mercadorias-controller.php');

$controle = new ControllerMercadorias();

if(isset($_POST['delete_id'])){
    $controle->deletarMercadoria();
}
?>