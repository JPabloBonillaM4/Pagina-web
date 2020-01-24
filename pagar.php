<?php

if(!isset($_POST['producto'],$_POST['precio'])){
    exit('Hubo un error');
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'includes/paypal.php';

//Variables de compra
$producto  = htmlspecialchars($_POST['producto']);
$precio    = htmlspecialchars($_POST['precio']);
$cantidad  = htmlspecialchars($_POST['cantidad']);
$precio    = (int)$precio * $cantidad;
$envio     = 0;
$total     = $precio + $envio;
$articulos = [];
$cantidad_articulos_carrito = 1;

//Datos de compra 
$compra = new Payer();
$compra->setPaymentMethod('paypal');

// for ($i=0; $i < $cantidad_articulos_carrito; $i++) { 
//     $articulo = new Item();
//     $articulo->setName($producto)
//              ->setPrice($precio)
//              ->setCurrency('MXN')
//              ->setQuantity($cantidad);
        
//     array_push($articulos,$articulo);
// }

$articulo = new Item();
$articulo->setName($producto)
            ->setPrice($precio)
            ->setCurrency('MXN')
            ->setQuantity($cantidad);

$lista_articulos = new ItemList();
$lista_articulos->setItems($articulo);
  
$detalles = new Details();
$detalles->setShipping($envio)
         ->setSubtotal($precio);

$cantidad = new Amount();
$cantidad->setCurrency('MXN')
         ->setTotal($total)
         ->setDetails($detalles);

// cantidadArticulos($lista_articulos);

$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($lista_articulos)
            ->setDescription('Pago')
            ->setInvoiceNumber(uniqid());

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . '/pago_finalizado.php?exito=true')
              ->setCancelUrl(URL_SITIO . '/pago_finalizado.php?exito=false');

$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));
     
try {
    $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
    echo "<pre>";
        print_r(json_decode($pce->getData()));
        exit;
    echo "</pre>";
}

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");

// FUNCIONES NORMALES
function cantidadArticulos($listado){
    foreach ($listado->getItems() as $value) {

        if($value->getQuantity() == 0){
            alerta1();
            // alerta2();
        }
        else if($value->getQuantity() == 1){
            $total = $value->getQuantity() * $value->getPrice();
            echo "<br> Se vendio por un total de $$total: <br>";
            echo "- ".$value->getName()." en $".$value->getPrice().".00 ".$value->getCurrency();
        } 
        else if($value->getQuantity() >= 2){
            $total = $value->getQuantity() * $value->getPrice();
            echo "<br> Se vendieron por un total de $$total.00 ".$value->getCurrency().": <br>";
            echo "- ".$value->getQuantity()." ".$value->getName()." en $".$value->getPrice().".00 ".$value->getCurrency()." c/u";
        }
    
    }
}

// FUNCIONES DE SALIDA
function alerta1(){
    return exit('
        <script>
            alert("Debes agregar al menos 1 producto");
            window.history.back();
        </script>
    ');
}

function alerta2(){
    return exit('
        <h2>Debes agregar al menos 1 producto</h2>
        <a href="http://paypal.xd/paypal/">Regresar</a>
    ');
}