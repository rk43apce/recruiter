<?php

//adding the resume upload code start 
if(isset($_FILES[ 'fileToUpload' ]))
{	

	if ( is_uploaded_file( $_FILES[ 'fileToUpload' ][ 'tmp_name' ] ) ) {

		$pathpart = pathinfo( $_FILES[ 'fileToUpload' ][ 'name' ] );
	
		
		$prefixer = 'dddddddddddd';
		
		
		var_dump(move_uploaded_file( $_FILES[ "fileToUpload" ][ "tmp_name" ], $_SERVER[ 'DOCUMENT_ROOT' ] . "/rms/upload/" . $prefixer . "resume" . "." . $pathpart[ 'extension' ] ));
		


	}
}

?>