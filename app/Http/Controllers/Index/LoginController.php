<?php

namespace App\Http\Controllers\Index;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Server\Exception\OAuthServerException;

use Zend\Diactoros\Response as Psr7Response;

class LoginController extends Controller
{
    public function login(AuthorizationServer $server, ServerRequestInterface $request)
    {
        try {
            $result = $server->respondToAccessTokenRequest($request, new Psr7Response);

        } catch (OAuthServerException $exception) {
            $status = 401;
            $message = $exception->getMessage();

            //用户密码错误,返回402
            if ($exception->getCode() == 6) {
                $status = 402;
                $message = ['error' => '用户密码错误'];
            }
            //返回错误信息
            return response()->json($message, $status);
        }

        if ($result->getStatusCode() === 200) {
            $username = $request->getParsedBody()['username'];

            //登录成功, 查询用户信息


            $user = User::query()
                ->select('id', 'name', 'email')
                ->where('email', $username)
                ->first();
            //返回 token 和用户信息
            return response()->json(['token' => json_decode((string)$result->getBody(), true), 'user' => $user], $result->getStatusCode());
        }

    }

    public function sign(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();


      return  User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>Hash:: make($request->input('password')),
        ]);

    }
}

