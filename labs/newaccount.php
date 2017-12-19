<html>
<body>
	<form action="insert.php" method="post">
	<h3>Insert a new account</h3>
	<p>Acount no.: <input type=text" name="account_number"/></p>
	<p>Branch:
	  <select name="branch_name">	
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT branch_name FROM branch ORDER BY branch_name;";

	$result = $connection->query($sql);
	if ($result == False)
	{
		$info = $connection->errorInfo();
		echo("<p>Error: {$info[2]}</p>");
		exit();
	}
		

	foreach($result as $row)
	{
		
		$branch_name = $row['branch_name'];
		echo("<option value=\"$branch_name\">$branch_name</options>");
	}
			
        $connection = null;

	?>

		</select>
		</p>
		<p>Balance: <input type="text" name="balance"/></p>
		<p><input type="submit" value="Submit"/></p>
	</form>
</body>
</html>
