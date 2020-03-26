<?php
$controladorProducto = new ProductController();
$controladorCarrito = new CarsController();
$controladorPago = new PayController();

switch ($_GET['route']) {

    //Rutas Productos

    case '':
        $controladorProducto->getAll();
        break;

    case 'getAll':
        $controladorProducto->getAll();
        break;
    
    case 'getCategory':
        $controladorProducto->getCategory();
        break;    
    
    case 'getName':
        $controladorProducto->getName();
        break;  

    case 'item':
        $controladorProducto->getId();
        break;

    //Rutas Carrito

    case 'car':
        $controladorCarrito->addToCars();
        break;
    
    case 'car2':
        $controladorCarrito->addToCars2();
        break;
        
    case 'car3':
        $controladorCarrito->addToCars3();
        break;

    case 'deleteCar':
        $controladorCarrito->detroyCar();
        break;
    
    case 'deleteProd':
        $controladorCarrito->removeToCars();
        break;

    //Rutas de Pago    

    case 'purchase':
        $controladorCarrito->purchase();
        break;
      
    case 'pay':
        $controladorCarrito->pay();
        break;

    case 'pay_ok_insert':
        $controladorPago->pay_ok_insert();
        break;
        
    case 'pay_ok':
        $controladorPago->pay_ok();
        break;

    default:
        echo 'Ingresar una ruta Valida';
        break;
}
?>