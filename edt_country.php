<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- Izmena drzava -->

<?php

    if(isset($_REQUEST['btn-save-country'])){
        
            $idCountryToSave = $_REQUEST['tb_hidden'];
            $countryToSave = $_REQUEST['tb_country_to_change'];
       
            $upitCuvanje = "UPDATE drzave
                            SET naziv_drzava = '$countryToSave'
                            WHERE id_drzava = '$idCountryToSave'";
            $rezUpitCuvanje = mysqli_query($konekcija, $upitCuvanje);
            
            if(!$rezUpitCuvanje) $msg_edit_save = "Fail!"; 
                else $msg_edit_save = "Succesfuly edited."; 
    }

    if(isset($_POST['btn-edit-country'])){     
        
        $countryToEdit = $_POST['ddl-edit-country'];
        
        $upitPrikazZaIzmenu = "SELECT * FROM drzave WHERE id_drzava='$countryToEdit'";
        $rezPrikazZaIzmenu = mysqli_query($konekcija, $upitPrikazZaIzmenu);
        while($u=mysqli_fetch_array($rezPrikazZaIzmenu)){
            $zaPrikaz = "
                    <form action='?page=16' method='post'>
                    <input type='hidden' name='tb_hidden' value=".$u['id_drzava'].">
                    <input type='text' name='tb_country_to_change' value=".$u['naziv_drzava']." class='form-control'>
                    <button type='submit' name='btn-save-country' class='btn btn-primary mb-2 form-control'>Save</button>
                </form>";           
        }       
    }

?>

<!-- Prikaz drzava u tabeli -->

<?php

    $upit = "SELECT * FROM drzave";
	
	$rez = mysqli_query($konekcija, $upit);
	
	if(mysqli_num_rows($rez) == 0){
		echo "There are no countries.";
	} else {  ?>
        <div class='row'>
            <div class='col-xs-6 col-lg-6'>
                <h2>Countries</h2>
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
                            <td>".$r['id_drzava']."</td>
                            <td>".$r['naziv_drzava']."</td>
                          </tr>";
                    $i++;
                }	?>	
                </table>
            </div>
<?php } ?>
            
<!-- Gotova tabela -->
            
<!-- Izmena drzava -->        

    <div class="col-xs-6 col-lg-6">
        <h2>Edit countries</h2>
        <form action='?page=16' method="post"> 
            <select name='ddl-edit-country' class='form-control'>
                <option value='0'>Select country to edit:</option>
                <?php
                    $upit_prikaz = "SELECT * FROM drzave";
                    $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                    while($r=mysqli_fetch_array($rez_prikaz)){
		              echo "<option value='{$r['id_drzava']}'>{$r['naziv_drzava']}</option>";
	               }
                ?>                        
            </select>
            <button type="submit" name="btn-edit-country" class='btn btn-primary mb-2 form-control'>Edit</button><br/>                 
            <?php  if(isset($zaPrikaz)) echo $zaPrikaz;  ?>
        </form>
        <?php if(isset($msg_edit_save)) echo $msg_edit_save; ?>
                
    </div><!--/.col-xs-6.col-lg-4--> 
</div>