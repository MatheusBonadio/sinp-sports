var currentHead;

function select_head(n){
    if(currentHead!=n){
        var sites = ["home", "partidas", "esportes", "equipes", "login"];
        var url = "pages/"+sites[n]+".php";
        $.ajax({
            url: url,
            beforeSend: function() {
                $('#loader').show();
                $('.content').hide();
            },
            success: function (data){
                setTimeout(function(){
                    window.history.pushState("", "", "/public_html/"+sites[n]);
                    $('#loader').hide();
                    $('.content').show();
                    $(".content").html(data);
                }, 800);
            },
        });
    }
    currentHead = n;
}