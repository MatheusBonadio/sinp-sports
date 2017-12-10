	<div class='footer'>
		<div class='footer_body'>
			<div class='footer_block'>
				<label>Solicitar administração</label>
				<label>Informe seu email para solicitar a administração de um torneio no nossso site para entrarmos em contato.</label>
				<form>
					<input type='email' nome='email' placeholder='Digite seu email' required/>
					<input type='submit' value='ENVIAR' />
				</form>
			</div>
			<div class='footer_block'>
				<label>Sobre nós</label>
				<label>Estudantes da Etec Antonio Devisate do Ensino Técnico de Informática Integrado ao Médio, com o anseio de dominar o mundo dos esportes a partir de sua aplicação Web.</label>
			</div>
			<div class='footer_block'>
				<label>Redes Sociais</label>
				<div class='media'>
					<div class='social'></div>
					<div class='social'></div>
					<div class='social'></div>
				</div>
			</div>
			<div class='footer_block'>
				<label>Voltar ao topo</label>
				<div class='button material-icons flex' id='back_top'>arrow_upward</div>
			</div>
		</div>
		<div class='footer_copy'>
			© Copyright 2017 - Sinp Sports - Todos os direitos reservados
		</div>
		<!-- <div class='footer_body flex'>
			© Copyright 2017 - Sinp Sports - Todos os direitos reservados
		</div> -->
	</div>
	<script>
		$("#back_top").click(function() {
		  $('html, body').animate({scrollTop:0}, 'slow');
		});
	</script>
</body>
</html>