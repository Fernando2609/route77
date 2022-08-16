<?php
class PreguntasModel extends Mysql{  

		private $idPreguntas;
		private $strPreguntas;
		
        

        public function __construct()
        {
           parent::__construct();
        } 
		
		public function insertPreguntas(string $preguntas){

			
			$this->strPreguntas = $preguntas;

			$return = 0;
            //validación

			$sql = "SELECT * from TBL_PREGUNTAS where PREGUNTA='$this->strPreguntas'";
           
           /* $sql="CALL CRUD_REDES_SOCIALES(null,'$this->strDescripcion','$this->strEnlace','A',null)";*/
			/* dep($sql);
            exit; */
            $request = $this->select_all($sql); 

			if(empty($request))
			{
				/*$query_insert= " CALL CRUD_REDES_SOCIALES(1,?,?,'I',null)";*/
                $query_insert="INSERT INTO TBL_PREGUNTAS(PREGUNTA) VALUES (?)";
				$arrData = array($this->strPreguntas);
	        	$request_insert = $this->insert($query_insert,$arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
	        	$return = $request_ID['last_insert_id()'];
				
			}else{
				$return = false;
			}
	        return $return;
		}
    public function selectPreguntas()
    {
        $sql = "SELECT COD_PREGUNTA, PREGUNTA
					FROM TBL_PREGUNTAS";
        /*$sql = "CALL CRUD_REDES_SOCIALES(1,null,null,'V',null)";*/
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPregunta(int $Cod )
    {
        $this->idPreguntas = $Cod;

        $sql = "SELECT COD_PREGUNTA, PREGUNTA
					FROM TBL_PREGUNTAS WHERE COD_PREGUNTA =$this->idPreguntas";
        $request = $this->select($sql);
        return $request;
    }
    public function selectPreguntasSeguridad(int $idUsuario)
    {
        $this->intIdUsuario = $idUsuario;
        /* $sql = "SELECT u.idUsuario,u.dni,u.nombres,u.apellidos,u.telefono,
			u.email,u.datecreated,DATE_FORMAT(u.datecreated,'%d-%m-%Y %r') as fechaRegistro,
			DATE_FORMAT(u.fechaNacimiento,'%d-%m-%Y') as fechaNacimiento, DATE_FORMAT(u.fechaNacimiento,'%Y-%m-%d') as fechaNaci,u.status,DATE_FORMAT(u.datelogin,'%d-%m-%Y %r') as datelogin,DATE_FORMAT(u.datemodificado,'%d-%m-%Y %r') as datemodificado ,
			s.idsucursal,s.nombre as 'sucursal',r.Id_Rol,r.nombreRol, 
			n.idNacionalidad,n.descripcion as 'nacionalidad',g.idGenero, g.descripcion as 'genero',
			e.idEstado,e.descripcion as 'estadocivil' 
			FROM usuarios u 
			INNER JOIN roles r ON u.idRol = r.Id_Rol 
			INNER JOIN nacionalidad n ON u.idNacionalidad = n.idNacionalidad 
			INNER JOIN genero g on u.idGenero = g.idGenero 
			INNER JOIN sucursal s on u.idSucursal = s.idsucursal 
			INNER JOIN estadocivil e on u.idEstadoCivil = e.idEstado 
			WHERE u.idUsuario = $this->intIdUsuario"; */

        $sql = "CALL CRUD_REDES_SOCIALES(1,null,null,'R',$this->intIdUsuario)";

        $request = $this->select($sql);

        return $request;
    }
    public function updatePreguntas(int $Cod, string $pregunta)
    {

        $this->idPreguntas = $Cod;
        $this->strPreguntas = $pregunta;

        if (empty($request)) {    

             $sql = "UPDATE TBL_PREGUNTAS SET PREGUNTA=?
							WHERE COD_PREGUNTA = $this->idPreguntas "; 
            $arrData = array(
                $this->strPreguntas,
            );


            $request = $this->Update($sql, $arrData);
        } else {
            $request = false;
        }

        return $request;
    }

    public function deletePreguntas(int $Cod)
    {
        $this->idPreguntas = $Cod;
 
        $sql="SELECT * FROM `TBL_PREGUNTAS_X_USUARIO` WHERE COD_PREGUNTA=$Cod";
        $request = $this->select_all($sql);
        if(empty($request))
		{
            $sql = "DELETE  FROM TBL_PREGUNTAS WHERE COD_PREGUNTA = $this->idPreguntas";
        
            $arrData = array($this->idPreguntas);
            $request = $this->Delete($sql, $arrData);
            
        }else{
            $request=false;
        }
        return $request;
    }

    }
?>