<div class="row featurette">

<!-- primena filtera iz desnog menija -->
            
<?php 
            
    if(isset($_REQUEST['btn_filter'])){
        
        $filter_country = $_REQUEST['ddl_country'];
        $filter_season = $_REQUEST['ddl_season'];
        
        if($filter_country!=0 && $filter_season!=0){
         
            $upit_prikaz = "SELECT * FROM article WHERE id_drzava='$filter_country' AND id_kategorija='$filter_season'";
            $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);

            if(mysqli_num_rows($rez_prikaz)!=0){
                $g=1;
                while($p=mysqli_fetch_array($rez_prikaz)){                

                echo "  <hr class='col-md-12'>
                        <div class='col-md-5'>
                            <a href='{$p['picture']}' data-lightbox='gal-{$g}'><img class='featurette-image img-responsive center-block'  src={$p['picture']} alt='".$p['title']."' title='".$p['title']."'></a>
                        </div>
                        <div class='col-md-7'>
                            <h2 class='featurette-heading'>".$p['title']."</h2>
                            <p class='lead'>".$p['text']."</p>
                        </div>";
                    $g++;
                    }
            } else {
                echo "<h3 class='form-signin-heading'>Sorry, we don't currently have anything for this criterion.</h3>";
            }
        
        } else {
            
            echo "<h3 class='form-signin-heading'>You didn't choose both filters.</h3>";    
        } 
        
    } else {
        
        $upit_prikaz = "SELECT * FROM article";
        $rez_prikaz = mysqli_query($konekcija, $upit_prikaz);   
    
        if($rez_prikaz){
            $g=1;
            while($p=mysqli_fetch_array($rez_prikaz)){                
        
            echo "  <hr class='col-md-12'>
                    <div class='col-md-5'>
                        <a href='{$p['picture']}' data-lightbox='gal-{$g}'><img class='featurette-image img-responsive center-block'  src={$p['picture']} alt='".$p['title']."' title='".$p['title']."'></a>
                    </div>
                    <div class='col-md-7'>
                        <h2 class='featurette-heading'>".$p['title']."</h2>
                        <p class='lead'>".$p['text']."</p>
                    </div>";
                $g++;
        } 
        } else {
            echo "Error with mysql.";
        }
        
         
    }
               
?>  
    
    <!-- ime onoga ko je objavio -->
    
</div><!--/row-->
