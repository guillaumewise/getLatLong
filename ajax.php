<?php 
require_once 'config.php';
if (is_numeric($_GET['id_address']))
{
  
	// get address details
	$q = $db->prepare('SELECT address FROM my_addresses WHERE id = :id');
	$q->bindValue(':id',$_GET['id_address']);
	$q->execute();

	$res = $q->fetch(PDO::FETCH_ASSOC);
	$address = $res['address'];

	$to = array('\'',' ');
	$or = array('+','+');

	$query = str_replace($to,$or,$address);

	$api_url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$query.'&sensor=false';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	curl_setopt($ch, CURLOPT_URL, $api_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);

	$data = json_decode($result,true);

	if ($data['results'])
	{
		$latitude = $data['results'][0]['geometry']['location']['lat'];
		$longitude = $data['results'][0]['geometry']['location']['lng'];

		$q = $db->prepare('UPDATE my_addresses SET latitude = :lat, longitude = :long WHERE id = :id');
		$q->bindValue(':lat',$latitude);
		$q->bindValue(':long',$longitude);
		$q->bindValue(':id',$_GET['id_address']);
		$q->execute();
	}	
}
