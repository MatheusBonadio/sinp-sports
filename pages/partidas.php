	<link rel="stylesheet" href="public/css/partidas.css" type="text/css">
	<script src="public/js/partidas.js"></script>
	<div class='container'>
		<div class='container_filter'>
			<div class='filter_header'>FILTROS</div>
			<div class='filter_header'>ESPORTES</div>
			<div class='filter_line'></div>
			<div class='filter'>League of Legends</div>
			<div class='filter'>Xadrez</div>
			<div class='filter'>Futsal feminino</div>
			<div class='filter'>Vôlei masculino</div>
			<div class='filter_header'>EQUIPES</div>
			<div class='filter_line'></div>
			<div class='filter'>1º Administração</div>
			<div class='filter'>3º Informática</div>
		</div>
		<div class='container_match'>
			<div class='container_stage'>
				<a class='stage' href='#20-11-2017'>20/11</a>
				<a class='stage' href='#21-11-2017'>21/11</a>
			</div>
			<div class='matchs'>
				<div class='date' id='20-11-2017'>Segunda-feira, 20 de Novembro de 2017</div>
				<div class='match'>
					<div class='time flex'>
						<span>11:00 AM</span>
						<span>League of Legends</span>
					</div>
					<div class='teams'>
						<div class='team_a'>
							<div class='team_name'>
								<span>3º Informática</span>
								<span class='victory'>VITÓRIA</span>
							</div>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/hongkong-esports-40hnvdmn.png' width='90%'>
							</div>
						</div>
						<div class='versus flex'>VS</div>
						<div class='team_b'>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/rampage-4caqgbq7.png' width='90%'>
							</div>
							<div class='team_name'>
								<span>3º Administração</span>
								<span class='defeat'>DERROTA</span>
							</div>
						</div>
					</div>
				</div>
				<div class='match'>
					<div class='time flex'>
						<span>12:00 AM</span>
						<span>Xadrez</span>
					</div>
					<div class='teams'>
						<div class='team_a'>
							<div class='team_name'>
								<span>3º Informática</span>
								<span class='defeat'>DERROTA</span>
							</div>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/hongkong-esports-40hnvdmn.png' width='90%'>
							</div>
						</div>
						<div class='versus flex'>VS</div>
						<div class='team_b'>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/rampage-4caqgbq7.png' width='90%'>
							</div>
							<div class='team_name'>
								<span>3º Administração</span>
								<span class='victory'>VITÓRIA</span>
							</div>
						</div>
					</div>
				</div>
				<div class='date' id='21-11-2017''>Terça-feira, 21 de Novembro de 2017</div>
				<div class='match'>
					<div class='time flex'>
						<span>13:00 PM</span>
						<span>Vôlei masculino</span>
					</div>
					<div class='teams'>
						<div class='team_a'>
							<div class='team_name'>
								<span>3º Administração</span>
								<span class='victory'>VITÓRIA</span>
							</div>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/rampage-4caqgbq7.png' width='90%'>
							</div>
						</div>
						<div class='versus flex'>VS</div>
						<div class='team_b'>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/hongkong-esports-40hnvdmn.png' width='90%'>
							</div>
							<div class='team_name'>
								<span>3º Informática</span>
								<span class='defeat'>DERROTA</span>
							</div>
						</div>
					</div>
				</div>
				<div class='match'>
					<div class='time flex'>
						<span>14:00 PM</span>
						<span>Futsal feminino</span>
					</div>
					<div class='teams'>
						<div class='team_a'>
							<div class='team_name'>
								<span>3º Administração</span>
								<span class='defeat'>DERROTA</span>
							</div>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/rampage-4caqgbq7.png' width='90%'>
							</div>
						</div>
						<div class='versus flex'>VS</div>
						<div class='team_b'>
							<div class='team_img flex'>
								<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/hongkong-esports-40hnvdmn.png' width='90%'>
							</div>
							<div class='team_name'>
								<span>3º Informática</span>
								<span class='victory'>VITÓRIA</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var $doc = $('html, body');
		$('.stage').click(function() {
			console.log("crico");
		    $doc.animate({
		        scrollTop: $( $.attr(this, 'href') ).offset().top
		    }, 500);
		    return false;
		});
	</script>
	<script>slider($(".header a:eq(2)"))</script>