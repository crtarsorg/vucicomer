<?php 

         
//$fh = fopen("./data.json", "r+");
$json_file = file_get_contents("./data/data_all.json");

$svi_podaci =  json_decode( $json_file );
    

//id - 3356

$id_vesti = $_GET['id'];
if(!is_numeric($id_vesti) ){
    $id_vesti = 2757;
}
        

$jedna_vest = array_filter($svi_podaci,function ($la='') use ($id_vesti)
{    
    return $la->id == $id_vesti;    
});

$jedna_vest = array_pop( $jedna_vest ) ;

$temp_naslov = stripslashes( $jedna_vest->naslov );

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vučićomer | <?php echo $temp_naslov; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"></link> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/extern.css">
    <script src="js/jquery-1.11.2.js"></script>
    <script src="js/index.js?2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/10.0.0/js/smooth-scroll.min.js"></script>
    <style type="text/css">
    .ikonica {
        height: 25px;
    }
    
    .filter-ikonica {
        cursor: pointer;
    }
    .block-quote {
        margin: 20px 0 20px 0;
        padding: 20px;
        border: 1px solid #ccc;
        position: relative;
        font-size: 12.5px !important;
    }
    .logo{    
        height: 150px;
        margin: auto;
    }
    .odvojeno{margin-top: 100px;}
    .margin-top-20{margin-top: 20px;}
    </style>
</head>

<body>
    <header class="container-fluid">
        <div class="container">
            <h1>
                    <a href="./">
                        <img class="img-responsive logo" src="images/logo.jpg" alt="vučićomer_logo">
                    </a>
                </h1>
        </div>
    </header>


<?php 





  /*  print_r("<pre>");    
    var_dump( $jedna_vest );    
    print_r("</pre>");
    die();*/
// $jedna_vest->naslov
// $jedna_vest->izjava
// $jedna_vest->izvor
// $jedna_vest->datum_izjave
// var_dump( $jedna_vest->komentar_istinomera );
// za komentar istinomer-a parsiranje svega, replace-ovanje 


?>
  <?php  

            $statusi_ocena = array(
                //beleznica, kao posebna kategorija
                0  => "Beleznica",
                18 => "Ispunjeno",
                23 => "Skoro ispunjeno",
                22 => "Radi se na tome",
                19 => "Krenuli pa stali",
                20 => "Neispunjeno",
                21 => "Ni započeto",
                );


            $statusi_filter = array(18=>"Ispunjeno", 23 =>'U procesu', 22 =>'U procesu' , '19' =>'Beležnica', 20=>'Neispunjeno', 21=>'Neispunjeno',  0=>'Beležnica' );
              $statusi_ikonice =  array(18=>"ispunjeno", 23 =>'uprocesu', 22 =>'uprocesu' , 19 =>'beleznica', 20=>'neispunjeno', 21=>'neispunjeno', 0 =>'beleznica');      
            
            $temp_sta = $statusi_filter[ $jedna_vest->status ] ;
        ?>

        <?php 


///replace text editor tagova

$komentar_temp = stripslashes($jedna_vest->komentar_istinomera) ;

$komentar_temp = str_replace('../','',$komentar_temp);
$komentar_temp = str_replace('&feature=youtu.be','',$komentar_temp);
//$komentar_temp = str_replace('<div>','',$komentar_temp);
//$komentar_temp = str_replace('</div>','',$komentar_temp);
$komentar_temp = str_replace('[quote]','<div class="block-quote">',$komentar_temp);
$komentar_temp = str_replace('[quote_title]','<div class="info"><i class="fa fa-quote-left fa-lg"></i>',$komentar_temp);
$komentar_temp = str_replace('[/quote_title]','</div>',$komentar_temp);
$komentar_temp = str_replace('[quote_content]','<div class="quote">',$komentar_temp);
$komentar_temp = str_replace('[/quote_content]','</div>',$komentar_temp);
$komentar_temp = str_replace('[/quote]','</div>',$komentar_temp);
$komentar_temp = str_replace('<i class="fa fa-quote-left fa-lg"></i>','',$komentar_temp);
$komentar_temp = str_replace('<div class="info"></div>','',$komentar_temp);

$komentar_temp  = str_replace('<div class="source"><br></div>','',$komentar_temp);


