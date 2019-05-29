<?php

    // Zastita stranice

	if($_SESSION['uloga'] != 'admin')
	{
		header('Location:index.php');
	}

    //obrada podataka

    if(isset($_REQUEST['btn_add_article'])){
        $title = $_REQUEST['tb_title'];
        $text = $_REQUEST['ta_text'];
        
        $pic_name = $_FILES['pic']['name'];
        $pic_tmp = $_FILES['pic']['tmp_name'];
        $pic_loc = 'img/'.$pic_name;
        
        $category = $_REQUEST['ddl_category'];
        $country = $_REQUEST['ddl_country'];
        
        if($title && $text && $pic_name && $category && $country){
            if(move_uploaded_file($pic_tmp, $pic_loc)){
                $upit_upis = "INSERT INTO article VALUES ('', '$title', '$pic_loc', '$text', '$category', '$country')";
                $rez_upis = mysqli_query($konekcija, $upit_upis);

                if($rez_upis){
                    $msg_add = "Succesfylly added destination!";
                } else{
                    $msg_add = "Error with mysql.";
                }
            } else {
                    $msg_add = "Error with picture.";
            }
        } else $msg_add = "You must complete all tasks.";
        
            
    }

?>

<div class="container">
    <form  method="POST" action="?page=10" enctype="multipart/form-data">
        
        <h2 class="form-signin-heading">Add new destination</h2>
        
        <!-- title -->
        <div class="form-group row">
            <label for="tb_title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="tb_title" name="tb_title" placeholder="Title" >
            </div>
        </div>
        
        <!-- text -->
        <div class="form-group row">
            <label for="tb_text" class="col-sm-2 col-form-label">Text</label>
            <div class="col-sm-5">
                <textarea class="form-control" id="ta_text" name="ta_text" placeholder="Text" rows="7"></textarea>
            </div>
        </div>
        
        <!-- picture -->
        <div class='form-group row'>
            <label for="pic" class="col-sm-2 col-form-label">Picture (500x500)</label>
            <div class="col-sm-5">
                <input type="file" class="form-control-file" id="pic" name="pic">
            </div>
        </div>
        
        <!-- kategorije -->
        <div class="form-group row">
            <label for="ddl_category" class="col-sm-2 col-form-label">Category</label>
            <div class='col-sm-5'>
                <select name='ddl_category' id='ddl_category' class='form-control'>
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
        
        <!-- drzave -->
        <div class="form-group row">
            <label for="ddl_country" class="col-sm-2 col-form-label">Country</label>
            <div class='col-sm-5'>
                <select name='ddl_country' id='ddl_country' class='form-control'>
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
        <div class="form-group row">
            <div class='col-sm-2'><!-- prazan div zbog izgleda --></div>
            <div class='col-sm-5'>
                <button type="submit" class="btn btn-primary mb-2" name='btn_add_article'>Add</button>
            </div>
        </div>
    </form>
    
    <?php if(isset($msg_add)) echo "$msg_add"; ?>
</div>

