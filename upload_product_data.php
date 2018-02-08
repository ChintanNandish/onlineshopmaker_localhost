<?php
	session_start();
	if (isset($_FILES["product_image"])){
		echo "YES";
	}
	$product_name = $_POST["product_name"];
	$product_price = $_POST["product_price"];
	$product_stock = $_POST["product_stock"];
	$product_threshold = $_POST["product_threshold"];
	$product_id = $_POST["product_id"];
	$product_brand = $_POST["product_brand"];
	$product_size = $_POST["product_size"];
	$product_description = $_POST["product_description"];
	$product_gender = $_POST["product_gender"];
	$product_offer_price = $_POST["product_offer_price"];
	$product_offer_percentage = $_POST["product_offer_percentage"];
	$product_color = $_POST["product_color"];
	$product_image = $_FILES["product_image"]["name"];

	$user = $_SESSION["username"];

	if (!file_exists('user_folders/'.$user.'/images'))
		mkdir('user_folders/'.$user.'/images');

	$path = "user_folders/".$user."/images/".$product_image;
	$copy = copy($_FILES['product_image']['tmp_name'], $path);
	$file = fopen('user_folders/'.$user.'/product_data.json', 'a');
	/*$string = '{'.(string)$product_name.' : {'.
		'product_price : '.(string)$product_price.','.
		'product_stock : '.(string)$product_stock.','.
		'product_threshold : '.(string)$product_threshold.','.
		'product_image : '.$product_image.','.
		'product_id : '.(string)$product_id.','.
		'product_brand : '.$product_brand.','.
		'product_size : '.(string)$product_size.','.
		'product_description : '.(string)$product_description.','.
		'product_gender : '.$product_gender.','.
		'product_offer_price : '.(string)$product_offer_price.','.
		'product_offer_percentage : '.(string)$product_offer_percentage.','.
		'product_color : '.$product_color.','.
		'}'.
	'}';*/

	$string[] = array('product_price' => (string)$product_price, 'product_stock' => (string)$product_stock, 'product_threshold' => (string)$product_threshold, 'product_image' => (string)$product_image, 'product_id' => (string)$product_id, 'product_brand' => (string)$product_brand, 'product_size' => $product_size, 'product_description' => (string)$product_description, 'product_gender' => (string)$product_gender, 'product_offer_price' => (string)$product_offer_price, 'product_offer_percentage' => (string)$product_offer_percentage, 'product_color' => (string)$product_color); 

	$json_str[(string)$product_name] = $string; 

	fwrite($file, json_encode($json_str));
	fclose($file);
	header("location:javascript://history.go(-1)");
?>