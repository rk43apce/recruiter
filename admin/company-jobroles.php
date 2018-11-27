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

    	$compnayJobroles =  $jobrole->getJobRoleByCompanyId();

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

            <div class="container-fluid">

                <div class="card">    

                    <h2><?php echo $companyName; ?></h2>    
                    <span><a href="./new-job-role.php?companyId=<?php echo $companyId;?>" class="btn-link" >+ Add new Job Role</a></span>
                   <span> 

                        <p class="text-success">

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                      </p>
                    </span> 
                    
                        
                    <div class="line"></div>

                     <?php  
                     
                        if ($compnayJobroles) {
                            # code...

                            ?>

                    <table id="example" class="table table-striped table-bordered nowrap" style="max-width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Industry</th>  
                                 <td>Action</td>                              
                            </tr>

                            <tr>
                                <td>Name</td>
                                <td>City</td>
                                <td>Industry</td>
                                <td>Action</td>
                                                                            
                            </tr>

                        </thead>
                        <tbody>

                             <?php  
                                 foreach ($compnayJobroles as $key => $Jobrole) { ?>
                                        
                                    <tr>
                                        <td><a href="./company-jobroles.php?companyId=<?php echo $value['companyId']; ?>" class="btn btn-link"><?php echo $Jobrole['jobRoleTitle']; ?></a></td>
                                        <td><?php echo $Jobrole['jobRoleTitle']; ?></td>
                                        <td><?php echo $Jobrole['jobRoleTitle']; ?></td>
                                         <td><a href="./new-job-role.php?companyId=<?php echo $value['companyId']; ?>" class="btn-link">View Profile</a> </td>
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
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
    } );
    </script>

</body>

</html>