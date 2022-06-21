<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quick start. Local server-side application</title>
</head>
<body>
	<div id="name">
		<?php

		require_once (__DIR__.'/crest.php');
		$tTitle = "ТЕС Т";
		$loo = 1;
		$result =Crest::call(
    'tasks.task.add',
    [
      'fields'=>
      [
          "TITLE" => $tTitle
		//  "RESPONSIBLE_ID"=> $loo
      ]]);
	  if(!empty($result['result'])){
		echo json_encode(['message' => 'Contact add']);
	}elseif(!empty($result['error_description'])){
		echo json_encode(['message' => 'Contact not added: '.$result['error_description']]);
	}else{
		echo json_encode(['message' => 'Contact not added']);
	}





		?>
	</div>
</body>
</html>