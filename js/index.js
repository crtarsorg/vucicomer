/*
Copyright (c) 2015, Covosoft Corp.
This code and information are provided "as is" without warranty of any kind, either expressed or implied. In no event shall the authors be liable for any claim, damages or other liability arising from, out of or in connection with this site or its use.
Author: Dom Bernard
Email: contact@covosoft.com
Date: 01-Nov-2015
*/


  function init() {

    $(".summary a div").on("click", function () {
        $(".search input").val($(this).data("search")).change()
    });

    $("input[type=search]").on("keyup search input paste cut change", function () {
        var filter = $(this).val();
        count = 0;


        $("tr").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide()
            } else {
                $(this).show()
                count++;
            };
        });

        if ($(this).val()) {
            $(".search button").show();
            $(".tabs").addClass("inactive");
            if (count == 1) {
                $("#count").html("1 match")
            } else {
                $("#count").html(count + " matches")
            };
        } else {
            $(".search button").hide();
            $(".tabs").removeClass("inactive");
            $("#count").empty();
            $("tr").hide();
            $("tr." + $(".selected").attr("class").split(" ")[0]).show();
        };
    });

    $(".search button").on("click", function () {
        $(".search input").val("").change()

        if($(".tabs li.active>a ").attr("class").indexOf("all")!=-1 )           
            {
              $("tr").show();
              return;
            }
    });

    $(".tabs a").on("click", function () {
        if (!$(this).parent().hasClass("inactive")) {
            if (!$(this).hasClass("selected")) {
                $(".tabs a").removeClass("selected");
                var klasa = $(this).attr('class');

                $(this).addClass("selected");



                if("all" == klasa)
                  {

                    $("tr:not(.a-1)").show();
                    $("tr.a-1)").hide();
                    return;
                  }

                $("tr").each(function () {
                    $("tr.a-1)").show();
                    //na prvom mestu mora biti
                    if ($(this).hasClass($(".selected").attr("class").split(" ")[0])) {
                        $(this).show()
                    } else {
                        $(this).hide()
                    }
                });
            };
        };
    });

}



function izracunaj () {

    var grandtotal = $("tr.promise").length;

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
        var total = $("tr.promise." + classOfCategory ).length;
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
   });


   $(window).scroll(
     function () {
        solid();
     }

   );


 });
