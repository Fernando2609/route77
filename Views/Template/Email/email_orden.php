<?php

$orden = $data['pedido']['orden'];
$detalle = $data['pedido']['detalle'];
?>
<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="es-ES">

<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
	<!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css">
	<!--<![endif]-->
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		.desktop_hide,
		.desktop_hide table {
			mso-hide: all;
			display: none;
			max-height: 0px;
			overflow: hidden;
		}

		@media (max-width:620px) {
			.desktop_hide table.icons-inner {
				display: inline-block !important;
			}
            .logo {
            width: 80px;
            }


            
            table tr td.hola,
            table tr th.hola {
            font-size: 9px;
            color: #40507a;
                
            }
			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.fullMobileWidth,
			.image_block img.big,
			.row-content {
				width: 100% !important;
			}

			.mobile_hide {
				display: none;
			}

			.stack .column {
				width: 100%;
				display: block;
			}

			.mobile_hide {
				min-height: 0;
				max-height: 0;
				max-width: 0;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide,
			.desktop_hide table {
				display: table !important;
				max-height: none !important;
			}
		}
	</style>
</head>

<body style="background-color: #f3de2e; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
	<table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f3de2e;">
		<tbody>
			<tr>
				<td>
					<table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f3de2e;">
						<tbody>
							<tr>
								<td>
									<table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
										<tbody>
											<tr>
												<td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 20px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
													<table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
														<tr>
															<td style="width:100%;padding-right:0px;padding-left:0px;">
																<div align="center" style="line-height:10px"><a href="https://estacionroute77.com/" target="_blank" style="outline:none" tabindex="-1"><img class="big" src="https://estacionroute77.com/Assets/images/email/animated_header.png" style="display: block; height: auto; border: 0; width: 600px; max-width: 100%;" width="600"></a></div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #d9dffa; background-image: url('https://estacionroute77.com/Assets/images/email/body_background_3.png'); background-position: top center; background-repeat: repeat; background-size: auto;">
						<tbody>
							<tr>
								<td>
									<table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-size: auto; color: #000000; width: 600px;" width="600">
										<tbody>
											<tr>
												<td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 50px; padding-right: 50px; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
													<table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #055488; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:34px;"><strong><span style>Orden # <?=$orden['COD_PEDIDO']?></span></strong></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table class="html_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
														<tr>
															<td>
																<div style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif;text-align:center;" align="center"><style>
  table tr td.hola,
  table tr th.hola {
    padding: 5px 10px;
    font-family: arial;
    font-size: 12px;
  }

  table tr td.hola,
  table tr th.hola {
    padding: 5px 10px;
    font-family: arial;
    font-size: 12px;
  
  }

  #detalleOrden tr td {
    border: 1px solid #CCC;
    color:#40507a;
  }

  .table-active {
    background-color: #CCC;
  }

  .text-center {
    text-align: center;
  }

  .text-right {
    text-align: right;
  }

  .logo {
    width: 8rem;
  }

  /* @media screen and (max-width: 470px) {
    .logo {
      width: 80px;
    }

    p,
    table tr td.hola,
    table tr th.hola {
      font-size: 9px;
   
    }
  } */
