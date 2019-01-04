// JavaScript Document
function loadInterview() {	
		$.ajax({
			type: 'POST',
			url: 'interview.php',
			data: {action:'viewInterview'},
			success:function(html){
			$('#scheduleInterviews').html(html);
			}
		});	

	}		
	
function validation()
{
	var isFormValid = true;

	$( "#tet input" ) . each( function () {
		if ( $ . trim( $( this ) . val() ) . length == 0 ) {
			$( this ) . addClass( "is-invalid" );
			isFormValid = false;
			$( this ) . focus();
		} else {
			$( this ) . removeClass( "is-invalid" );
		}
	} );

	if ( isFormValid ) {

		interview();
		return false;

	} else {
		alert( "Please fill in all the required fields (indicated by *)" );
	}
}	


function interview() {
	var sheduleInterviewModal = $( "#sheduleInterviewModal" );
	var interviewData = sheduleInterviewModal . find( 'form' ) . serialize();
	$ . ajax( {
		type: 'POST',
		url: 'interview.php',
		data: interviewData,
		dataType: "text",
		success: function ( html ) {
			
			if(html) {
				$('#sheduleInterviewModal').modal('toggle');
				 $('#sheduleInterviewModal').find('form')[0].reset();
				loadInterview();
			} else {
				alert( html );
			}		
			
		}
	} );	

}

function editInterview(editInterviewId) {

	var interviewId = $(editInterviewId).attr('editInterviewId');
	
	alert(interviewId);
}
function deleteInterview(deleteInterviewId) {
	
	var interviewId = $(deleteInterviewId).attr('deleteInterviewId');
	
	$ . ajax( {
		type: 'POST',
		url: 'interview.php',
		data: {interviewId:interviewId, action:'deleteInterview'},
		dataType: "text",
		success: function ( resp ) {			
			
			if(resp == true) {
				loadInterview();
			}else{
				
				alert(resp);
			}
			
		}
	} );	
}
	

