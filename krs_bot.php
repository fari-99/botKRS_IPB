<?php 
	include('library/lib_http.php');
	include('library/lib_parse.php');
	
	$rootWeb = 'https://simak.ipb.ac.id';

	$page = $rootWeb . '/Account/Login';
	$ref = '';

	$pageLogin = http_get($page, $ref);
	// echo $pageLogin['FILE'];
	$formLogin = parse_array($pageLogin['FILE'], '<form', '</form>');
	// print_r($formLogin[0]);
	
	$inputForm  = parse_array($formLogin[0], '<input', '>'); 		// print_r($inputForm);
	// die();

	$inputData = [];
	foreach ($inputForm as $key => $value) { 
		$name = get_attribute($value, 'name');
		$value = get_attribute($value, 'value');

		if($name == 'UserName'){
			$inputData[$name]  = '*********';
		}
		elseif ($name == 'Password') {
			$inputData[$name]  = '*********';
		}
		else{
			$inputData[$name]  = $value;
		}
	}
	// print_r($inputData); die();

	$actionForm = $rootWeb . get_attribute($formLogin[0], 'action');  // print_r($actionForm); die();
	$methodForm = strtoupper(get_attribute($formLogin[0], 'method')); // print_r($methodForm);

	$response = http($actionForm, $ref, $methodForm, $inputData, EXCL_HEAD);
	// print_r($response); die();
	
	if($response['STATUS']['url'] != $rootWeb . '/Home'){
		echo 'login gagal'; die();
	}

	$pageKRS = $rootWeb . '/KRSSarjana/KRSOnline/Index';
	$ref = '';

	$pageFormKRS = http_get($pageKRS, $ref);
	// print_r($response);
	$formKRS = parse_array($pageFormKRS['FILE'], '<form', '</form>');
	// print_r($formKRS); die();
	
	$inputForm  = parse_array($formKRS[1], '<input', '>'); 		
	// print_r($inputForm); die();
	
	$inputData = [];
	foreach ($inputForm as $key => $value) { 
		$name = get_attribute($value, 'name');
		$value = get_attribute($value, 'value');

		if($name == 'UserName'){
			$inputData[$name]  = 'fadhlanr11s';
		}
		elseif ($name == 'Password') {
			$inputData[$name]  = '185591';
		}
		else{
			$inputData[$name]  = $value;
		}
	}
	// print_r($inputData); die();

	$actionForm = $rootWeb . get_attribute($formKRS[1], 'action');  // print_r($actionForm); die();
	$methodForm = strtoupper(get_attribute($formKRS[1], 'method')); // print_r($methodForm); die();

	$pageKRS = http($actionForm, $ref, $methodForm, $inputData, EXCL_HEAD);
	print_r($pageKRS);
?>
