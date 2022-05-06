<?php

$url = Route::ctrRoute();

session_destroy();

if(!empty($_SESSION['id_token_google'])){

	unset($_SESSION['id_token_google'] );


}




echo '

	<script>
		
		localStorage.removeItem("user");
		localStorage.clear();
		window.location= "'.$url.'";

	</script>




';