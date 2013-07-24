<?php 
require_once 'config.php'; 

$q = $db->query('SELECT id FROM my_addresses');

$tableau .= '[';

$nbr_addresses = $q->rowCount();
$i = 1;

while ($res = $q->fetch(PDO::FETCH_ASSOC))
{  
	if ($i == $nbr_addresses ) $s = '';
	else $s = ', ';

	$tableau .= $res['id'].$s;

	$i++;
}

$tableau .= ']';

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Get Latitude / Longitude</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
	
	<input type="submit" id="start" value="Start">
	<br>
	<div class="message"></div>

<script>

		var tableau = <?=$tableau?>;		
		var i = 0;

		function myLoop () {
			
			setTimeout(function () {

				$.ajax({
					type: 'GET',
					data: {id_address : tableau[i]},
					url : 'ajax.php',
				    dataType: 'JSON',
				});

				$('.message').html('processing');
				i++;

				if (i < tableau.length) myLoop();
				else $('.message').html('Complete.');

			}, 4000)
		}

		$('#start').click(function(){

			myLoop();

		})

</script>
</body>
</html>
