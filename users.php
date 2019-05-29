<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}
?>


<?php 
    // Brisanje korisnika

    if(isset($_POST['btn-delete-user'])){                    
        $userToDelete = $_POST['ddl-rm-user'];
        $upitBrisanje = "DELETE FROM korisnici WHERE id_korisnika='$userToDelete'";
        $rezBrisanje = mysqli_query($konekcija, $upitBrisanje);
        
        if($rezBrisanje) $msg_del = "Succesfully deleted.";
            else $msg_del = "Error.";
    }

    //Dodavanje korisnika

    if(isset($_REQUEST['btn-insert-user'])){
        $username_insert = trim($_REQUEST['tb_insert_name']);
        $pass_insert = trim($_REQUEST['tb_insert_pass']);
        $passToWrite = md5($pass_insert);
        $role_insert = $_REQUEST['ddl_insert_user'];
        
        $reg_username = "/^[A-Za-z0-9]{3,}$/";
        $reg_pass = "/^[A-Za-z0-9]{5,}$/";
        
        $greske = array();
        
        if(!preg_match($reg_username, $username_insert))
		{
			$greske[] = "Username must be one word,can contain only letters and numbers and must be at least 3 characters long.";
        }
        
        if(!preg_match($reg_pass, $pass_insert))
		{
			$greske[] = "Password can contain only letters and numbers and must be at least 6 characters long.";
        }
        
        if(!$role_insert){
            $greske[] = "You must choose role.";
        }
        
        if(count($greske)==0){
            $upit_provera = "SELECT * FROM korisnici WHERE kor_ime = '$username_insert'";        
            $rez_provera = mysqli_query($konekcija, $upit_provera);
            if(mysqli_num_rows($rez_provera)==0){                
                $upit_upis = "INSERT INTO korisnici VALUES ('', '$username_insert', '$passToWrite', '$role_insert')";
                $rez_upis = mysqli_query($konekcija, $upit_upis);                
                if($rez_upis){                    
                    $msg_add = "Succesfully added user.";                    
                } else {               
                    $msg_add = "This user already exists.";                
                } 
            }   
        } else {
              echo "<ul>";
              foreach($greske as $g){
                  echo "<li>".$g."</li>";
              }
              echo "</ul>"; 
        }
    }

    // Izmena korisnika

    if(isset($_REQUEST['btn-save-user'])){
            $idUserToSave = $_REQUEST['tb_hidden'];
            $userToSave = $_REQUEST['tb_user_to_change'];
            $roleToSave = $_REQUEST['ddl_role_to_change'];
        
            if($roleToSave){
       
            $upitCuvanje = "UPDATE korisnici
                            SET kor_ime = '$userToSave', uloga = '$roleToSave'
                            WHERE id_korisnika = '$idUserToSave'";
            $rezUpitCuvanje = mysqli_query($konekcija, $upitCuvanje);
            
            if(!$rezUpitCuvanje) $msg_edit_save = "Fail!"; 
                else $msg_edit_save = "Succesfuly edited.";
            } else $msg_edit_save = "You must choose role.";
    }

    if(isset($_POST['btn-edit-user'])){                    
        $userToEdit = $_POST['ddl-edit-user'];
        
        $upitPrikazZaIzmenu = "SELECT * FROM korisnici WHERE id_korisnika='$userToEdit'";
        $rezPrikazZaIzmenu = mysqli_query($konekcija, $upitPrikazZaIzmenu);
        while($u=mysqli_fetch_array($rezPrikazZaIzmenu)){
            $zaPrikaz = 
                "<form action='?page=9' method='post'>
                    <input type='hidden' name='tb_hidden' value=".$u['id_korisnika']." class='form-control'><br/>
                    <input type='text' name='tb_user_to_change' value=".$u['kor_ime']." class='form-control'>
                    <select name='ddl_role_to_change' class='form-control'>
                        <option value='0'>Select role</option>
                        <option value='admin'>Admin</option>  
                        <option value='user'>User</option> 
                    </select>
                    <button type='submit' name='btn-save-user' class='btn btn-primary mb-2 form-control'>Save</button>
                </form>";           
        }       
    }

    

    // Prikaz korisnika u tabeli

    $upit = "SELECT * FROM korisnici";
	
	$rez = mysqli_query($konekcija, $upit);
	
	if(mysqli_num_rows($rez) == 0){
		echo "There are no registered users.";
	} else {  ?>
        <div class='row'>
            <div class='col-xs-6 col-lg-6'>
                <h2>Registered users</h2>
                <table class='table table-stripped table-hover table-sm'>
                        <tr>
                            <th>RB</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                <?php $i = 1; 

                while($r = mysqli_fetch_array($rez)){
                    echo "<tr>
                            <td>$i</td>
                            <td>".$r['id_korisnika']."</td>
                            <td>".$r['kor_ime']."</td>
                            <td>".$r['uloga']."</td>
                          </tr>";
                    $i++;
                }	?>	
                </table>
            </div>
            
    <!-- Gotova tabela -->
            
    <!-- Izmena korisnika -->        

            <div class="col-xs-6 col-lg-6">
                <h2>Edit users</h2>
                <form action='?page=9' method="post"> 
                    <select name='ddl-edit-user' class='form-control'>
                        <option value='0'>Select ID user to edit:</option>
                        <?php
                            $upit_prikaz = "SELECT * FROM korisnici";
                            $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                            while($r=mysqli_fetch_array($rez_prikaz)){
		                      echo "<option value='{$r['id_korisnika']}'>{$r['id_korisnika']}</option>";
	                       }
                        ?>                        
                    </select>
                    <button type="submit" name="btn-edit-user" class='btn btn-primary mb-2 form-control'>Edit</button><br/>                 
                    <?php  if(isset($zaPrikaz)) echo $zaPrikaz;  ?>
                </form>
                <?php if(isset($msg_edit_save)) echo $msg_edit_save; ?>
                
            </div><!--/.col-xs-6.col-lg-4--> 
            
     <!-- Brisanje i dodavanje korisnika; php se nalazi na vrhu stranice. -->        
            
            <div class="col-xs-6 col-lg-6">
                <h2>Delete users</h2>
                <form action='?page=9' method="post"> 
                    <select name='ddl-rm-user' class='form-control'>
                        <option value='0'>Select user to delete:</option>
                        <?php
                            $upit_prikaz = "SELECT * FROM korisnici";
                            $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                            while($r=mysqli_fetch_array($rez_prikaz))
	                       {
		                      echo "<option value='{$r['id_korisnika']}'>{$r['id_korisnika']}</option>";
	                       }
                        ?>                        
                    </select>
                    <button type="submit" name="btn-delete-user" class='btn btn-primary mb-2 form-control'>Delete</button>      
                </form> 
                <?php if(isset($msg_del)) echo $msg_del; ?>
                <h2>Add user</h2>
                <form action='?page=9' method="post"> 
                    <input type="text" name="tb_insert_name" placeholder="Enter username" class='form-control' />
                    <input type="password" name="tb_insert_pass" placeholder="Enter password" class='form-control' />
                    <select name='ddl_insert_user' class='form-control'>
                        <option value='0'>Select role</option>
                        <option value='admin'>Admin</option>  
                        <option value='user'>User</option> 
                    </select>
                    <button type="reset" class='btn btn-primary mb-2 form-control'>Reset</button>
                    <button type="submit" name="btn-insert-user" class='btn btn-primary mb-2 form-control'>Insert</button>      
                </form>
                <?php if(isset($msg_add)) echo $msg_add; ?>
            </div><!--/.col-xs-6.col-lg-4-->

        </div>

	<?php } 

?>