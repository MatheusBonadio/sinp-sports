	<link rel="stylesheet" href="/public/css/login.css" type="text/css">
	<div class='container flex'>
		<form action='../controllers/session/verifyLogin.php' method='POST'>
			<label>login</label>
			<input type='text' name='login' /><br />
			<label>senha</label>
			<input type='password' name='senha' /><br />
			<input type='submit' />
		</form>
	</div>
	<script>slider($('.header a:eq(5)'))</script>