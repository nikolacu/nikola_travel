<div class='row'>

<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

    // rad sa podacima
    
    // brisanje iz tabele
            
    if(isset($_REQUEST['btn-delete-article'])){
            
        $article_to_del = $_REQUEST['ddl-rm-article'];
            
        $upitBrisanje = "DELETE FROM article WHERE id_article='$article_to_del'";
        $rezBrisanje = mysqli_query($konekcija, $upitBrisanje);
        
        if($rezBrisanje) $msg_del = "Succesfully deleted.";
            else $msg_del = "Error.";
    }

    // tabeliarni prikaz svih destinacija

    $upit = "SELECT * FROM article";
	
	$rez = mysqli_query($konekcija, $upit);
	
	if(mysqli_num_rows($rez) == 0){
		$msg_del = "There are no articles.";
	} else {  ?>
        
            <div class='col-xs-6 col-lg-6'>
                <h2>All destinations</h2>
                <table class='table table-stripped table-hover table-sm'>
                        <tr>
                            <th>RB</th>
                            <th>ID</th>
                            <th>Title</th>
                        </tr>
                <?php $i = 1; 

                while($r = mysqli_fetch_array($rez)){
                    echo "<tr>
                            <td>$i</td>
                            <td>".$r['id_article']."</td>
                            <td>".$r['title']."</td>
                          </tr>";
                    $i++;
                }	?>	
                </table>
            </div>
        
       
    <!-- Gotova tabela -->
<?php 
           } 
?>

    <div class="col-xs-6 col-lg-6">
        <h2>Delete destination</h2>
        <form action='?page=11' method="post"> 
            <select name='ddl-rm-article' class='form-control'>
                <option value='0'>Select article to delete:</option>
                <?php
                    $upit_prikaz = "SELECT * FROM article";
                    $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);
                
                    while($d=mysqli_fetch_array($rez_prikaz)){
		              echo "<option value='{$d['id_article']}'>{$d['id_article']}</option>";
	                }
                    ?>                        
            </select>
            <button type="submit" name="btn-delete-article" class='btn btn-primary mb-2 form-control'>Delete</button>      
        </form> 
        <?php if(isset($msg_del)) echo $msg_del; ?>
    </div>
</div> <!-- div class='row' -->







