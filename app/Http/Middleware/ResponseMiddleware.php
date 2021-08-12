<?php

namespace App\Http\Middleware;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\ResponseTrait;
use Closure;

class ResponseMiddleware
{

    /**
     * Interpret data and format to standard json format
     * process only the response for mobile api's
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response->headers->get('content-type') == 'application/json') {
            $content = (array) $response->getData();
            $action = explode('/', $request->path());
            if (isset($content['error'])) {
                $result['message'] = $content['error'];
                $result['action'] = $action[1];
                $response->setData(array("error" => $result));
            } else {
                $result['data'] = isset($content['data']) ? $content['data'] : [];
                if (isset($content['message'])) {
                    //show success message for status 200
                    $result['message'] = isset($content['message']) ? $content['message'] : '';
                } else {
                    //show exception for status 500 case
                    $result['message'] = !empty($content[0]) ? $content[0] : '';
                }
                $response->setData(array("result" => $result));
            }
        }
        return $response;
    }
}
