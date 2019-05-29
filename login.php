<?php


    if(isset($_POST['btnSubmit'])){
        
        $username = trim($_POST['inputUsername']);
        $pass = trim(md5($_POST['inputPassword']));
        
        $upit = "SELECT * FROM korisnici WHERE kor_ime = '$username' AND lozinka='$pass'";
        
        $rez = mysqli_query($konekcija, $upit);
        if(mysqli_num_rows($rez)==0){
            $login_error = "Please check your username or password.";
		}
		else {
			$r = mysqli_fetch_array($rez);
			
			$_SESSION['uloga'] = $r['uloga'];			
			$_SESSION['korIme'] = $r['kor_ime'];
            $_SESSION['id'] = $r['id_korisnika'];
            
            header('Location: index.php');
            }
        }  
        
        
?>


          <div class="container">

      <form class="form-signin" method="POST" action="?page=4">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="name" id="inputUsername"  name="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnSubmit">Sign in</button>
        <?php
        
          if(isset($login_error)){
              echo $login_error;
          }
          
        ?>
      </form>

           </div> <!-- /container -->