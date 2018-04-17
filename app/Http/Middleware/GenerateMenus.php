<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
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
        \Menu::make('Sidebar', function ($menu) {
           $menu->add('Home', "blubb")->data('icon', 'users');
           $menu->home->active();
           $menu->add('Test', "blibb");
           $menu->test->add('TestChild', "blibb2");
        });

        return $next($request);
    }
}
