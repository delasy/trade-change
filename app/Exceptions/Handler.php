<?php

namespace App\Exceptions;

use Exception;
use App\Helpers\AppHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler {
    /**
     * True if error was sent to error reporting system.
     *
     * @var bool
     */
    private $handledError = false;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception) {
        $should_report = !$this->handledError;

        if ($should_report) {
            foreach ($this->dontReport as $dont_report) {
                if ($exception instanceof $dont_report) {
                    $should_report = false;
                    break;
                }
            }
        }

        if ($should_report) {
            $e_file = str_replace(base_path(), '', $exception->getFile());
            $e_line = ':' . $exception->getLine();

            $this->handledError = true;

            AppHelper::sendTelegramMessage(
                '<b>Ошибка в приложении</b>' . PHP_EOL
                . '<code>' . $e_file . $e_line . ' - ' . $exception->getMessage() . '</code>'
            );
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception) {
        return parent::render($request, $exception);
    }


    /**
     * Return not authorized users to signin page
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception) {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('auth/signin'));
    }
}
