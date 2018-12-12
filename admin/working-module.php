

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

                   
                        <div class="line"></div>                     
                         	<ul>
                         		<li><a  class="btn-link" href="employees.php">Employees</a>
                         			<ul>
                         				<li>Create</li>
                         				<li>Update</li>
                         				<li>Assign Role</li>
                         				<li>Assign Team Leader</li>
                         				<li>Activate</li>
                         				<li>Remove</li>                         				
                         			</ul>
                         		</li>
                         			
                         		<li><a  class="btn-link" href="companies.php">Companies</a>
                         			<ul>
                         			<li>Add New Compnay</li>
									<li>Update</li>
									
									<li>Add job role</li>
									<li>Update job role</li>							                         				
                         			</ul>		
                         		</li>  
                         		<li><a class=" btn-link" href="ongoing-assignment.php">Ongoing assignment</a>
                         			<ul>
                         				<li>Create</li>
                         				<li>Update</li>
                         			</ul>
                         		
                         		</li>
                         		                       	
                         	</ul>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once  '../include/footer.php'; ?>

    </body>

    </html>