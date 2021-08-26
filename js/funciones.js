$(document).ready(function () {
    
    /* CATEGORIAS LATERAL */
    
    $('.ic_btn_cat_lat').click(function(){
        if($('.colum_categ_categ_int').hasClass('active')){
            $('.colum_categ_categ_int').removeClass('active');
        }else{
            $('.colum_categ_categ_int').addClass('active');
        }
    });
    
    /* BUSCADOR*/
    
    $('.btn_buscador_header').click(function(){
        if($('.cont_gen_buscador').hasClass('active')){
            $('.cont_gen_buscador').removeClass('active');
        }else{
            $('.cont_gen_buscador').addClass('active');
        }
    });
    
    $('.cerrar_buscador').click(function(){
        $('.cont_gen_buscador').removeClass('active');
    });
    
    /*btn_movil*/
    
    $('.btn_menu_movil').click(function(){
        
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('.nav').removeClass('active');
        }else{
            $(this).addClass('active');
            $('.nav').addClass('active');
        }
    });
    
    $('.menu_pri li .material-icons').click(function(){
        $(this).next('.submenu_prin').slideToggle('fast');
    });
    
    /* MENU INGRESO */
    
    $('.cont_ingresado').click(function(){
        
        $('.cont_submenu_ingreso').slideToggle('fast');
    });
    
    
    
    /*carrusel entrena equipo*/
    
    var swiper = new Swiper('.crrusel_cursos_entrena_equipo .swiper-container', {
        autoplay: {
            delay: 6000,
        },
        speed:1000,
        slidesPerView:3,
        slidesPerGroup:3,
        breakpoints:{
            768:{
                slidesPerView:2,
            } ,
            480:{
                slidesPerView:1,
            }
        },
        pagination: {
            el: ".crrusel_cursos_entrena_equipo .swiper-pagination",
            clickable: true,
        },
    });
    /* DESPLEGAR respuestas ayuda*/
    
    $(".btn_preg").click(function(){
        
        if($(this).hasClass('active')){
            $(".btn_preg").removeClass('active');
            $(".despl_res").slideUp("fast");
        }else{
            $(".btn_preg").removeClass('active');
            $(this).addClass('active');
            $(".despl_res").slideUp("fast");
            $(this).next(".despl_res").slideDown("fast");
        }
        
    });
    
    /*CARRUSEL ENTRENADORES*/
    
    var swiper = new Swiper(".cont_list_entrenadores_home .swiper-container", {
         slidesPerView:4,
        breakpoints:{
            1050:{
                slidesPerView:3,
            },
            768:{
                slidesPerView:2,
            } ,
            480:{
                slidesPerView:1,
            }
        },
        pagination: {
            el: ".cont_list_entrenadores_home .swiper-pagination",
            clickable: true,
        },
      });
    /*CARRUSEL TESTIMONIOS*/
    
     var swiper = new Swiper(".carrusel_testm .swiper-container", {
         slidesPerView:3,
         breakpoints:{
            768:{
                slidesPerView:2,
            } ,
            480:{
                slidesPerView:1,
            } 
        },
        navigation: {
          nextEl: ".carrusel_testm .swiper-button-next",
          prevEl: ".carrusel_testm .swiper-button-prev",
        },
      });
    /*CARRUSEL CLIENTES*/
    
     var swiper = new Swiper(".carrusel_clientes .swiper-container", {
         slidesPerView:5,
         breakpoints:{
            1050:{
                slidesPerView:4,
            },
            768:{
                slidesPerView:3,
            } ,
            480:{
                slidesPerView:2,
            } 
        },
        navigation: {
          nextEl: ".carrusel_clientes .swiper-button-next",
          prevEl: ".carrusel_clientes .swiper-button-prev",
        },
      });
    
    /*BANNER HOME*/
    
    var swiper = new Swiper('.cont_banner_home .swiper-container', {
        autoplay: {
            delay: 6000,
        },
        speed:1000,
        pagination: {
            el: ".cont_gen_banner_home .swiper-pagination",
            clickable: true,
        },
    });
    
    
    
    
    
    /*----detectar elemento entrar viewport para animacion */
       
       if ($(window).width() >= 1200) {
   
           $.fn.isInViewport = function() {
              var elementTop = $(this).offset().top;
              var elementBottom = elementTop + $(this).outerHeight();

              var viewportTop = $(window).scrollTop();
              var viewportBottom = viewportTop + $(window).height();

              return elementBottom > viewportTop && elementTop < viewportBottom;
            };
           
           
           $(window).on('resize scroll', function() { 

               $('.in_down, .in_left, .in_right').each(function() {
                   
                   if($(this).isInViewport()){

                       $(this).addClass('act_anim');
                   }else{
                       //$(this).removeClass('act_anim');
                   }
                   
               });

            });
       }else{
           $('.in_down, .in_left, .in_right').addClass('act_anim');
       }
    /*---*/
    
       
});



    /* PESTAÑAS CATEGORIAS MEDIO PAGO*/
    
    const catg = document.querySelectorAll(".pest_med_pago");
    const infCatg = document.querySelectorAll(".cont_gen_inf_form_med_pag");

    let selectCatg = null;
    
    catg.forEach((pest) => {
       
        pest.addEventListener("click", (e) => {
            catg.forEach((el) => {
                el.classList.remove("active");
            });
            e.currentTarget.classList.toggle("active");
            
            selectCatg = pest.dataset.cat;
            
            infCatg.forEach((infel) => {
               if(infel.dataset.cat === selectCatg){
                   infel.classList.add("active_info");
               }else{
                   infel.classList.remove("active_info");
               } 
            });
        });
        
    });

function init() {
    window.addEventListener('scroll', function (e) {
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 40,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header, "smaller");
            $("header").addClass('smaller');

        } else {
            if (classie.has(header, "smaller")) {
                classie.remove(header, "smaller");
                $("header").removeClass('smaller');
            }
        }
    });
}
window.onload = init();


const btnSideMisCursos = document.querySelectorAll('.m_side_miscursos .h_lat_categ');
const containerMisCursos = document.querySelectorAll('.colum_list_cursos');
const slideMenu = document.querySelectorAll('.m_subs_categ');
let compareCat = null

btnSideMisCursos.forEach((buttonEl) =>{
    buttonEl.addEventListener('click', (e) =>{
        buttonEl.classList.remove('active_slide_menu_s');
        e.currentTarget.classList.toggle('active_slide_menu_s');

        compareCat = buttonEl.dataset.miscursos;

        // CONTAINER

        containerMisCursos.forEach((elContainer) =>{
            if(elContainer.dataset.miscursos === compareCat){
                elContainer.classList.add('act_container')
            }else{
                elContainer.classList.remove('act_container')
            }
        })

        
    })
});