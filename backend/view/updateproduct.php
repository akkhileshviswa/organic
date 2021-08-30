<!DOCTYPE html>
<html>
	<head>
		<title>Update Product</title>
		<link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/newproduct.css">
		<script src="<?= Utility::getAssests() ?>/assests/js/updateproduct.js"></script>
	</head>
	<body>	
		<div>
			<table id="table">
				<tr>
					<td><h2>Update Product</h2></td>
				</tr>
				<?php
					$controller = new Controller;
					$editProduct = $controller -> editProduct();
					while( $i = $editProduct->fetch_assoc()): 
				?>
				<tr>
					<td>
					    <form method="POST" action="products" onsubmit="return validate();" autocomplete="off">
							<input type="hidden" name="product_id" value="<?php echo $i["product_id"]; ?>">
							<label id="required">NAME</label><br>
					        <input id="product_name" type="text" name="product_name" value="<?php echo $i["product_name"]; ?>" size="40" ><br><br>
					        <span id="nameerr"></span><br>
						    <br><label id="required">Price</label><br>
						    <br><input id="price" type="text" name="price" value="<?php echo $i["price"]; ?>" size="40" ><br><br>
						    <span id="priceerr"></span><br>
						    <br><input id="button" type="submit" name="update" value="Update"><br><br>		
						</form>
					</td>
				</tr>	
				<?php endwhile;?>		
        	</table>
		</div>
	</body>
</html>