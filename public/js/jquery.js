var currentHead;

function select_head(torneio, n){
    if(currentHead!=n){
        var sites = ["home", "partidas", "esportes", "equipes", "login"];
        var url = "/pages/"+sites[n]+".php";
        $.ajax({
            url: url,
            beforeSend: function() {
                $('html, body').animate({scrollTop:0}, 400);
                $('#loader').show();
                $('.content').hide();
            },
            success: function (data){
                setTimeout(function(){
                    window.history.pushState("", "", "/"+torneio+"/"+sites[n]);
                    $('#loader').hide();
                    $('.content').show();
                    $(".content").html(data);
                }, 800);
            },
        });
    }
    currentHead = n;
}

window.onpopstate = function (event) {
  location.reload();
}