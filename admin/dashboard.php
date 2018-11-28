<?php 
    require_once '../core/init.php'; 

    Login::isUservalid('admin');  

    $assingment = new Assingment();  

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

            <div class="container">

                <div class="card">    

                    <h5>Ongoing Assingment</h5>    
                    <span><a href="./new-assingment.php" class="btn-link" >+ Create new assingment</a></span>

                    <span> 

                        <!-- <p class="text-success"> -->

                      <?php echo  (Session::exists('errorMsg')) ? "<p class='text-success'>". Session::flash('errorMsg') : ""; ?>  
                      <!-- </p> -->
                    </span>    
                        
                    <div class="line"></div>

                     <?php  
                     
                        if ($result) {
                            # code...

                            ?>

                    <table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
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
                                        <td><a class="btn btn-link" href="./update-assingment.php?assingmentId=<?php echo $value['assingmentId']; ?>    ">Edit</a></td>                             
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