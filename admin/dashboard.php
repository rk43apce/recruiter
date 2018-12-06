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
                        <li class="breadcrumb-item">Dashboard</li>
                         <li class="breadcrumb-item text-success">
                            <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                        </li>                   
                    </ol>
                                                   

                        <div class="line"></div>

                         <h3>Page Under Construction</h3>   
                              
                    </div>
                </div>
            </div>
        </div>

        <?php require_once  '../include/footer.php'; ?>

    </body>

    </html>