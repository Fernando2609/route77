<?php
   headerTienda($data);
   /* getModal('modalCarrito', $data); */
   $arrProductos = $data['productos'];
   /* dep($arrProductos); */
?>
<br><br><br>
<hr>
<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <h3><?= $data['page_title']; ?></h3>
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        &nbsp; &nbsp;
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Categoría &nbsp;
					</div>

					<!-- <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div> -->
				</div>
				
				<!-- Search product -->
			<!-- 	<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div> -->

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								CATEGORÍAS
							</div>
							
						<div class="flex-w p-t-4 m-r--5">
							<?php
						   if(count($data['categorias_search']) > 0){
						   foreach ($data['categorias_search'] as $categoria){

						
							?>	
						<a href="<?= base_url() ?>/tienda/categoria/<?=$categoria['COD_CATEGORIA'].'/'.$categoria['RUTA'] ?>" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
						<?= $categoria ['NOMBRE'] ?> <span> &nbsp; (<?= $categoria ['cantidad'] ?>)
					</a>
					
					
						<?php 
							}
						}
						?>			
						
							</div>
						</div>
					</div>
				</div>			
			</div>

			<div class="row isotope-grid">
                <?php
                if(!empty($arrProductos)){
                  for($p=0; $p < count($arrProductos); $p++){
					
					  
					  $ruta=$arrProductos[$p]['RUTA'];
                    if(count($arrProductos[$p]['images']) > 0){
                        $portada = $arrProductos[$p]['images'][0]['url_image'];
                    }else{
                      $portada = media().'/images/uploads/product.png';
                    }
                  
                ?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?= $portada ?>" alt="<?= $arrProductos[$p]['NOMBRE'] ?>">

							<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['COD_PRODUCTO'].'/'.$ruta;?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Ver producto
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['COD_PRODUCTO'].'/'.$ruta;?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                  <?= $arrProductos[$p]['NOMBRE'] ?>
								</a>

								<span class="stext-105 cl3">
                                  <?= SMONEY.formatMoney($arrProductos[$p]['PRECIO']); ?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#"
								 id="<?= openssl_encrypt($arrProductos[$p]['COD_PRODUCTO'],METHODENCRIPT,KEY); ?>"
								 class="btn-addwish-b2 dis-block pos-relative js-addcart-detail
								 icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-shopping-cart"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php 
				}
			}else{
				?>
			<p>No hay productos para mostrar <a href="<?= base_url() ?>/tienda"> Ver productos</a></p>
			<?php 
			} 
			?>
			</div>

			<!-- Load more -->
			<?php 
				if(count($data['productos']) > 0){
					$prevPagina = $data['pagina'] - 1;
					$nextPagina = $data['pagina'] + 1;
			 ?>
			<div class="flex-c-m flex-w w-full p-t-45">
			<?php if($data['pagina'] > 1){ ?>
				<a href="<?= base_url() ?>/tienda/categoria/<?= $data['infoCategoria']['idcategoria'].'/'.$data['infoCategoria']['ruta'].'/'.$prevPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> <i class="fas fa-chevron-left"></i> &nbsp; Anterior </a>&nbsp;&nbsp;
			<?php } ?>
			<?php if($data['pagina'] != $data['total_paginas']){ ?>
				<a href="<?= base_url() ?>/tienda/categoria/<?= $data['infoCategoria']['idcategoria'].'/'.$data['infoCategoria']['ruta'].'/'.$nextPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> Siguiente &nbsp; <i class="fas fa-chevron-right"></i> </a>
			<?php } ?>
			</div>
			<?php 
				}
			 ?>
		</div>
	</div>
<?php 
	footerTienda($data);
?>