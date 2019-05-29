<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- obrada za brisanje -->

<?php

    if(isset($_REQUEST['btn-rm-country'])){
        $country_to_del = $_REQUEST['ddl-rm-country'];
        
        $upit_brisanje = "DELETE FROM drzave WHERE id_drzava = '$country_to_del'";
        $rez_brisanje = mysqli_query($konekcija, $upit_brisanje);
        if(!$rez_brisanje){
            $msg_add = "Error msql country.";
        } else {
            $msg_add = "Succesfully removed country!";
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

<!-- forma za brisanje -->

    <div class="col-xs-6 col-lg-6">
        <h2>Remove country</h2>
        <form action='?page=15' method="post"> 
            <select name='ddl-rm-country' class='form-control'>
                <option value='0'>Select country to delete:</option>
                <?php
                    $upit_prikaz = "SELECT * FROM drzave";
                    $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                    while($d=mysqli_fetch_array($rez_prikaz)){
		              echo "<option value='{$d['id_drzava']}'>{$d['naziv_drzava']}</option>";
	                }
                    ?>                        
            </select>
            <button type="submit" name="btn-rm-country" class='btn btn-primary mb-2 form-control'>Remove</button>      
        </form> 
        <?php if(isset($msg_add)) echo $msg_add; ?>
    </div>
    
</div>