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

					Session::put('errorMsg', 'Assingment successfully created!');
				
				}
			}
			else {

				Session::put('assingmentCreated', 'Assingment successfully created!');
			}
	
		} else {

				Session::put('errorMsg', 'Sorry!, fail to create new assingment');
		}

		
	}

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

                    <span> <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  </span>                   

                    <div class="line"></div>

                    <form method="post" action="">
					  <fieldset>

	                    <input type="hidden" name="assingmentId" id="assingmentId" value="">
	            
							    						    
					    <div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <label for="companyId">Company</label>
							      <select class="form-control" id="companyName" name="companyId" autofocus>
							        <option value="1">Company 1</option>
							        <option value="2">Company 2</option>
							        <option value="3">Company 3</option>
							        <option value="4">Company 4</option>
							        <option value="5">Company 5</option>
							      </select>
							    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
							      <label for="jobRoleId">Role</label>
								      <select class="form-control" id="jobRoleId" name="jobRoleId">
								        <option value="1">Role 1</option>
								        <option value="2">Role 2</option>
								        <option value="3">Role 3</option>
								        <option value="4">Role 4</option>
								        <option value="5">Role 5</option>
								      </select>
							    	</div>
								</div>
					    </div>
					      <div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <label for="jobCity">City</label>
							      <select class="form-control" id="jobCity" name="jobCity">
							      	<option >Choose city</option>
							        <option value="Haryana">City 1</option>
							        <option value="Pune">City 2</option>
							        <option value="Mumbai">City 3</option>
							        <option value="Kolkata">City 4</option>
							        <option value="Chennai">City 5</option>
							      </select>
							    </div>
							</div>
							<div class="col-md-6">
								<label for="noOfPosition" >Number of position</label>
								<div class="form-group">
								    <select class="custom-select" id="noOfPosition" name="noOfPosition">
								      <option >Choose position</option>
								      <option value="1">One</option>
								      <option value="2">Two</option>
								      <option value="3">Three</option>
								    </select>
								  </div>
							</div>
					    </div>

					    <div class="form-group">
					      <label for="clientBrief">Client brief note</label>
					      <textarea class="form-control" rows="3" placeholder="Write here..." id="clientBrief" name="clientBrief"></textarea>
					    </div>

					   <div class="form-group">
							<label for="spocId">Assign SPOC</label>
							<select class="ui fluid search dropdown"  required="" id="spocId" name="spocId">
								<option value=""> Choose SPOC </option>
								<option  value="SPOC 1">SPOC 1</option>
								<option  value="SPOC 2">SPOC 2</option>
								<option  value="SPOC 3">SPOC 3</option>
								<option  value="SPOC 4">SPOC 4</option>
							</select>
					    </div>	
					     <div class="form-group">
							<label for="recruiters">Assign additional recruiters</label>
							<select class="ui fluid search dropdown" multiple=""  id="recruiters" name="recruiters[]">
								<option value=""> Choose Employee(multiple) </option>
								<option  value="Employee 1">Employee 1</option>
								<option  value="Employee 2">Employee 2</option>
								<option  value="Employee 3">Employee 3</option>
							</select>			   
					    </div>						 
					  <input type="hidden" name="token" value="<?php echo Token::generate2('newAssingment'); ?>">  
					  <button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Launch Assingment</button>
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