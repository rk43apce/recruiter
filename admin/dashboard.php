<?php 
    require_once '../core/init.php'; 

    Login::isUservalid('admin');  

    $assingment = new Assingment();  

    $result =  $assingment->getOnGoingAssingment();

    if (!$result = $assingment->getOnGoingAssingment()) {

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

                    <h2>Ongoing Assingment</h2>    
                       <a href="./new-assingment.php" class="btn-link" >+ Create new assingment</a>   
                    <div class="line"></div>

                     <?php  
                     
                        if ($result) {
                            # code...

                            ?>

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

                             <?php  

                                             

                                 foreach ($result as $key => $value) { ?>
                                        
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['assingmentId']; ?></td>
                                        <td><?php echo $value['companyId']; ?></td>
                                        <td><?php echo $value['jobRoleId']; ?></td>
                                        <td><?php echo $value['jobCity']; ?></td>
                                        <td><?php echo $value['noOfPosition']; ?></td> 
                                        <td><?php echo $value['spocId']; ?></td>
                                        <td><?php echo $value['createdOn']; ?></td>
                                        <td><?php echo $value['createdAt']; ?></td>     
                                        <td><?php echo $value['id']; ?></td>                             
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