<?php 

         
//$fh = fopen("./data.json", "r+");
$json_file = file_get_contents("./data.json");

$svi_podaci =  json_decode($json_file) ;
    

//id - 3356


$jedna_vest = array_filter($svi_podaci,function ($la='')
{
    return $la->id == "3356";    
});

$jedna_vest = array_pop( $jedna_vest ) ;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vučićomer | <?php echo $jedna_vest->naslov; ?></title>
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
    </style>
</head>

<body>
    <header class="container-fluid">
        <div class="container">
            <h1>
                    <a href="index.html">
                        <img class="img-responsive" src="images/logo.jpg" alt="vučićomer_logo">
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







<div class="container-fluid">
    <div class="container">
        <div class="content">
            
            <!-- <div class="sharepromise">
                <i class="fa fa-arrow-left"></i> Share this promise!
            </div> -->
            <h2> 
                <i class="fa fa-university"></i> <?php echo $jedna_vest->naslov;  ?>
            </h2>

            <h1><?php 

            $iz_temp  = trim($jedna_vest->izjava) ;  
            $iz_temp  = trim($iz_temp,'"') ;  
            $iz_temp  = trim($iz_temp,'“') ;  
            echo ($iz_temp) ;

            ?></h1>
        </div>





        <div class="status pull-right"> 
               
              <span>       <i class="fa fa-cogs"></i>In progress</span>
               
            <p> 
                <span> <?php echo $jedna_vest->izvor; ?> </a> </span>
            </p> 
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

    <div class="container-fluid">
        
        <div>
            <br>
        </div>

        <div class="container">
            
            <?php echo $komentar_temp; ?>
        </div>
        <!-- <div class="container">
            <div>Mesec dana nakon rušenja u Savamali premijer je izjavio da tamo uopšte nije bilo ljudi u fantomkama, da ih niko nije video i da je cela priča o fantomkama izmišljena. &nbsp;
                <br>
            </div>
            <div>
                <div class="photography-wrapper">
                    <div class="photography ">
                        <img src="http://www.istinomer.rs/pictures/slike/20090925834419.jpg" class="img-responsive" alt="*">
                    </div>
                </div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>Međutim, postoji više svedočenja o tome kako su izgledale osobe koje su u noći između 24. i 25. učestvovale u rušenju nekoliko objekata u Hercegovačkoj ulici.</div>
            <div>
                <br>
            </div>
            <div>Prvo je <a href="http://www.poverenik.rs/images/stories/dokumentacija-nova/pismaorganima/2016/sinisamali.pdf" title="" target="_blank">poverenik za informacije od javnog značaja Rodoljub Šabić</a>, kome su se građani sami obraćali, pošto policija nije reagovala i koji je neposredno razgovarao sa građanima, objavio da je <b>oko 30 ljudi maskiranih fantomkama učestvovalo u rušenju</b>, nakon što su vezali čuvara i oduzeli mu mobilni telefon.&nbsp;</div>
            <div>
                <br>
            </div>
            <div>Miloš Đorđević, koji se zatekao na parking kod restorana Savanova u vreme noćne akcije u Hercegovačkoj, izjavio je da su ga maltretirali ljudi u fantomkama.[quote] [quote_title]N1, 27.4.2016. godine[/quote_title] [quote_content]“<b>Prišla su mi tri lika sa fantomkama</b>, izvukli me iz auta, rekli da ćutim sve vreme, da sagnem glavu dole… I pitali su me odmah za telefon. Bio je pored na sedištu, pa su ga uzeli odmah i pokupili mi sve stvari, ličnu kartu i celu torbicu. Onda su me odveli iza tog parkirališta, gde je onaj šut i gde je bager radio sve vreme. Postrojili su još par ljudi… Stajao sam raširenih ruku i nogu mislim jedno sat vremena”, rekao je Đorđević.[/quote_content] [/quote]I <a href="http://www.zastitnik.rs/attachments/article/4723/savamala.pdf" title="" target="_blank">u izveštaju Zaštitnika građana Saše Jankovića</a> navodi se da je u akciji učestvovalo <b>“više desetina uniformisanih lica pod fantomkama”</b>.&nbsp;</div>
            <div>
                <br>
            </div>
            <div>Dakle, budući da su građani i javno govorili da su ih maltretirali ljudi u fantomkama, da su to zaključili i Poverenik i Zaštitnik građana, izjava premijera da u Hercegovačkoj nije bilo fantomki dobija ocenu <b>“neistina”</b>.
                <br>
                <br>
                <div>Nije jasno na osnovu čega je premijer formulisao ovakve tvrdnje, uprkos izjavama svedoka i dva izveštaja nezavisnih institucija. Isto se odnosi i na njegovu tvrdnju da je bilo 9, 10 ili 11, a ne 30 napadača kako se navodi u izveštajima nezavisnih tela, iako sam broj učesnika nije od suštinske važnosti, odnosno ne menja činjenicu da je akcija bila protivzakonita. Nadležni organi bi svakako trebalo da utvrde ko su ti ljudi, koliko ih je bilo, po čijem naređenju su radili, itd.&nbsp;</div>
                <div>
                    <br>
                </div>
                <div>Takođe je, pokazalo se, neopravdano tvrdio da su svi srušeni objekti bespravno sagrađeni i da su vlasnici kriminalci.[quote] [quote_title]N1, 23.5.2016. godine[/quote_title] [quote_content]"Sve tamo, sve to što su dobili, mogu da mi pričaju dal ima ovakav ili onakav papir, sve je stečeno kriminalom i korupcijom, nisu mu ni mama ni tata ostavljali, već prethodni gradski čelnici na lopovluk i kriminal, zato oni i uglavnom ćute, jedan stručnjak ima 64 krivičnih dela", rekao je Vučić.[/quote_content] [/quote]Vlasnici objekata su to demantovali i najavili tužbu protiv Vučića. Poverenik za pristup informacijama od javnog značaja Rodoljub Šabić potvrdio je da je irelevantno da li su objekti bili legalni ili ne, ali i rekao da dobar deo objekata jeste bio legalno podignut.</div>
                <div>
                    <br>
                </div>
                <div>Posle ovoliko netačnih ili promenjenih poruka koje premijer šalje povodom događaja u Hercegovačkoj, a na osnovu neidentifikovanih izvora, neće biti čudo ako se pokaže da ne stoje ni njegove tvrdnje o tome kako iza ove akcije ne stoji država, kao ni da će nadležni pronaći počinioce i nalogodavce u roku od sedam do deset dana.</div>
            </div>
            <div>
                <br>
            </div>
        </div> -->
    </div>
    <footer>
        <a href="http://www.istinomer.rs">
            <p>Powered by Istinomer</p>
        </a>
    </footer>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
