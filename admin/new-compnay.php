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
	<style type="text/css">
		.card label {
			text-align: right;
		}
	</style>
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

                	 <ol class="breadcrumb">   
                	 	<li class="breadcrumb-item"><a href="./companies.php" class="btn-link">Companies</a></li>            
                        <li class="breadcrumb-item">Add new company</li>                       
                       
                        <li class="breadcrumb-item text-success">
                            <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                        </li>                   
                    </ol>

                    <div class="line"></div>

                    <form method="post" action="">
					  <fieldset>

					  	<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Compnay Name</label>
							<div class="col-sm-6">
							 <input type="text" class="form-control" placeholder="Name" id="companyName" name="companyName" required="">
							</div>
						</div>

							<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-6">
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
						</div>


						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Industry Type</label>
							<div class="col-sm-6">
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
						</div>

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-6">
							 <input type="hidden" name="token" value="<?php echo Token::generate2('addNewCompany'); ?>">  
							 <button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Add Company</button>
							 <a class="btn btn-link" href="./companies.php" class="btn-link">Cancel</a>
							</div>
						</div>									      
					   						 
						
					
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