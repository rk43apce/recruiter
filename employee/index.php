<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../core/init.php'; 
require_once '../functions/sanitize.php'; 
if (Input::exists('post')) {
    if (Token::check(Input::get('token'))) {
        
        $username =  escape(Input::get('username'));
        $password = escape(Input::get('password'));   
        $userLogin = new Login();
		if ($userLogin->loginEmployee($username, $password)) {			
		
			Redirect::to('./dashboard.php');

			
		}    
    }    
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log In | Blueyed</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
    	.card {
    		max-width: 686px;
    		margin-top: 10%;
    		margin-left: auto;
    		margin-right: auto;

    	}
    </style>
</head>

<body>
    <div class="container">
        <div  class="card">
        	<div class="card-body">
	            <form action="" method="post">
	              <fieldset>
	                <legend>Log In</legend>                
	                <div class="form-group">
	                  <label for="exampleInputEmail1"> Username / Email address</label> 
	                  <input type="email" name="username" class="form-control" placeholder="Username" required="" autofocus>                
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputPassword1">Password</label>
	                  <input type="password" name="password" class="form-control" placeholder="Password" required="">
	                </div>      
	                 <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">  
	                <button type="submit" class="btn btn-primary" autofocus>Log In</button>
	              </fieldset>
	            </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script src="../js/script.js"></script>
</body>

</html>