<?php require_once '../core/init.php';

Login::isUservalid('admin');  

if (Input::exists('post')) {

	if (Token::check2('newAssingment', Input::get('token'))) {
		# code...
		$assingmentId =  Input::get('assingmentId');
		$companyId =  Input::get('companyId');
		$jobRoleId =  Input::get('jobRoleId');
		$jobCity =  Input::get('jobCity');
		$noOfPosition =  Input::get('noOfPosition');
		$clientBrief =  Input::get('clientBrief');
		$spocId =  Input::get('spocId');
		$recruiters =  Input::get('recruiters');
		$createdOn = date("Y/m/d"); 

		$assingmentData = array("assingmentId"=>$assingmentId, "companyId"=>$companyId, "jobRoleId"=>$jobRoleId, "jobCity"=>$jobCity, "noOfPosition"=>$noOfPosition, "clientBrief"=>$clientBrief, "spocId"=>$spocId, "createdOn"=>$createdOn);

		$assingment = new Assingment();

		if ($assingment->createNewAssingment($assingmentData)) {				

			if (count($recruiters)) {

				if ($assingment->assignAssingmnetToEmployee($assingmentId, $recruiters, $createdOn)) {

					Session::put('isAssingmentCreated', true);	
					Session::put('errorMsg', 'Assingment successfully created!');				
				} else {

					Session::put('errorMsg', 'Assingment created!, but fail to assingment to recruiter!');
				}

			}
			else {

				Session::put('assingmentCreated', 'Assingment successfully created!');
			}
	
		} else {

				Session::put('errorMsg', 'Sorry!, fail to create new assingment');
		}

		
	}

}elseif (Input::exists('get')) {	


		$assingmentId = Input::get('assingmentId');

		$assingment =  new Assingment();	
		 
		 $assingmentData = $assingment->getOnGoingAssingmentById($assingmentId);
		 echo "<pre>";
		 var_dump($assingmentData);
		 echo "</pre>";

		echo  $assingmentData['assingmentId'] ;

}    
    
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
	<?php require_once  '../include/css.php'; ?>   
	 <script>
        window.onload = function () {
            var assingmentId = new Date().getTime(); // generating student registation by using tim in milliseconds

            document.getElementById( "assingmentId" ).value = assingmentId;
        };
    </script> 
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/sidebar.php'; ?> 

        <!-- Page Content Holder -->
        <div id="content">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/navbar-top.php'; ?>           

            <div class="container">

                <div class="card">    
                	
                    <h2>New Assingment</h2>    

                    <span> 

                    	<p class="text-success">

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                      </p>
                  	</span>                   

                    <div class="line"></div>

                    <form method="post" action="">
					  <fieldset>

	                    <input type="hidden" name="assingmentId" id="assingmentId" value="">
	            
							    						    
					    <div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <label for="companyId">Company</label>

							      <input type="" class="form-control" id="companyName" name="companyId" value="companyName" readonly>
							      
							    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="jobRoleId">Role</label>
									<input type="" class="form-control" id="jobRoleId" name="jobRoleId" value="companyName" readonly>
								</div>
							</div>
					    </div>
					      <div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <label for="jobCity">City</label>																	
									<input type="" class="form-control" id="jobCity" name="jobCity" value="companyName" readonly>
							    </div>
							</div>
							<div class="col-md-6">								
								<div class="form-group">
									<label for="noOfPosition" >Number of position</label>
									<input type="" class="form-control" id="noOfPosition" name="noOfPosition" value="companyName" required="">								    
								  </div>
							</div>
					    </div>

					    <div class="form-group">
					      <label for="clientBrief">Client brief note</label>
					      <textarea class="form-control" rows="3" id="clientBrief" name="clientBrief">
					      	Client brief note
					      </textarea>
					    </div>

					   <div class="form-group">
							<label for="spocId">Chnage SPOC</label>
							<select class="ui fluid search dropdown"  required="" id="spocId" name="spocId">					
								<option  value="SPOC 1" selected="">SPOC 1</option>
								<option  value="SPOC 2">SPOC 2</option>
								<option  value="SPOC 3">SPOC 3</option>
								<option  value="SPOC 4">SPOC 4</option>
							</select>
					    </div>	
					     <div class="form-group">
							<label for="recruiters">Chnage additional recruiters (Optional)</label>
							<select class="ui fluid search dropdown" multiple=""  id="recruiters" name="recruiters[]">
								<option value=""> Choose Employee(multiple) </option>
								<option  value="Employee 1" selected="">Employee 1</option>
								<option  value="Employee 2" selected="">Employee 2</option>
								<option  value="Employee 3">Employee 3</option>
							</select>			   
					    </div>						 
					  <input type="hidden" name="token" value="<?php echo Token::generate2('newAssingment'); ?>">  
					  	<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Update Assingment</button>
						<a href="./dashboard.php" class="btn btn-link">Back to Dashboard</a>
					  </fieldset>
					</form>                 
                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>

     <script>
	    $('.ui.dropdown')
	    .dropdown();
    </script>

	  <script type="text/javascript">
	    function confirmFormSubmit() {
	    	return confirm('Are you sure you want to save this thing into the database?');
	    }
	   </script> 
  </body>

</html>