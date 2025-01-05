<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Redirect;

class InvalidOrderException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }


    public function render($request)
    {
        return Redirect::route('home')->withInput()
            ->withErrors(['message' => $this->getMessage()])
            ->with('info', $this->getMessage());
    }
}
