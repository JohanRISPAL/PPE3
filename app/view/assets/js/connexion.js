$( document ).ready(function(){
    var user = $("#username"),
        pwd = $("#password");
        
    $(".errorConnexion").hide();
    $(".errorEmpty").hide();
    $(".loginEmpty").hide();
    $(".passEmpty").hide();

    $("#buttonConnexion").click(function(event){
            $.ajax({
                data : {connexion : 1, user : user.val(), pass : pwd.val()},
                type : "POST",
                url : "app/view/assets/js/ajax_connexion.php",
                success: function(response)
                {
                    if(user.val() == "" || pwd.val() == ""){
                        if(user.val() == "" && pwd.val() != "" ){
                            $(".errorConnexion").hide();
                            $(".errorEmpty").hide();
                            $(".loginEmpty").show();
                            $(".passEmpty").hide();
                        }else if(user.val() != "" && pwd.val() == ""){
                            $(".errorConnexion").hide();
                            $(".errorEmpty").hide();
                            $(".loginEmpty").hide();
                            $(".passEmpty").show();
                        }else if (user.val() == "" && pwd.val() == ""){
                            $(".errorConnexion").hide();
                            $(".errorEmpty").show();
                            $(".loginEmpty").hide();
                            $(".passEmpty").hide();
                        }
                    }else{
                        var reponse = JSON.parse(response);
                        if(reponse == ""){
                            $(".errorConnexion").show();
                            $(".errorEmpty").hide();
                            $(".loginEmpty").hide();
                            $(".passEmpty").hide();
                        }else{
                            document.location.href="index.php";
                        }
                    }
                }
            });
            
    });    
});

