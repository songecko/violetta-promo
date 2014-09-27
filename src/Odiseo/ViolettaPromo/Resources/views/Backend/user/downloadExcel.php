<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<table>
		<tr>
			<th>Facebook ID</th> 
			<th>Nombre</th>
			<th>Email</th>
			<th>Teléfono</th>
			<th>Tiene DIRECTV?</th>
			<th>Cuenta DIRECTV</th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user["fbid"] ?></td>
			<td><?php echo $user["full_name"] ?></td>
			<td><?php echo $user["email"] ?></td>
			<td><?php echo $user["phone"] ?></td>
			<td><?php echo ($user["has_dtv"]==1)?"SI":"NO";  ?></td>
			<td><?php echo $user["dtv_account_number"] ?></td>
		</tr>
		<?php endforeach;  ?>  	  		 
	</table>
</body>  
</html>