<?php

    // Zastita stranice

	if(!isset($_SESSION['korIme']))
	{
		header('Location:index.php');
	}

?>

<?php

    if(isset($_REQUEST['btn_survey'])){
        
        $korisnik = $_SESSION['korIme'];
        $idAnketa = $_REQUEST['tb_hidden'];
        
        // nalazenje ID-a ulogovanog korisnika
        
        $upit_korisnik = "SELECT * FROM korisnici WHERE kor_ime = '$korisnik' ";
        $rez_korisnik = mysqli_query($konekcija, $upit_korisnik);
        if($rez_korisnik){
            while($k=mysqli_fetch_array($rez_korisnik)){
                $id_kor = $k['id_korisnika'];
            }
        } else { echo "Greksa upit."; }
        
        // prikupljanje odgovora
        
        $answer1 = $_REQUEST['tb_question1'];
        $answer2 = $_REQUEST['ddl_question2'];
        $answer3 = $_REQUEST['ddl_question3'];
        $answer4 = $_REQUEST['ddl_question4'];
        
        // provera i upis
        
        $upit_provera = "SELECT * FROM odgovori WHERE id_korisnik = '$id_kor'";
        $rez_provera = mysqli_query($konekcija, $upit_provera);
        if(mysqli_num_rows($rez_provera)==0){
        
            $upit_upis = "INSERT INTO odgovori VALUES ('', '$id_kor', '$idAnketa', '$answer1', '$answer2', '$answer3', '$answer4')";
            $rez_upis = mysqli_query($konekcija, $upit_upis);
            if($rez_upis){
                $msg_survey = "Thank you!";
            } else { $msg_survey = "Error mysql for insert"; }
        
        } else { $msg_survey = "You have already completed survey."; }  
    }

?>

<div class='row'>
    
    <form action='?page=20' method='post'>
        <h2>Please, complete this short survey</h2>
        
        <?php
        
            $upit_tabela = 'SELECT * FROM anketa';
            $rez_anketa = mysqli_query($konekcija, $upit_tabela);
        
            if($rez_anketa){
                
                
                echo "";
                
                while($a=mysqli_fetch_array($rez_anketa)){
                    
                    echo "<div class='form-group row'>
                          <input type='hidden' value={$a['id_anketa']} name='tb_hidden'>
                          <label for='tb_question1' class='col-sm-4 col-form-label'>{$a['q1']}</label>
                            <div class='col-sm-6'>
                                <input type='text' class='form-control' id='tb_question1' name='tb_question1' placeholder='friend / internet / school / work...' >
                            </div>
                          </div>
                    
                          <div class='form-group row'>                    
                            <label for='ddl_question2' class='col-sm-4 col-form-label'>{$a['q2']}</label>
                            <div class='col-sm-6'>
                                <select name='ddl_question2' class='form-control'>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </div>
                           </div>
                           
                           <div class='form-group row'>                    
                            <label for='ddl_question3' class='col-sm-4 col-form-label'>{$a['q3']}</label>
                            <div class='col-sm-6'>
                                <select name='ddl_question3' class='form-control'>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </div>
                           </div>
                           
                           <div class='form-group row'>                    
                            <label for='ddl_question4' class='col-sm-4 col-form-label'>{$a['q4']}</label>
                            <div class='col-sm-6'>
                                <select name='ddl_question4' class='form-control'>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </div>
                           </div>
                           
                           <div class='form-group row'>
                             <div class='col-sm-4 col-form-label'></div>
                             <div class='col-sm-6'>
                               <button type='submit' name='btn_survey' class='btn btn-primary mb-2 form-control'>Submit</button>
                             </div>
                           </div>'";
                    
                }
            }
        
        ?>
        
    </form> 
    
    <?php if(isset($msg_survey)) echo $msg_survey; ?>
    
<?php    
    
    // tabelarni prikaz podataka ankete
    
    if($_SESSION['uloga'] == 'admin'){     
        
        $upit_anketa = "SELECT * FROM anketa";
        $rez_anketa = mysqli_query($konekcija, $upit_anketa);
        if($rez_anketa){           
            while($r = mysqli_fetch_array($rez_anketa)){
                $q1 = $r['q1'];
                $q2 = $r['q2'];
                $q3 = $r['q3'];
                $q4 = $r['q4'];
            }
            
        $upit_odg = "SELECT * FROM odgovori";
        $rez_odg = mysqli_query($konekcija, $upit_odg); ?>  
                <div class='row'>
                    <div class='col-xs-6 col-lg-12'>
                      <h2>Completed survey</h2>
                      <table class='table table-stripped table-hover table-sm'>
                        <tr>
                            <th>RB</th>
                            <th>ID answer</th>
                            <th>ID user</th>
                            <th><?php echo $q1; ?></th>
                            <th><?php echo $q2; ?></th>
                            <th><?php echo $q3; ?></th>
                            <th><?php echo $q4; ?></th>
                        </tr>
                     <?php  $i = 1;  
                        while($o = mysqli_fetch_array($rez_odg)){
                        echo "<tr>
                                <td>$i</td>
                                <td>{$o['id_odgovor']}</td>
                                <td>{$o['id_korisnik']}</td>
                                
                                <th>{$o['a1']}</th>
                                <th>{$o['a2']}</th>
                                <th>{$o['a3']}</th>
                                <th>{$o['a4']}</th>
                              </tr>";
                        $i++;
                    }	?>
                    </table>
                  </div>
                </div>
    <?php        }
            
    } ?>
</div>