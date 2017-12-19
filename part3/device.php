<html>
<body>
<h3>Check devices of patient no.: <?=$_REQUEST['number']?></h3>

<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist181622";	// <== replace istxxx by your IST identity
	$password="bsyq3544";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$name = $_REQUEST['name'];
	$number = $_REQUEST['number'];

	date_default_timezone_set();
	$date = date('m/d/Y H:i:s', time());
	echo("$date");

	$sql = "select * from device natural join  wears where wears.patient='$number' and wears.snum=device.serialnum ORDER BY wears.end desc";
	
	$result = $connection->query($sql);

	$nrows = $result->rowCount();

	
	
	echo("<table border=\"1\">\n");
	echo("<tr><td>serialnum</td><td>manufacturer</td><td>model</td><td>start</td><td>end</td></tr>");
	foreach($result as $row)
	{
		echo("<tr><td>");
		echo($row["serialnum"]);
		echo("</td><td>");
		echo($row["manufacturer"]);
		echo("</td><td>");
		echo($row["model"]);
		echo("</td><td>");
		echo($row["start"]);
		echo("</td><td>");
		echo($row["end"]);
		$time = wears.start;
		$diff1 = (strtotime($date)-strtotime($row["end"]))/(60*60*24);
		$diff2 = (strtotime($date)-strtotime($row["start"]))/(60*60*24);
		if ($diff1<0 and $diff2>0)
		{
			echo("</td><td>");
			$manufacturer=$row['manufacturer'];
			$serialnum=$row['serialnum'];		
			echo("<td><a href=\"changedevice.php?manufacturer=$manufacturer&serialnum=$serialnum");
			echo("\">Change device</a></td>\n");
		}		
		echo("</td></tr>\n");
	}
	echo("</table>\n");


	$connection = null;

?>


</body>
</html>
