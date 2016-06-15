
  


  $(function() {

   

      $(".reset-dugme").click(function(ev) {
        
       resetovanje();
      })      

            $(".dugme").click(function(ev) {


                $(".dugme").removeClass (function (index, css) {
                        return (css.match (/period-\d+-gornji$/g) || []).join(' ');
                    });

                $(".dugme").removeClass('dugme-active')

                var ime = $(this).attr('class');
                var d_klasa = "";
                var tekst_temp = "";

                if(ime.indexOf('period-14')!= -1 ){
                    d_klasa = "period-14";
                    tekst_temp = "Prvi potpredsednik Vlade republike Srbije";
                }
                else if(ime.indexOf('period-16')!= -1 ){
                    d_klasa = "period-16";
                    tekst_temp = 'Predsednik Vlade republike Srbije - prvi mandat';
                }
                else if(ime.indexOf('period-X')!= -1 ){
                    d_klasa = "period-X";
                    tekst_temp = 'Predsednik Vlade republike Srbije - drugi mandat';
                }


                //Ukloni sve koji nisu u tom periodu  

                
                $(this).addClass('dugme-active')
                $(".dugme").removeClass(d_klasa+"-gornji")

                 
                $(".dodatno").show();
                $(".dodatno").html( tekst_temp )
                $dodat = $(".dodatno").removeClass();
                $dodat.addClass("dodatno")
                $dodat.addClass(d_klasa)

                $dodat.addClass(d_klasa+"-donji")
                $(this).addClass(d_klasa+"-gornji")  

                if(d_klasa !="period-X"){
                    $dodat.addClass("belo")
                      
                }

                ///izmeni brojeve ukupno
                izracunaj();
                ofarbajNaizmenicne();

            });
         })

  function init() {

    $(".summary a div").on("click", function () {
        $(".search input").val($(this).data("search")).change()
    });


    //filtriranje po status
    $(".filter-ikonica-kategorija").click(function(ev) {


      //klasa kategorije
      var kl_sel = $("li.active .selected").attr("class");
      if(kl_sel != undefined ){
        kl_sel = kl_sel.replace('selected','').trim();
        
        if(kl_sel == "all")
          kl_sel = "";
        else 
          kl_sel = "." + kl_sel;  
      }
      else kl_sel = "";

      if(kl_sel == ""){
        $("tr.category").hide();

      }

      // kad je all - sakrij sve tr.category

      
      //filter po periodu
      if( this.className.indexOf('period-14-filter')!=-1 ){

        $('tr' + kl_sel ).show() // prikazi samo tu kategoriju
        $('tr div:not(.period-14)').parents().filter('tr' ).hide()
      }
      else if( this.className.indexOf('period-16-filter')!=-1  ) {
        $('tr'+ kl_sel).show()
        $('tr  div:not(.period-16)').parents().filter('tr').hide()
      }
      else if( this.className.indexOf('period-X')!=-1  ) {
        $('tr'+ kl_sel).show()
        $('tr div:not(.period-X)').parents().filter('tr').hide()
      }
      
      ofarbajNaizmenicne();
      $(".a-1.category:visible").slice(1).hide();

    })

    $("input[type=search]").on("keyup search input paste cut change", function () {
        var filter = $(this).val();
        count = 0;


        var period_temp = vratiPeriod();
        if(period_temp != "") 
          period_temp = "." + period_temp + " ";

        $("tr" +period_temp).each(function () {
            if ($(this).text().search(new RegExp("\\s+"+filter, "i")) < 0) {
                $(this).hide()
            } else {
                $(this).show()
                count++;
            };
        });

        if ($(this).val()) {
           
            $(".tabs").addClass("inactive");
            if (count == 1) {
                $("#count").html("1 obećanje")
            } else {
                $("#count").html(count + " obećanja")
            };
        } else {
           
            $(".tabs").removeClass("inactive");
            $("#count").empty();
            $("tr").hide();
            $("tr." + $(".selected").attr("class").split(" ")[0]).show();
        };

        ofarbajNaizmenicne();
        $(".a-1.category:visible").slice(1).hide();
    });

    $(".reset-search").on("click", function () {
        
        resetovanje()

        $(".search input").val("").change()
        $("tr.a-1").hide();

        
        
        if($(".tabs li.active>a ").attr("class").indexOf("all")!=-1 )           
            {
              //prebaci na sve izjave
              $("tr").show();
              
              ofarbajNaizmenicne();
              $(".a-1.category:visible").slice(1).hide();

              return;
            }
    });

    $(".tabs a").on("click", function () {

      var d_klasa = vratiPeriod();


        if (!$(this).parent().hasClass("inactive")) {

            if (!$(this).hasClass("selected")) {
                $(".tabs a").removeClass("selected");
                var klasa = $(this).attr('class');

                $(this).addClass("selected");

                $("tr.a-1").removeClass('hidden')

                if("all" == klasa)
                  {

                    $("tr:not(.a-1)").show();
                    $("tr.a-1").hide();

                    return;
                  }

                $("tr").each(function () {

                  //sta da se radi kad su selektovane sve vesti -> tab all
                    $("tr.a-1"+"."+klasa ).show();
                    //na prvom mestu mora biti
                    var klasa_kategorije = $(".selected").attr("class").split(" ")[0];
                    

                    if ( $(this).hasClass( klasa_kategorije ) /*&& temp_uslov*/ ) {
                        var temp_uslov = (d_klasa!="")?  $(this).hasClass( d_klasa ) : true;
                        if(temp_uslov)
                          $(this).show()
                    } else {
                        $(this).hide()
                    }
                });
            };
        }; // inactive


        ofarbajNaizmenicne();
        $(".a-1.category:visible").slice(1).hide();
    });

}

