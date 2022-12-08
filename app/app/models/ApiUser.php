<?php

namespace Crud\Mvc\app\models;

use Crud\Mvc\core\http\response\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


/**
 * @OA\Info(
 *   title="Native PHP REST API",
 *   version="1.0.0",
 *
 * )
 */
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

    /**
     * @OA\Post(
     *     path="/api/users/",
     *     tags={"Create"},
     *     summary="Create new user",
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  description="The product name",
     *                  example="localhost@localhost.com",
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Jim Royal",
     *              ),
     *              @OA\Property(
     *                  property="gender",
     *                  type="string",
     *                  example="male",
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="active",
     *              ),
     *           ),
     *        ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="A resource was successfully created in response to a POST request",
     *     ),
     *     @OA\Response(
     *     response="422",
     *     description="Data validation failed. Please check the response body for detailed error messages.",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     */
    public static function post($data,$response)
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
        $response->setCode($res->getStatusCode());
        return $res->getBody()->getContents();
    }


    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Delete"},
     *     summary="Delete user by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The user ID",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK. Everything worked as expected",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="The requested resource does not exist",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     */
    public static function delete($id, $response): bool|string
    {
        $query = self::setClient()->request('DELETE', "/public/v2/users/$id",
            [
                'exceptions' => false,
                'headers' => self::$headers
            ]);

        $result = $query->getBody()->getContents();
        $response->setCode($query->getStatusCode());
        return $result ? $result : json_encode(['message' => 'Deleted successfully']);
    }

    /**
     * @OA\Patch(
     *     path="/api/users/{id}",
     *     tags={"Update"},
     *     summary="Update user by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The user ID",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="localhost@localhost.com",
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Jim Royal",
     *              ),
     *              @OA\Property(
     *                  property="gender",
     *                  type="string",
     *                  example="female",
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="inactive",
     *              ),
     *           ),
     *        ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="The requested resource does not exist",
     *     ),
     *     @OA\Response(
     *     response="422",
     *     description="Data validation failed. Please check the response body for detailed error messages.",
     *     ),
     * )
     *
     * Update the specified resource in storage.
     */
    public static function patch($id, $data,$response): string
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
        $response->setCode($res->getStatusCode());
        return $res->getBody()->getContents();
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get list all users",
     *     tags={"Users"},
     *     @OA\Response(response="200", description="OK. Everything worked as expected")
     *
     * )
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"User"},
     *     summary="Get user by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="The requested resource does not exist",
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     *
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
        $response->setCode($res->getStatusCode());
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
