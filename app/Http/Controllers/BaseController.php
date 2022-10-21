<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as IluBaseController;

class BaseController extends IluBaseController
{

    private $message;
    private $code;


    public function getMessage()
    {
        return $this->message;
    }


    public function setMessage(string $message)
    {
        $this->message = $message;
    }


    public function getCode()
    {
        return $this->code;
    }


    public function setCode(int $code)
    {
        $this->code = $code;
    }



    public function respond($data, $headers = []){
        return response()->json($data, $this->getCode());
    }



    //Respond Base
    public function respondWithError($message, $errorCode = '', $errorDescription = '')
    {
        $this->setCode(200);
        return $this->respond([
            'message' => $message,
            'error_code' => $errorCode,
            'error_description' => $errorDescription,
            'status_code' => $this->getCode(),
            'success' => false,
        ]);
    }


    //Implememtar este:
//    public function respondWithError(string $message='', $errors = null, $code = 422)
//    {
//        $this->setCode($code);
//        return $this->respond([
//            'message' => $message,
//            'errors' => $errors,
//            'success' => FALSE,
//            'status_code' => $this->getCode(),
//        ]);
//    }



    //The 200
    public function respondWithData($message, $data)
    {
        $this->setCode(200);
        return $this->respond([
            'data' => $data,
            'message' => $message,
            'status_code' => 200
        ]);
    }



    //The 400
    public function respondHttpBadRequest($message = 'Bad Request!'){
        $this->setCode(400);
        return $this->respondWithError($message);
    }


    //The 401
    public function respondHttpUnauthorized($message = 'Bad Request!'){
        $this->setCode(401);
        return $this->respondWithError($message);
    }


    public function respondHttpConflict($message = 'Data Conflict'){
        $this->setCode(409);
        return $this->respondWithError($message);
    }

    public function respondUnprocessableEntity($message = 'Unprocessable Entity')
    {
        $this->setCode(422);
        return $this->respondWithError($message);
    }


}
