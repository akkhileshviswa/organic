<!DOCTYPE html>
<html>
	<head>
		<title>Update Customer</title>
		<link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/updatecustomer.css">
		<script src="<?= Utility::getAssests() ?>/assests/js/customers.js"></script>
	</head>
	<body>	
		<div>
			<table id="table">
				<tr>
					<td><h2>Update Customer</h2></td>
				</tr>
				<?php
					$controller = new Controller;
					$editCustomer = $controller -> editCustomer();
					while( $i = $editCustomer->fetch_assoc()): 
				?>
				<tr>
					<td>
					    <form method="POST" action="customers" onsubmit="return validate();" autocomplete="off">
							<input type="hidden" name="user_id" value="<?php echo $i['user_id']; ?>">
							<label id="required">NAME</label><br>
					        <input id="username" type="text" name="username" value="<?php echo $i['username']; ?>" size="40" ><br><br>
					        <span id="nameerr"></span><br>
						    <br><label id="required">Email</label><br>
						    <br><input id="email" type="text" name="email" value="<?php echo $i['email']; ?>" size="40" ><br><br>
						    <span id="emailerr"></span><br>
						    <br><input id="button" type="submit" name="update" value="Update"><br><br>		
						</form>
					</td>
				</tr>	
				<?php endwhile;?>			
        	</table>
		</div>
	</body>
</html>