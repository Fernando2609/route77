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

Programa:          Módulo Contactos
Fecha:             23-Abril-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Módulo que recibe los mensajes enviados por los clientes

-----------------------------------------------------------------------*/

class ContactosModel extends Mysql{

	public function selectContactos()
	{
		$sql = "SELECT COD_CONTACTO, NOMBRE, EMAIL, DATE_FORMAT(FECHA_CREACION, '%d/%m/%Y') as fecha,MENSAJE
				FROM TBL_CONTACTO ORDER BY COD_CONTACTO DESC";
		$request = $this->select_all($sql);
		return $request;
	}
    public function selectMensaje(int $idMensaje)
    {
       
		$sql = "SELECT COD_CONTACTO, NOMBRE, EMAIL, DATE_FORMAT(FECHA_CREACION, '%d/%m/%Y') as fecha,MENSAJE
        FROM TBL_CONTACTO WHERE COD_CONTACTO=$idMensaje";
        $request = $this->select($sql);
        return $request;
    }

}
 ?>