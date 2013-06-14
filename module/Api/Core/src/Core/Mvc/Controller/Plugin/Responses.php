<?php

namespace Core\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Http\Response;

/**
 * plugin to faster returning "bad request" response for wrong REST request.
 */
class Responses extends AbstractPlugin
{
    private function response($code, $reasonPhrase = null)
    {
        $response = new Response();
        $response->setStatusCode($code);
        if($reasonPhrase !== null) {
            $response->setReasonPhrase($reasonPhrase);
        }
        return $response;
    }

    public function internalServerError($reasonPhrase = null)
    {
        return $this->response(Response::STATUS_CODE_500, $reasonPhrase);
    }

    public function badRequest($reasonPhrase = null)
    {
        return $this->response(Response::STATUS_CODE_400, $reasonPhrase);
    }

    public function OK($reasonPhrase = null)
    {
        return $this->response(Response::STATUS_CODE_200, $reasonPhrase);
    }

    /**
     * teapot response - used when server get requests with arguments that shouldn't
     * be generated by our client - when probably somebody trying to find system exploit
     */
    public function teapot($reasonPhrase = null)
    {
        return $this->response(Response::STATUS_CODE_418, $reasonPhrase);
    }


}