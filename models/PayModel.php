<?php

class Pay{

    public function __construct(){
        $this->db=Conectar::conexion();
        $this->productos=array();
    }

    public function insert_order($value){
        
        $date = date("d-m-Y");
        $product_value = $_SESSION['payment']['pay'];
        $send =  $value['send'];
        $products =  json_encode($_SESSION['payment']['products']);
        
        $sql_client = "INSERT INTO `order_clients`(`id`, `total_value`, `product_list`, `fecha`, `send`, `fk_dni_client`) VALUES ('','".$product_value."','".$products."','".$date."','".$send."','".$value['dni']."')";

        $question_client = $this->db->query($sql_client);       
        
    }

    public function search_client($value){
        try {
            
            $buyer = $consulta=$this->db->query("select * from clients where dni = ".$value['dni']."");
            $result = $consulta->num_rows;
            
            $object = new Pay();
            
            if ($result == 0) {
                
                $sql_client = "INSERT INTO `clients`(`dni`, `name`, `mail`, `tel`, `location`, `home`) VALUES ('".$value['dni']."','".$value['name']."','".$value['mail']."','".$value['tel']."','".$value['loc']."','".$value['home']."')";

                $question_client = $this->db->query($sql_client);

                $object->insert_order($value);
                
            }
            else{
                
                $object->insert_order($value);
            }


        } catch (\Throwable $th) {
            
        }
    }

    

}
?>