<?php 
		$catFotter = getCatFooter();
		$redesSociales=datosEmpresa()['RedSocial'];
		$telefonos=datosEmpresa()['TelEmpresa'];
		$sucursales=datosEmpresa()['Sucursales'];
		$empresa=datosEmpresa()['Empresa'];
		$numero=str_replace("+504 ","504",$empresa['CEL_EMPRESA']);
		$numero=str_replace("-","",$numero);
	 ?>
<!-- Footer -->

<?php  
	if (ENVIRONMENT==1) {
?>
<a id="app-whatsapp" target="_blanck" href="https://api.whatsapp.com/send?phone=<?=  $numero  ?>&amp;text=Hola!&nbsp;me&nbsp;pueden&nbsp;apoyar?">
<i class="fa-brands fa-whatsapp-square" aria-hidden="true"></i>
</a>
<a id="app-whatsapp" target="_blanck" href="https://api.whatsapp.com/send?phone=50494877564&amp;text=Hola!&nbsp;me&nbsp;pueden&nbsp;apoyar?">
<i class="fa-brands fa-whatsapp-square" aria-hidden="true"></i>
</a>
<?php } ?>
<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categorias
					</h4>
					<?php if(count($catFotter) > 0){ ?>
					<ul>
						<?php foreach ($catFotter as $cat) { ?>
						<li class="p-b-10">
							<a href="<?= base_url() ?>/tienda/categoria/<?= $cat['COD_CATEGORIA'].'/'.$cat['RUTA'] ?>" class="stext-107 cl7 hov-cl1 trans-04">
								<?= $cat['NOMBRE'] ?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Contacto
					</h4>

					<p class="stext-107 cl7 size-201">
						
						<?php
						if (count($telefonos) > 0) {
							foreach ($telefonos as $tel) {
						?>

						Tel: <a class="linkFooter" href="tel:+504<?= $tel['TELEFONO'] ?>"><?='+504 '. $tel['TELEFONO'] ?></a><br>
						<?php  }
							} ?>
						Email: <a class="linkFooter" href="mailto:<?= $empresa['EMAIL_EMPRESA'] ?>"><?= $empresa['EMAIL_EMPRESA'] ?></a>
					</p>

					
					<div >
						<a href="<?= $redesSociales[0]['ENLACE'] ?>" target="_blanck" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>


						<a href="<?= $redesSociales[2]['ENLACE'] ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="https://api.whatsapp.com/send?phone=<?=  $redesSociales[1]['ENLACE']  ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fab fa-whatsapp"></i>
						</a> 
					</div>
					<div class="p-t-27">
					<h4 class="stext-301 cl0 p-b-30">
						Dirección Sucursales
					</h4>
					<p class="stext-107 cl7 size-201">
					<?php
						if (count($sucursales) > 0) {
							foreach ($sucursales as $sucursales) {
					
						?>
						<?= $sucursales['DIRECCION'] ?> <br>
						<?php }
						 } ?>
					</p>
					</div>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Suscríbete
					</h4>

				<form id="frmSuscripcion" name="frmSuscripcion">
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" id="nombreSuscripcion" name="nombreSuscripcion" maxlength="50" placeholder="Nombre completo" required>
							<div class="focus-input1 trans-04"></div>
						</div>
						<br>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="email" id="emailSuscripcion" maxlength="60"  name="emailSuscripcion" placeholder="email@example.com" required >
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Suscribirme
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="<?= media() ?>/tienda/images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media() ?>/tienda/images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media() ?>/tienda/images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media() ?>/tienda/images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="<?= media() ?>/tienda/images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">

					Copyright ©<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					

					</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
	<script>
	    const base_url = "<?= base_url(); ?>";
		const smony = "<?= SMONEY; ?>";
	</script>
<!--===============================================================================================-->	
	<script src="<?= media() ?>/tienda/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= media() ?>/tienda/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/select2/select2.min.js"></script>
	<script src="<?= media(); ?>/js/fontawesome.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/slick/slick.min.js"></script>
	<script src="<?= media() ?>/tienda/js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/parallax100/parallax100.js"></script>

<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>

<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="<?= media() ?>/tienda/vendor/sweetalert/sweetalert.min.js"></script> -->
<!-- SweetAlert2 -->
<script src="<?= media(); ?>/js/plugins/sweetalert2/sweetalert2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 <!-- Bootstrap Select -->
 <script src="<?= media(); ?>/js/bootstrap-select.min.js"></script>
<!--===============================================================================================-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="<?= media() ?>/tienda/js/functions.js"></script>
<script src="<?= media() ?>/js/functions_login.js"></script>

<script src="<?= media() ?>/tienda/js/main.js"></script>
<script>
	nombre='<?=    $data['page_name']  ?>';
	
</script>
</body>
<?php  
	if (ENVIRONMENT==1) {
?>

<!-- Messenger Plugin de chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin de chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "656978747780306");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
	FB.init({
	  xfbml            : true,
	  version          : 'v14.0'
	});
  };

  (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
	fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>
</html>