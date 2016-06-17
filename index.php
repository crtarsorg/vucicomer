<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Vučićomer</title>

		 <meta property="og:title" content="Vučićomer" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://www.vucicomer.rs/" />
        <meta property="og:image" content="http://www.vucicomer.rs/images/logo.jpg" />
        <meta name="description" content="Vučićomer – sajt koji ocenjuje, prati i analizira obećanja koja je građanima Srbije dao predsednik Vlade Aleksandar Vučić.">
        <meta name="keywords" content="predsednik Vlade,Aleksandar Vučić, Srbija, premijer, politika,obećanja, doslednost, dogovornost">
        <meta name="author" content="istinomer.rs">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="mobile-web-app-capable" content="yes">
    	<meta name="apple-mobile-web-app-capable" content="yes">

		
		<!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"></link> -->

		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css?1">
		<link rel="stylesheet" type="text/css" href="css/style.css?1">
        <link rel="stylesheet" type="text/css" href="css/extern.css?1">

		<script src="js/jquery-1.11.2.js"></script>
		<script src="js/index.js?3"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/10.0.0/js/smooth-scroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2014-11-29/FileSaver.min.js"></script>



    <style type="text/css">
    .ikonica{
        height: 15px; 
        width: 15px;
        border-radius: 12px;
        display: inline-block;
        box-shadow: 0px 2px 5px 2px rgb(200, 200, 200);
        margin-bottom: -2px;
    }

    .dani-vlasti{
       /*  box-shadow: 2px 4px 10px 5px rgb(200, 200, 200);
       border-radius: 10px 10px 10px 10px;
       min-height: 30px;
       padding: 15px; */
        text-align: center;
        cursor: pointer;
        margin:10px;
    }
    .dani-vlasti span{
        text-transform: uppercase;
        position: relative;
        top:-30px;
    }
    
    .dugme-active{
        transform: translateY(-2px);
        border-radius: 0 0 10px 10px;
    }
    .period-14-donji{border-radius: 5px 5px 5px 0px !important;}
    .period-16-donji{border-radius: 5px 5px 5px 5px !important;}
    .period-X-donji{border-radius: 5px 5px 0px 5px !important;}

    .period-14-gornji{border-radius: 0px 0px 10px 10px !important;}
    .period-16-gornji{border-radius: 0px 0px 10px 10px !important;}
    .period-X-gornji{border-radius: 0px 0px 10px 10px !important;}

    .dugme {
      /*   -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
      -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); */
        box-shadow: 5px 5px 5px 0px rgb(227, 225, 226);
        
        border-radius: 10px 10px 10px 10px;
      /*   -moz-border-radius: 10px 10px 10px 10px;
      -webkit-border-radius: 10px 10px 10px 10px; */
        border: 0px solid #000000;
        padding: 10px;
        min-width: 100px;
        width: 32.5%;
        display: inline-block;
        text-align: center;
        cursor: pointer;
     }   

    .belo{color: white;}
    .period-14{ background-color: #58595b; }
    .period-16{ background-color: #72b1c8; } 
    .period-X{ background-color: #f1f2f2; } 
    .ikonice-glavno{    

        position: absolute;
        left: -10%;    
        margin-top: -20px;
    }
    .dodatno{
        min-height: 35px;
        box-shadow: 5px 5px 5px 0px rgb(227, 225, 226);
        border-radius: 5px 5px 5px 5px;
        margin-bottom: 2px;
        text-align: center;
        padding: 5px;

    }
    .filter-ikonica-kategorija{ cursor: pointer; }
    .filter-ikonica{cursor: pointer;margin-bottom: 5px;}
    .width-100{width: 100%;}
    .dim-layer{
        width: 100%;
        height: 100%;
        background-color: rgba(128, 128, 128, 0.65);
        position: absolute;
        z-index: 9999;
    }
    .loader-icon{
        top: 50%;
        right: 50%;
        position: absolute;
    }

    .social-div {
        position: fixed;
        right: 10px;
        top: 100px;
        width: 75px;
        z-index: 1;
    }
    .legenda div{
        margin-left: 20px;        
    }
    .legenda span{
        margin-left: 5px;        
    }

    .klasa-levo{
        padding-left: 0px;  
        margin-left: -16px;
        padding-right: 0px;
        width: 390px;
    }

    @media (min-width: 992px){
        .procenat-20 {
            width: 20%;
        }

        .search-cont{padding-left: 0px;}
    }
        
    </style>
    
    
    

  
  


	</head>
	<body>

    <div class="dim-layer">
        <img class="loader-icon" src="images/spinner.svg">
    </div>
    
		<header class="container-fluid">
            <div class="container">
                <h1>
                    <a href="index.html">
                        <img class="img-responsive" src="images/logo.jpg" alt="vučićomer_logo">
                    </a>
                </h1>
            </div>
        </header>

        

		<section class="container">
            <div class="row"   style="margin-top: 40px;margin-bottom: 40px">
    		    <div class="summary col-xs-12 col-sm-4" id="stats">
    		        <div class="daysinoffice ">
    		            <div class="dani-vlasti reset-dugme">
    		                <!-- <i class="fa fa-calendar"></i> -->
                          <span title="od 27. aprila 2014 godine">Ukupno na vlasti:</span> <object id="svg1" data="images/dani_vlast.svg" type="image/svg+xml"></object> <span>dana</span>

                         
    		            </div>

                        <div>
                            <div class="dodatno hidden "></div>
                            <div class="dugme period-14 period-14-filter filter-ikonica belo">2012-2014</div>
                            <div class="dugme period-16 period-16-filter filter-ikonica belo">2014-2016</div>
                            <div class="dugme period-X filter-ikonica period-X-filter">2016-</div>
                        </div>
                         
    		        </div>
    		        <a  data-scroll="" href="#obecanja">
    		            <div class="beleznica" data-search="Beleznica" title="Neocenjeno obećanje">
    		                <h2>
    		                	
    		                	<span>Beležnica: <b class="count"></b>/<b class="total"></b></span>
    		                </h2>
    		              
                           <img class="ikonice-glavno" src="images/ikonica-beleznica.svg"> 
                           <p class="progress"><span></span></p>
                          
    		            </div>
    		            <div class="uprocesu" data-search="U procesu">
    		                <h2>
    		                	<!-- <i class="fa fa-cogs"></i> -->
    		                	<span>U procesu: <b class="count"></b>/<b class="total"></b></span>
    		                </h2>
                            <img class="ikonice-glavno" src="images/ikonica-uprocesu.svg"> 
    		                <p class="progress"><span></span></p>
    		            </div>
    		            <div class="ispunjeno" data-search="Ispunjeno">
    		                <h2>
    		                	<!-- <i class="fa fa-check-circle-o"></i> -->
    		                	<span>Ispunjeno: <b class="count"></b>/<b class="total"></b></span>
    		                </h2>
                             <img class="ikonice-glavno" src="images/ikonica-ispunjeno.svg"> 
    		                <p class="progress"><span></span></p>
    		            </div>
    		            <div class="neispunjeno" data-search="Neispunjeno">
    		                <h2>
                                <!-- <i class="fa fa-ban"></i> -->
                                <span>Neispunjeno: <b class="count"></b>/<b class="total"></b></span>
                            </h2>
                            <img class="ikonice-glavno" src="images/ikonica-neispunjeno.svg"> 
    		                <p class="progress"><span></span></p>
    		            </div>
    		        </a>

    		    </div>


    		    <div class="intro col-xs-12 col-sm-8">
    		        <p>
    		           Srbija je 27. aprila 2014, nepune dve godine pošto je <a href="http://bit.ly/1oxfnAD" target="_blank">koalicija predvođena SNS-om preuzela vlast, posle vanrednih izbora</a> dobila jedanaestog po redu predsednika Vlade. Pred narodnim poslanicima Aleksandar Vučić je položio zakletvu i pročitao plan budućeg rada.                        
    		        </p>
                    <p>Samo dve godine kasnije, 24. aprila 2016. godine premijer je od građana tražio poverenje na još jednim vanrednim izborima i <a href="http://bit.ly/1tA6n0x">dobio novi mandat</a>.</p>

                    <p>Budući da nas uskoro čeka nov ekspoze novog starog predsednika Vlade, kao i da je u protekle četiri godine <a href="http://www.istinomer.rs/akter/15/Aleksandar-Vucic">Aleksandar Vučić</a>, kao prvi potpredsednik i predsednik Vlade, uspeo da se nametne kao apsolutno dominantna figura na našoj političkoj sceni, mi u Istinomeru, u skladu sa našom društvenom misijom, osećamo kao svoju obavezu da javnosti pružimo pun uvid u sve ono što smo zabeležili i ocenili u ovom periodu.</p>

    		        <p>
                        Šta je sve  <a href="http://www.istinomer.rs/akter/15/Aleksandar-Vucic" target="_blank">Aleksandar Vučić</a> obećavao, a šta ispunio? Koliko je bio dosledan i uporan u ispunjavanju svojih obećanja? <a href="http://www.srbija.gov.rs/extfile/sr/208699/ekspoze_aleksandar_vucic_cyr270414.doc" target="_blank">Koliko stavki iz prošlog ekspozea je Vlada uspela da realizuje</a>, a koje su ostale samo “mrtvo slovo na papiru”?                        
                    </p>
                    <p>Zato pokrećemo Vučićomer – sajt koji ocenjuje, prati i analizira obećanja koja je građanima Srbije dao predsednik Vlade Aleksandar Vučić.</p>
    		        <p>
                   Izjave premijera razvrstane su u tri sekcije – politika, društvo i ekonomija. Svako obećanje dobija jedinstvenu ocenu uz jasnu analizu baziranu na javno dostupnim podacima i obrazloženje. Status obećanja možete pratiti i u okviru statistike koja pokazuje procenat ispunjenih, neispunjenih, kao i obećanja čija je realizacija u toku. Rubrika Beležnica podseća na sve ono što je premijer Vučić obećao, ali rok za njihovo ostvarenje još nije istekao.
                   </p> 
                   
                   <p>Nove epizode Vučićomera naši čitaoci mogu očekivati od trenutka kada Aleksandar Vučić bude predstavio svoj ekspoze u Skupštini Srbije.</p>

                   <p>Nadamo se da će ovo izdanje Vučićomera doprineti boljem razumevanju jedne politike u javnosti, kvalitetu političkog diskursa i da će možda jednim malim delom uticati na to da se manje obećava, a više ispunjava u narednom mandatu. </p>
                   
                   <hr/>
                    
    		       <section >
                        <div class="procenat-20 col-xs-5">
                            <a href="http://www.istinomer.rs/pregled_ocena/tipovi,3,4,5/akter,45/pstr,10/strana,1/" target="_blank"><img class="img-responsive width-100 " src="images/cvetkovic.svg" alt="Gradjani na strazi logo"></a>
                        </div>
                       <div class="procenat-20 col-xs-5">
                            <a href="http://www.istinomer.rs/pregled_ocena/tipovi,3,4,5/akter,162/pstr,10/strana,1/" target="_blank"><img class="img-responsive width-100" src="images/dacic.svg" alt="Otvoreni parlament logo"></a>
                       </div>

                        <div class="procenat-20 col-xs-5">
                            <a href="http://www.istinomer.rs/pregled_ocena/tipovi,3,4,5/akter,15/pstr,10/strana,1/" target="_blank"><img class="img-responsive width-100" src="images/vucic.svg" alt="Otvoreni parlament logo"></a>
                       </div>

                        <div class="procenat-20 col-xs-5">
                            <a href="http://www.birackiproglas.rs" target="_blank"><img class="img-responsive width-100" src="images/prog-logo.svg" alt="Biracki proglas logo"></a>
                        </div>
                        <div class="procenat-20 col-xs-5">
                            <a href="http://www.istinomer.rs/" target="_blank"><img class="img-responsive width-100" src="images/ist-logo.svg" alt="Istinomer logo"></a>
                        </div>
                       
                    </section>

                    <hr/>
    		    </div>
            </div>
		</section>

  
       
       <script type="text/javascript">
        
        var windowObjectReference;
        var strWindowFeatures = "menubar=no,location=yes,resizable=yes,scrollbars=yes,status=yes";

        function openRequestedPopup(el) {
            
          windowObjectReference = window.open(el.href, "Vucicomer podeli", strWindowFeatures);
        }

    </script>

     <section class="container ">
        
        <div class="social-div">
            <a target="_blank" onclick="false;openRequestedPopup(this)" href="https://www.facebook.com/sharer/sharer.php?u=www.vucicomer.rs"><img src="images/fb.svg"></a>
            <a target="_blank" onclick="false;openRequestedPopup(this)" href="https://twitter.com/home?status=www.vucicomer.rs"> <img src="images/twitter.svg"></a>
        </div>


        <section class="container search-cont" style="    "> 

            <div class="search col-xs-12 col-md-4 klasa-levo " >
               
                <!-- <i class="fa fa-search"></i>  -->
                <input class="col-xs-12 col-md-11" type="search" placeholder="Pretraga...">
                 <span id="count"></span>
            </div>

            <div class="col-sm-2">
                <button class="btn btn-primary reset-search">Resetuj </button>    
            </div>
            

            <div class="pull-right col-xs-12 col-sm-4 legenda" style="text-align: center; margin:10px;">                
               <div class="ikonica period-14-filter filter-ikonica-kategorija period-14"></div><span>2012 - 2014</span>
               <div class="ikonica period-16-filter filter-ikonica-kategorija period-16" ></div><span>2014 - 2016</span>
               <div class="ikonica period-X-filter filter-ikonica-kategorija period-X"></div><span>2016 - </span> 
             
            </div>
        </section>


        <section class="container obecanja" id="obecanja">
        
            <ul class="nav nav-tabs navigation tabs" data-tabs="tabs">
                <li class="active"><a class="all" data-toggle="tab">Sva obećanja</a></li>
                <li><a class="drustvo" data-toggle="tab">Društvo</a></li>
                <li><a class="zdravstvo" data-toggle="tab">Zdravstvo</a></li>
                <li><a class="kultura selected" data-toggle="tab">Kultura</a></li>
                <li><a class="ekonomija" data-toggle="tab">Ekonomija</a></li>
                <li><a class="politika" data-toggle="tab">Politika</a></li>
            </ul>


            <table>

            </table>

        </section>
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
