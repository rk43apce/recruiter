<?php 
    require_once '../core/init.php'; 

    Login::isUservalid('admin');  

    $employee = new Employee();  

    if (!$result = $employee->getAllEmployee()) {

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

            <div class="container-fluid">

                <div class="card">    

                    <h2>All Employees</h2>    
                    <span><a href="./new-employee.php" class="btn-link" >+ Add new employee</a></span>
                   <span> 

                        <p class="text-success">

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                      </p>
                    </span> 
                    
                        
                    <div class="line"></div>

                     <?php  
                     
                        if ($result) {
                            # code...

                            ?>

                    <table id="example" class="table table-striped table-bordered nowrap" style="max-width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                <th>Category</th>                                
                                <th>Status</th>
                                                     
                            </tr>

                            <tr>
                                <td>Name</td>
                                <td>Mobile No</td>
                                <td>Email Id</td>
                                <td>Category</td>                              
                                <td>Status</td>
                                                  
                            </tr>

                        </thead>
                        <tbody>

                             <?php  
                                 foreach ($result as $key => $value) { ?>
                                        
                                    <tr>
                                        <td><?php echo $value['employeeName']; ?></td>
                                        <td><?php echo $value['employeeMobileNumber']; ?></td>
                                        <td><?php echo $value['employeeEmailId']; ?></td>
                                        <td><?php echo $value['employeeRoleName']; ?></td>
                                        <td>Inactive</td>
                                                                  
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