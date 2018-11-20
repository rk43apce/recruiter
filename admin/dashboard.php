
<?php require_once '../core/init.php'; 

if (Input::exists('post')) {
    # code...
    $userLogin = new Login();

    var_dump($userLogin);
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

                    <h2>Dashboard</h2>      

                    <div class="line"></div>

                    <table id="dashboard" class="table table-striped table-bordered nowrap" style="max-width:100%">
                        <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>                               
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

            loadDataTable('#dashboard');

        } );
    </script>

</body>

</html>