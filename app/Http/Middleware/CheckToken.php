<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //验证是否已经登录
        //得到当前访问的控制器名
        $controller = get_class($request->route()->getController());
        $controllerArr = explode('\\',$controller);
        $controllerName = array_pop($controllerArr);
        var_dump($controllerName);
        return $next($request);
    }
}
