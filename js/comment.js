// JavaScript Document
	function loadComments() {	
		var candidateId = $('#candidateId').val();	
		$.ajax({
			type: 'POST',
			url: 'comments.php',
			data: {candidateId:candidateId, action:'viewComment'},
			success:function(html){
			$('#commentData').html(html);
			}
		});	

	}
	
	function addComment() {			
		var candidateId = $('#candidateId').val();		
		var comment = $('#comment').val();			
		$.ajax({
			type: 'POST',
			url: 'comments.php',
			data: {candidateId:candidateId, comment:comment, action:'addComment'},
			 beforeSend: function(){
            $('#test').html('Please wait...');
        	},
			success:function(html){
			$('#commentData').html(html);
				$('#test').html('submit Comment');
				loadComments();
			}
		});	

	}
		