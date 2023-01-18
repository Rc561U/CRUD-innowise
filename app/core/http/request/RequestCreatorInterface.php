<?php

namespace Crud\Mvc\core\http\request;


interface RequestCreatorInterface
{

    public function create(): RequestInterface;

    /**
     * @param array $request
     * @return array
     */

}
