<?php

function seo_naziv($element='')
{
	 $urlForbidenCharacters = array('%',': ','?','š','Š','ž','Ž','ć','Ć','č','Č','đ','Đ','. ','.',', ',' - ','/',' ',"'",'’','`','!','+','(',')','"','®','!','?','\\','*','\'','^','&','#','<','>','; ',';','{','}','(',')','|','~','[',']',
		'“', '”','„','“');
	 $urlValidCharacters = array('','-','','s','S','z','Z','c','C','c','C','dj','Dj','','','-','-','-','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
		'','','','');

	$element = ltrim($element);
	$element = rtrim($element);
	return str_replace($urlForbidenCharacters, $urlValidCharacters, $element);
}

//!!!!1/
//!
//!treba zameniti sve null vrednosti nulama

//generisati full link na osnovu id-a i naslova, iskopirati deo koji se nalazi u seo klasi
	/*
	b = [5,121]
	c = a.filter(function(el){return b.indexOf(+el.tip_ocena)!=  -1 })
	 */
	ob_start();


	$putanja = "http://www.istinomer.rs/api/ocena?premijer=true";

	//sacuvati fajl

	$podaci_json = file_get_contents($putanja); //http://www.istinomer.rs/api/ocena?akter=15
	$podaci = json_decode($podaci_json);



	

	$kategorije = "";


	// ne moram da izdvajam kategorije - samo da ih sortiram?

	//ovo prebaciti na sql stranu

	function cmp($a, $b)
		{
		    $rdiff = $a->kategorija > $b->kategorija;
		      /*if ($rdiff)*/ return $rdiff;
    		//return $a->tip_ocena > $b->tip_ocena;
		}

	usort($podaci, "cmp");

	//samo ove stvari
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


	$statusi_filter = array(18=>"Ispunjeno", 23 =>'U procesu', 22 =>'U procesu' , '19' =>'Beleznica', 20=>'neispunjeno', 21=>'neispunjeno',  0=>'Beleznica' ); //Beleznica U procesu ispunjeno neispunjeno ;

	$statusi_trenutno =  array(18=>"ispunjeno", 23 =>'uprocesu', 22 =>'uprocesu' , 19 =>'beleznica', 20=>'neispunjeno', 21=>'neispunjeno', 0 =>'beleznica');


	$kategorije = array(24 =>'politika', 25 =>'ekonomija', 26 =>'kultura', 27 =>'zdravstvo', 28 =>'drustvo',  );
	

	$politika = array_filter($podaci, function( $el )
	{
		return $el->kategorija == 24 /*|| $el->kategorija == 0 || $el->kategorija == null*/ ;
	});
	$politika = count($politika );

	$ekonomija = array_filter($podaci, function( $el )
	{
		return $el->kategorija == 25;
	});
	$ekonomija = count($ekonomija );

	$kultura = array_filter($podaci, function( $el )
	{
		return $el->kategorija == 26;
	});
	$kultura = count($kultura );
	

	$zdravstvo = array_filter($podaci, function( $el )
	{
		return $el->kategorija == 27;
	});
	$zdravstvo = count($zdravstvo );

	$drustvo = array_filter($podaci, function( $el )
	{
		return $el->kategorija == 28;
	});
	$drustvo = count($drustvo );

	/*$counts = array(24 =>count($politika), 25 =>count($ekonomija), 26 =>count($kultura), 27 =>count($zdravstvo), 28 =>count($drustvo),  );*/
	$all_count = count($podaci);

	echo <<<BROJAC
	
	<tr class="hidden" >
		<td>
			<span class="kategorija all">$all_count</span>
			<span class="kategorija politika">$politika</span>
			<span class="kategorija ekonomija">$ekonomija</span>
			<span class="kategorija kultura">$kultura</span>
			<span class="kategorija zdravstvo">$zdravstvo</span>
			<span class="kategorija drustvo">$drustvo</span>
		</td>
	</tr>
	 
