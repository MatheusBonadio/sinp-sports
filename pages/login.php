	<link rel="stylesheet" href="/public/css/login.css" type="text/css">
	<div class='container'>
		<div class='background_left'></div>
		<div class='form_login flex'>
			<form action='/controllers/session/verifyLogin.php' class='flex' method='POST'>
				<div class='form_title'>Login</div>
				<input type='text' name='login' maxlength='20' placeholder='Login' autocomplete='off' required/>
				<input type='password' name='senha' maxlength='20' placeholder='Senha' autocomplete='off' required/>
				<input type='submit' />
			</form>
		</div>
	</div>
	<script>slider($('.header a:eq(5)'))</script>