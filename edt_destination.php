

<?php
    
    // Zastita stranice
	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

?>

<!-- obrada -->

<?php

    if(isset($_REQUEST['btn_save_article'])){
        
        $id_za_promenu = $_REQUEST['tb_hidden'];  
        
        // nove vrednosti
        
        $title_new = $_REQUEST['tb_new_title'];
        $text_new = $_REQUEST['ta_new_text'];
        
        $pic_new_name = $_FILES['new_pic']['name'];
        $pic_new_tmp = $_FILES['new_pic']['tmp_name'];
        $pic_new_loc = 'img/'.$pic_new_name;
        
        $category_new = $_REQUEST['ddl_new_category'];
        $country_new = $_REQUEST['ddl_new_country'];
        
        // title
        
        if($title_new) {
            $upit_naslov = "UPDATE article SET title = '$title_new' WHERE id_article = '$id_za_promenu'";
            $rez_naslov = mysqli_query($konekcija, $upit_naslov);
            if(!$rez_naslov) echo "Error with title.";
                else echo "Succesfully changed title!<br/>";
        } else {
            // Prazno zbog upisa u tabelu. Da se ne upise prazan string
            // ukoliko nista nije upisano u polje za naslov.
            // Ponavljace se svuda.
        }
        
        // text
        
        if($text_new) {
            $upit_text = "UPDATE article SET text = '$text_new' WHERE id_article = '$id_za_promenu'";
            $rez_text = mysqli_query($konekcija, $upit_text);
            if(!$rez_text) echo "Error with text.";
                else echo "Succesfully changed text! <br/>";
        } else {}
        
        // image
        
        if($pic_new_tmp){
            if(move_uploaded_file($pic_new_tmp, $pic_new_loc)){
                $upit_slika = "UPDATE article SET picture = '$pic_new_loc' WHERE id_article = '$id_za_promenu'";
                $rez_slika = mysqli_query($konekcija, $upit_slika);

                if($rez_slika){
                    echo "Succesfylly changed picture! <br/>";
                } else{
                    echo "Error with mysql.";
                }
            } else {
                    echo "Error with picture.";
            }
        } else {}
        
        // category
        
        if($category_new){
            $upit_kategorija = "UPDATE article SET id_kategorija = '$category_new' WHERE id_article = '$id_za_promenu'";
            $rez_kategorija = mysqli_query($konekcija, $upit_kategorija);
            if(!$rez_kategorija) echo "Error with category.";
                else echo "Succesfully changed category! <br/>";
        } else {}
    
        // country 
        
        if($country_new){
            $upit_drzava = "UPDATE article SET id_drzava = '$country_new' WHERE id_article = '$id_za_promenu'";
            $rez_drzava = mysqli_query($konekcija, $upit_drzava);
            if(!$rez_drzava) echo "Error with category.";
                else echo "Succesfully changed country! <br/>";
        } else {}
    }

?>



<!-- dohvatanje trenutnih vrednosti -->

<?php

    if(isset($_POST['btn-edit-article'])){
        
        $articleToEdit = $_POST['ddl-edit-article'];
        
        // upit kategorija
        
        $upit_kategorije = "SELECT * FROM article a INNER JOIN kategorije k ON a.id_kategorija = k.id_kategorija";
        $rez_kategorije = mysqli_query($konekcija, $upit_kategorije);
        if($rez_kategorije){
            while($m=mysqli_fetch_array($rez_kategorije)){
                $kategorija_prikaz = $m['naziv_kategorija'];
            }
            
        } else { echo "Error mysql categories."; }
        
        // upit drzava
        
        $upit_drzave = "SELECT * FROM article a INNER JOIN drzave d ON a.id_drzava = d.id_drzava";
        $rez_drzave = mysqli_query($konekcija, $upit_drzave);
        if($rez_drzave){
            while($b=mysqli_fetch_array($rez_drzave)){
                $drzava_prikaz = $b['naziv_drzava'];
            }
            
        } else { echo "Error mysql countries."; }
        
        // kod za obradu
        
        $upitPrikazZaIzmenu = "SELECT * FROM article WHERE id_article='$articleToEdit'";
        $rezPrikazZaIzmenu = mysqli_query($konekcija, $upitPrikazZaIzmenu);
        while($u=mysqli_fetch_array($rezPrikazZaIzmenu)){
            $id_promena = "<input type='hidden' name='tb_hidden' value={$u['id_article']}>";
            
            $current_data = 
                "   <form action='?page=12' method='post'>                    
                    <h3>Current values</h3>
                    <!-- current title -->
                    <div class='form-group row'>
                    <label for='tb_title' class='col-sm-2 col-form-label'>Title</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' id='tb_title' name='tb_title' value='".$u['title']."' readonly>
                            <input type='hidden' name='tb_hidden_title' value={$u['id_article']} class='form-control'><br/>
                        </div>
                    </div>
        
                    <!-- current text -->
                    <div class='form-group row'>
                        <label for='tb_text' class='col-sm-2 col-form-label'>Text</label>
                        <div class='col-sm-10'>
                            <textarea class='form-control' id='ta_text' name='ta_text' value='".$u['text']."' readonly rows='7'>{$u['text']}</textarea>
                        </div>
                    </div>
                    
                    <!-- current picture -->
                    <div class='form-group row'>
                        <label for='current_pic' class='col-sm-2 col-form-label'>Picture</label>
                        <div class='col-sm-10'>
                            <img class='featurette-image img-responsive center-block' src='".$u['picture']."' alt='".$u['title']."' title='".$u['title']."' id='current_pic' name='current_pic'>
                        </div>
                    </div>
                    
                    <!-- current category -->
                    
                    <div class = 'form-group row'>
                        <label for='cur_cat' class='col-sm-2 col-form-label'>Category</label>
                        <div class='col-sm-10'>
                            <input type='text' name='tb_cur_cat' id='tb_cur_cat' class='form-control' readonly value={$kategorija_prikaz}>
                        </div>
                    </div>
                    
                    <!-- current country -->
                    <div class='form-group row'>
                        <label for='ddl_country' class='col-sm-2 col-form-label'>Country</label>
                        <div class='col-sm-10'>
                            <input type='text' name='tb_cur_country' id='tb_cur_country' class='form-control' readonly value={$drzava_prikaz}>
                        </div>
                    </div>    
                </form>";
            
        }  
    }

