$(document).ready(function() {

	$("#search").val("");
	$("#search").focus();
    getDados();
	$("#search").keyup(function() {
        getDados();
	});
	$(".search_icon").click(function() {
        getDados();
	});

});

function getDados(){
	$.ajax({
        url: "/controllers/crud/torneio/searchTorneio.php?search="+$("#search").val(),
        success: function (data){
            $(".results").html(data);
        },
    });
}