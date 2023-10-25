$(function(){
    setTimeout(function(){
        $("#preloader").fadeOut(1000);}, 2000);
});

function filterProducts(producent) {
    const form = document.createElement('form');
    form.method = 'post';
    form.action = 'products.php';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'producent';
    input.value = producent;

    form.appendChild(input);
    document.body.appendChild(form);

    form.submit();
}


jQuery(document).ready(function($) {
    var alterClass = function() {
      var ww = document.body.clientWidth;
      if (ww < 940) {
        $('.navbar_main_mobile').removeClass('menu_hamburger_close');
        
        //console.log("dodana, szerokosc: " + ww);
  
      } else if (ww >= 940) {
        $('.navbar_main_mobile').addClass('menu_hamburger_close');
        //console.log("usunieta, szerokosc: " + ww);
      };
    };
    $(window).resize(function(){
      alterClass();
    });
    alterClass();
  });
  
  //POKAZUJE LISTE PO KLIKNIECIU W HAMBURGERKA
  function show_hamburger_list() {
    var x = document.getElementById("myLinks");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  
  //GDZIEKOLWIEK SIĘ NIE KLIKNIE TO HAMBURGEREK REAGUJE
  function click_whole_box_hamburger(){
    $(".ham").toggleClass("active ");
  }
  
  
  //OTWIERA STRONE DZIENNIKA
  function otworz_dziennik(){
    window.open('www.dziennik.zse-zdwola.pl', '_blank');
  }
  
  
  //DODAWANIE PLIKÓW, KLIKANIE PRZYCISKU, NIE WIEM CO 
  $('.panel_dodawanie_plikow_przycisk').on('click', function() { 
    $('#zal').click();
    return false;
  });