BROJAC;


	function stampanje_tr_a ($klasa_tr_a='', $status_txt = "", $text_upis = '', $period = '')
	{
		$title_slika = "";

		switch ($period) {
			case 'ekspoze':
				$title_slika = "images/ekspoze.png";	
				break;
			case 'pre-ekspoze':
				$title_slika = "images/obecanja.png";	
				break;	
			case 'post-ekspoze':
				$title_slika = "images/prime.png";	
				break;	
			case 'trenutna':
				$title_slika = "images/kampanja.png";	
				break;	
			
			default:
				$title_slika = "";		
				break;
		}

		if(!strstr($klasa_tr_a,"a-1") && $status_txt == "")  $status_txt = "Beleznica";
	$template = <<< TROVI
	 	<tr class="$klasa_tr_a">
	        <td class="status">
	            $status_txt
	        </td>
	        <td class="text">
	            $text_upis
	        </td>
	        <td class="count">
	        	
	        	<img class="ikonica $period" src="$title_slika" title="$period ikonica"/>
	        </td>
	    </tr>


TROVI;


		print_r($template);
	}

	//statusi!!!

	//brojac * 2 , broji koliko ima ocena jednog tipa

	$brojac_vesti = -1; //zbog prvog unosa i reda 177 // $brojac_vesti ++;
	$brojac_kategorija = 0;

	/*$kategorija_flag = $podaci[0]->kategorija;
	if(empty($kategorija_flag )){
		$kategorija_flag = "politika";
	}*/

			

	foreach ($podaci as  $jedan_unos) {

			$status_text = "";
	
			if(!empty($jedan_unos->kategorija ))
				$glavna_klasa =	$kategorije[ $jedan_unos->kategorija ] ;
			else{
				$jedan_unos->kategorija = "politika";				
				$glavna_klasa = "politika";
			}

			/*
			sortirani su po kategoriji tako da sa prvim unosom druge kategorija setuje promenljivu
			 */
			if( $kategorija_flag == $jedan_unos->kategorija )
			{
				$brojac_vesti ++;
				$brojac_kategorija ++;

			}
			else
			{ //resetuj kategoriju i brojace
				$brojac_kategorija = 0;
				$brojac_vesti = 0;
				$kategorija_flag = $jedan_unos->kategorija;

			}
				//druga kategorija

			
			

			$naslov_vesti = stripcslashes($jedan_unos->naslov) ;
			$title_status = $jedan_unos->status;

			$datum_slika = "";
					
			$datum = strtotime(date_format( date_create_from_format('Y-m-d', $jedan_unos->datum_izjave )  , 'Y-m-d' ) );



			//var_dump( strtotime($jedan_unos->datum_izjave .' -4 months') );

			$datum_temp = strtotime($jedan_unos->datum_izjave );
				
			if( $datum_temp  == strtotime("2014-4-27")){ //ekspoze
				$datum_slika = "ekspoze";
				$status_text .= " ekspoze ";

			}
			else if ($datum_temp > strtotime("2014-1-1") && $datum_temp < strtotime("2014-4-27")){
					$datum_slika = "pre-ekspoze";			
					$status_text .= " preEk ";
			}
			else if ($datum_temp > strtotime("2014-4-27") && $datum_temp <= strtotime("2016-3-4")){
					$datum_slika = "post-ekspoze";			
					$status_text .= " postEk ";
			}
			else if($datum_temp > strtotime("2016-3-4") && $datum_temp < strtotime("2016-4-24") ){//trenutna kampanja
				$datum_slika = "trenutna";
				$status_text .= " trenutna kampanja ";
			}

			$link_vest = "http://www.istinomer.rs/ocena/". $jedan_unos->id."/".seo_naziv($naslov_vesti);


			$index = $brojac_vesti - 1;




			$nulti_text = <<<NULTI


			<div class="beleznica" title="Beleznica"><i class="fa fa-hourglass-start"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="uprocesu" title="U procesu"><i class="fa fa-cogs"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="ispunjeno" title="ispunjeno"><i class="fa fa-check-circle-o"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="neispunjeno" title="neispunjeno"><i class="fa fa-ban"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>

NULTI;

				
		/*print_r("<pre>");
				var_dump($brojac_vesti);
				print_r("</pre>");
				die();*/

		$text_upis = "";

		$prvi_text  = "kat".$kategorija_flag.$jedan_unos->tip_ocena;
		$vest_text = '<a target="_blank" href="'. $link_vest .'" title="'.  $title_status .'">'. $naslov_vesti .'</a>';


		$status_klasa = "";
		if( true /*!empty( $jedan_unos->status ) || $jedan_unos->status ==0 */){
			$status_klasa = intval( $jedan_unos->status) ;
			if(in_array( $status_klasa , array_keys($statusi_trenutno) ) )
				$status_klasa = $statusi_trenutno[ $status_klasa ] ;
		}




		if($brojac_vesti == 0  )	{

			if($brojac_kategorija == 0){
				$klasa_tr_a = "a$index np category $glavna_klasa hidden"; 
				$text_upis = $nulti_text;
				$status_text .= "";
				stampanje_tr_a($klasa_tr_a, $status_text, $text_upis,$datum_slika);
			}


		}


		$klasa_tr_a = "a$index obecanje $status_klasa $glavna_klasa"; //2-gi tr
		$text_upis = $vest_text;
		$status_text .= $statusi_filter[$jedan_unos->status] ;

		stampanje_tr_a($klasa_tr_a, $status_text, $text_upis,$datum_slika);


} //for brojac

		


$la = ob_get_clean();


$cache_file = "./lista.html";
touch($cache_file);
@chmod($cache_file, 0777);

$fp = fopen($cache_file, 'w+');


fwrite($fp, $la);
fclose($fp);



ob_end_flush();








?>
