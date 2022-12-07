<?php

namespace Crud\Mvc\app\models;

use Crud\Mvc\core\http\response\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiUser
{
    private static Client $client;
    protected static array $headers = ['Content-Type' => 'application/json',
        'Authorization' => 'Bearer b23be7073b19da9b7bb4942492e1ae5fb68a5cc4354155e103f9cf3cf2ae57a5',
        'Accept' => 'application/json'];

    public static function setClient()
    {
        return self::$client = new Client(['base_uri' => 'https://gorest.co.in']);
    }

    public static function post($data)
    {
        $res = self::setClient()->request('POST', "/public/v2/users/",
            [
                'exceptions' => false,
                'json' => [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'gender' => $data['gender'],
                    'status' => $data['status'],
                ],
                'headers' => self::$headers,
            ]
        );
        return $res->getBody()->getContents();
    }

    public static function delete($id)
    {
        $query = self::setClient()->request('DELETE', "/public/v2/users/$id",
            [
                'exceptions' => false,
                'headers' => self::$headers
            ]);

        $result = $query->getBody()->getContents();
        return $result ? $result : json_encode(['message' => 'Deleted successfully']);
    }

    public static function patch($id, $data)
    {
        $res = self::setClient()->request('PATCH', "/public/v2/users/$id",
            [
                'exceptions' => false,
                'json' => [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'gender' => $data['gender'],
                    'status' => $data['status'],
                ],
                'headers' => self::$headers
            ]
        );

        return $res->getBody()->getContents();
    }

    /**
     * @throws GuzzleException
     */
    public static function get(?int $id, ?array $params, ResponseInterface $response): string
    {

        if ($id) {
            $res = self::handleGetRequest($id);
        } elseif (isset($params['page']) && isset($params['per_page'])) {
            $res = self::handleGetRequest("?per_page={$params['per_page']}&page={$params['page']}");
        } elseif (isset($params['page'])) {
            $res = self::handleGetRequest("?page={$params['page']}");
        } elseif (isset($params['per_page'])) {
            $res = self::handleGetRequest("?per_page={$params['per_page']}");
        } else {
            $res = self::handleGetRequest($id);
        }
        $response->setHeaders([
            @"x-pagination-total: {$res->getHeader('x-pagination-total')[0]}",
        ]);
        return $res->getBody()->getContents();
    }

    /**
     * @throws GuzzleException
     */
    private static function handleGetRequest(?string $params): \Psr\Http\Message\ResponseInterface
    {
        $options = ['exceptions' => false, 'headers' => self::$headers];
        $uri = "/public/v2/users/";
        return self::setClient()->request('GET', $uri . $params, $options);
    }
}
