<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToPrivateArea.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Rede Social</title>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-icons-1.8.3/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
	<div class="container" style="margin-top: 35vh;">
	<div class="row d-flex justify-content-center">
		<aside class="col-sm-4">
			<div class="card">
				<article class="card-body">
					<form action="./Login.php" method="post">
    					<div class="form-group mb-4">
    						<label>Email:</label>
        					<input id="email" name="email" class="form-control" placeholder="Email" type="email">
    					</div> <!-- form-group// -->
    					<div class="form-group">
        					<button type="submit" class="btn btn-primary btn-block">Login</button>
    					</div> <!-- form-group// -->                                                           
					</form>
				</article>
			</div> <!-- card.// -->
		</aside> <!-- col.// -->
	</div>
</body>
</html>