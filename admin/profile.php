<?php 
require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  


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
        <div id="content">
			<!-- Sidebar Holder -->
			<?php require_once  '../include/navbar-top-employee.php'; ?>   
			
				<div class="container">
				<div class="card">   
					<h3>Edit profile pic</h3>	
					<div class="line"></div>
					<div class="card-body">	
						<div class="form-group">
							<div class="row col-md-12">
							<h3>Page under construction!</h3>
<!--
							<div class="input-group mb-3">
								<div class="custom-file">								
									<input class="form-control" type="file" name="upload_image" id="upload_image" />	
								</div>								
							</div>
-->
							
							</div>
						</div>	
						 
					</div>			
				</div>
            </div>  
			
			
        </div>        
        <?php require_once  '../include/footer.php'; ?>
    </div>
</body>
<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
       		<h3 class="modal-title">Upload & Crop Image</h3>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>        		
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 text-center">
						  <div id="image_demo" style="width:350px; margin-left:auto; margin-right: auto;"></div>
  					</div>
  					<br>
  					<div class="col-md-12 text-center">
  					<button class="btn btn-success crop_image">Crop & Upload Image</button>
					</div>
  					
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>
</html>

<script>  
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload-profile-pic.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
			if(data == 'true') {
				
				$('#uploadimageModal').modal('hide');
				 location.reload();
				
			}else {
				$('#uploaded_image').html('Sorry!. Fail to upload. Please try again!');	
			}		
        	
        }
      });
    })
  });

});  
</script>