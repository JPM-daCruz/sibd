<html>
<body>
	<form action="changeresult.php" method="post">
	<h3>Insert a new device</h3>
	<p>Serialnum:
	  <select name="serialnum">	
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$manufacturer= $_REQUEST['manufacturer'];
	$serialnum= $_REQUEST['serialnum'];

	$sql = "SELECT distinct serialnum FROM device, wears where device.manufacturer like '$manufacturer' and device.serialnum != '$serialnum' and ((wears.snum=device.serialnum and wears.end<current_date) or (device.serialnum!=wears.snum))";

	$result = $connection->query($sql);
	if ($result == False)
	{
		$info = $connection->errorInfo();
		echo("<p>Error: {$info[2]}</p>");
		exit();
	}
		

	foreach($result as $row)
	{
		
		$serialnum = $row['serialnum'];
		echo("<option value=\"$serialnum\">$serialnum</options>");
	}
			
        $connection = null;

	?>

		</select>
		</p>
		<p><input type="submit" value="Submit"/></p>
	</form>
</body>
</html>
