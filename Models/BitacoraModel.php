<?php  
    /*
-----------------------------------------------------------------------
Universidad Nacional Autónoma de Honduras (UNAH)
    Facultad de Ciencias Economicas
Departamento de Informatica administrativa
     Analisis, Programacion y Evaluacion de Sistemas
                Segundo Periodo 2022


Equipo:
Jose Fernando Ortiz Santos .......... (jfortizs@unah.hn)
Hugo Alejandro Paz Izaguirre..........(hugo.paz@unah.hn)
Kevin Alfredo Rodríguez Zúniga........(karodriguezz@unah.hn)
Leonela Yasmin Pineda Barahona........(lypineda@unah)
Reynaldo Jafet Giron Tercero..........(reynaldo.giron@unah.hn)
Gabriela Giselh Maradiaga Amador......(ggmaradiaga@unah.hn)
Alejandrino Victor García Bustillo....(alejandrino.garcia@unah.hn)

Catedrático:
Lic. Karla Melisa Garcia Pineda 

---------------------------------------------------------------------

Programa:          Módulo de Bitacora
Fecha:             11-Mayo-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Registra y Muestra los cambios y acciones realizados 
                   por los usuarios al sistema

-----------------------------------------------------------------------*/

    class BitacoraModel extends Mysql{  

		//private $intIdUsuario;
		//private $strIdentificacion;
        
	    private $intCod_Producto;
	

        public function __construct()
        {
           parent::__construct();
        } 
	
		public function selectBitacoras()
		{
		
            $sql = "SELECT b.*,m.NOMBRE  as 'MODULO',CONCAT(p.NOMBRES, ' ', p.APELLIDOS) AS 'USUARIO' FROM `TBL_BITACORA` b 
            INNER JOIN TBL_MODULO m on ID_MODULO=COD_MODULO
            INNER JOIN TBL_PERSONAS p on ID_PERSONA=COD_PERSONA";
			//WHERE idRol = 7 and status != 0";
			    $request = $this->select_all($sql);
               
				return $request;
                
		}
        
        
       
		 public function selectBitacora(int $idBitacora){
			$this->intCod_Producto = $idBitacora;

			
			$sql= "SELECT b.*,m.NOMBRE as 'MODULO',CONCAT(p.NOMBRES, ' ', p.APELLIDOS) AS 'USUARIO' FROM `TBL_BITACORA` b 
			INNER JOIN TBL_MODULO m on ID_MODULO=COD_MODULO
			INNER JOIN TBL_PERSONAS p on ID_PERSONA=COD_PERSONA WHERE ID_BITACORA=$this->intCod_Producto";
			$request = $this->select($sql);
			
			/* dep(($request));
			exit; */
			return $request;
		}

	



    }
?>