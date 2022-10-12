<?php

if(empty($_GET['submit']))
{
	echo '<script>alert("Enter some text")</script>';
}
else
{
	$text=$_GET['text'];
	$language=$_GET['lang'];
    $curl = curl_init();

    curl_setopt_array($curl, [
	CURLOPT_URL => "https://microsoft-translator-text.p.rapidapi.com/translate?to%5B0%5D=".$language."&api-version=3.0&profanityAction=NoAction&textType=plain",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "[\r\n    {\r\n        \"Text\": \"".$text."\"\r\n    }\r\n]",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: microsoft-translator-text.p.rapidapi.com",
		"X-RapidAPI-Key: 2fd36e12b6msh8ab0b585dfad1e3p1861a3jsn27dfad489721",
		"content-type: application/json"
	],
]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $result = json_decode($response,true);
    echo "<pre>";
    $d= $result[0] ['translations'] [0] ['text'];
    echo "</pre>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanuage Translator</title>
    <style>
        body{
            background:url(hlo.png);
            margin:auto;
            font-size:30px;
        }
        b{
            color:green;
        }
        input{
            border-radius:25px;
            text-align:center;
        }
        h1{
            color:red;
        }
        </style>
</head>
<body>
	<form method="get" class="myform">
		<center>
            <h1>Text Translator</h1>
            <input type="text" class="text" name="text" placeholder="Enter text here"/><br/><br/>
		<b>Select Language :</b> <select name="lang" class="sel">
			<option value="hi">Hindi</option>
			<option value="en-GB">English (UK)</option>
			<option value="es">Spanish</option>
			<option value="ru">Russian</option>
			<option value="ja">Japanese</option>
		</select><br/><br/>
		<input type="submit" class="sub" name="submit" value="Enter"/><br/><br/><br/></center>
		<?php
		if(!empty($d))
		{
			echo $d;
		}
		?>
	</form>

</body>
</html>