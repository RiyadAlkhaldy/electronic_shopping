<?php

namespace App\Exceptions;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // $this->reportable(function (QueryException $e) {
        //     if ($e->getCode() == 23000) {
        //         Log::channel('sql')->warning($e->getMessage());
        //         return false;
        //     }
        //     return true;
        // });

        // /**
        //  * Handling the QueryException
        //  */
        // $this->renderable(function (QueryException $e, $request) {
        //     if ($e->getCode() == 23000) {
        //         $messagee = "Foreign key constraint violation";
        //     } else {
        //         $messagee = $e->getMessage();
        //     }
        //     if ($request->expectsJson()) {
        //         return response()->json(['error' => $messagee], 400);
        //     }

        //     return redirect()->back()
        //         ->withInput()
        //         ->withErrors(['error' => $messagee])
        //         ->with('error', $messagee);
        // });
    }
}
