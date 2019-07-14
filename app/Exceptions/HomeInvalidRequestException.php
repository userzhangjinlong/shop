<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

/**
 * Client端用户错误行为页面
 *
 * Class HomeInvalidRequestException
 * @package App\Exceptions
 */
class HomeInvalidRequestException extends Exception
{
    public function __construct(string $message = "", int $code = 200, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request){
        if ($request->expectsJson()){
            // json() 方法第二个参数就是 Http 返回码
            return response()->json(['msg' => $this->message], $this->code);
        }

        return view('Home.Pages.error', ['msg' => $this->message]);
    }
}
