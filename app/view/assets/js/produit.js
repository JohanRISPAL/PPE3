$( document ).ready(function(){ 
    $(".description").show();
    $(".review").hide();

    $("#descriptionButton").click(function(event){
        $("#descriptionButton").removeClass("nonactive");
        $("#descriptionButton").addClass("active");

        $("#reviewButton").removeClass("active");
        $("#reviewButton").addClass("nonactive");

        $(".description").show();
        $(".review").hide();
    }); 

    $("#reviewButton").click(function(event){
        $("#descriptionButton").removeClass("active");
        $("#descriptionButton").addClass("nonactive");

        $("#reviewButton").removeClass("nonactive");
        $("#reviewButton").addClass("active");

        $(".description").hide();
        $(".review").show();
    });
});

