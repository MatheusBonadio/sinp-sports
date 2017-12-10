document.onscroll = function(){
	if(document.documentElement.scrollTop)
		var posicao = document.documentElement.scrollTop;
	else
		var posicao = document.body.scrollTop;
	var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	if(posicao>(height-240))
        $('.container_filter').addClass('absolute');
    else
    	$('.container_filter').removeClass('absolute');

}

function select_filter(id, acao){
	var url;
	if(id)
		url = "/controllers/crud/partida/filterPartida.php?acao="+acao+"&id="+id;
	else
		url = "/controllers/crud/partida/filterPartida.php";
    $.ajax({
        url: url,
        beforeSend: function() {
        	$('html, body').animate({scrollTop:0}, 'slow');
            $('.load').show();
            $('.content_match').hide();
        },
        success: function (data){
            setTimeout(function(){
                $('.load').hide();
                $('.content_match').show();
                $('.content_match').html(data);
            }, 500);
        },
    });
}

function select_match(torneio, id){
    $.ajax({
        url: "/pages/id-partida.php?id="+id,
        beforeSend: function() {
            $('html, body').animate({scrollTop:0}, 400);
            $('#loader').show();
            $('.content').hide();
        },
        success: function (data){
            setTimeout(function(){
                window.history.pushState("", "", "/"+torneio+"/partidas/"+id);
                $('#loader').hide();
                $('.content').show();
                $('.content').html(data);
            }, 500);
        },
    });
}