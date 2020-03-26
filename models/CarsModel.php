<?php

class Cars{

    public function __construct(){
        $this->db=Conectar::conexion();
        $this->productos=array();
    }
    
    function findById($id){
        
        for ($i=0; $i < count($id); $i++) { 
            
            if ($id[$i] != NULL) {
                $consulta=$this->db->query("select * from productos where id = '".$id[$i]."';");
                $filas=$consulta->fetch_assoc();
                $this->productos[]=$filas;
            }
            
        }
        //Contador de productos en carrito
        $_SESSION['contador'] = $this->productos;
        return $this->productos;    
    }
}

?>