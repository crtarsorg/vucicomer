<?php


	ob_start();

	$podaci_json = file_get_contents("data.json");
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
		//beleznica

		18 => "Ispunjeno",
		23 => "Skoro ispunjeno",
		22 => "Radi se na tome",
		19 => "Krenuli pa stali",
		20 => "Neispunjeno",
		21 => "Ni započeto",
		);


	$statusi_trenutno =  array(18=>"achieved", 12=>"achieved", 22 =>'inprogress' , 15 =>'inprogress', 16 =>'inprogress' , 20=>'notstarted', 21=>'notstarted', 14=>'notstarted', 17=>'notstarted', 13=>'notstarted');

	/*$tip_ocena = array_map(
				function ($el){	return $el->tip_ocena;	},
				$podaci);

	$tip_ocena = array_unique($tip_ocena);*/


	$kategorije = array('24' =>'Politika', '25' =>'Ekonomija', '26' =>'Kultura', '27' =>'Zdravstvo', '28' =>'Društvo',  );
	$kategorije = array(24 =>'government', 25 =>'economy', 26 =>'culture', 27 =>'environment', 28 =>'security',  );
	/*"culture",
	"economy",
	"environment",
	"government",
	"immigration",
	"indigenouspeoples",
	"security",*/


	function stampanje_tr_a ($klasa_tr_a='', $status_txt = "", $text_upis = '')
	{
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

	foreach ($podaci as  $jedan_unos) {


			if( $kategorija_flag == $jedan_unos->kategorija )
			{
				$brojac_vesti ++;
				$brojac_kategorija ++;

			}
			else
			{
				$brojac_kategorija = 0;
				$brojac_vesti = 0;
				$kategorija_flag = $jedan_unos->kategorija;

			}
				//druga kategorija

			if(!empty($jedan_unos->kategorija ))
				$glavna_klasa =	$kategorije[ $jedan_unos->kategorija ] ;
			else
				$glavna_klasa = "indigenouspeoples";


			$naslov_vesti = $jedan_unos->naslov;
			$title_status =  'In progress'; //$jedan_unos->tip_ocena;
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
		if( !empty( $jedan_unos->status ) ){
			$status_klasa = intval( $jedan_unos->status) ;
			if(in_array( $status_klasa , array_keys($statusi_trenutno) ) )
				$status_klasa = $statusi_trenutno[ $status_klasa ] ;
		}




		if($brojac_vesti == 0  )	{

			if($brojac_kategorija == 0){
				$klasa_tr_a = "a0 np category $glavna_klasa"; //0-ti tr; menja se samo cultura
				$text_upis = $nulti_text;
				$status_text = "";
				stampanje_tr_a($klasa_tr_a, $status_text, $text_upis);
			}


			$klasa_tr_a = "a0 np subcategory $glavna_klasa"; //1-i tr ; menja se samo cultura
			$text_upis = $prvi_text;
			$status_text = '<i class="fa fa-cogs" title="In progress"></i> In progress Inprogress Culture';

			stampanje_tr_a($klasa_tr_a, $status_text, $text_upis);
		}


		$klasa_tr_a = "a$index promise $status_klasa $glavna_klasa"; //2-gi tr
		$text_upis = $vest_text;
		$status_text = 'Novosti';

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
