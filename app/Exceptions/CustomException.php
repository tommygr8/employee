<?php


namespace App\Exceptions;


use Illuminate\Http\Response;
use Exception;

class CustomException extends Exception
{
    private $data;

    public function __construct($message = "", $code = "", $data = "")
    {
        $this->data = $data;
        parent::__construct($message, $code);
    }



    public function render($request)
    {
        return Response::error($this->getMessage(),$this->data,$this->getCode());
    }
}