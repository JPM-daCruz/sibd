<html>
<body>
	<form action="series/1" method="post">
	<h3>Create a new Study</h3>
	
	<p>Request number:
	  <select name="request_number">	
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT distinct number FROM request";

	$result = $connection->query($sql);
	if ($result == False)
	{
		$info = $connection->errorInfo();
		echo("<p>Error: {$info[2]}</p>");
		exit();
	}
		

	foreach($result as $row)
	{
		
		$request_number = $row['number'];
		echo("<option value=\"$request_number\">$request_number</options>");
	}
			
        $connection = null;

	?>

		</select>
		</p>

	<p>Description:</p>
	<textarea name="Description" cols="50" rows="4">Enter the study description...</textarea>


		<p>Doctor id:
	  <select name="doctor_id">	
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT distinct doctor_id FROM doctor WHERE NOT EXISTS (SELECT 1 From request where request.number='$request_number' and request.doctor_id=doctor.doctor_id)";


	$result = $connection->query($sql);
	if ($result == False)
	{
		$info = $connection->errorInfo();
		echo("<p>Error: {$info[2]}</p>");
		exit();
	}
		

	foreach($result as $row)
	{
		
		$doctor_id = $row['doctor_id'];
		echo("<option value=\"$doctor_id\">$doctor_id</options>");
	}
			
        $connection = null;

	?>

		</select>
		</p>


			<p>Manufacturer:
	  <select name="doctor_id">	
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT distinct manufacturer FROM device";

	$result = $connection->query($sql);
	if ($result == False)
	{
		$info = $connection->errorInfo();
		echo("<p>Error: {$info[2]}</p>");
		exit();
	}
		

	foreach($result as $row)
	{
		
		$manufacturer = $row['manufacturer'];
		echo("<option value=\"$manufacturer\">$manufacturer</options>");
	}
			
        $connection = null;

	?>

		</select>
		</p>

			<p>Serial number:
	  <select name="serialnum">	
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = "SELECT distinct serialnum FROM device";

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
