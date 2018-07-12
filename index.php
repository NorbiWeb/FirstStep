<?php
//index.php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
	if(empty($_POST["firstname"]))
	{
		$error .= '<p><label class="text-danger">Kérem a nevet!</label></p>';
	}
	else
	{
		$name = clean_text($_POST["firstname"]);
		if(!preg_match("/^[\pL\s,.'-]+$/u",$name))
		{
			$error .= '<p><label class="text-danger">Csak betuket fogadok el!</label></p>';
		}
	}
	if(empty($_POST["email"]))
	{
		$error .= '<p><label class="text-danger">Kérem az Email címed!</label></p>';
	}
	else
	{
		$email = clean_text($_POST["email"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error .= '<p><label class="text-danger">Pontos email címet adj meg!</label></p>';
		}
	}
	if(empty($_POST["subject"]))
	{
		$error .= '<p><label class="text-danger">Pizza típusa elengedhetetlen!</label></p>';
	}
	else
	{
		$subject = clean_text($_POST["subject"]);
	}
	if(empty($_POST["address"]))
	{
		$error .= '<p><label class="text-danger">Kérem az uzenetet!</label></p>';
	}
	else
	{
		$message = clean_text($_POST["address"]);
	}

	if($error == '')
	{
		$file_open = fopen("contact_data.csv", "a");
		$no_rows = count(file("contact_data.csv"));
		if($no_rows > 0)
		{
			$no_rows = ($no_rows - 1) + 1;
		}
		$form_data = array(
			'sr_no'		=>	$no_rows,
			'firstname'		=>	$name,
			'email'		=>	$email,
			'subject'	=>	$subject,
			'address'	=>	$message
		);
		fputcsv($file_open, $form_data);
		$error = '<label class="text-success">Koszonjuk, rendelésed megkaptuk!</label>';
		$name = '';
		$email = '';
		$subject = '';
		$message = '';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>PANDA RENDELESEK</title>
		<link rel="stylesheet" href="CSS/index.css">
		<link rel="shortcut icon" type="image/png" href="../IMG/logo.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta http-equiv="cache-control" content="max-age=0" /> <meta http-equiv="cache-control" content="no-cache" /> <meta http-equiv="expires" content="0" /> <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" /> <meta http-equiv="pragma" content="no-cache" />

	</head>
	<body>
		<br />
		<div class="hiba">
			<?php echo $error; ?>	
		</div>
		<div class="container">
		
			<div class="sticky" align="center">
				<div class="felso">
				  
				  <div class="felso logo">
						<img src="IMG/logo.png" style="width: 25%;">
				  </div>
				  <div class="buttons">
					<button type="button" style="cursor: pointer;" onclick=window.open('https://docs.google.com/forms/d/e/1FAIpQLSdSUBVKq8bE6t4tcZHJ2yZ8Ca6_PI7bLoJlo8FBBCNQ5QovPg/viewform?usp=pp_url&entry.1472878392=Eger,+&entry.929561500=06/','_blank');>HOME</button>
					<button type="button" style="cursor: pointer;" onclick=window.open('https://docs.google.com/forms/d/e/1FAIpQLSdSUBVKq8bE6t4tcZHJ2yZ8Ca6_PI7bLoJlo8FBBCNQ5QovPg/viewform?usp=pp_url&entry.1472878392=Eger,+&entry.929561500=06/','_blank');>Pizzak</button>
					<button type="button" style="cursor: pointer;" onclick=window.open('https://docs.google.com/forms/d/e/1FAIpQLSdSUBVKq8bE6t4tcZHJ2yZ8Ca6_PI7bLoJlo8FBBCNQ5QovPg/viewform?usp=pp_url&entry.1472878392=Eger,+&entry.929561500=06/','_blank');>Gyros</button> 
					<button type="button" style="cursor: pointer;" onclick=window.open('https://docs.google.com/forms/d/e/1FAIpQLSdSUBVKq8bE6t4tcZHJ2yZ8Ca6_PI7bLoJlo8FBBCNQ5QovPg/viewform?usp=pp_url&entry.1472878392=Eger,+&entry.929561500=06/','_blank');>Udito</button> 
					<button type="button" style="cursor: pointer;" onclick=window.open('https://docs.google.com/forms/d/e/1FAIpQLSdSUBVKq8bE6t4tcZHJ2yZ8Ca6_PI7bLoJlo8FBBCNQ5QovPg/viewform?usp=pp_url&entry.1472878392=Eger,+&entry.929561500=06/','_blank');>Rolunk</button> 
					<button type="button" style="cursor: pointer;" onclick=window.open('https://docs.google.com/forms/d/e/1FAIpQLSdSUBVKq8bE6t4tcZHJ2yZ8Ca6_PI7bLoJlo8FBBCNQ5QovPg/viewform?usp=pp_url&entry.1472878392=Eger,+&entry.929561500=06/','_blank');>Kapcsolat</button>
					<script>
						$(document).ready(function(){
							$("button").click(function(){
							var div = $(this);
							div.slideUp(500);
							div.fadeIn(1600);
							});
						});
					</script>
				  </div>
				  <div class="felso logo">
						<img src="IMG/logo.png" style="width: 25%;">
				  </div>
				</div>
			</div>	
	
		
			
			<div class="col-md-6" style="margin:0 auto; float:right;">
				<form name="input" method="post">
					<h1 align="center" >RENDELÉS</h1>
					
					<div class="form-group">
						<label>Kérem a Neved</label>
						<input type="text" name="firstname" placeholder="Ide ird a neved" class="form-control" value="<?php echo $name; ?>" />
					</div>
					<div class="form-group">
						<label>Kérem az Email címed</label>
						<input type="text" name="email" class="form-control" placeholder="Johet az email cimed" value="<?php echo $email; ?>" />
					</div>
										
					
						<label>Pizza Valasztek</label>
						<select name="" onchange="myFunction(event)">
							  <option disabled selected>Válassz a Menubol</option>
							  <option name="subject" type="text" class="form-control" value="Quattro Formaggie">Quattro Formaggie</option>
							  <option name="subject" type="text" class="form-control" value="Margherita">Margherita</option>
							  <option name="subject" type="text" class="form-control" value="Szalámi">Szalámi</option>
							  <option name="subject" type="text" class="form-control" value="Dolora">Dolora</option>
							  <option name="subject" type="text" class="form-control" value="Happy">Happy</option>
							  <option name="subject" type="text" class="form-control" value="Hawaii">Hawaii</option>
							  <option name="subject" type="text" class="form-control" value="Mexiko">Mexikó</option>
						</select>
							
					<div class="form-group">
						<label>Választott Pizza:</label>
						<input id="myText" type="text" name="subject" class="form-control" value="<?php echo $subject; ?>">
					</div>
					
					<script>
						function myFunction(e) {
						document.getElementById("myText").value = e.target.value
												}
					</script>
					
					
					<div class="form-group">
						<label>Kiszállítási Cím:</label>
						<textarea style="min-height: 50px;" name="address" class="form-control" placeholder="Pontos címed"><?php echo $message; ?></textarea>
					</div>
					<div class="form-group" align="center">
						<input type="submit" name="submit" class="btn btn-info" value="Kuldes" style="width:30%;border-radius: 10px;" align="center"/>
					</div>
				</form>
			</div>
						
			
		</div>
	</body>
</html>
