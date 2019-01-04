<!-- Modal -->
<div class="modal fade" id="sheduleInterviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Schedule an Interview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="card">
			<form onsubmit="return validation()" id="sheduleInterviewform">		
				
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label">Type</label>  
					<div class="col-sm-9">
						<select name="type"  id="type" class="form-control" required autofocus>
							<option>Call</option>
							<option>On site interview</option>
							<option>Meeting</option>
							<option>Internal meeting</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label">Date</label>
					<div class="col-sm-9">  
						<input type="date" class="form-control" placeholder="Date" name="date" id="date" required="" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label">Schedule</label>
					<div class="col-sm-4">
						<select name="startAt" id="startAt" class="form-control" required>	
								
							<?php
								foreach (Timeslot::timeSlotCalculator() as $key => $value) {
									if ($key % 2 == 0) { ?>

									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									
									<?php }
								}
							?>                                              
						</select>
					</div>
					to
					<div class="col-sm-4">
						<select name="endAt" id="endAt" class="form-control" required>						
							<?php 
								foreach (Timeslot::timeSlotCalculator() as $key => $value) {
									if ($key % 2 == 1) { ?>
									
									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									
									<?php } 
								}
							?>                                              
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label">Location</label>
					<div  class="col-sm-9">  
						<input type="text"  class="form-control" placeholder="Location" name="location" id="location" required="">
					</div>                                          
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label">Title</label>
					<div class="col-sm-9">  
						<input type="text" class="form-control" placeholder="Title" name="title" id="title" required="">
					</div>                                          
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label">Description</label>
					<div class="col-sm-9">  
						<textarea rows="3" name="description" id="description" class="form-control" required></textarea>
					</div>                                          
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3 col-form-label"></label>
					<div class="col-sm-9">
						<input type="hidden" name="action" id="action" value="addInterview">
						<input type="hidden" name="assingmentId" id="assingmentId" value="<?php echo $assingmentId; ?>">
						<input type="hidden" name="interviewSheduleCandidateId" id="interviewSheduleCandidateId" value="<?php echo $candidateId ?>">                                      
						<button type="submit" class="btn btn-primary">Schedule Now</button>
					</div>                                          
				</div>
				
				</form>		
		</div>	
      </div>
      
    </div>
  </div>
</div>