<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function jsonSuccess($data, $code=200){
		$callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : null;

    	return response()->json($data, $status=200, $headers=[], $options=JSON_PRETTY_PRINT)
			->setCallback($callback);
    }
    public function jsonError($message, $code=500){
    	$callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : null;

        return response()->json(['error' => 1, 'message' => $message], $status=200, $headers=[], $options=JSON_PRETTY_PRINT)
			->setCallback($callback);
    }
}