?>

<!-- Izmena artikala --> 

<div class='row'>
    <div class="col-xs-6 col-lg-12">
        <h2>Edit destination</h2>
        <form action='?page=12' method="post"> 
            <select name='ddl-edit-article' class='form-control'>
                <option value='0'>Select destination to edit:</option>
                <?php
                    $upit_prikaz = "SELECT * FROM article";
                    $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);

                    while($r=mysqli_fetch_array($rez_prikaz)){
                      echo "<option value='{$r['id_article']}'>{$r['title']}</option>";
                   }
                ?>                        
            </select>
            <button type="submit" name="btn-edit-article" class='btn btn-primary mb-2 form-control'>Edit</button><br/>                 
        </form>
    </div><!--/.col-xs-6.col-lg-12-->
    
    <!-- current values -->

    <div class='col-xs-6 col-lg-6'>
        <?php  if(isset($current_data)) echo $current_data;  ?>
        <?php if(isset($msg_edit_save)) echo $msg_edit_save; ?>
    </div>    
    
    <!-- new values -->
    
    <?php if(isset($_REQUEST['btn-edit-article'])) { ?>
    <div class='col-xs-6 col-lg-6'>
        <form action='?page=12' method='post' enctype='multipart/form-data'>
        <!--    <input type='hidden' name='tb_hidden' value=".$u['id_article']." class='form-control'><br/> -->
            <?php if(isset($id_promena)) echo $id_promena; ?>        
            <h3>New values</h3>
            
            <!-- new title -->
            
            <div class='form-group row'>
                <label for='tb_new_title' class='col-sm-2 col-form-label'>Title</label>
                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='tb_new_title' name='tb_new_title'>
                </div>
            </div>
        
            <!-- new text -->
            
            <div class='form-group row'>
                <label for='tb_new_text' class='col-sm-2 col-form-label'>Text</label>
                <div class='col-sm-10'>
                    <textarea class='form-control' id='ta_new_text' name='ta_new_text' rows='7'></textarea>
                </div>
            </div>
                    
            <!-- new picture -->
            
            <div class='form-group row'>
            <label for='new_pic' class='col-sm-2 col-form-label'>Picture</label>
                <div class='col-sm-10'>
                    <input type='file' class='form-control-file' name='new_pic' id='new_pic'>
                </div>
            </div>
                    
            <!-- new category -->
                    
            <div class='form-group row'>
                <label for='ddl_category' class='col-sm-2 col-form-label'>Category</label>
                <div class='col-sm-10'>
                    <select name='ddl_new_category' id='ddl_category' class='form-control'>
                        <option value="0">Choose...</option>
                            <?php 
                                $upit_kategorija = "SELECT * FROM kategorije";
                                $rez_kategorija = mysqli_query($konekcija, $upit_kategorija);
                                while($k=mysqli_fetch_array($rez_kategorija)){
                                    echo "<option value='{$k['id_kategorija']}'>{$k['naziv_kategorija']}</option>";
                                }
                            ?>
                    </select>
                </div>
            </div>
                    
            <!-- new country -->
            
            <div class='form-group row'>
            <label for='ddl_country' class='col-sm-2 col-form-label'>Country</label>
                <div class='col-sm-10'>
                    <select name='ddl_new_country' id='ddl_country' class='form-control'>
                        <option value="0">Choose...</option>
                            <?php 
                                $upit_drzava = "SELECT * FROM drzave";
                                $rez_drzava = mysqli_query($konekcija, $upit_drzava);
                                while($d=mysqli_fetch_array($rez_drzava)){
                                    echo "<option value='{$d['id_drzava']}'>{$d['naziv_drzava']}</option>";
                                }
                            ?>
                    </select>
                </div>
            </div>
        
            <!-- dugme -->
            
            <div class='form-group row'>
                <div class='col-sm-12'>
                    <button type='submit' class='btn btn-primary mb-2 form-control' name='btn_save_article'>Save</button>
                </div>
            </div>
        </form>
    </div>
    <?php } ?>
    
</div><!-- /.row -->