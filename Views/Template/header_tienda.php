<?php
    
	//dep($data);
	$arrCategorias = $data['categorias'];
	//dep($arrCategorias); 
	$cantCarrito = 0;
	if(isset($_SESSION['arrCarrito']) and count($_SESSION['arrCarrito']) > 0){ 
		foreach($_SESSION['arrCarrito'] as $product) {
			$cantCarrito += $product['cantidad'];
		}
	}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<title> <?= $data['page_tag'];?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= media() ?>/tienda/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!--===============================================================================================-->
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="<?= media(); ?>/js/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/sweetalert2/sweetalert2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
 <!-- Bootstrap Select -->
 <link rel="stylesheet" href="<?= media(); ?>/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/main.css">
	<link rel="stylesheet" href="<?= media(); ?>/css/style.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	<div id="divLoading">
      <div>
        <img src="<?=media();?>/images//loadingRoute.gif" alt="Loading">
       </div>
    </div>
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Bienvenido Usuario:
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Mi Cuenta
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Salir
						</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="<?= base_url(); ?>#" class="logo" >
						<img src="<?= media() ?>/tienda/images/icons/logo.png" alt="Tienda Virtual">
					</a>
					
					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="<?= base_url(); ?>" >Inicio</a>
							</li>

							
							<li >
								<a class="js-show-categoria" href="javascript:void(0);">Categorias <ion-icon style="font-size: 12px;" name="pricetags"></ion-icon></a>
								<!--<ul class="sub-menu" >
									 <div style="display: flex;"> -->
								
									<?php
										//for ($i=0; $i < count($arrCategorias); $i++) { 
									
									?>
									
										<!-- <li><a href="index.html"><?= $arrCategorias[$i]['nombre']?></a></li> -->
										
									<?php //}?>
								
									
									<!-- 	
									</div> 
								</ul>-->
               				 </li>

							<li>
								<a href="<?= base_url(); ?>/tienda">Tienda</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/carrito">Carrito</a>
							</li>
							<li>
								<a href="<?= base_url(); ?>/nosotros">Nosotros</a>
							</li>

							<li>
								<a href="<?= base_url(); ?>/contacto">Contacto</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>
						<?php  
							if ($data['page_name']!="carrito" and $data['page_name'] != "procesarpago") {
					
						?>
						<div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?=  $cantCarrito;  ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						<?php } ?>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="<?= base_url(); ?>"><img src="<?= media() ?>/tienda/images/logo.png" alt="Tienda Virtual"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 js-show-categoria">
				<ion-icon style="font-size: 25px;" name="pricetags"></ion-icon>
				</div>
				<?php  
					if ($data['page_name']!='carrito' and $data['page_name'] != "procesarpago") {
					
				?>
				<div  class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?=  $cantCarrito;  ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
				<?php } ?>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Bienvenido
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Mi Cuenta
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Salir
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="<?= base_url(); ?>">Inicio</a>
				</li>
				<li>
					<a class="js-show-categoria" href="#">Categorias</a>
				</li>
				<li>
					<a href="<?= base_url(); ?>/tienda">Tienda</a>
				</li>
				<li>
					<a href="<?= base_url(); ?>/carrito">Carrito</a>
				</li>
				<li>
					<a href="<?= base_url(); ?>/nosotros">Nosotros</a>
				</li>

				<li>
					<a href="<?= base_url(); ?>/contacto">Contacto</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?= media() ?>/tienda/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>
<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Tu Carrito
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div id="productoCarrito" class="header-cart-content flex-w js-pscroll">
				<?=  getModal("modalCarrito",$data)  ?>
			</div>
		</div>
	</div>
	<div class="wrap-header-cart js-panel-categoria">
	
	<div class="s-full js-hide-cart"></div>

		<div id="header-cate" class="header-categoria flex-col-l p-l-25 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Categorías
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			
			<div class="header-cart-content flex-w js-pscroll" style="padding-left: 20px;">
				<ul class="header-cart-wrapitem w-full">
				<?php
				for ($j=0; $j < count($arrCategorias); $j++) { 
					$ruta=$arrCategorias[$j]['RUTA'];
									
				?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<a href="<?= base_url().'/tienda/categoria/'.$arrCategorias[$j]['COD_CATEGORIA'].'/'.$ruta; ?>">
						<div class="header-cart-item-img">
							  <img src="<?= $arrCategorias[$j]['PORTADA']?>" alt="<?= $arrCategorias[$j]['NOMBRE']?>">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="<?= base_url().'/tienda/categoria/'.$arrCategorias[$j]['COD_CATEGORIA'].'/'.$ruta; ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?= $arrCategorias[$j]['NOMBRE']?>
							</a>

							<!-- <span class="header-cart-item-info">
							<?= $arrCategorias[$j]['descripcion']?>
							</span> -->
						</div>
						</a>
					</li>
					
			<?php
				 }					
			?>

					
					<!-- <li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="<?= media() ?>/images/uploads/portada_categoria.png" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>  -->
				</ul>
				
				<!-- <div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
