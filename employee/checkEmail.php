<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
$candidate =  new Candidate();
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once  '../include/css.php'; ?>  
<script>
	window.onload = function () {
		var candidateId = new Date().getTime(); // generating student registation by using tim in milliseconds
		document.getElementById( "candidateId" ).value = candidateId;
	};
</script> 
</head>
<body>
	<div class="loader"></div>
	<div class="wrapper">
		<!-- Sidebar Holder -->
		<?php require_once  '../include/sidebar.php'; ?> 
		<!-- Page Content Holder -->
		<div id="content">
			<!-- Sidebar Holder -->
			<?php require_once  '../include/navbar-top-employee.php'; ?>
					 
			<div class="container">
				<div class="card">   
					<ol class="breadcrumb">  
						<li class="breadcrumb-item"><a class="btn-link" href="./candidates.php">Canidates</a>  </li>  
						<li class="breadcrumb-item active">+Add new candidate</li>                                    
					</ol>	
					<div class="line"></div>
					<div class="card-body">					
	                    <form method="post" action="./add-candidate.php">
						  <fieldset>
							
							<div class="form-group row">													
					
								<label for="" class="col-sm-3 col-form-label">Full Name</label>
								<div class="col-sm-6">
								  <input type="text" id="email" class="form-control" placeholder="Full Name"  name="candidateEmail">
								 
								    <div id="status" class=""></div>
								</div>
							</div>		 	
						  </fieldset>
						</form>				 
					</div>			
				</div>
            </div>
  
		</div>
	</div>
	
	<?php require_once  '../include/footer.php'; ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
	<script>
	$('.ui.dropdown')
	.dropdown();
	</script>

<script>

$(document).ready(function(){
    $("#email").change(function() {
    var usr = $("#email").val();
		
    if(usr.length >= 4){	
		
        $("#status").html('Checking availability...');
        $.ajax({ 
        type: "POST", 
        url: "checkUsername.php", 
        data: "email="+ usr,
        dataType: 'text',
            success: function(msg){				
				
                if(msg == 'available'){
					
                    $("#email").addClass("is-invalid");
					$("#status").addClass("invalid-feedback");					
                    $("#status").html("&nbsp; Sorry, that email's taken. Try another?");
                } else {

					$("#email").addClass("is-valid");
					$("#status").addClass("valid-feedback");
					$("#status").html("&nbsp; Success! available to use.");
               }
            }

        });
    } else {
        $("#status").html('<font color="red">' + 'Enter Valid Email</font>');
        $("#email").removeClass('object_ok'); // if necessary
        $("#email").addClass("object_error");
    }
    });
});	
	
</script>
</body>
</html>