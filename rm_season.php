<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- obrada za brisanje -->

<?php

    if(isset($_REQUEST['btn-rm-season'])){
        $season_to_del = $_REQUEST['ddl-rm-season'];
        
        $upit_brisanje = "DELETE FROM kategorije WHERE id_kategorija = '$season_to_del'";
        $rez_brisanje = mysqli_query($konekcija, $upit_brisanje);
        if(!$rez_brisanje){
            $msg_add = "Error msql season.";
        } else {
            $msg_add = "Succesfully removed season!";
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

<!-- forma za brisanje -->

    <div class="col-xs-6 col-lg-6">
        <h2>Remove season</h2>
        <form action='?page=18' method="post"> 
            <select name='ddl-rm-season' class='form-control'>
                <option value='0'>Select season to delete:</option>
                <?php
                    $upit_prikaz = "SELECT * FROM kategorije";
                    $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                    while($d=mysqli_fetch_array($rez_prikaz)){
		              echo "<option value='{$d['id_kategorija']}'>{$d['naziv_kategorija']}</option>";
	                }
                    ?>                        
            </select>
            <button type="submit" name="btn-rm-season" class='btn btn-primary mb-2 form-control'>Remove</button>      
        </form> 
        <?php if(isset($msg_add)) echo $msg_add; ?>
    </div>
    
</div>