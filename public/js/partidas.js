document.onscroll = function(){
	if(document.documentElement.scrollTop)
		var posicao = document.documentElement.scrollTop;
	else
		var posicao = document.body.scrollTop;
	var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	
	if(posicao>=(height-150)){
        $('.container_filter').addClass('absolute');
	}
    else
    	$('.container_filter').removeClass('absolute');
}