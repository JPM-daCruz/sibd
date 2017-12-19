<html>
<body>
<?php

	$host="db.ist.utl.pt";
	$user="ist181622";	
	$password="bsyq3544";	
	$dbname = $user;	

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT * FROM account;";

	$result = $connection->query($sql);
	
	$num = $result->rowCount();


	echo("<table border=\"0\" cellspacing=\"5\">\n");
	foreach($result as $row)
	{
	echo("<tr>\n");
	echo("<td>{$row['account_number']}</td>\n");
	echo("<td>{$row['balance']}</td>\n");
	echo("<td><a href=\"newbalance.php?account_number=");
	echo($row['account_number']);
	echo("\">Change balance</a></td>\n");
	echo("</tr>\n");
	}
	echo("</table>\n");
		
        $connection = null;

?>
</body>
</html>
