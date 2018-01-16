var maincat = "all";
var mainperiod = "all";
var klasa_kategorije = "all";


$(function() {

/*$(".progress").parent().hover(function() {
  // Stuff to do when the mouse enters the element 
 $(this).find(".progress>span").addClass("mouseover");
}, function() {
  // Stuff to do when the mouse leaves the element 
  $(this).find(".progress>span").removeClass("mouseout");
});
*/

  

    $(".reset-dugme").click(function(ev) {

        //resetovanje();
        $(".reset-search").trigger( "click" );
    })

    $(".dugme").click(function(ev) {

        var ime = $(this).attr('class');
        var d_klasa = "";
        var tekst_temp = "";


        $(".dugme").removeClass(function(index, css) {
            return (css.match(/period-\d+-gornji$/g) || []).join(' ');
        });

        $(".dugme").removeClass('dugme-active')



        if (ime.indexOf('period-14') != -1) {
            d_klasa = "period-14";
            tekst_temp = "Prvi potpredsednik Vlade Republike Srbije";
            mainperiod = "period-14";
        } else if (ime.indexOf('period-16') != -1) {
            d_klasa = "period-16";
            tekst_temp = 'Predsednik Vlade Republike Srbije - prvi mandat';
            mainperiod = "period-16";
        } else if (ime.indexOf('period-X') != -1) {
            d_klasa = "period-X";
            tekst_temp = 'Predsednik Vlade Republike Srbije - drugi mandat';
            mainperiod = "period-X";
        }
        else if (ime.indexOf('period-17') != -1) {
            d_klasa = "period-17";
            tekst_temp = 'Predsednik Republike Srbije';
            mainperiod = "period-17";
        }
      


        //Ukloni sve koji nisu u tom periodu


        $(this).addClass('dugme-active')
        $(".dugme").removeClass(d_klasa + "-gornji")


        $(".dodatno").show();
        $(".dodatno").html(tekst_temp)
        $dodat = $(".dodatno").removeClass();
        $dodat.addClass("dodatno")
        $dodat.addClass(d_klasa)

        $dodat.addClass(d_klasa + "-donji")
        $(this).addClass(d_klasa + "-gornji")

        if (d_klasa != "period-X") {
            $dodat.addClass("belo")

        }

        ///izmeni brojeve ukupno
        izracunaj();
        ofarbajNaizmenicne();
        filtrirajSelektovane();

    });
})

