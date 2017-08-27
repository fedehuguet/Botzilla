<?php
include "Tools.php";

//========================================================================================================================
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST, DELETE, OPTIONS');
//header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header("Content-Type: application/json", true);

//========================================================================================================================
isset($_POST['function']) ? $function = $_POST['function'] : $function = '404';


//========================================================================================================================
//                                                          		//Selecciona el metodo a ejecutar, se coloca solo por
//                                                         `//    estandar
switch ($function)
{
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	case "echoTop5" : SystemController::echoTop5();
		  break;
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	case "echoProblemStatus" : SystemController::echoProblemStatus();
		  break;

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 	case '404': header("HTTP/1.1 404 Not Found");
		break;

  	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
  	default: header("HTTP/1.1 400 Bad Request");
		break;

  	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
}

//========================================================================================================================
class SystemController
{
	//------------------------------------------------------------------------------------------------------------------
	public static function echoTop5()
	{
		$paramtypes = null;
		$params = null;
		echo json_encode(Tools::CallStoredProcedure("SP_GetTop5",$paramtypes, $params));
	}
	
	//------------------------------------------------------------------------------------------------------------------
	public static function echoProblemStatus()
	{
		$paramtypes = null;
		$params = null;
		echo json_encode(Tools::CallStoredProcedure("SP_GetProblemStatus",$paramtypes, $params));
	}
}

//========================================================================================================================
?>