</style>
<table style="width: 100%; max-width: 600px; margin: 10px auto; border: 1px solid #CCC; border-spacing: 0;">
			<tr style="background-color: #F3DE2E; color: black;">
				<td class="hola" width="33.33%">
					<img style="width: 6rem;" class="logo" src="https://estacionroute77.com/Assets/tienda/images/icons/logo3.png" alt="Logo" />
				</td>
				<td class="hola" width="33.33%">
					<div class="text-center" style="text-align: center">
                        <h4><strong><?= datosEmpresa()['Empresa']['NOMBRE_EMPRESA'] ?></strong></h4>
						<p>
							<?= datosEmpresa()['Empresa']['RTN'] ?> <br>
							<?= datosEmpresa()['Empresa']['DIRECCION_FACTURA']?> <br>
							<?= datosEmpresa()['Empresa']['TEL_EMPRESA'] ?> <br>
							<?= datosEmpresa()['Empresa']['EMAIL_EMPRESA'] ?>
						</p>
					</div>
				</td>
				<td class="hola" width="33.33%">
					<div class="text-right" style="text-align: right;">
                    <p>
							No. Orden: <strong> <?=$orden['COD_PEDIDO']?> </strong><br>
                            Fecha: <?=$orden['FECHA']?>  <br>
                            <?php
                            if($orden['COD_TIPO_PAGO']==1){
                                ?>
                            Método Pago: <?=$orden['TIPO PAGO']?>  <br>
                            Transacción: <?=$orden['COD_TRANSACCION_PAYPAL']?>
                            <?php }else{ ?>
                                Método Pago: Contra Entrega  <br>
                                Tipo Pago: <?=$orden['TIPO PAGO']?>
                            <?php }?> 
						</p>
					</div>
				</td>				
			</tr>
		</table>
		<table style="width: 100%; max-width: 600px; margin: 10px auto; border: 1px solid #CCC; border-spacing: 0;">
			<tr>
		    	<td class="hola" width="140">Nombre:</td>
		    	<td class="hola"><?=$_SESSION['userData']['NOMBRES'].' '.$_SESSION['userData']['APELLIDOS'] ?></td>
		    </tr>
		    <tr>
		    	<td class="hola">Teléfono</td>
		    	<td class="hola"><?=$_SESSION['userData']['TELEFONO']?></td>
		    </tr>
		    <tr>
		    	<td class="hola">Dirección de envío:</td>
		    	<td class="hola"><?=$orden['DIRECCION_ENVIO']?></td>
		    </tr>
		</table>
		<table style="width: 100%; max-width: 600px; margin: 10px auto; border: 1px solid #CCC; border-spacing: 0;">
		  <thead class="table-active">
		    <tr style="background-color:#055488; color: whitesmoke;">
		      <th class="hola" style="color: whitesmoke;">Descripción</th>
		      <th class="hola text-right" style="text-align: right;color: whitesmoke;">Precio</th>
		      <th class="hola text-center" style="text-align: center;color: whitesmoke;">Cantidad</th>
		      <th class="hola text-right" style="text-align: right;color: whitesmoke;">Importe</th>
		    </tr>
		  </thead>
		  <tbody id="detalleOrden">
          <?php
                if(count($detalle)>0){
                    $subtotal=0;
                    foreach($detalle as $producto){
						$importe=0;
                        $precio=formatMoney($producto['PRECIO']);
                        //$importe=formatMoney(floatval($producto['PRECIO']) * floatval($producto['CANTIDAD']));
						$importe=$producto['PRECIO'] * $producto['CANTIDAD'];
                        $subtotal=$subtotal+$importe;
						

                
              ?>
		    <tr>
		      <td class="hola" style="border: 1px solid #ccc;"><?= $producto['NOMBRE'] ?></td>
		      <td class="text-right hola" style="text-align: right;border: 1px solid #ccc;"><?= SMONEY.' '.$precio ?></td>
		      <td class="text-center hola" style="text-align: center;border: 1px solid #ccc;"><?= $producto['CANTIDAD'] ?></td>
		      <td class="text-right hola" style="text-align: right;border: 1px solid #ccc;"><?= SMONEY.' '.formatMoney($importe) ?></td>
		    </tr>
            <?php } 
            }?>
		  </tbody>
		  <tfoot>
		  		<tr>
		  			<th colspan="3" class="hola text-right" style="text-align: right;">Subtotal:</th>
		  			<td class="hola text-right" style="text-align: right;"><?= SMONEY.' '.formatMoney($subtotal)?></td>
		  		</tr>
		  		<tr>
		  			<th colspan="3" class=" hola text-right " style="text-align: right;">Envío:</th>
		  			<td class="hola text-right " style="text-align: right;"><?= SMONEY.' '.formatMoney($orden['COSTOENVIO']) ?></td>
		  		</tr>
				
		  		<tr style="color: #81B031; font-weight: bold; text-decoration: underline;">
					
		  			<th colspan="3" class="hola text-right" style="text-align: right; color: #81B031">Total:</th>
		  			<td class="hola text-right" style="text-align: right; color: #81B031;"><?= SMONEY.' '.formatMoney($orden['MONTO']); ?></td>
		  		</tr>
		  </tfoot>
		</table></div>
															</td>
														</tr>
													</table>
													
													<table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 21px; color: #40507a; line-height: 1.5; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center;">Si tienes preguntas sobre tu pedido,<br>póngase en contacto con nombre, teléfono y Email</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
																		<p style="margin: 0; font-size: 14px;"><span style="font-size:14px;">¿Tienes Problemas? Escríbenos: <a href="mailto:<?=datosEmpresa()['Empresa']['EMAIL_EMPRESA']?>" target="_blank" title="@socialaccount" style="text-decoration: none; color: #40507a;" rel="noopener" bis_size="{&quot;x&quot;:396,&quot;y&quot;:567,&quot;w&quot;:107,&quot;h&quot;:16,&quot;abs_x&quot;:396,&quot;abs_y&quot;:627}"><strong><?=  datosEmpresa()['Empresa']['EMAIL_EMPRESA']  ?></strong></a></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
																		<p style="margin: 0; text-align: center;"><span style="font-size:24px;"><strong>¡Gracias por tu compra!</strong></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
						<tbody>
							<tr>
								<td>
									<table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
										<tbody>
											<tr>
												<td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
													<table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
														<tr>
															<td style="width:100%;padding-right:0px;padding-left:0px;">
																<div align="center" style="line-height:10px"><img class="big" src="https://estacionroute77.com/Assets/images/email/bottom_img.png" style="display: block; height: auto; border: 0; width: 600px; max-width: 100%;" width="600" alt="Card Bottom with Border and Shadow Image" title="Card Bottom with Border and Shadow Image"></div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
						<tbody>
							<tr>
								<td>
									<table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
										<tbody>
											<tr>
												<td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 10px; padding-right: 10px; padding-top: 10px; padding-bottom: 20px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
													<table class="image_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
														<tr>
															<td>
																<div align="center" style="line-height:10px"><a href="<?= base_url()  ?>" target="_blank" style="outline:none" tabindex="-1"><img class="fullMobileWidth" src="https://estacionroute77.com/Assets/tienda/images/icons/logoTienda.png" style="display: block; height: auto; border: 0; width: 232px; max-width: 100%;" width="232" alt="Your Logo" title="Your Logo"></a></div>
															</td>
														</tr>
													</table>
													<table class="social_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
														<tr>
															<td>
																<table class="social-table" width="210px" border="0" cellpadding="0" cellspacing="0" role="presentation" align="center" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
																	<tr>
																		<td style="padding:0 5px 0 5px;"><a href="https://estacionroute77.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/website@2x.png" width="32" height="32" alt="Web Site" title="Web Site" style="display: block; height: auto; border: 0;"></a></td>
																		<td style="padding:0 5px 0 5px;"><a href="https://www.facebook.com/estacion77/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/facebook@2x.png" width="32" height="32" alt="Facebook" title="Facebook" style="display: block; height: auto; border: 0;"></a></td>
																		<td style="padding:0 5px 0 5px;"><a href="https://www.instagram.com/estacion_77/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/instagram@2x.png" width="32" height="32" alt="Instagram" title="instagram" style="display: block; height: auto; border: 0;"></a></td>
																		<td style="padding:0 5px 0 5px;"><a href="https://api.whatsapp.com/send?phone=50494877564&amp;text=Hola!&nbsp;me&nbsp;pueden&nbsp;apoyar?" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/whatsapp@2x.png" width="32" height="32" alt="WhatsApp" title="WhatsApp" style="display: block; height: auto; border: 0;"></a></td>
																		<td style="padding:0 5px 0 5px;"><a href="mailto:estacionroutehn@gmail.com" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/mail@2x.png" width="32" height="32" alt="E-Mail" title="E-Mail" style="display: block; height: auto; border: 0;"></a></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center;"><?=  datosEmpresa()['Empresa']['CEL_EMPRESA']  ?></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
														<tr>
															<td>
																<div style="font-family: sans-serif">
																	<div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
																		<p style="margin: 0; text-align: center; font-size: 12px;">Copyright© 2022 Estación Route 77.</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
						<tbody>
							<tr>
								<td>
									<table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
										<tbody>
											<tr>
												<td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
													<table class="icons_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
														<tr>
															<td style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
																<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
																	<tr>
																		<td style="vertical-align: middle; text-align: center;">
																			<!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
																			<!--[if !vml]><!-->
																			<table class="icons-inner" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;" cellpadding="0" cellspacing="0" role="presentation">
																				<!--<![endif]-->
																				<tr>
																					<td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;"><a href="https://www.designedwithbee.com/" target="_blank" style="text-decoration: none;"><img class="icon" alt="Designed with BEE" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png" height="32" width="34" align="center" style="display: block; height: auto; margin: 0 auto; border: 0;"></a></td>
																					<td style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;"><a href="https://www.designedwithbee.com/" target="_blank" style="color: #9d9d9d; text-decoration: none;">Designed with BEE</a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table><!-- End -->
</body>

</html>