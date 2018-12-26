<?php 
    require_once '../core/init.php'; 

    Login::isUservalid('admin');  

    try {
          $employee = new Employee();  

          if (!$result = $employee->getAllEmployee()) {

          Session::put("errorMsg", 'Sorry, No record found!');
          }
    } catch (Exception $e) {
      
      echo 'Message: ' .$e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once  '../include/css.php'; ?>   
  <style type="text/css">
    table a, a:hover, a:focus {
    color: #007bff;
    text-decoration: none;
    transition: all 0.3s;
  }
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
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
                  <li class="breadcrumb-item"><a href="./employees.php" class="btn-link">Employees</a> </li>
                  <li class="breadcrumb-item"><a href="./new-employee.php" class="btn-link" >+ Add new employee</a></li>
                  <li class="breadcrumb-item text-success">
                  <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                  </li>                   
                </ol>                               
                    <div class="line"></div>

                     <?php  
                     
                    if ($result) { ?>

                    <table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
                        <thead>
                            <tr>
                              <th>S.No</th>
                              <th>Name</th>
                              <th>Mobile No</th>
                              <th>Email Id</th>
                              <th>Category</th>                                
                              <th>Status</th>                                                                   
                            </tr>                       
                        </thead>                     
                        <tbody>
                          <?php  
                            $counter=1;
                            foreach ($result as $key => $value) { ?>
                            <tr>
                              <td><?php echo $counter ?></td>
                              <td >
                                <a title='View  profile' data-toggle='tooltip' href="./employee-profile.php?employeeId=<?php echo $value['employeeId'];?> ">
                                <?php echo $value['employeeName']; ?></a>
                              </td>
                              <td><?php echo $value['employeeMobileNumber']; ?></td>
                              <td><?php echo $value['employeeEmailId']; ?></td>
                              <td><?php echo $value['employeeRoleName']; ?></td>
                              <td>
                                <a href="JavaScript:Void(0);" employeeId="<?php echo $value['employeeId'];?>" onclick="changeEmployeeStatus(this)" title='Update Status' data-toggle='tooltip'>


                                  <?php

                                echo $employee::isActive($value['isActive']);

                                ?>
                                    
                                </a>
                              </td>                                                         
                            </tr>
                            <?php 
                            // Increase counter
                            $counter++;  } 
                          ?>                                                                                
                        </tbody>
                    </table>
                    
                    <?php  } else {  ?>

                     <table>                                 
                         <tr> 
                            <td> <?php echo (Session::exists('errorMsg')) ? Session::flash('errorMsg') : "";?> </td>
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
        $('#example').DataTable();
    } );
    </script>

  <script>
  function changeEmployeeStatus(employeeId){

    var employeeId = $(employeeId).attr('employeeId');

    if(confirm("Are you sure you want to Update  this?"))
    { 

      $.ajax({

        url:"ajax-requets.php",
        method:"POST",
        data:{employeeId:employeeId},
        success:function(data)
        { 
               
          if (data) {

            alert(data);

            window.location.reload(); 

          }

        }

      });

    }
    else
    {
    return false; 
    } 

  } 
  </script>

 
</body>

</html>