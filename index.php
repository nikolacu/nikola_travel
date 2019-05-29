<?php
 @session_start();
 include('konekcija.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-89673883-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-89673883-2');
	</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="No.1 world travel agecy! Travel anywhere with us">
    <meta name="author" content="Nikola Curcic">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
    <title>Travel agency</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
      <link href="css/lightbox.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?page=1">Travel agency</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <?php
                $upit_meni = "SELECT * FROM putanjedostranica WHERE id_putanja <= 3";
                $rez_meni = mysqli_query($konekcija, $upit_meni);
                while($m=mysqli_fetch_array($rez_meni)){
                    echo "<li><a href='?page={$m['id_putanja']}'>{$m['naziv']}</a></li>";
                } ?>               
            </ul>
              
                
            
              
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Show menu</button>
          </p>
          <div class="jumbotron" id="bg">
            <h1>Travel agency</h1>
            <p>Let us show you the world!</p>
          </div>
            
            <!-- content -->
            
            <?php
            
            $stage = @$_GET['page'];
            
            switch($stage){
                case '1':
                    include('home.php');
                    break;
                    
                case '2':
                    include('about.php');
                    break;
                    
                case '3':
                    include('contact.php');
                    break;
                    
                case '4':
                    include('login.php');
                    break;
                    
                case '5':
                    include('register.php');
                    break;
                    
                case '6':
                    include('author.php');
                    break;
                    
                case '7':
                    include('documentation.php');
                    break;
                    
                case '8':
                    include('logout.php');
                    break;
                    
                case '9':
                    include('users.php');
                    break;
                    
                case '10':
                    include('new_destination.php');
                    break;
                
                case '11':
                    include('del_destination.php');
                    break;
                    
                case '12':
                    include('edt_destination.php');
                    break;
                    
                case '13':
                    include('destinations.php');
                    break;
                    
                case '14':
                    include('country.php');
                    break;
                    
                case '15':
                    include('rm_country.php');
                    break;
                    
                case '16':
                    include('edt_country.php');
                    break;
                    
                case '17':
                    include('new_season.php');
                    break;
                    
                case '18':
                    include('rm_season.php');
                    break;
                    
                case '19':
                    include('edt_season.php');
                    break;
                    
                case '20':
                    include('survey.php');
                    break;
                    
                case '21':
                    include('message.php');
                    break;
                    
                default:
                   header('Location: index.php?page=1');
                    break;
                                
            }?>          
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <?php
            
              if(isset($_SESSION['korIme'])){
                  echo "<p class='list-group-item active'>Hello ".$_SESSION['korIme']."</p>
                        <a href='?page=8' class='list-group-item'>Logout</a><br/>
                        <a href='?page=20' class='list-group-item'>Survey</a><br/>";
                  
                  if($_SESSION['uloga']=='admin'){
                      
                      echo "<a href='?page=21' class='list-group-item'>Messages</a><br/>
                      <a href='?page=9' class='list-group-item'>Users</a><br/>
                      <a href='?page=13' class='list-group-item'>Destination</a>
                      <a href='?page=10' class='list-group-item'>Add destination</a>
                      <a href='?page=11' class='list-group-item'>Remove destination</a>
                      <a href='?page=12' class='list-group-item'>Edit destination</a><br/>
                      <a href='?page=14' class='list-group-item'>Add country</a>
                      <a href='?page=15' class='list-group-item'>Remove country</a>
                      <a href='?page=16' class='list-group-item'>Edit country</a><br/>
                      <a href='?page=17' class='list-group-item'>Add season</a>
                      <a href='?page=18' class='list-group-item'>Remove season</a>
                      <a href='?page=19' class='list-group-item'>Edit season</a><br/>";
                  }
              } else {
                  echo "<p class='list-group-item active'>You're not logged in.</p>
                        <p class='list-group-item'><a href='?page=4' class='navbar-toggler-right'>Login</a></p>
                        <p class='list-group-item'><a href='?page=5' class='navbar-toggler-right'>Register</a></p><br/>";
              }
              
            ?>
            
            <form action='?page=1' method="post">
                
                <p class='list-group-item'>Choose filter:</p>
                
                <select class='form-control' name='ddl_season'> 
                    <option value='0'>Choose season</option>           
                    <?php            
                     $upit_kategorije = "SELECT * FROM kategorije";
                     $rez_kategorije = mysqli_query ($konekcija, $upit_kategorije);

                     if($rez_kategorije){
                         while($k=mysqli_fetch_array($rez_kategorije)){
                                 echo "<option value='{$k['id_kategorija']}'>{$k['naziv_kategorija']}</option>";                     
                             }
                     } else {
                         echo "Error season.";
                     }
                    echo "<br/>";              
                    ?>
                </select>
                
                <select class='form-control' name='ddl_country'>
                    <option value='0'>Choose country</option>
                        <?php            
                         $upit_drzave = "SELECT * FROM drzave";
                         $rez_drzave = mysqli_query ($konekcija, $upit_drzave);

                         if($rez_drzave){
                             while($d=mysqli_fetch_array($rez_drzave)){
                                 echo "<option value='{$d['id_drzava']}'>{$d['naziv_drzava']}</option>";                     
                             }
                         } else {
                             echo "Error countries.";
                         }             
                        ?>                
                </select>

                
                <button type="submit" class="btn btn-primary mb-2 form-control" name="btn_filter">Apply</button>
                
            </form>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer>
          <?php
            
            $upit_meni = "SELECT * FROM putanjedostranica WHERE id_putanja <= 6";
                $rez_meni = mysqli_query($konekcija, $upit_meni);
                while($m=mysqli_fetch_array($rez_meni)){
                    echo "<a href='?page={$m['id_putanja']}'>{$m['naziv']}</a> &nbsp;";
                }   
          
          ?>
		  
		  <a href='documentation.pdf'>Documentation</a>
      </footer>

    </div><!--/.container-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrypt.js"></script>
      <script src="js/lightbox-plus-jquery.js"></script>
  </body>
    <?php mysqli_close($konekcija); ?>
</html>
