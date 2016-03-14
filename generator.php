<?php



//!!!!1/
//!
//!treba zameniti sve null vrednosti nulama

//generisati full link na osnovu id-a i naslova, iskopirati deo koji se nalazi u seo klasi
	/*
	b = [5,121]
	c = a.filter(function(el){return b.indexOf(+el.tip_ocena)!=  -1 })
	 */
	ob_start();

	$podaci_json = file_get_contents("data.json"); //http://www.istinomer.rs/api/ocena?akter=15
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


	$statusi_filter = array(18=>"Achieved", 23 =>'In progress', 22 =>'In progress' , '19' =>'Not started', 20=>'Broken', 21=>'Broken',  0=>'Not started' ); //Not started In progress Achieved Broken ;

	$statusi_trenutno =  array(18=>"achieved", 23 =>'inprogress', 22 =>'inprogress' , 19 =>'notstarted', 20=>'broken', 21=>'broken', 0 =>'notstarted');


	$kategorije = array(24 =>'politika', 25 =>'ekonomija', 26 =>'kultura', 27 =>'zdravstvo', 28 =>'drustvo',  );
	

	$politika = array_filter($podaci, function( $el )
	{
		return $el->kategorija == 24;
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


	function stampanje_tr_a ($klasa_tr_a='', $status_txt = "", $text_upis = '')
	{
		
		if(!strstr($klasa_tr_a,"a-1") && $status_txt == "")  $status_txt = "Not started";
	$template = <<< TROVI
	 	<tr class="$klasa_tr_a">
	        <td class="status">
	            $status_txt
	        </td>
	        <td class="text">
	            $text_upis
	        </td>
	        <td class="count">
	        <!-- count disquss stvari-->
	        </td>
	    </tr>


TROVI;


		print_r($template);
	}

	//statusi!!!

	//brojac * 2 , broji koliko ima ocena jednog tipa

	$brojac_vesti = 0;
	$brojac_kategorija = 0;

	$kategorija_flag = $podaci[0]->kategorija;
	if(empty($kategorija_flag )){
		$kategorija_flag = "politika";
	}

	foreach ($podaci as  $jedan_unos) {


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

			


			$naslov_vesti = $jedan_unos->naslov;
			$title_status = $jedan_unos->status;
			$link_vest = "http://www.istinomer.rs/ocena/". $jedan_unos->id;


			$index = $brojac_vesti - 1;




			$nulti_text = <<<NULTI


			<div class="notstarted" title="Not yet started"><i class="fa fa-hourglass-start"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="inprogress" title="In progress"><i class="fa fa-cogs"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="achieved" title="Achieved"><i class="fa fa-check-circle-o"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>
		    <div class="broken" title="Broken"><i class="fa fa-ban"></i><b class="$glavna_klasa">0</b>
		        <p class="progress"><span></span></p>
		    </div>

NULTI;

		$text_upis = "";

		$prvi_text  = "Arts".$jedan_unos->tip_ocena;
		$vest_text = '<a href="'. $link_vest .'" title="'.  $title_status .'">'. $naslov_vesti .'</a>';


		$status_klasa = "";
		if( true /*!empty( $jedan_unos->status ) || $jedan_unos->status ==0 */){
			$status_klasa = intval( $jedan_unos->status) ;
			if(in_array( $status_klasa , array_keys($statusi_trenutno) ) )
				$status_klasa = $statusi_trenutno[ $status_klasa ] ;
		}




		if($brojac_vesti == 0  )	{

			if($brojac_kategorija == 0){
				$klasa_tr_a = "a$index np category $glavna_klasa"; //0-ti tr; menja se samo cultura
				$text_upis = $nulti_text;
				$status_text = "";
				stampanje_tr_a($klasa_tr_a, $status_text, $text_upis);
			}


			/*$klasa_tr_a = "a0 np subcategory $glavna_klasa"; //1-i tr ; menja se samo cultura
			$text_upis = $prvi_text;
			$status_text = '<i class="fa fa-cogs" title="In progress"></i> In progress Inprogress Culture';

			stampanje_tr_a($klasa_tr_a, $status_text, $text_upis);*/
		}


		$klasa_tr_a = "a$index promise $status_klasa $glavna_klasa"; //2-gi tr
		$text_upis = $vest_text;
		$status_text = $statusi_filter[$jedan_unos->status] ;

		stampanje_tr_a($klasa_tr_a, $status_text, $text_upis);


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
