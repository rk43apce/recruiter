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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./companies.php" class="btn-link">Companies</a></li>
                        <li class="breadcrumb-item"><a href="company-jobroles.php?companyId=7"><?php echo $companyName; ?></a></li>
                        <li class="breadcrumb-item active">Job Roles</li>
                        <li class="breadcrumb-item  text-success">
                            <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?> 
                        </li>
                    </ol>

                    <span><a href="./new-job-role.php?companyId=<?php echo $companyId;?>" class="btn-link" >+ Add new Job Role</a></span>
                                                              
                    <div class="line"></div>

                     <?php if ($jobrolesData) { ?>

                    <table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
                        <thead>
                            <tr>
                                <th>Jobrole Title</th>
                                <th>Functional Area</th>
                                <th>CTC Range</th> 
                                <th>Experience Range</th> 
                                <th>Minimum Qualification</th>  
                            </tr>                         
                        </thead>
                        <tbody>

                            <?php  
                                 foreach ($jobrolesData as $key => $Jobrole) { ?>
                                        
                                    <tr>
                                        <td><a class="btn-link" href="./view-jobrole-description.php?jobRoleId=<?php echo $Jobrole['jobRoleId']; ?>"> <?php echo $Jobrole['jobRoleTitle']; ?></a> </td>
                                        <td><?php echo $Jobrole['functionalareaName']; ?></td>
                                        <td><?php echo $Jobrole['minFixedSalary']; ?> to <?php echo $Jobrole['maxFixedSalary']; ?> </td>
                                        <td><?php echo $Jobrole['minWorkExperience']; ?> to <?php echo $Jobrole['maxWorkExperience']; ?></td>
                                        <td>Minimum Qualification</td>                                    
                                    </tr>

                            <?php  } ?>   
                                                                             
                        </tbody>
                    </table>

                    <?php } else { ?>

                    <table>                                 
                         <tr> 
                            <td> <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : "";?> </td>
                        </tr>
                    </table>   

                    <?php } ?> 

                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>

    
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable( {
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal( {
                                header: function ( row ) {
                                    var data = row.data();
                                    return 'Details for '+data[0]+' '+data[1];
                                }
                            } ),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                                tableClass: 'table'
                            } )
                        }
                    }
                } );
            } );
        </script>

</body>

</html>