function ofarbajNaizmenicne() {
  $("tr:visible:odd").css('background-color', 'rgba(0, 0, 0, .03)');
  $("tr:visible:even").css('background-color', 'white');

}

function vratiPeriod() {

  var dugme_active = $('.dugme-active').attr('class') || "";
  var d_klasa ="";

      if(dugme_active.indexOf('period-14')!= -1 ){
          d_klasa = "period-14";      
      }
      else if(dugme_active.indexOf('period-16')!= -1 ){
          d_klasa = "period-16";          
      }
      else if(dugme_active.indexOf('period-X')!= -1 ){
          d_klasa = "period-X";          
      }

  return d_klasa;    
}

function izracunaj () {

  //uzmi selektovan tab

    var period_temp = vratiPeriod();

    var grandtotal = $("tr.obecanje").length;
    
    if(period_temp == "period-14")
      grandtotal = $("tr.obecanje.period-14").length;
    else if(period_temp == "period-16")
      grandtotal = $("tr.obecanje.period-16").length;
    else if(period_temp == "period-X")
      grandtotal = $("tr.obecanje.period-X").length;

    if(period_temp != "") 
        period_temp = "." + period_temp + " ";

    //setovanje ukupnih
    $(".summary b.count").each(function () {
        var classOfSuperCategory = $(this).closest("div").attr("class");
        var numberInSuperCategory = $("tr." + classOfSuperCategory + period_temp).length;
        $(this).html(numberInSuperCategory)
    });


    $(".summary b.total").each(function () {
        $(this).html( grandtotal )
    });

   

    $(".summary p.progress span").each(function () {

        var br_uk = $("tr." + $(this).closest("div").attr("class") + period_temp);

        $(this).css("width", (br_uk.length * 100 / grandtotal) + "%")
    });

    $("tr.category b").each(function () {
        var kategory_tot = 
          $("tr." + $(this).parent().attr("class").replace(" col-md-3 col-xs-6",'') + "." + $(this).attr("class") + period_temp).length;
        $(this).html( kategory_tot)
    });


    //racunanje barova u tabovima 

    $("tr.category p.progress span").each(function () {

        var $pra_roditelj = $(this).parent().parent();
        var classOfCategory = $pra_roditelj.children("b").attr("class");
        var total = $("tr.obecanje." + classOfCategory ).length;
        var neki_selektor =
          $("tr." + $pra_roditelj.attr("class").replace(" col-md-3 col-xs-6",'') + 
              "." + $pra_roditelj.children("b").attr("class") + period_temp);

        $(this).css("width", (neki_selektor.length * 100 / total) + "%")
    });


    ofarbajNaizmenicne();
    $(".a-1.category:visible").slice(1).hide();

}




function datum() {

 var a =  document.getElementById("svg1");
    var doc = a.getSVGDocument();
    var text = doc.querySelector("text"); // suppose our image contains a <rect>
    //text.setAttribute("fill", "green");
    text.textContent = Math.ceil((new Date() - new Date(2014,4,27))/(1000*60*60*24));

  /*$('.summary > div > h2 > b').html(
      
      );*/
}


function solid () {
  if (document.documentElement.scrollTop || document.body.scrollTop) {
      $("header").addClass("solid")
  } else {
      $("header").removeClass("solid")
  }
}






function scrollInit() {
  smoothScroll.init({
      speed: 500,
      offset: 40,
      updateURL: false
  });
}


function sakrij() {


  $("span.kategorija").each(function () {
    var broj = +$(this).html();
    if(broj == 0)
      {
        var klasa = $(this).attr("class").split(" ")[1];
        $("a."+klasa).hide();
      }

  })

}

 function resetovanje() {
        //ukloni active klasu
        $('.dugme-active').removeClass('dugme-active');
         //sakrij deo sa tekstom
         $(".dodatno").hide();
         izracunaj();
    }


 $(window).load(function () {
   datum();
   scrollInit()
   $('table').load("lista.html", function( x ) {
       izracunaj();
       init();
       sakrij();
       $(".dim-layer").remove()
   });


   $(window).scroll(
     function () {
        solid();
     }

   );


 });
