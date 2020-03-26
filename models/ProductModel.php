<?php

class Product{

    public function __construct(){
        $this->db=Conectar::conexion();
        $this->productos=array();
    }

    function findAll(){
        $consulta=$this->db->query("select * from productos;");
        while($filas=$consulta->fetch_assoc()){
            $this->productos[]=$filas;
        }
        return $this->productos;
    }

    function findCategory($categoria){
        $consulta=$this->db->query("select * from productos where categoria = '".$categoria."';");
        while($filas=$consulta->fetch_assoc()){
            $this->productos[]=$filas;
        }
        return $this->productos;
    }

    function findName($name){
        $consulta=$this->db->query("select * from productos where titulo LIKE '%".$name."%';");
        $articulos_encontrados = $consulta->num_rows;

        while($filas=$consulta->fetch_assoc()){
            
            $this->productos[]=$filas;

        }
        return $this->productos;    
    }
    function findById($id){
        $consulta=$this->db->query("select * from productos where id = '".$id."';");
        $fila = $consulta->fetch_assoc();
        
        $this->producto= $fila;

        return $this->producto;    
    }

}
?>