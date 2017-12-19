<html>
<body>
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$account_number = $_REQUEST['account_number'];

	$branch_name = $_REQUEST['branch_name'];
	
	$balance = $_REQUEST['balance'];
	
	$sql = "INSERT INTO account VALUES ('$account_number', '$branch_name', $balance)";

	echo("<p>$sql</p>");
	
	$nrows = $connection->exec($sql);
	
	echo("<p>Rows inserted: $nrows</p>");
		
        $connection = null;

?>
</body>
</html>
