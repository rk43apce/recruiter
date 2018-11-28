<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('get')) ?  Redirect::to('./companies.php') : "";

if (Input:: get('companyId') ) {
	# code...
	$company = new Company();  
	
    if ($companyDaTas = $company->getCompanyById(escape(Input::get('companyId')))) {

    	$companyName =  $companyDaTas['companyName']; 
    	$companyId =  $companyDaTas['companyId'];

    	$jobrole = new Jobrole();

    	$jobrolesData =  $jobrole->getJobRoleByCompanyId($companyId);

    } else {

    	Session::put("errorMsg", 'Sorry, No record found!');
    }

}  
    
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

                    <h5><?php echo $companyName; ?></h5>    
                    <span><a href="./new-job-role.php?companyId=<?php echo $companyId;?>" class="btn-link" >+ Add new Job Role</a></span>

                    
                   <span> 

                       <!--  <p class="text-success"> -->

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                 <!--      </p> -->
                    </span> 
                    
                        
                    <div class="line"></div>

                     <?php  
                     
                        if ($jobrolesData) {
                            # code...

                            ?>

                    <table id="example" class="table table-bordered nowrap" style="max-width:100%">
                        <thead>
                            <tr>
                                <th>Jobrole Title</th>
                                <th>Functional Area</th>
                                <th>CTC Range</th> 
                                <th>Experience Range</th> 
                                 <th>Minimum Qualification</th>    
                                  <td>Action</td>                           
                            </tr>
                         
                        </thead>
                        <tbody>

                             <?php  
                                 foreach ($jobrolesData as $key => $Jobrole) { ?>
                                        
                                    <tr>
                                        <td><?php echo $Jobrole['jobRoleTitle']; ?></td>
                                        <td><?php echo $Jobrole['functionalareaName']; ?></td>
                                        <td><?php echo $Jobrole['minFixedSalary']; ?> to <?php echo $Jobrole['maxFixedSalary']; ?> </td>
                                         <td><?php echo $Jobrole['minWorkExperience']; ?> to <?php echo $Jobrole['maxWorkExperience']; ?></td>
                                         <td>Minimum Qualification</td>
                                          <td><a href="">Edit</a> </td> 
                                    </tr>

                            <?php  }    ?>   
                                                                             
                        </tbody>
                    </table>


                            <?php
                        } else {

                            ?>

                             <table>                                 
                                 <tr> 
                                    <td> 

                                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : "";?>      

                                    </td>
                                </tr>
                             </table>   


                            <?php
                        }

                      ?>   

                  

                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>

    
 <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>

</body>

</html>