<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- Izmena kategorija -->

<?php

    if(isset($_REQUEST['btn-save-season'])){
        
            $idSeasonToSave = $_REQUEST['tb_hidden'];
            $seasonToSave = $_REQUEST['tb_season_to_change'];
       
            $upitCuvanje = "UPDATE kategorije
                            SET naziv_kategorija = '$seasonToSave'
                            WHERE id_kategorija = '$idSeasonToSave'";
            $rezUpitCuvanje = mysqli_query($konekcija, $upitCuvanje);
            
            if(!$rezUpitCuvanje) $msg_edit_save = "Fail!"; 
                else $msg_edit_save = "Succesfuly edited."; 
    }

    if(isset($_POST['btn-edit-season'])){     
        
        $seasonToEdit = $_POST['ddl-edit-season'];
        
        $upitPrikazZaIzmenu = "SELECT * FROM kategorije WHERE id_kategorija='$seasonToEdit'";
        $rezPrikazZaIzmenu = mysqli_query($konekcija, $upitPrikazZaIzmenu);
        while($u=mysqli_fetch_array($rezPrikazZaIzmenu)){
            $zaPrikaz = "
                    <form action='?page=19' method='post'>
                    <input type='hidden' name='tb_hidden' value=".$u['id_kategorija'].">
                    <input type='text' name='tb_season_to_change' value=".$u['naziv_kategorija']." class='form-control'>
                    <button type='submit' name='btn-save-season' class='btn btn-primary mb-2 form-control'>Save</button>
                </form>";           
        }       
    }

?>

<!-- Prikaz kategorija u tabeli -->

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
            
<!-- Izmena kategorija -->        

    <div class="col-xs-6 col-lg-6">
        <h2>Edit seasons</h2>
        <form action='?page=19' method="post"> 
            <select name='ddl-edit-season' class='form-control'>
                <option value='0'>Select season to edit:</option>
                <?php
                    $upit_prikaz = "SELECT * FROM kategorije";
                    $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                    while($r=mysqli_fetch_array($rez_prikaz)){
		              echo "<option value='{$r['id_kategorija']}'>{$r['naziv_kategorija']}</option>";
	               }
                ?>                        
            </select>
            <button type="submit" name="btn-edit-season" class='btn btn-primary mb-2 form-control'>Edit</button><br/>                 
            <?php  if(isset($zaPrikaz)) echo $zaPrikaz;  ?>
        </form>
        <?php if(isset($msg_edit_save)) echo $msg_edit_save; ?>
                
    </div><!--/.col-xs-6.col-lg-4--> 
</div>