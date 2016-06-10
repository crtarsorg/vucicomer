
  


  $(function() {
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

                 

                $(".dodatno").html( tekst_temp )
                $dodat = $(".dodatno").removeClass();
                $dodat.addClass("dodatno")
                $dodat.addClass(d_klasa)

                $dodat.addClass(d_klasa+"-donji")
                $(this).addClass(d_klasa+"-gornji")  

                if(d_klasa !="period-X"){
                    $dodat.addClass("belo")
                      
                }
            });
         })

  function init() {

    $(".summary a div").on("click", function () {
        $(".search input").val($(this).data("search")).change()
    });


    //filtriranje po status
    $(".filter-ikonica").click(function(ev) {


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


    })

    $("input[type=search]").on("keyup search input paste cut change", function () {
        var filter = $(this).val();
        count = 0;


        $("tr").each(function () {
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
    });

    $(".reset-search").on("click", function () {
        $(".search input").val("").change()
        $("tr.a-1").hide();
        
        if($(".tabs li.active>a ").attr("class").indexOf("all")!=-1 )           
            {
              $("tr").show();
              return;
            }
    });

    $(".tabs a").on("click", function () {

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


    });

}



function izracunaj () {

    var grandtotal = $("tr.obecanje").length;

    $(".summary b.count").each(function () {
        var classOfSuperCategory = $(this).closest("div").attr("class");
        var numberInSuperCategory = $("tr." + classOfSuperCategory).length;
        $(this).html(numberInSuperCategory)
    });

    $(".summary b.total").each(function () {
        $(this).html(grandtotal)
    });

    $(".summary p.progress span").each(function () {
        $(this).css("width", ($("tr." + $(this).closest("div").attr("class")).length * 100 / grandtotal) + "%")
    });

    $("tr.category b").each(function () {
        $(this).html($("tr." + $(this).parent().attr("class") + "." + $(this).attr("class")).length)
    });

    $("tr.category p.progress span").each(function () {
        var classOfCategory = $(this).parent().parent().children("b").attr("class");
        var total = $("tr.obecanje." + classOfCategory ).length;
        $(this).css("width", ($("tr." + $(this).parent().parent().attr("class") + "." + $(this).parent().parent().children("b").attr("class")).length * 100 / total) + "%")
    });


}


function datum() {
  $('.summary > div > h2 > b').html(
      Math.ceil((new Date() - new Date(2014,4,27))/(1000*60*60*24))
      );
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
