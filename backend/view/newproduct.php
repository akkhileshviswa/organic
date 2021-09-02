<!DOCTYPE html>
<html>
	<head>
		<title>New Product</title>
		<link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/newproduct.css">
		<script src="<?= Utility::getAssests() ?>/assests/js/newproduct.js"></script>
	</head>
	<body>	
		<div>
			<div id="box">
				<?php 
					if(isset($_SESSION['message'])){
						echo $_SESSION['message'];
						unset($_SESSION['message']);
					} 
				?>
			</div>
			<div>
				<table id="table">
					<tr>
						<td><h2>Register Product</h2></td>
					</tr>
					<tr>
						<td>
						<form method="POST" action="createproduct" autocomplete="off" onsubmit="return validate();" enctype="multipart/form-data" >
						<label id="required">PRODUCT NAME</label><br>
							<input id="product_name" type="text" name="product_name" size="40" ><br><br>
							<span id="nameerr"></span><br>
							<br><label id="required">PRICE</label><br>
							<input id="price" type="text" name="price" size="40" ><br><br>
							<span id="priceerr"></span><br>
							<br><label id="required">Quantity</label><br>
						    <br><input id="quantity" type="text" name="quantity" value="<?php echo $i["quantity"]; ?>" size="40" ><br><br>
						    <span id="quantityerr" class="error"></span><br>
							<br><label id="required">UPLOAD IMAGE OF PRODUCT </label><br>
							<br><input id="file" type="file" name="file" ><br>
							<br><span id="fileerr"></span><br>
							<br><input id="button" type="submit" value="Submit"></input><br><br>		
						</form>
						</td>
					</tr>			
				</table>
			</div>
		</div>
	</body>
</html>