$( document ).ready(function(){
    $(".container").hide();
    
    $(".buttonOption .button").click(function(event) {
        //j'enleve la classe hover sur les bouttons
        $(".buttonOption .button").removeClass("buttonHover");

        //j'ajoute la classe hover sur le boutton cliqué
        $(this).addClass("buttonHover");

        //je cache toutes les divs
        $(".container").hide();

        //j'affiche celle qui correspond au boutton cliqué
        $("." + $(this).val() + "Container").show();
    })
});