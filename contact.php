<?php

    if(isset($_REQUEST['btn_contact'])){
        
        $title = $_REQUEST['tb_title'];
        $message = $_REQUEST['ta_message'];
        
        if($title != '' && $message != ''){
        
            if(isset($_SESSION['korIme'])){            
                $username = $_SESSION['korIme'];
                $upit_poruka = "INSERT INTO poruka VALUES ('', '$username', '$title', '$message')";
                $rez_poruka = mysqli_query($konekcija, $upit_poruka);
                if($rez_poruka) { $msg_contact = 'Thank you!'; }
                    else { $msg_contact = 'Error1.'; }
            } else {
                $upit_poruka = "INSERT INTO poruka VALUES ('', 'not_registered', '$title', '$message')";
                $rez_poruka = mysqli_query($konekcija, $upit_poruka);
                if($rez_poruka) { $msg_contact = 'Thank you!'; }
                    else { $msg_contact = 'Error2.'; }
            }
        } else { $msg_contact = 'Please, fill all fields.'; }
    }


?>



<div class="container">
    <form  method="POST" action="?page=3">
        
        <h2 class="form-signin-heading">Contact us if you have some questions or suggestions</h2>
        
        <!-- title -->
        <div class="form-group row">
            <label for="tb_title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="tb_title" name="tb_title" placeholder="Title" >
            </div>
        </div>
        
        <!-- message -->
        <div class="form-group row">
            <label for="ta_message" class="col-sm-2 col-form-label">Message</label>
            <div class="col-sm-5">
                <textarea class="form-control" id="ta_message" name="ta_message" placeholder="Message" rows="7"></textarea>
            </div>
        </div>
        
        <!-- dugme -->
        <div class="form-group row">
            <div class='col-sm-2'><!-- prazan div zbog izgleda --></div>
            <div class='col-sm-5'>
                <button type="submit" class="btn btn-primary mb-2 form-control" name='btn_contact'>Send</button>
                <?php if(isset($msg_contact)) echo $msg_contact; ?>
            </div>
        </div>
        
    </form>
    
</div>