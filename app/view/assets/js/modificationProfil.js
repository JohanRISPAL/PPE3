$( document ).ready(function(){
    var name = $("#name"),
        firstname = $("#firstName"),
        login = $("#login"),
        mdp = $("#mdp"),
        confMdp = $("#confiMdp"),
        id = $("#id");

    $("#buttonModif").click(function(event){
            $.ajax({
                data : {modification : 1, id : id.val(), name : name.val(), firstname : firstname.val(), login : login.val(), mdp : mdp.val(), confMdp : confMdp.val()},
                type : "POST",
                url : "app/view/assets/js/ajax_modificationProfil.php",
                success: function(response)
                {
                    document.location.href="index.php?p=profil&modif=true";
                }
            });
            

    }); 
});