<?php 
require_once '../core/init.php'; 
require_once '../functions/helper.php';

Login::isUservalid('admin');  

$assingment = new Assingment();  

if (!$assingmentData = $assingment->getOnGoingAssingment()) {

    Session::put("errorMsg", 'Sorry, No record found!');
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

                    <h5></h5>    

                     <ol class="breadcrumb">                  
                        <li class="breadcrumb-item">Assignments</li>
                        <li class="breadcrumb-item"><a href="./new-assingment.php" class="btn-link" >+ Start New Assignment</a></li>
                        <li class="breadcrumb-item text-success">
                            <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                        </li>                   
                    </ol>
                                                   

                        <div class="line"></div>

                        <?php  

                        if ($assingmentData) { ?>

                            <table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Role</th>
                                         <th>SPOC</th>  
                                        <th>City</th>
                                        <th>CTC</th>
                                        <th>Experience</th>
                                        <th>Open On</th> 
                                        <th>Days Old</th>   
                                        <th>Last work on</th>    
                                        <th>Action</th>                           
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php foreach ($assingmentData as $key => $assingment) { ?>

                                        <tr>
                                            <td><?php echo $assingment['companyName']; ?> </td>
                                            <td>
                                                <a class="btn-link" href="view-assingment-description.php?jobRoleId=<?php echo $assingment['jobRoleId']; ?>&assingmentId=<?php echo $assingment['assingmentId']; ?>">         
                                                    <?php echo $assingment['jobRoleTitle']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $assingment['employeeName']; ?></td> 
                                            <td><?php echo $assingment['cityName']; ?></td>
                                            <td><?php echo $assingment['minFixedSalary']; ?> - <?php echo $assingment['maxFixedSalary']; ?> </td>
                                            <td><?php echo $assingment['minWorkExperience']; ?> - <?php echo $assingment['maxWorkExperience']; ?> yrs </td> 
                                            <td><?php echo date('d-m-Y', strtotime($assingment['createdOn'])); ?></td> 
                                            <td> <?php echo noOfDays($assingment['createdOn']);?> </td>
                                            <td> <?php echo date('d-m-Y', strtotime($assingment['createdOn'])); ?></td>                                                
                                            <td>
                                                <a class="btn-link" href="./edit-assingment.php?assingmentId=<?php echo $assingment['assingmentId']; ?>">Edit</a>
                                            </td>                             
                                        </tr>

                                    <?php  } ?>   

                                </tbody>
                            </table>

                            <?php } else { ?>

                            <table>                                 
                                <tr> 
                                    <td> 
                                        <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : "";?>   
                                    </td>
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