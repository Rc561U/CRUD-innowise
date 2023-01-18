<?php

namespace Crud\Mvc\core\http\request;

class Request implements RequestInterface
{
    /**
     * @var string|null
     */
    private ?string $uri;
    /**
     * @var string|null
     */
    private ?string $method;
    /**
     * @var string|null
     */
    private ?string $contentType;
    /**
     * @var array
     */
    private array $params;
    /**
     * @var array
     */
    private array $post;

    /**
     * @param string|null $uri
     * @param string|null $method
     * @param string|null $contentType
     * @param array $params
     * @param array $post
     */
    public function __construct(
        ?string $uri,
        ?string $method,

        ?string $contentType,
        array   $params,
        array   $post
    )
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->contentType = $contentType;
        $this->params = $params;
        $this->post = $post;

    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }


    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getJsonRequest()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
