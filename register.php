<div class="container">
    
      <script type="text/javascript" src="reg.js"></script>

      <form class="form-signin" method="POST" action="?page=5">
        <h2 class="form-signin-heading">Please register</h2>
        <input type="name" id="inputUser" name='inputUsername' class="form-control" placeholder="Username" required autofocus>
        <input type="password" id="inputPassword" name='inputPassword' class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnSubmit" onClick="check();">Register</button>
      </form>

</div> <!-- /container -->

<?php
	if(isset($_POST['btnSubmit'])){
		$username = trim($_POST['inputUsername']);
        $pass = trim($_POST['inputPassword']);
        $passWrite = md5($pass);
        $uloga = 'user';
        
        $reg_username = "/^[A-Za-z0-9]{3,}$/";
        $reg_pass = "/^[A-Za-z0-9]{5,}$/";
        
        $greske = array();
        
        if(!preg_match($reg_username, $username))
		{
			$greske[] = "Username must be one word,can contain only letters and numbers and must be at least 3 characters long.";
        }
        
        if(!preg_match($reg_pass, $pass))
		{
			$greske[] = "Password can contain only letters and numbers and must be at least 6 characters long.";
        }
        
        if(count($greske)==0) {
            
            $upit_provera = "SELECT * FROM korisnici WHERE kor_ime = '$username'";
        
            $rez_provera = mysqli_query($konekcija, $upit_provera);
            if(mysqli_num_rows($rez_provera)==0){       
                
                $upit_upis = "INSERT INTO korisnici VALUES ('', '$username', '$passWrite', '$uloga')";
                $rez_upis = mysqli_query($konekcija, $upit_upis);
                
                if($rez_upis) {
					echo "You are successfully registered!"; 					
				}					
                
            } else echo "This username is already taken.";
            
        }
    }
     

?>