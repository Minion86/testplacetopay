<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
           
		if(!empty($_POST["cantidad"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM producto WHERE codigo='" . $_GET["codigo"] . "'");
			$itemArray = array($productByCode[0]["codigo"]=>array('nombre'=>$productByCode[0]["nombre"], 'codigo'=>$productByCode[0]["codigo"], 'cantidad'=>$_POST["cantidad"], 'precio'=>$productByCode[0]["precio"], 'imagen'=>$productByCode[0]["imagen"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["codigo"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["codigo"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["cantidad"])) {
									$_SESSION["cart_item"][$k]["cantidad"] = 0;
								}
								$_SESSION["cart_item"][$k]["cantidad"] += $_POST["cantidad"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["codigo"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Test</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Carrito</div>

<a id="btnEmpty" href="index.php?action=empty">Vaciar carrito</a>
<a id="btnCheckout" href="pay.php">Pagar</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_cantidad = 0;
    $total_precio = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Nombre</th>
<th style="text-align:left;">Código</th>
<th style="text-align:right;" width="5%">Cantidad</th>
<th style="text-align:right;" width="10%">Precio unitario</th>
<th style="text-align:right;" width="10%">Precio</th>
<th style="text-align:center;" width="5%"></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_precio = $item["cantidad"]*$item["precio"];
		?>
				<tr>
				<td><img src="<?php echo $item["imagen"]; ?>" class="cart-item-imagen" /><?php echo $item["nombre"]; ?></td>
				<td><?php echo $item["codigo"]; ?></td>
				<td style="text-align:right;"><?php echo $item["cantidad"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["precio"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_precio,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&codigo=<?php echo $item["codigo"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_cantidad += $item["cantidad"];
				$total_precio += ($item["precio"]*$item["cantidad"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_cantidad; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_precio, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">El carrito está vacío</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Productos</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM producto  ");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&codigo=<?php echo $product_array[$key]["codigo"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["imagen"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["nombre"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["precio"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="cantidad" value="1" size="2" /><input type="submit" value="Agregar al carrito" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
</BODY>
</HTML>