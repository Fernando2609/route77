<?php
require_once("Libraries/Core/Mysql.php");
trait Tproducto{
    private $con;
    private $strCategoria;
    private $intIdCategoria;
    private $intIdProducto;
    private $strProducto;
    private $cant;
    private $option;
    private $strRuta;
   
    public function getProductosT(){
        $this->con = new Mysql();
        $sql = "SELECT p.idproducto,
                        p.codigo,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.stock,
                        p.ruta 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria
                WHERE p.status != 0 ORDER BY p.idproducto DESC ";
                $request = $this->con->select_all($sql);
                if(count($request) > 0){
                    for ($c=0; $c < count($request) ; $c++) { 
                        $intIdProducto = $request[$c]['idproducto'];
                        $sqlImg = "SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";
                        $arrImg = $this->con->select_all($sqlImg);
                        if(count($arrImg) > 0){
                            for($i=0; $i < count($arrImg); $i++){
                                $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                            }
                        }
                        $request[$c]['images'] = $arrImg;
                    }
                }
        return $request;
    }

    public function getProductosCategoriaT(int $idCategoria, string $ruta){
        $this->intIdcategoria = $idCategoria;
        $this->strRuta=$ruta;
        $this->con = new Mysql();

        $sql_cat = "SELECT idcategoria, nombre FROM categoria WHERE idcategoria = '{$this->intIdcategoria}'";
        $request = $this->con->select($sql_cat);

        if(!empty($request)){
            $this->strCategoria = $request['nombre'];
            $sql = "SELECT p.idproducto,
            p.codigo,
            p.nombre,
            p.descripcion,
            p.categoriaid,
            c.nombre as categoria,
            p.precio,
            p.ruta,
            p.stock 
            FROM producto p 
            INNER JOIN categoria c
            ON p.categoriaid = c.idcategoria
            WHERE p.status != 0  AND p.categoriaid = $this->intIdcategoria AND c.ruta = '{$this->strRuta}'";
            $request = $this->con->select_all($sql);
            if(count($request) > 0){
                for ($c=0; $c < count($request) ; $c++) { 
                    $intIdProducto = $request[$c]['idproducto'];
                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if(count($arrImg) > 0){
                        for($i=0; $i < count($arrImg); $i++){
                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                        }
                    }
                    $request[$c]['images'] = $arrImg;
                }
            }
            $request = array('idcategoria' => $this->intIdcategoria,
								//'ruta' => $this->strRutaCategoria,
								'categoria' => $this->strCategoria,
								'productos' => $request
							);
        }
     
        return $request;
    }
    public function getProductoT(int $idProducto,string $ruta)
    {
        $this->con = new Mysql();
        $this->intIdProducto=$idProducto;
        $this->strRuta=$ruta;
      
        $sql = "SELECT p.idproducto,
                        p.codigo,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.stock 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria
                WHERE p.status != 0 AND p.idproducto = '{$this->intIdProducto}'AND p.ruta = '{$this->strRuta}' ";
        $request = $this->con->select($sql);
         if (!empty($request)) {
                 $intIdProducto = $request['idproducto'];
                 $sqlImg = "SELECT img
                                 FROM imagen
                                 WHERE productoid = $intIdProducto";
                 $arrImg = $this->con->select_all($sqlImg);
                 if (count($arrImg) > 0) {
                     for ($i = 0; $i < count($arrImg); $i++) {
                         $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
                     }
                 }else{
                    $arrImg[0]['url_image'] = media().'/images/uploads/product.png';
                }
                 $request['images'] = $arrImg;
         }
        return $request;
    }
    public function getProductosRandom(int $idcategoria, int $cant, string $option){
        $this->intIdCategoria =$idcategoria;
        $this->cant = $cant;
        $this->option = $option;

        if ($option == "r") {
            $this->option = " RAND() ";
        }else if
        ($option == "a"){
            $this->option = "idproducto ASC ";
        }else{
            $this->option = "idproducto DESC ";
        }

        $this->con = new Mysql();
            $sql = "SELECT p.idproducto,
            p.codigo,
            p.nombre,
            p.descripcion,
            p.categoriaid,
            c.nombre as categoria,
            p.precio,
            p.ruta,
            p.stock 
            FROM producto p 
            INNER JOIN categoria c
            ON p.categoriaid = c.idcategoria
            WHERE p.status != 0  AND p.categoriaid = $this->intIdCategoria
            ORDER BY $this->option LIMIT $this->cant ";
            $request = $this->con->select_all($sql);
            if (count($request) > 0) {
                for ($c = 0; $c < count($request); $c++) {
                    $intIdProducto = $request[$c]['idproducto'];
                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
                        }
                    }
                    $request[$c]['images'] = $arrImg;
                }
            }
        

        return $request;



    }


}
?>
