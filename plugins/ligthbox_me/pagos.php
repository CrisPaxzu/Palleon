<?php
/*
 * Archivo que permite la administracion de los usuarios que han enviado cotizacion
 * @autor Farez Jair Prieto Castro
 * @date 13de mayo de 2010
 * @version 1.0
 */
global $db;
global $id;
require('../core/phpmailer/class.phpmailer.php');
global $funciones;
$bandera 	=	false;
$horas[0]['tiempo']	=	'7:30 AM';
$horas[1]['tiempo']	=	'8:00 AM';
$horas[2]['tiempo']	=	'8:30 AM';
$horas[3]['tiempo']	=	'9:00 AM';
$horas[4]['tiempo']	=	'9:30 AM';
$horas[5]['tiempo']	=	'10:00 AM';
$horas[6]['tiempo']	=	'10:30 AM';
$horas[7]['tiempo']	=	'11:00 AM';
$horas[8]['tiempo']	=	'11:30 AM';
$horas[9]['tiempo']	=	'12:00 M';
$horas[10]['tiempo']	=	'12:30 M';
$horas[11]['tiempo']	=	'1:00 PM';
$horas[12]['tiempo']	=	'1:30 PM';
$horas[13]['tiempo']	=	'2:00 PM';
$horas[14]['tiempo']	=	'2:30 PM';
$horas[15]['tiempo']	=	'3:00 PM';
$horas[16]['tiempo']	=	'3:30 PM';
$horas[17]['tiempo']	=	'4:00 PM';
$horas[18]['tiempo']	=	'4:30 PM';
$horas[19]['tiempo']	=	'5:00 PM';
$horas[20]['tiempo']	=	'5:30 PM';
//capturo el id del usuario
$id_usuario	=	(isset($_GET['user']))?base64_decode($_GET['user']):0;
//valido si hay un usuario de lo contrario no dejo entrar a la ventana de pedidos
//listado de usuarios para pintar la tabla
$listado_usuarios	=	$db->GetAll(sprintf("SELECT * FROM pedidos_carrito ORDER BY id desc"));
$bandera == false;
if(isset($_GET['ver']))
{
	$bandera =true;
	$info_compra	= $db->GetAll(sprintf("SELECT * FROM pedidos_carrito WHERE id=%s",$_GET['ver']));	
}
?>
<style>
        *{font-size: 13px}
	.titulo{text-align:center;font-weight:bold}
	.titulo2{text-align:left;font-weight:bold}
	.tabla td{border:1px solid #ccc}
	.tabla2 td{padding:0 0 10px 0}
</style>
<?if($bandera == true){?>
	<table width="100%" class="tabla2">
		<tr>
			<td class="titulo2" colspan="2" align="center"><center>Resumen del pedido: </center></td>
		</tr>
		<tr>
			<td class="titulo2">Id orden: </td>
			<td><?=$info_compra[0]['id']?></td>
		</tr>
		<tr>
			<td class="titulo2">Estado de la orden: </td>
			<td>
				<?php 
				switch ($info_compra[0]['estado']) {
			        case "1":
			            $msjRespPayu = "Capturando datos.";
			        break;
			        case "2":
			            $msjRespPayu = "Estado inicial de la transaccion.";
			        break;
			        case "101":
			            $msjRespPayu = "Retornado por el conversor de monedas, indicando la modificacion realizada.";
			        break;
			        case "102":
			            $msjRespPayu = "Transaccion fue evaluada por nuestro modulo antifraude.";
			        break;
			        case "103":
			            $msjRespPayu = "Movimiento fue enviado para su procesamiento al proveedor de pago.";
			        break;
			        case "4":
			            $msjRespPayu = "La transaccion fue aprobada por la entidad financiera.";
			        break;
			        case "6":
			            $msjRespPayu = "Transaccion declinada o abandonada";
			        break;
			        case "104":
			            $msjRespPayu = "Se presento un error con el medio de pago externo";
			        break;
			        case "7":
			            $msjRespPayu = "Operacion pendiente de finalizacion";
			        break;
			        case "5":
			            $msjRespPayu = "Transaccion expiro, por superar el tiempo limite de respuesta";
			        break;
			        default:
			        	$msjRespPayu = "Estado inicial";
			        break;
			    }

			    echo $msjRespPayu;
			    ?>
			</td>
		</tr>
		<tr>
			<td class="titulo2">Nombre: </td>
			<td><?php echo $info_compra[0]['nombre']." ".$info_compra[0]['apellido']; ?></td>
		</tr>
                <tr>
			<td class="titulo2">Mail: </td>
			<td><?php echo $info_compra[0]['email'];?></td>
		</tr>
		<tr>
			<td class="titulo2">Telefono: </td>
			<td><?php echo $info_compra[0]['telefonoEntrega'];?></td>
		</tr>
		<tr>
			<td class="titulo2">Dirección: </td>
			<td><?php echo $info_compra[0]['direccionEntrega'];?></td>
		</tr>
		<tr>
			<td class="titulo2">Costo envio: </td>
			<td><?php echo $info_compra[0]['costoEnvio'];?></td>
		</tr>
		<tr>
			<td class="titulo2">Costo: </td>
			<td><?php echo $info_compra[0]['costoTotal'];?></td>
		</tr>
		<tr>
			<td class="titulo2">Valor total: </td>
			<?php $total = $info_compra[0]['costoTotal'] + $info_compra[0]['costoEnvio'];?>
			<td><?php echo $total;?></td>
		</tr>
		<tr>
			<td class="titulo2">Fecha: </td>
			<td><?php echo $info_compra[0]['fecha_registro'];?></td>
		</tr>
                
	</table>
	<?php 

		$query_productos_pedido = "SELECT * from detalle_pedido where id_pedido=".$_GET['ver'];
	  	$lista_productos_pedido=$db->GeTAll($query_productos_pedido);

  	?>

        <table width="100%" border="1" cellspacing=0>
            <tr>
                <th><center>REFERENCIA</center></th>
                <th><center>ARTICULO</center></th>
                <th><center>PESO</center></th>
                <th><center>VALOR UNITARIO</center></th>
                <th><center>CANTIDAD</center></th>
                <th><center>TOTAL</center></th>
            </tr>
            <?
            foreach($lista_productos_pedido as $prod){

                $precio_total=$prod['precio']*$prod['cantidad'];
                	
            ?>
                <tr>
                <td><?php echo $prod['id']?></td>
                <td><?php echo $prod['descripcion']?></td>
                <td><center><?php echo $prod['peso']?></center></td>
                <td><center><?php echo '$ '.number_format($prod['precio'],0,",",".")?></center></td>
                <td><center><?php echo $prod['cantidad']?></center></td>
                <td><center><?php echo '$ '.number_format($precio_total,0,",",".")?></center></td>

                </tr>
            <?}?>
                <tr>
                    <td colspan="5" style="text-align:right"><b>TOTAL: </b></td>
                    <td><center><?php echo '$ '.number_format($total,2,",",".")?></center></td>
                </tr>
        </table>
<?}else{?>

	<table class="tabla" width="100%" border="0" cellspacing="0">
	<!--<tr>
		<td colspan="5">
			<a href="externos/excel3.php">Genera Excel</a>
		</td>
	</tr>-->
		<tr>
			<td class="titulo">
				ID ORDEN
			</td>
			<td class="titulo">
				NOMBRE
			</td>
			<td class="titulo">
				MAIL
			</td>
            <td class="titulo">
				TELEFONO
			</td>
			<td class="titulo">
				FECHA
			</td>
			<!--<td class="titulo">
				DIRECCION
			</td>-->
			<!--<td class="titulo">
				ESTADO
			</td>-->
			<td class="titulo">
				ACCIONES
			</td>
		</tr>
	<?
        foreach($listado_usuarios as $contactos){ 

        	if (!empty($contactos['nombre'])){
        	?>
		<tr>
			<td>
				<?php echo $contactos['id'] ?>
			</td>
			<td>
				<?php echo $contactos['nombre']." ".$contactos['apellido']; ?>
			</td>
			<td align="center">
				<?php echo $contactos['email']; ?>
			</td>
            <td align="center">
				<?php echo $contactos['telefonoEntrega']; ?>
			</td>
			<td align="center">
				<?php echo $contactos['fecha_registro']; ?>
			</td>
		
			
			<td align="center">
				<a href="index.php?id=<?=$id ?>&ver=<?=$contactos['id']?>">Ver</a>
			</td>
		</tr>

		<?php } ?>


	<?php } ?>
<?php } ?>