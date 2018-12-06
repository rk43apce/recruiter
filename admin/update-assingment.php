<?php require_once '../core/init.php';

Login::isUservalid('admin');  

if (Input::exists('post')) {

	if (Token::check2('updateAssingment', Input::get('token'))) {
		$assingment =  new Assingment();	
		$assingmentId =  Input::get('assingmentId');	
		$noOfPosition =  Input::get('noOfPosition');
		$clientBrief =  Input::get('clientBrief');
		$spocId =  Input::get('spocId');
		$recruiters =  Input::get('recruiters');

		$assingmentData = array("noOfPosition"=>$noOfPosition, "clientBrief"=>$clientBrief, "spocId"=>$spocId);


		if ($assingment->updateAssingment($assingmentId, $assingmentData, $recruiters)) {

			Session::put('errorMsg', 'Success! Assingment successfully updated! ');	

			Redirect::to('./ongoing-assignment.php');
			exit();

		} else {

			Session::put('errorMsg', 'Sorry! Fail to update, try again!');

			Redirect::to('edit-assingment.php?assingmentId='.Input::get('assingmentId'));

			exit();
		}

	}  else {

		Session::put('errorMsg', 'Assingment is already update!');

		Redirect::to('edit-assingment.php?assingmentId='.Input::get('assingmentId'));
		exit();
	}

} else {

	Redirect::to('.dashboard.php');
	exit();
}

