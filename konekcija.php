<?php
	
	$konekcija = mysqli_connect("sql300.byethost33.com", "b33_21591493", "N4pr3dzv3zd0", "b33_21591493_sajtphp1");
    $konekcija->set_charset("utf-8");
	
	$greske = array();
	
	if(!$konekcija)
	{
		$greske[] = "Greska prilikom konekcije sa serverom baze podataka! ".mysql_error();
	}
	else
	{
		if(!$konekcija)
		{
			$greske[] = "Greska prilikom izbora baze podataka! ".mysql_error();
		}
	}
  
?>