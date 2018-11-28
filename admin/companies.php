<?php 
    require_once '../core/init.php'; 

    Login::isUservalid('admin');  

    $company = new Company();  

    if (!$result = $company->getAllCompany()) {

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

                    <h5>All Companies</h5>    
                    <span><a href="./new-compnay.php" class="btn-link" >+ Add new company</a></span>
                   <span> 

                       <!--  <p class="text-success"> -->

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                 <!--      </p> -->
                    </span> 
                    
                        
                    <div class="line"></div>

                     <?php  
                     
                        if ($result) {
                            # code...

                            ?>

                <table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>                                            
                                <th>Action</th>                              
                            </tr>

                            </thead>
                        <tbody>

                             <?php  
                                 foreach ($result as $key => $value) { ?>
                                        
                                    <tr>
                                    
                                        <td><a href="./company-jobroles.php?companyId=<?php echo $value['companyId']; ?>"><?php echo $value['companyName']; ?></a></td>
                                                                   
                                         <td>Action</td>
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