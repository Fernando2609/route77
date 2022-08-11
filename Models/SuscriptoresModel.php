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

Programa:          Módulo de Suscriptores
Fecha:             03-Mayo-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Almacena los suscriptores de la tienda para ofrecer 
                   futuras ofertas 
-----------------------------------------------------------------------*/

class SuscriptoresModel extends Mysql{

	public function selectSuscriptores()
	{
		$sql = "SELECT COD_SUSCRIPCION, NOMBRE, EMAIL, DATE_FORMAT(FECHA_CREACION, '%d/%m/%Y') as fecha
				FROM TBL_SUSCRIPCIONES ORDER BY COD_SUSCRIPCION DESC";
		$request = $this->select_all($sql);
		return $request;
	}

}
 ?>