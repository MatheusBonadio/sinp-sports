var currentHead;

function select_head(torneio, n){
    var path = last_word();
    var sites = ["home", "partidas", "esportes", "destaques", "login"];
    var url = "/pages/"+sites[n]+".php";
    if(path=="")
        path = sites[0];
    if(path!=sites[n]){
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
}

window.onpopstate = function (event) {
  location.reload();
}

function last_word(){
    var path = window.location.pathname;
    path = path.split('').reverse().join('');
    var indexPath = path.indexOf("/");
    path = path.substring(0, indexPath);
    path = path.split('').reverse().join('');
    path = path.replace("/", "");
    return path;
}