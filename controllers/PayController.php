<?php
require_once('models/PayModel.php');
class PayController{
    
    public function pay_ok_insert(){
        //Cargo los datos de la Url a la sesion
        $value = [
            'name' => $_GET['name'],
            'dni'  => $_GET['dni'],
            'mail' => $_GET['mail'],
            'tel'  => $_GET['tel'],
            'loc'  => $_GET['loc'],
            'home' => $_GET['home'],
            'send' => $_GET['send'],
        ];
        $_SESSION['pay'] = $value;
        
        //Instancio el objeto y llamo al modelo
        $buyer = new Pay();
        $buyer->search_client($value);
        
        //Destruyo el carrito de la
        unset($_SESSION['carrito']);
        
        if ($buyer) {
            header('Location: ./?route=pay_ok');
        }
        

    }

    public function pay_ok(){
        $client = $_SESSION['pay'];
        
        require_once('./views/pay/Pay.ok.phtml');
    }
}
?>