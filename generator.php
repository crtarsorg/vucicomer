<?php

	$filename = "./data/data_all.json";
	ob_start();


	$podaci =  citaj_iz_fajla();
	if( !$podaci ){
		$podaci = napravi_json_fajl();
	}


	$kategorije = "";


	// ne moram da izdvajam kategorije - samo da ih sortiram?
	//ovo prebaciti na sql stranu

	function cmp($a, $b)
		{
		    $rdiff = $a->kategorija > $b->kategorija;
		      /*if ($rdiff)*/ return $rdiff;
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


	$statusi_filter = array(18=>"Ispunjeno", 23 =>'U procesu', 22 =>'U procesu' , '19' =>'Beleznica', 20=>'Neispunjeno', 21=>'Neispunjeno',  0=>'Beleznica' ); //Beleznica U procesu ispunjeno neispunjeno ;

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

	$levo =  <<<BROJAC
	
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
	
	echo $levo ;

	//brojac * 2 , broji koliko ima ocena jednog tipa

	$brojac_vesti = -1; //zbog prvog unosa i reda 177 // $brojac_vesti ++;
	$brojac_kategorija = 0;

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

			
					
			$datum = strtotime(date_format( date_create_from_format('Y-m-d', $jedan_unos->datum_izjave )  , 'Y-m-d' ) );

			$period = $jedan_unos->period;

			//var_dump( strtotime($jedan_unos->datum_izjave .' -4 months') );

			$datum_temp = strtotime($jedan_unos->datum_izjave );
				
			switch ( $period ) {
					case 'ppv':
						$period = "ppv";			
						$status_text .= " ppv ";
						$ikonica = "period-14";
						break;
					
					case 'prvi_mandat':
						$period = "prvi_mandat";			
						$status_text .= " prvi_mandat ";
						$ikonica = "period-16";
						break;

					case 'drugi_mandat':
						$period = "drugi_mandat";			
						$status_text .= " drugi_mandat ";
						$ikonica = "period-X";
						break;

					default:
						$period = "";			
						$status_text .= "";
						$ikonica = $period;
						break;
				}	

		

			$link_vest = "http://www.vucicomer.rs/ocena.php?id=". $jedan_unos->id;
			//."/".seo_naziv($naslov_vesti)


			$index = $brojac_vesti - 1;




			$nulti_text = <<<NULTI


			<div class="beleznica" title="Beleznica"><i class="fa fa-hourglass-start"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="uprocesu" title="U procesu"><i class="fa fa-cogs"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="ispunjeno" title="Ispunjeno"><i class="fa fa-check-circle-o"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="neispunjeno" title="Neispunjeno"><i class="fa fa-ban"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>

NULTI;

				
	

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
				$klasa_tr_a = "a$index np category $glavna_klasa hidden $period"; 
				$text_upis = $nulti_text;
				$status_text .= "";
				stampanje_tr_a($klasa_tr_a, $status_text, $text_upis, $period , $statusi_trenutno[$jedan_unos->status], $ikonica  );
			}


		}


		$klasa_tr_a = "a$index obecanje $status_klasa $glavna_klasa $period"; //2-gi tr
		$text_upis = $vest_text;
		$status_text .= $statusi_filter[$jedan_unos->status] ;

		stampanje_tr_a( $klasa_tr_a, $status_text, $text_upis,$period, $statusi_trenutno[$jedan_unos->status], $ikonica  );


} //for brojac

		


$la = ob_get_clean();
napraviListu($la);
ob_end_flush();





function napraviListu($sadrzaj='')
{
	$cache_file = "./lista.html";
	touch($cache_file);
	@chmod($cache_file, 0777);

	$fp = fopen($cache_file, 'w+');


	fwrite($fp, $sadrzaj);
	fclose($fp);
}



function stampanje_tr_a ($klasa_tr_a='', $status_txt = "",
		$text_upis = '', $period = '', $status_poj = '', $ikonica = '' )
	{
		$title_slika = "";
		

		switch ( $status_poj ) {
			case 'beleznica':
				$title_slika = "images/ikonica-beleznica.svg";	
				break;
			case 'uprocesu':
				$title_slika = "images/ikonica-u-procesu.svg";	
				break;	
			case 'ispunjeno':
				$title_slika = "images/ikonica-ispunjeno.svg";	
				break;	
			case 'neispunjeno':
				$title_slika = "images/ikonica-neispunjeno.svg";	
				break;	
			
			default:
				$title_slika = "";		
				break;
		}

		if(!strstr($klasa_tr_a,"a-1") && $status_txt == "")  
			{
				$status_txt = "Beleznica";
				$status_poj = "beleznica";
			}

		
		$count_kolona =
		 '<td class="count">'.
	        	'<div class="ikonica filter-ikonica pomeraj-ikonice '.$ikonica.' '.$period.'"></div>'.
	        	'<img class="ikonica-2 '.$status_poj.'" src="'.$title_slika.'" alt="'.$status_poj.' ikonica"/>'.
	        '</td>';


		if(strpos($klasa_tr_a, "category") != false  ){
			$count_kolona = '<td class="count"></td>';
		}

		$template = <<< TROVI
	 	<tr class="$klasa_tr_a">
	        <td class="status">
	            $status_txt
	        </td>
	        <td class="text">
	            $text_upis
	        </td>
	       $count_kolona
	    </tr>


TROVI;


		print_r($template);
	}

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

function napravi_json_fajl(  )
{
	
	$putanja = "http://www.istinomer.rs/api/ocena?premijer=true";
	$podaci_json = file_get_contents($putanja); 
	$rezultat_upisa = 
		file_put_contents($filename, $podaci_json);


		//upisivanje u fajl
		
	
	return json_decode($podaci_json);
}

function citaj_iz_fajla( )
{
	//dodati proveru da li je stariji od 1 dan
	//uraditi mv fajla na -OLD
	if( !file_exists($filename) )
		return false;

	$podaci_json = file_get_contents($filename); 
	return json_decode($podaci_json);
}


?>
