<?php
require_once('models/CarsModel.php');
class CarsController{

    public $id_new;
    public $all_car = [];

    public function addToCars(){
        
        $this->id_new = $_GET['prod'];
        
        if (!$_SESSION["carrito"]) {
            $_SESSION["carrito"] = [];
            
            if ($this->id_new != 'undefined') {
                array_push($_SESSION["carrito"],$this->id_new); 
                
            }            
        }
        else{
            
            array_push($_SESSION["carrito"],$this->id_new);
            
        }
        $this->all_car = $_SESSION["carrito"];

        $product = new Cars();
        $products = $product->findById($this->all_car);

        
        
        require_once('views/cars/Cars.fav.phtml');
        
        
    }

    public function addToCars2(){
        
        $this->id_new = $_GET['prod'];
        
        if (!$_SESSION["carrito"]) {
            $_SESSION["carrito"] = [];
            
            if ($this->id_new != 'undefined') {
                array_push($_SESSION["carrito"],$this->id_new); 
                
            }            
        }
        else{
            
            array_push($_SESSION["carrito"],$this->id_new);
            
        }
        $this->all_car = $_SESSION["carrito"];

        $product = new Cars();
        $products = $product->findById($this->all_car);
        
        
        header('Location: ./?route=getAll');
        
    }

    public function addToCars3(){
        
        $this->id_new = $_GET['prod'];
        
        if (!$_SESSION["carrito"]) {
            $_SESSION["carrito"] = [];
            
            if ($this->id_new != 'undefined') {
                array_push($_SESSION["carrito"],$this->id_new); 
                
            }            
        }
        else{
            
            array_push($_SESSION["carrito"],$this->id_new);
            
        }
        $this->all_car = $_SESSION["carrito"];

        $product = new Cars();
        $products = $product->findById($this->all_car);
        
        
        header('Location: ./?route=car');
        
    }
    
    public function detroyCar(){
        session_unset();
        session_destroy();
        header('Location: ./?route=car');
        
    }

    public function removeToCars(){
        

        $this->id_new = $_GET['prod'];

        for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
            if ($_SESSION['carrito'][$i] == $this->id_new) {
                unset($_SESSION['carrito'][$i]);
                header('Location: ./?route=car');  
                break;
                
            }
        }       
        header('Location: ./?route=car');        
    }  

    public function purchase(){
        
        //Verifica la sesion y carga el formulario de compra
        $purchase = $_SESSION['payment'];
        if ($purchase['pay'] > 0) {
            require_once('views/cars/Cars.form.pay.phtml');
        }
        else{
            header('Location: ./?getAll');
        }
    }

    public function pay(){

        $purchase = $_SESSION['payment'];
        if ($purchase['pay'] > 0) {
            //Dato del Comprador
            $name = $_POST['name'];
            $dni = $_POST['dni'];
            $mail = $_POST['mail'];
            $tel = $_POST['cel'];
            $location = $_POST['loc'];
            $home = $_POST['home'];
            $send = $_POST['send'];
            
            //Comprobacion de envio a domicilio
            if ($send == NULL) {
                $send = 0;
            }
            
            //Acceso a Token de Mercado Pago - Cambiar por el del dueño de la tienda
            MercadoPago\SDK::setAccessToken('TEST-528934859274400-032613-13c9b5819c4227afc29fd166398db26c-433955233');

            //Datos del Vendedor
            
            /*$payer = new MercadoPago\Payer();
            $payer->name = "Fernando";
            $payer->surname = "Romo";
            $payer->email = "fernandoromo401@gmail.com";
            $payer->date_created = "2018-06-02T12:58:41.425-04:00";
            $payer->phone = array(
              "area_code" => "5501",
              "number" => "2612597274"
            );
            
            $payer->identification = array(
              "type" => "DNI",
              "number" => "39235401"
            );
            
            $payer->address = array(
              "street_name" => "Los Reyunos 609 b Amam",
              "street_number" => 609,
              "zip_code" => "11020"
            );*/
            

            //Valor total a pagar
            $valor = intval($purchase['pay']);

            //Creacion de rutas de estado
            $preference = new MercadoPago\Preference();
           
            
            // Cambiar ruta por la del sitio
            $my_web = 'http://localhost/Curso-PHP/MVC/';

            // Cargar por url datos comprador en success
            // Pending desactivado
            $preference->back_urls = array(
                "success" => "".$my_web."?route=pay_ok_insert&name=".$name."&dni=".$dni."&mail=".$mail."&tel=".$tel."&loc=".$location."&home=".$home."&send=".$send."",
                "failure" => "".$my_web."?route=pay_none",
                "pending" => "".$my_web."?route=pending"
            );
            $preference->auto_return = "approved";
            // Crea un ítem en la preferencia
           
                $item = new MercadoPago\Item();
                $item->title = 'Productos tienda ONLINE';
                $item->quantity = 1;
                $item->unit_price =  $purchase['pay'] + $send;
                $preference->items = array($item);
            
                $preference->save();

            //Redirige a la web de pago de mercado pago
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL='.$preference->init_point.'"> ';

        }
    }
}

?>