<html>
<body>
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$account_number = $_REQUEST['account_number'];

	$sql = "SELECT balance FROM account WHERE account_number='$account_number'";

	echo("<p>$sql</p>");

	$result = $connection->query($sql);
	
	$nrows = $result->rowCount();
	
	if($nrows == 0)
	{
		echo("<p>There is no account with such number.</p>");
	}
	else
	{
		$row = $result->fetch();
		$balance = $row['balance'];
		echo("<p>The balance of $account_number is: $balance</p>");
	}	

        $connection = null;

?>
</body>
</html>
