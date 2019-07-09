<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

/**
 * Client端系统错误显示信息
 *
 * Class HomeInternalException
 * @package App\Exceptions
 */
class HomeInternalException extends Exception
{
    public function __construct(string $message = "", string $msgForUser = '系统内部错误', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->msgForUser = $msgForUser;
    }

    public function render(Request $request){
        if ($request->expectsJson()) {
            return response()->json(['msg' => $this->msgForUser], $this->code);
        }

        return view('Home.Pages.error', ['msg' => $this->msgForUser]);
    }

}
