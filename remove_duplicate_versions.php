<?php

// Connexion database
mysql_connect("mysql51-32.bdb", "koalabss", "HzwEEhrs");
mysql_select_db("koalabss");

$SQL = "SELECT * FROM flyspray_list_version GROUP BY version_name";
$reponse = mysql_query($SQL);
while ($req = mysql_fetch_array($reponse))
{
	$SQL = "SELECT * FROM flyspray_list_version WHERE version_name='".$req['version_name']."' AND project_id=".$req['project_id']." AND version_id != ".$req['version_id'];
	$reponse2 = mysql_query($SQL);
	while ($req2 = mysql_fetch_array($reponse2))
	{
		echo $req2['version_name']." ".$req2['version_id']."<br>";
	
		$SQL = "UPDATE flyspray_tasks SET product_version=".$req['version_id']." WHERE product_version=".$req2['version_id'];
		mysql_query($SQL);
		
		$SQL = "UPDATE flyspray_tasks SET closedby_version=".$req['version_id']." WHERE closedby_version=".$req2['version_id'];
		mysql_query($SQL);
		
		$SQL = "DELETE FROM flyspray_list_version WHERE version_id=".$req2['version_id'];
		mysql_query($SQL);
	}
}

?>