<!-- IST MySQL Connection Test -- 2015.09.19 -->

<html>
<body>
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT * FROM account;";

	$result = $connection->query($sql);
	
	$num = $result->rowCount();


	echo("<table border=\"1\">\n");
	echo("<tr><td>account_number</td><td>branch_name</td><td>balance</td></tr>");
	foreach($result as $row)
	{
		echo("<tr><td>");
		echo($row["account_number"]);
		echo("</td><td>");
		echo($row["branch_name"]);
		echo("</td><td>");
		echo($row["balance"]);
		echo("</td></tr>\n");
	}
	echo("</table>\n");
		
        $connection = null;

?>
</body>
</html>
