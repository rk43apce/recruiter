function _( el ) {
		return document.getElementById( el );
	}


	function uploadFile() {


		var file = _( "fileToUpload" ).files[ 0 ];
		// alert(file.name+" | "+file.size+" | "+file.type);

		$( "#fileuploadbar" ).fadeIn();

		var formdata = new FormData();
		
		formdata.append( "fileToUpload", file );
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener( "progress", progressHandler, false );
		ajax.addEventListener( "load", completeHandler, false );
		ajax.addEventListener( "error", errorHandler, false );
		ajax.addEventListener( "abort", abortHandler, false );
		ajax.open( "POST", "add-upload.php" );
		ajax.send( formdata );
	}

	function progressHandler( event ) {

		var percent = ( event.loaded / event.total ) * 100;
		_( "fileuploadbar" ).value = Math.round( percent );
		//  _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
		if ( Math.round( percent == '100' ) ) {
			$( "#ajaxuploadsuccess" ).fadeIn();
			$( "#fileuploadbar" ).fadeOut();

		}

	}

	function completeHandler( event ) {

		//_("status").innerHTML = event.target.responseText;
		_( "fileuploadbar" ).value = 0;

	}

	function errorHandler( event ) {
		_( "status" ).innerHTML = "Upload Failed";
	}

	function abortHandler( event ) {
		_( "status" ).innerHTML = "Upload Aborted";
	}