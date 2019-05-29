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
        $country_to_add = $_REQUEST['tb_add_country'];
        
        $upit_unos = "INSERT INTO drzave VALUES ('', '$country_to_add')";
        $rez_unos = mysqli_query($konekcija, $upit_unos);
        if(!$rez_unos){
            $msg_add = "Error msql country.";
        } else {
            $msg_add = "Succesfully added country!";
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

<!-- forma za dodavanje -->

    <div class="col-xs-6 col-lg-6">
        <h2>Add country</h2>
        <form action='?page=14' method="post"> 
            <input type='text' name='tb_add_country' id='tb_add_country' class='form-control' placeholder='Enter name'>
            <button type="submit" name="btn-add-country" class='btn btn-primary mb-2 form-control'>Add</button>      
        </form> 
        <?php if(isset($msg_add)) echo $msg_add; ?>
    </div>
    
</div>