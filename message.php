<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<?php

// Prikaz korisnika u tabeli

    $upit = "SELECT * FROM poruka";
	
	$rez = mysqli_query($konekcija, $upit);
	
	if(mysqli_num_rows($rez) == 0){
		echo "There are no messages.";
	} else {  ?>
        <div class='row'>
            <div class='col-xs-6 col-lg-12'>
                <h2>Messages</h2>
                <table class='table table-stripped table-hover table-sm'>
                        <tr>
                            <th>RB</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Title</th>
                            <th>Message</th>
                        </tr>
                <?php $i = 1; 

                while($r = mysqli_fetch_array($rez)){
                    echo "<tr>
                            <td>$i</td>
                            <td>".$r['id_poruka']."</td>
                            <td>".$r['kor_ime']."</td>
                            <td>".$r['naslov']."</td>
                            <td>".$r['poruka']."</td>
                          </tr>";
                    $i++;
                }	?>	
                </table>
            </div>
        </div>
<?php } ?>
            
<!-- Gotova tabela -->