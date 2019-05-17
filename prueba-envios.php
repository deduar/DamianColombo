<?php
require_once ('lib/mercadopago.php');

$mp = new MP('2695356676946070', '8QWsKEZgAHEpenvnXu4ymQAss5J9qKce');

$preference_data = array(
	"items" => array(
		array(
			"title" => "Multicolor kite",
			"quantity" => 1,
			"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
			"unit_price" => 10.00
		)
	),
	"shipments" => array(
		"mode" => "me2",
		"dimensions" => "30x30x30,500",
		"local_pickup" => true,
		"free_methods" => array(
			array(
				"id" => 73328
			)
		),
		"default_shipping_method" => 73328,
		"zip_code" => "5700"
	)
);

$preference = $mp->create_preference($preference_data);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pay</title>
	</head>
	<body>
		<a href="<?php echo $preference['response']['init_point']; ?>">Pay</a>
	</body>
</html>
