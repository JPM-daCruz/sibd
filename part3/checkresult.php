<html>
<body>
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$name = $_REQUEST['name'];

	$stmt = $connection->prepare("SELECT *
 FROM patient  WHERE name like :%name");

	$stmt->execute(array('name' => $name));

	
	if($stmt == 0)
	{
		echo("<p>There is no Patient with such name.</p>");
		echo("<td><a href=\"insertpatient.php");
		echo("\">Add patient</a></td>\n");
	}

	else{

	echo("<table border=\"0\" cellspacing=\"5\">\n");
	foreach($stmt as $row)
	{
	echo("<tr>\n");
	echo("<td><a href=\"device.php?number=");
	echo($row['number']);
	echo("\">{$row['name']}</a></td>\n");
	echo("</tr>\n");
	}
	echo("</table>\n");
	}

        $connection = null;

?>
</body>
</html>
