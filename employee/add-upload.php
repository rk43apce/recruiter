<?php

require_once '../core/init.php';

if ( isset( $_FILES[ 'fileToUpload' ] ) ) {

	if ( is_uploaded_file( $_FILES[ 'fileToUpload' ][ 'tmp_name' ] ) ) {

		$fileExtention = pathinfo( $_FILES[ 'fileToUpload' ][ 'name' ] );
		
		$candidateId = $_POST['candidateId'];
		$fileId = time(); 	
		
		$uploadPath = $_SERVER[ 'DOCUMENT_ROOT' ] . "/rms/upload/" . $fileId . "." . $fileExtention[ 'extension' ] ;
		
		if(move_uploaded_file( $_FILES[ "fileToUpload" ][ "tmp_name" ], $uploadPath)) {
			
			$uploadData = array("candidateId"=>$candidateId, "resumeId"=>$fileId, "fileType"=>$fileExtention[ 'extension' ]);

			$upload = new Upload();

			if($upload->resume($uploadData)) {

			Redirect::to('view-candidate-description.php?candidateId='.$candidateId);

			}
		}

	}
}else {
	Redirect::to('dashboard.php');
}
