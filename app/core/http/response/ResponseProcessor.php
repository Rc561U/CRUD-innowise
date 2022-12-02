<?php

namespace Crud\Mvc\core\http\response;


class ResponseProcessor
{


    /**
     * @param ResponseInterface $response
     * @return void
     */
    public function process(ResponseInterface $response)
    {
        $this->clearHeaders();
        $this->processHeaders($response->getHeaders());
        $this->setCode($response->getCode());
        if (!empty($response->getCookie())) {
            $this->setCookie($response->getCookie());
        }
        if ($response->getBody()) {
            $this->renderBody($response->getBody());
        } else {
            $this->renderBodyJson($response->getBodyJson());
        }
    }

    /**
     * @return void
     */
    protected function clearHeaders(): void
    {
        header_remove();
    }

    /**
     * @param array $headers
     * @return void
     */
    protected function processHeaders(array $headers): void
    {
        foreach ($headers as $header) {
            header($header);
        }
    }

    /**
     * @param int $code
     * @return void
     */
    protected function setCode(int $code): void
    {
        http_response_code($code);
    }

    protected function setCookie($cookie): void
    {
        setcookie($cookie["name"], $cookie["token"], $cookie["expire"]);
    }

    /**
     * @param mixed $body
     * @return void
     */
    protected function renderBody(mixed $body): void
    {
        $result = $body['content'] ?? null;
        $status = $body['status'] ?? null;
        $errors = $body['errors'] ?? null;
        $pagination = $body['pagination'] ?? null;


        include_once "app/views/layouts/header.php";
        include_once $body['template'];
        include_once "app/views/layouts/footer.php";
    }

    protected function renderBodyJson(mixed $body): void
    {
        echo json_encode($body);
    }
}
