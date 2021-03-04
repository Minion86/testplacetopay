<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();


$db_handle->execute("INSERT INTO ORDERS (customer_name,customer_email,customer_mobile,status, created_at,updated_at,reference)values ('','','','REJECTED',now(),now(),'".$_GET['reference']."')");
unset($_SESSION["cart_item"]);
?>
<link href="style.css" type="text/css" rel="stylesheet" />
<div class="no-records">El carrito está vacío</div>
<br/>
<a id="btnCheckout" href="index.php">home</a>
<?php
?>

