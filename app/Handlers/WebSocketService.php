<?php

namespace App\Handlers;

use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Illuminate\Support\Facades\Log;

class WebSocketService implements WebSocketHandlerInterface
{

    public function __construct()
    {
    }

    public function onOpen(\Swoole\WebSocket\Server $server, \Swoole\Http\Request $request)
    {

        try{
            $server->push($request->fd, 'Welcome to LaravelS');
            Log::info('sdfdsfds');
        }catch (\Exception $exception){
            Log::info('sdfsfsdfds');
        }

    }


    public function onMessage(\Swoole\WebSocket\Server $server, \Swoole\WebSocket\Frame $frame)
    {
        Log::info("从{$frame->fd} 接收到的数据:{$frame->data}");
    }


    public function onClose(\Swoole\WebSocket\Server $server, $fd, $reactorId)
    {
        Log::info("连接关闭:" . $fd);
    }


}