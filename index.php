<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Vučićomer</title>

		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="mobile-web-app-capable" content="yes">
    	<meta name="apple-mobile-web-app-capable" content="yes">

		<title>Vučićomer</title>
		<!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"></link> -->

		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/extern.css">

		<script src="js/jquery-1.11.2.js"></script>
		<script src="js/index.js?2"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/10.0.0/js/smooth-scroll.min.js"></script>

     <style type="text/css">
     .ikonica{height: 25px;}
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

        <?php include 'social.php'; ?>

		<section class="container">
            <div class="row">
    		    <div class="summary col-xs-12 col-sm-4">
    		        <div class="daysinoffice">
    		            <h2>
    		                <!-- <i class="fa fa-calendar"></i> -->
                          <span title="od 27. aprila 2014 godine">Dani mandata:</span> <b></b>

                         
    		            </h2>
                         <button class="btn1">Prvi period</button>
                          <button class="btn2">Drugi period</button>
                          <button class="btn3">Treci period</button>
    		        </div>
    		        <a data-scroll="" href="#obecanja">
    		            <div class="beleznica" data-search="Beleznica">
    		                <h2>
    		                	<!-- <i class="fa fa-hourglass-start"></i> -->
    		                	<span>Beležnica: <b class="count"></b> od <b class="total"></b></span>
    		                </h2>
    		                <p class="progress"><span></span></p>
    		            </div>
    		            <div class="uprocesu" data-search="U procesu">
    		                <h2>
    		                	<!-- <i class="fa fa-cogs"></i> -->
    		                	<span>U procesu: <b class="count"></b> od <b class="total"></b></span>
    		                </h2>
    		                <p class="progress"><span></span></p>
    		            </div>
    		            <div class="ispunjeno" data-search="Ispunjeno">
    		                <h2>
    		                	<!-- <i class="fa fa-check-circle-o"></i> -->
    		                	<span>Ispunjeno: <b class="count"></b> od <b class="total"></b></span>
    		                </h2>
    		                <p class="progress"><span></span></p>
    		            </div>
    		            <div class="neispunjeno" data-search="Neispunjeno">
    		                <h2>
                                <!-- <i class="fa fa-ban"></i> -->
                                <span>Neispunjeno: <b class="count"></b> od <b class="total"></b></span>
                            </h2>
    		                <p class="progress"><span></span></p>
    		            </div>
    		        </a>

    		    </div>


    		    <div class="intro col-xs-12 col-sm-8">
    		        <p>
    		           Srbija je 27. aprila 2014, nepune dve godine pošto je <a href="http://bit.ly/1oxfnAD" target="_blank">koalicija predvođena SNS-om preuzela vlast, posle vanrednih izbora</a> dobila jedanaestog po redu predsednika Vlade. Pred narodnim poslanicima Aleksandar Vučić je položio zakletvu i pročitao plan budućeg rada. Samo dve godine kasnije, premijer od naroda traži novi mandat. 
    		        </p>
    		        <p>
                        
                        Šta je sve  <a href="http://www.istinomer.rs/akter/15/Aleksandar-Vucic" target="_blank">Aleksandar Vučić</a> u prethodne dve godine obećao, a šta ispunio?  <a href="http://www.srbija.gov.rs/extfile/sr/208699/ekspoze_aleksandar_vucic_cyr270414.doc" target="_blank">Koliko stavki iz ekspozea je Vlada uspela da realizuje</a>, a koje su ostala samo “mrtvo slovo na papiru”? <b>Može li se u njegovim izjavama naći razlog ovakvog skraćenog izbornog perioda?</b> Vučićomer ocenjuje, prati i analizira obećanja koja je građanima Srbije dao <a href="http://www.istinomer.rs/akter/15/Aleksandar-Vucic">predsednik Vlade Aleksandar Vučić</a>.
                      
                    </p>
    		        <p>
                    Izjave premijera razvrstane su u tri sekcije – politika, društvo i ekonomija. Svako obećanje dobija jedinstvenu ocenu uz određeno obrazloženje. Status obećanja možete pratiti u okviru statistike koja pokazuje procenat ispunjenih, neispunjenih, kao i obećanja čija je realizacija u toku. Rubrika Beležnica podseća na sve ono što je premijer Vučić  obećao, ali rok za njihovo ostvarenje još nije istekao.
                   </p> 
    		      
    		    </div>
            </div>
		</section>

  <style type="text/css">
  .filter-ikonica{cursor: pointer;}
  </style>   

   

        <section class="container obecanja" id="obecanja">
            <div class="search">
                <button class="btn btn-primary">Reset </button>
                <!-- <i class="fa fa-search"></i>  -->
                <input class="col-xs-12 col-sm-4" type="search" placeholder="Pretraga...">
                 <span id="count"></span>
            </div>
            
            <div class="container">
                <div class="pull-right">
                    <img class="ikonica post-ekspoze-filter filter-ikonica" src="images/prime.png" title="Izjave posle ekspozea">
                    <img class="ikonica pre-ekspoze-filter filter-ikonica" src="images/obecanja.png" title="Izjave pre ekspozea">
                    <img class="ikonica ekspoze-filter filter-ikonica" src="images/ekspoze.png" title="Izjave date u ekspozeu">
                </div>

            </div>

            <ul class="nav nav-tabs navigation tabs" data-tabs="tabs">
                <li class="active"><a class="all" data-toggle="tab">Sve</a></li>
                <li><a class="drustvo" data-toggle="tab">Društvo</a></li>
                <li><a class="zdravstvo" data-toggle="tab">Zdravstvo</a></li>
                <li><a class="kultura selected" data-toggle="tab">Kultura</a></li>
                <li><a class="ekonomija" data-toggle="tab">Ekonomija</a></li>
                <li><a class="politika" data-toggle="tab">Politika</a></li>
            </ul>


            <table>

            </table>

        </section>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div class="fb-comments" data-href="http://www.vucicomer.rs" data-numposts="5"></div>

        <footer>
            <a href="http://www.istinomer.rs">
                <p>Powered by Istinomer</p>
            </a>
        </footer>

		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
