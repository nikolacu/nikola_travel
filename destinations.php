<?php
    
    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- Prikaz destinacija u tabeli -->

<?php

    $upit = "SELECT * FROM article a INNER JOIN drzave d ON a.id_drzava = d.id_drzava INNER JOIN kategorije k ON a.id_kategorija = k.id_kategorija";
	
	$rez = mysqli_query($konekcija, $upit);
	
	if(mysqli_num_rows($rez) == 0){
		echo "There are no destinations.";
	} else {  ?>
        <div class='row'>
            <div class='col-xs-6 col-lg-12'>
                <h2>Destinations</h2>
                <table class='table table-stripped table-hover table-sm'>
                        <tr>
                            <th>RB</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Picture</th>
                            <th>Text</th>
                            <th>Category</th>
                            <th>Country</th>
                        </tr>
                <?php $i = 1; 

                while($r = mysqli_fetch_array($rez)){
                    echo "<tr>
                            <td>$i</td>
                            <td>".$r['id_article']."</td>
                            <td>".$r['title']."</td>
                            <td><img src='{$r['picture']}' alt='{$r['title']}' title='{$r['title']}'  width='100px'></td>
                            <td>".$r['text']."</td>
                            <td>".$r['naziv_kategorija']."</td>
                            <td>".$r['naziv_drzava']."</td>
                          </tr>";
                    $i++;
                }	?>	
                </table>
            </div>
        </div>
<?php } ?>
            
    <!-- Gotova tabela -->