$komentar_temp = explode('<blockquote>',$komentar_temp);
for($i=1;$i<sizeof($komentar_temp);$i++){
    $komentar_temp[$i] = explode('<em>',$komentar_temp[$i]);
    $komentar_temp[$i][1] = explode('</em></blockquote>',$komentar_temp[$i][1]);
    $komentar_temp[$i] = '<div class="block-quote"><div class="info"><i class="fa fa-quote-left fa-lg"></i>'.$komentar_temp[$i][1][0].'</div><div class="quote">'.$komentar_temp[$i][0].'</div></div>'.$komentar_temp[$i][1][1];
}
$komentar_temp = implode(' ',$komentar_temp);

//var_dump($komentar_temp);die();

$komentar_temp = str_replace('http://www.istinomer.rs/',$base_url,$komentar_temp);


$komentar_temp = str_replace('src="pictures/','src="http://www.istinomer.rs/pictures/',$komentar_temp);

$komentar_temp = str_replace('<img','<img class="img-responsive" style="margin:auto;" ',$komentar_temp);


$komentar_temp = str_replace('/izjava/','/ocena/',$komentar_temp);



if (strpos($komentar_temp,'www.youtube.com/watch?v=') !== false) {
    $komentar_temp = str_replace('http://www.youtube.com/watch?v=','<iframe width="500" height="281" src="https://www.youtube.com/embed/',$komentar_temp);
    $komentar_temp = str_replace('https://www.youtube.com/watch?v=','<iframe width="500" height="281" src="https://www.youtube.com/embed/',$komentar_temp);
    $watch_pos = strpos($komentar_temp,'embed/');
    $komentar_temp = substr($komentar_temp, 0, $watch_pos+17).'?feature=oembed" frameborder="0" allowfullscreen=""></iframe>'.substr($komentar_temp, $watch_pos+17);;
}

?>

<script type="text/javascript">
    
    var windowObjectReference;
    var strWindowFeatures = "menubar=no,location=yes,resizable=yes,scrollbars=yes,status=yes";

    function openRequestedPopup(el) {
        
      windowObjectReference = window.open(el.href, "Vucicomer podeli", strWindowFeatures);
    }

</script>

 <section class="container ">
    
    <div class="share-div margin-top-20" style="text-align: center; margin-top: 20px;">
        <a target="_blank" onclick="false;openRequestedPopup(this)" href="https://www.facebook.com/sharer/sharer.php?u=www.vucicomer.rs"><img src="images/fb.svg"></a>
        <a target="_blank" onclick="false;openRequestedPopup(this)" href="https://twitter.com/home?status=www.vucicomer.rs"> <img src="images/twitter.svg"></a>
    </div>

   
    
</section>

<style type="text/css">
    
    .siva-slika{
        -webkit-filter: grayscale(100%);
        -o-filter: grayscale(100%);
        filter: grayscale(100%);
        width: 100%

    }
</style>

<div class="container-fluid">
    <div class="container odvojeno">
        
        <div class="col-md-3">
            <img class="siva-slika" src="<?php echo $jedna_vest->slika; ?>" > 
        </div>
        <div class="content  col-md-9">
            
            <!-- <div class="shareobecanje">
                <i class="fa fa-arrow-left"></i> Share this obecanje!
            </div> -->
            <h1> 
                <i class="fa fa-university"></i> <?php echo $temp_naslov;  ?>
            </h1>

            <h2><?php 
            $iz_temp = stripslashes( $jedna_vest->izjava );
            $iz_temp  = trim($iz_temp ) ;  
           /* $iz_temp  = trim($iz_temp,'"') ;  
            $iz_temp  = trim($iz_temp,'“') ;  */
            echo ($iz_temp) ;

            ?></h2>
             <div class="status pull-left"> 
                    <?php 
                    $ikon = $statusi_ikonice[$jedna_vest->status ];
                    echo '<img src="images/ikonica-'.$ikon.'.svg">'
                ?>
                  <span>       <i class="fa fa-cogs"></i><?php echo $temp_sta; ?></span>
                  
                <p> 

                    
                    <span> <?php echo $jedna_vest->izvor; ?> </a> </span>
                </p> 
            </div>
        </div>


      

       

    </div>
   
</div>



    <div class="container-fluid">
        <div class="container">
        </div>
    </div>


    <div>
        <br>
    </div>




    <div class="container-fluid">
        
        <div>
            <br>
        </div>

        <div class="container">
            
            <?php echo $komentar_temp; ?>
        </div>
        
    </div>

    <section class="container container-fluid  container-border">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>



            <div class="fb-comments " data-href="http://www.vucicomer.rs" data-numposts="5" data-width="100%"></div>
        </section>
    <footer>
        <a href="http://www.istinomer.rs">
            <p>Powered by Istinomer</p>
        </a>
    </footer>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
