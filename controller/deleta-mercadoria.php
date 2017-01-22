<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/mercadorias/controller/mercadorias-controller.php');

$controle = new ControllerMercadorias();

if(isset($_POST['delete_id'])){
    $controle->deletarMercadoria();
}
?>