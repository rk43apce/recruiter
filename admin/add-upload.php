<?php

require_once '../core/init.php';

if ( isset( $_FILES[ 'fileToUpload' ] ) ) {

	if ( is_uploaded_file( $_FILES[ 'fileToUpload' ][ 'tmp_name' ] ) ) {

		$fileExtention = pathinfo( $_FILES[ 'fileToUpload' ][ 'name' ] );
		
		$jobRoleId = $_POST['jobRoleId'];
		$jdTrackerId = time(); 	
		
		$uploadPath = $_SERVER[ 'DOCUMENT_ROOT' ] . "/rms/upload/jd/" . $jdTrackerId . "." . $fileExtention[ 'extension' ] ;
		
		if(move_uploaded_file( $_FILES[ "fileToUpload" ][ "tmp_name" ], $uploadPath)) {
			
			$uploadData = array("jobRoleId"=>$jobRoleId, "jdTrackerId"=>$jdTrackerId, "fileType"=>$fileExtention[ 'extension' ]);

			$upload = new Upload();

			if($upload->jobDescription($uploadData)) {

				Redirect::to('view-jobrole-description.php?jobRoleId='.$jobRoleId);

			}
		}

	}
}else {
	Redirect::to('dashboard.php');
}
