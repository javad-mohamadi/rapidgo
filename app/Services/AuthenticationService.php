<?php

namespace App\Services;

use App\DTOs\Auth\LoginDTO;
use App\Exceptions\LogicException;
use App\Services\Interfaces\AuthenticationServiceInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response as HttpResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @string
     */
    const AUTH_ROUTE = '/oauth/token';

    /**
     * @param LoginDTO $dto
     * @return PromiseInterface|HttpResponse
     * @throws LogicException
     */
    public function login(LoginDTO $dto): PromiseInterface|HttpResponse
    {
        $data = [
            'username' => $dto->email,
            'password' => $dto->password,
        ];

        $loginData = array_merge($data, [
            'grant_type'    => $dto->grant_type ?? 'password',
            'client_id'     => Config::get('passport.personal_access_client.id'),
            'client_secret' => Config::get('passport.personal_access_client.secret'),
            'scope'         => '',
        ]);


        return $this->callOAuth($loginData);
    }

    /**
     * @param $data
     * @return PromiseInterface|HttpResponse
     * @throws LogicException
     */
    public function callOAuth($data): PromiseInterface|HttpResponse
    {
        try {
            $authFullApiUrl = Config::get('app.url') . self::AUTH_ROUTE;

            return Http::asForm()->post($authFullApiUrl, $data);
        } catch (\Exception $exception){
            throw new LogicException(Response::HTTP_NOT_FOUND, $exception->getMessage());
        }

    }
}
