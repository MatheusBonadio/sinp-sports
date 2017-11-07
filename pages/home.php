	<div class='slideshow'>
		<div class='highlight_container'>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(public/img/Overwatch.jpg);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						18/08/2017 - Eletrônico
					</div>
					<div class='highlight_sport'>Overwatch</div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						O mundo sempre precisa de novos heróis
					</div>
				</div>
			</div>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(public/img/volei.jpg);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						12/09/2017 - Físico
					</div>
					<div class='highlight_sport'>Vôlei masculino</div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit"
					</div>
				</div>
			</div>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(public/img/Dama.jpg);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						12/09/2017 - Tabuleiro
					</div>
					<div class='highlight_sport'>Dama</div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						Realmente um jogo emocionante
					</div>
				</div>
			</div>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(public/img/annie.jpg);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						11/10/2017 - Eletrônico
					</div>
					<div class='highlight_sport'>League of Legends</div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						Derrotado por uma garotinha
					</div>
				</div>
			</div>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(public/img/FutsalMasculino.jpg);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						11/10/2017 - Físico
					</div>
					<div class='highlight_sport'>Futsal masculino</div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."
					</div>
				</div>
			</div>
		</div>
		<div class='play flex material-icons'>play_arrow</div>
		<div class='play flex material-icons'>pause</div>
		<div class='container_dots flex'>
			<div class='dots_line'></div>
			<div class='group_dots'></div>
			<div class='dots_line'></div>
		</div>
		<div class='arrow flex material-icons' onclick='plusSlides(1)'>keyboard_arrow_right</div>
		<div class='arrow flex material-icons' onclick='plusSlides(-1)'>keyboard_arrow_left</div>
	</div>
	<div class='next_games'>
		<div class='team'>
			1º INFO
		</div>
	</div>
	<script>
		$('#loader').hide();
		var slides = document.getElementsByClassName("highlight_img");
		for(i = 0; i < slides.length; i++){
			var HTMLString = "<div class='dots' onclick='currentSlide("+(i+1)+")'></div>";
			var ref = document.getElementsByClassName("group_dots")[0];
			var div = document.createElement('div');
			div.innerHTML = HTMLString;  
			ref.appendChild(div);
		}
	</script>
	<script src="public/js/index.js"></script>