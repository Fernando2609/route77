<?php  
    require_once("Models/Tcategoria.php");
    require_once("Models/Tproducto.php");
    require_once("Libraries/Core/Conexion.php");
    class Backup extends Controllers{
        use Tcategoria, Tproducto;
        private $con;
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            
            getPermisos(MBACKUP);
        }
        
        public function Backup()
        {
            $this->conexion = new Conexion();
			$this->conexion = $this->conexion->connect();
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Backup";
            $data['page_title']="Respaldo Y Recuperación";
            $data['page_name']="backup";
            $data['page_functions_js']="functions_backup.js";
            $data['restore']=[];
            $cant=0;
            //include_once './Connet.php';
            if (ENVIRONMENT===0) {
                //local
                $ruta="C:\\xampp\htdocs\\route77\Backups\\";
            }else{
                //produccion
                $ruta="/home/u251006101/domains/estacionroute77.com/public_html//Backups/";
            }
            
          
          

            if(is_dir($ruta)){
                if($aux=opendir($ruta)){
                
                    while(($archivo = readdir($aux)) !== false){
                        
                      
                       
                        
                       
                      
                        if($archivo!=="." and $archivo!==".."){
                            $nombrearchivo=str_replace(".sql", "", $archivo);
                           
                           
                            //$nombrearchivo=str_replace("-", "/", $nombrearchivo);
                            $nombrearchivo=explode("_",$nombrearchivo);
                            
                            
                            $dia=date_create_from_format("Y-m-d",$nombrearchivo[2] )->format("d-m-Y");
                            $hora=date_create_from_format("His",$nombrearchivo[3] )->format("H:i:s A");
                          
                            
                            $ruta_completa=$ruta.$archivo;
                            if(is_dir($ruta_completa)){
                            }else{
                                $data['restore'][$cant]['ruta']=$ruta_completa;
                                $data['restore'][$cant]['fecha']="$dia a las $hora.";
                                //echo '<option value="'.$ruta_completa.'">'.$dia." a las ". $hora.'</option>';

                            }
                            $cant++;
                        }
                        
                    }
                    closedir($aux);
                }
            }else{
                echo $ruta." No es ruta válida";
            }
            asort($data['restore']);
            $data['restore']=array_reverse($data['restore']);
         
           
           
            
          


            //BIRACORA
            Bitacora($_SESSION['idUser'],MBACKUP,"Ingreso","Ingresó al módulo");


            $this->views->getView($this,"backup",$data);
         
        }

        public function CopiaSeguridad()
        {
        if($_SESSION['permisosMod']['w']){
            $db_host = DB_HOST; //Host del Servidor MySQL
             $db_name = DB_NAME; //Nombre de la Base de datos
             $db_user = DB_USER; //Usuario de MySQL
             $db_pass = DB_PASSWORD; //Password de Usuario MySQL

             $fecha = date("Y-m-d_His"); //Obtenemos la fecha y hora para identificar el respaldo
             if (ENVIRONMENT===1) {

                 $db_name2=str_replace(USER, "", $db_name);
                 $salida_sql = $db_name2.'_'.$fecha.'.sql'; 
             }else{
                // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
                $salida_sql = $db_name.'_'.$fecha.'.sql'; 
             }
             
            
            
            //Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
            if (ENVIRONMENT===0) {
                $dump = 'C:\xampp\mysql\bin\mysqldump '. $db_name .' -u '. $db_user .' > '. $salida_sql;
            }else{
                $dump = "mysqldump $db_name -u $db_user -p$db_pass > $salida_sql";
            }
           
            exec($dump); //Ejecutamos el comando para respaldo
            if (ENVIRONMENT===0) {
                //local 
                $to="C:/xampp/htdocs/route77/".$salida_sql;
                $destino ='C:/xampp/htdocs/route77//Backups/'.$salida_sql;   
            }else{
                //PRODUCCION
                $to="/home/u251006101/domains/estacionroute77.com/public_html/".$salida_sql;
                $destino ='/home/u251006101/domains/estacionroute77.com/public_html//Backups/'.$salida_sql; 
            }
 
            
            rename($to,$destino);
            
            
            $arrResponse = array('status' => true, 'msg' => 'Base De Datos Descargada Correctamente','data'=>$salida_sql);
            //BIRACORA
            Bitacora($_SESSION['idUser'],MBACKUP,"Nuevo","Realizó un respaldo de la base de datos ");  
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
     }
    
    
       
         
       
        function restoreMysqlDB()
        {
               /* dep($_POST);
               dep($_FILES);
               exit; */
            if($_SESSION['permisosMod']['u']){
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                //$filePath = 'C:\xampp\htdocs\route77\Backups\db_route77_20220506_020237.sql';
                //$filePath=$_FILES['fileBD']['tmp_name'];
                $filePath=$_POST['fileBD'];
                if (ENVIRONMENT===0) {

                    $archivo=explode('\\',$filePath);
                }else{
                    $archivo=explode('/',$filePath);
                }
                /* dep($filePath);
                exit; */
                $sql = '';
                $error = '';
                
                if (file_exists($filePath)) {
                    $lines = file($filePath);
                    
                    foreach ($lines as $line) {
                        
                        // Ignoring comments from the SQL script
                        if (substr($line, 0, 2) == '--' || $line == '') {
                            continue;
                        }
                        
                        $sql .= $line;
                        
                        if (substr(trim($line), - 1, 1) == ';') {
                            $result = mysqli_query($conn, $sql);
                            if (! $result) {
                                $error .= mysqli_error($conn) . "\n";
                            }
                            $sql = '';
                        }
                    } // end foreach
                    
                    if ($error) {
                        $arrResponse = array('status' => false, 'msg' => 'Ha surgido un error al Restaurar la base de datos');
                    
                    } else {
                        $arrResponse = array('status' => true, 'msg' => 'Base de datos Restaurada Correctamente');
                    }
                    if (ENVIRONMENT===0) {

                         //BIRACORA
                        Bitacora($_SESSION['idUser'],MBACKUP,"Update","Restauró la Base de datos ".$archivo[5]);
                    }else{
                        //BIRACORA
                        Bitacora($_SESSION['idUser'],MBACKUP,"Update","Restauró la Base de datos ".$archivo[8]);
                    }
                   
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                } // end if file exists
            }
         die();
        }
     }
 

?>
