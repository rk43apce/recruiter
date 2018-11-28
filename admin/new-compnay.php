<?php require_once '../core/init.php';

Login::isUservalid('admin');  

if (Input::exists('post')) {

	if (Token::check2('addNewCompany', Input::get('token'))) {
		# code...
		$companyName =  Input::get('companyName');
		$companyCity =  Input::get('companyCity');
		$companyIndustryTypeId =  Input::get('companyIndustryTypeId');	

		$companyData = array("companyName"=>$companyName, "companyCity"=>$companyCity, "companyIndustryTypeId"=>$companyIndustryTypeId);


		$company = new Company();

		if ($company->addNewCompany($companyData)) {	

			Session::put('errorMsg', 'Success!, New compnay added to database');			

			Redirect::to('./companies.php');

		} else {

				Session::put('errorMsg', 'Sorry!, fail to add new compnay');
		}

		
	}

}    

$industry =	new Industry();
	
$industriesData = $industry->getIndustry();

$city =	new City();
	
$cityData = $city->getCities();
    
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once  '../include/css.php'; ?>   
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

                    <h5>Add new company</h5>    
                   
                    <span> 

                    	<!-- <p class="text-success"> -->

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                      <!-- </p> -->
                  	</span>                   

                    <div class="line"></div>

                    <form method="post" action="">
					  <fieldset>
						<div class="form-group">
							<label class="col-form-label" for="inputDefault">Compnay Name</label>
							<input type="text" class="form-control" placeholder="Default input" id="companyName" name="companyName" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label" for="inputDefault">City</label>
							<select class="ui fluid search dropdown"  required="" id="companyCity" name="companyCity">
								<option value=""> Choose City </option>
								<?php

								foreach ($cityData as $key => $city) { ?>

									<option value="<?php echo	$city['cityId']; ?>">

									<?php echo	$city['cityName']; ?>

									</option>

								<?php }

								?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="spocId">Industry Type</label>
							<select class="ui fluid search dropdown"  required="" id="companyIndustryTypeId" name="companyIndustryTypeId" required="">
								<option value=""> Choose SPOC </option>
								<?php

								foreach ($industriesData as $key => $industryData) { ?>

									<option value="<?php echo $industryData['industryId']; ?>">

									<?php echo	$industryData['industryName']; ?>

									</option>

								<?php }

								?>
						
							</select>
					    </div>				      
					   						 
						<input type="hidden" name="token" value="<?php echo Token::generate2('addNewCompany'); ?>">  
						<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Add Company</button>
					<a href="./companies.php" class="btn-link">Back to Company Dashboard</a>
					  </fieldset>
					</form>                 
                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php';?>
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