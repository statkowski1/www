$(document).ready(function(){
    $("#animacjaTestowa1").on("click", function(){
        $(this).animate({
            width: "500px",
            opacity: 0.4,
            fontSize: "3em",
            borderWidth: "10px"
        }, 1500)
    });
});