function init() {

    $("tr:nth-child(2)").removeClass('hidden politika');

    $(".summary a div").on("click", function() {
        maincat = $(this)[0].className;
        filtrirajSelektovane();
        //$(".search input").val($(this).data("search")).change();
    });


    //filtriranje po status
    $(".filter-ikonica-kategorija").click(function(ev) {


        //filter po periodu
        if (this.className.indexOf('period-14-filter') != -1) {
            //assinged through triggered click
            //mainperiod = "period-14";
            $(".dugme.period-14-filter").trigger( "click" );
        } else if (this.className.indexOf('period-16-filter') != -1) {
            //mainperiod = "period-16";
            $(".dugme.period-16-filter").trigger( "click" );
        } else if (this.className.indexOf('period-X') != -1) {
            //mainperiod = "period-X";
            $(".dugme.period-X-filter").trigger( "click" );
        }
        else if (this.className.indexOf('period-17') != -1) {
            //mainperiod = "period-17";
            $(".dugme.period-17-filter").trigger( "click" );
        }
        filtrirajSelektovane();
        //ofarbajNaizmenicne();
        //$(".a-1.category:visible").slice(1).hide();

    })

    $("input[type=search]").on("keyup search input paste cut change", function() {
        var filter = $(this).val();
        count = 0;

        var period_temp = vratiPeriod();
        if (period_temp != "")
            period_temp = "." + period_temp + " ";

        $("tr" + period_temp).each(function() {
            if ($(this).text().search(new RegExp("\\s+" + filter, "i")) < 0) {
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

    $(".reset-search").on("click", function() {

        resetovanje();

        $(".search input").val("").change()
        $("tr.a-1").hide();



        if ($(".tabs li.active>a ").attr("class").indexOf("all") != -1) {
            //prebaci na sve izjave
            $("tr").show();

            ofarbajNaizmenicne();
            $(".a-1.category:visible").slice(1).hide();

            return;
        }
    });

    $(".tabs a").on("click", filtrirajSelektovane);




}


function filtrirajSelektovane() {
//console.log("filter");


if (this.nodeName == undefined) {
        $(".tabs li.active a").addClass("selected");
} else{
        $(".tabs a").removeClass("selected"); //iskljuci prethodno selektovane
        $(this).addClass("selected"); // trenutnom tabu daj klasu selektovan
}

        $("tr").each(function() {
            var temp_la = this;
            var uslov_temp = true;

            // mainperiod  (all, period-X, period-16, period-14)
            if(mainperiod == "all"){
                    uslov_mainperiod = true;
                }else {
                    uslov_mainperiod = $(temp_la).hasClass(mainperiod);
                }


            // maincat class (beleznica, uprocesu, ispunjeno, neispunjeno)
            if(maincat == "all"){
                    uslov_maincat = true;
                }else {
                    uslov_maincat = $(temp_la).hasClass(maincat);
                }

            //klasa kategorije -- ekonomija, politika, ...
            klasa_kategorije = $(".selected").attr("class").split(" ")[0];
            //var klasa_kategorije = $(".selected").classList()[0];


            if(klasa_kategorije == "all"){
              uslov_temp = true;
              }
            else {
              uslov_temp = $(temp_la).hasClass(klasa_kategorije);
            }


            // do the show/hide
            if ( uslov_temp && uslov_maincat && uslov_mainperiod   ) {
                    $(temp_la).show()
            } else {
                $(temp_la).hide()
            }

if(maincat=="all"){
        $("tr:nth-child(2)").removeClass('hidden');
}else{
        $("tr:nth-child(2)").addClass('hidden');
}


//console.log("field:"+temp_la.className+"/ klasa kategorija:"+klasa_kategorije+"/ mainkat:"+maincat+"/ period:"+mainperiod)



        });




    ofarbajNaizmenicne();
    $(".a-1.category:visible").slice(1).hide();
}

function ofarbajNaizmenicne() {
    $("tr:visible:odd").css('background-color', 'rgba(0, 0, 0, .03)');
    $("tr:visible:even").css('background-color', 'white');

}

function vratiPeriod() {

    var dugme_active = $('.dugme-active').attr('class') || "";
    var d_klasa = "";

    if (dugme_active.indexOf('period-14') != -1) {
        d_klasa = "period-14";
    } else if (dugme_active.indexOf('period-16') != -1) {
        d_klasa = "period-16";
    } else if (dugme_active.indexOf('period-X') != -1) {
        d_klasa = "period-X";
    }else if (dugme_active.indexOf('period-17') != -1) {
        d_klasa = "period-17";
    }

    return d_klasa;
}

function izracunaj() {

    //uzmi selektovan tab

    var period_temp = vratiPeriod();

    var grandtotal = $("tr.obecanje").length;

    if (period_temp == "period-14")
        grandtotal = $("tr.obecanje.period-14").length;
    else if (period_temp == "period-16")
        grandtotal = $("tr.obecanje.period-16").length;
    else if (period_temp == "period-X")
        grandtotal = $("tr.obecanje.period-X").length;
    else if (period_temp == "period-17")
        grandtotal = $("tr.obecanje.period-17").length;

    if (period_temp != "")
        period_temp = "." + period_temp + " ";

    //setovanje ukupnih
    $(".summary b.count").each(function() {
        var classOfSuperCategory = $(this).closest("div").attr("class");
        var numberInSuperCategory = $("tr." + classOfSuperCategory + period_temp).length;
        $(this).html(numberInSuperCategory);
    });


    $(".summary b.total").each(function() {
        $(this).html(grandtotal)
    });



    $(".summary p.progress span").each(function() {

        var br_uk = $("tr." + $(this).closest("div").attr("class") + period_temp);

        $(this).css("width", (br_uk.length * 100 / grandtotal) + "%")
    });


    $("tr.category b").each(function() {

        //just show all results for maincat - dont show results for subcat -
        $(this).html(   $(".summary ."+$(this).parent().attr("class").replace(" col-md-3 col-xs-6", '')+" b.count").html()     );
    });


    //racunanje barova u tabovima

    $("tr.category p.progress span").each(function() {

        var $pra_roditelj = $(this).parent().parent();
        var classOfCategory = $pra_roditelj.children("b").attr("class");
        var total = $("tr.obecanje." + classOfCategory).length;
        var neki_selektor =
            $("tr." + $pra_roditelj.attr("class").replace(" col-md-3 col-xs-6", '') +
                "." + $pra_roditelj.children("b").attr("class") + period_temp);

        $(this).css("width", (neki_selektor.length * 100 / total) + "%")
    });


    ofarbajNaizmenicne();
    $(".a-1.category:visible").slice(1).hide();

}



//ovde bi verovatno trebao da bude php datum
function datum() {

    var a = document.getElementById("svg1");
    var doc = a.getSVGDocument();
    var text = doc.querySelector("text"); // suppose our image contains a <rect>
    //text.setAttribute("fill", "green");
    text.textContent = Math.ceil((new Date() - new Date(2012, 6, 27)) / (1000 * 60 * 60 * 24));

}


function solid() {
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


    $("span.kategorija").each(function() {
        var broj = +$(this).html();
        if (broj == 0) {
            var klasa = $(this).attr("class").split(" ")[1];
            $("a." + klasa).hide();
        }

    })

}

function resetovanje() {
    maincat = "all";
    mainperiod = "all";
    //maincatperiod = "all";
    //manualy change tab
    //$(".tabs li a").removeClass("selected");
    $(".tabs li:first-child a").trigger("click");

    $("tr:nth-child(2)").removeClass('hidden');
    //ukloni active klasu
    $('.dugme-active').removeClass('dugme-active');
    //sakrij deo sa tekstom
    $(".dodatno").hide();
    izracunaj();
}

    function hideBanner( ) {
        $("#banner").hide();
    }

$(window).load(function() {
    datum();
    scrollInit()
    $('table').load("lista.html?"+Math.floor((Math.random() * 1000) + 1), function(x) {
        izracunaj();
        init();
        sakrij();
        $(".dim-layer").remove()

        window.setTimeout(hideBanner, 5*1000);


    });

    var a = document.getElementById("svg1").contentDocument;

    d3.select(a).on("click", function(event){
        $(".reset-search").trigger( "click" );
    });

    $(window).scroll(
        function() {
            solid();
        }

    );


});
