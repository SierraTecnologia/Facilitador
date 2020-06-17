<?php

namespace Facilitador\Exceptions;

use Throwable;
use Exception as BaseException;
use Support\Models\RedirectRule;
use App\Exceptions\Handler as AppHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Subclass the App's handler to add custom handling of various exceptions
 */
class Handler extends AppHandler
{

    public static $DEFAULT_MESSAGE = 'Algo que não esta certo deu errado! Por favor, entre em contato conosco.';

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        if (config('app.env')=='production'/* && app()->bound('sentry') && $this->shouldReport($exception)*/) {
            // Slack Report
            Log::channel('slack')->error('[PaymentService Fatal Error] Fatal erro: '.$exception->getMessage());

            // // Sentry Report
            // // \Sentry\configureScope(function (Scope $scope): void {
            // //     if ($user = auth()->user()) {
            // //         $scope->setUser([
            // //             'id' => $user->id,
            // //             'email' => $user->email,
            // //             'cpf' => $user->cpf
            // //         ]);
            // //     }
            // // });
            // app('sentry')->captureException($exception);
        }
    
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd($e); // @todo tirar aqui
        // Check for custom handling
        if ($response = $this->handle404s($request, $exception)) {
            return $response;
        }

        if ($response = $this->handleCSRF($exception)) {
            return $response;
        }

        if ($response = $this->handleValidation($request, $exception)) {
            return $response;
        }

        // Allow the app to continue processing
        return parent::render($request, $exception);
    }

    /**
     * If a 404 exception, check if there is a redirect rule.  Or return a simple
     * header if an AJAX request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handle404s($request, $e)
    {
        // Check for right exception
        if (!is_a($e, ModelNotFoundException::class) && !is_a($e, NotFoundHttpException::class)) {
            return;
        }

        // Check for a valid redirect
        if ($rule = RedirectRule::matchUsingRequest()->first()) {
            return redirect($rule->to, $rule->code);
        }

        // Return header only on AJAX
        if ($request->ajax()) {
            return response(null, 404);
        }
    }

    /**
     * If a CSRF invalid exception, log the user out
     *
     * @param  \Exception $e
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleCSRF($e)
    {
        if (!is_a($e, TokenMismatchException::class)) {
            return;
        }

        return app('facilitador.acl_fail');
    }

    /**
     * Redirect users to the previous page with validation errors
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     * @return \Illuminate\Http\Response
     */
    protected function handleValidation($request, $e)
    {
        if (!is_a($e, ValidationFail::class)) {
            return;
        }

        // Log validation errors so Reporter will output them
        // if (Config::get('app.debug')) Log::debug(print_r($e->validation->messages(), true));

        // Respond
        if ($request->ajax()) {
            return response()->json($e->validation->messages(), 400);
        }

        return back()->withInput()->withErrors($e->validation);
    }
}
