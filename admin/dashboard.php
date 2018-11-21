
<?php require_once '../core/init.php'; 
    
    $userLogin =    new Login();
    // $userLogin->isUserLoggedIn('admin');

    if (!$userLogin->isUserLoggedIn('admin')) {
        # code...
        Redirect::to('./index.php');
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

                    <h2>Ongoing Assingment</h2>      

                    <div class="line"></div>

                    

                    <table id="example" class="table table-striped table-bordered nowrap" style="max-width:100%">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Role</th>
                                <th>City</th>
                                <th>CTC</th>
                                <th>Experience</th>
                                <th>Open On</th>  
                                <th>Days Old</th> 
                                <th>Last work on</th> 
                                <th>SPOC</th>     
                                <th>Action</th>                           
                            </tr>

                            <tr>
                                <td>Company Name</td>
                                <td>Role</td>
                                <td>City</td>
                                <td>CTC</td>
                                <td>Experience</td>
                                <td>Open On</td>  
                                <td>Days Old</td> 
                                <td>Last work on</td> 
                                <td>SPOC</td>     
                                <td>Action</td>                           
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>varun</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>25</td>
                                <td>2011/04/25</td> 
                                <td>Edinburgh</td>
                                <td>25</td>
                                <td>2011/04/25</td>     
                                 <td>Edit</td>                             
                            </tr>
                             <tr>
                                <td>Vivek</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>25</td>
                                <td>2011/04/25</td> 
                                <td>Edinburgh</td>
                                <td>25</td>
                                <td>2011/04/25</td>   
                                  <td>Edit</td>                                 
                            </tr>
                             <tr>
                                <td>Vivek</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>25</td>
                                <td>2011/04/25</td> 
                                <td>Edinburgh</td>
                                <td>25</td>
                                <td>2011/04/25</td>    
                                 <td>Edit</td>                          
                            </tr>
                        </tbody>
                    </table>

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