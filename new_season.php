<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- obrada za unos -->

<?php

    if(isset($_REQUEST['btn-add-country'])){
        $season_to_add = $_REQUEST['tb_add_season'];
        
        $upit_unos = "INSERT INTO kategorije VALUES ('', '$season_to_add')";
        $rez_unos = mysqli_query($konekcija, $upit_unos);
        if(!$rez_unos){
            $msg_add = "Error msql season.";
        } else {
            $msg_add = "Succesfully added season!";
        }
    }

?>


<!-- Prikaz drzava u tabeli -->

<?php

    $upit = "SELECT * FROM kategorije";
	
	$rez = mysqli_query($konekcija, $upit);
	
	if(mysqli_num_rows($rez) == 0){
		echo "There are no seasons.";
	} else {  ?>
        <div class='row'>
            <div class='col-xs-6 col-lg-6'>
                <h2>Seasons</h2>
                <table class='table table-stripped table-hover table-sm'>
                        <tr>
                            <th>RB</th>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                <?php $i = 1; 

                while($r = mysqli_fetch_array($rez)){
                    echo "<tr>
                            <td>$i</td>
                            <td>".$r['id_kategorija']."</td>
                            <td>".$r['naziv_kategorija']."</td>
                          </tr>";
                    $i++;
                }	?>	
                </table>
            </div>
<?php } ?>
            
    <!-- Gotova tabela -->

<!-- forma za dodavanje -->

    <div class="col-xs-6 col-lg-6">
        <h2>Add season</h2>
        <form action='?page=17' method="post"> 
            <input type='text' name='tb_add_season' id='tb_add_season' class='form-control' placeholder='Enter name'>
            <button type="submit" name="btn-add-country" class='btn btn-primary mb-2 form-control'>Add</button>      
        </form> 
        <?php if(isset($msg_add)) echo $msg_add; ?>
    </div>
    
</div>