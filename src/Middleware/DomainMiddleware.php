<?php

namespace Leazycms\Domain\Middleware;

use Closure;
use Illuminate\Http\Request;

class DomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->getHost()==parse_url(config('app.url'), PHP_URL_HOST)){
            config(['domain.route'=>'panel.domain.']);
            config(['domain.path_url'=>'domain']);
            // config('modules.extension_module')
        }
        if(!$request->user()->isAdmin() && $request->user()->level != 'domain'){
            return to_route($request->user()->level .'.dashboard');
        }



        $response =  $next($request);
        if ($response->headers->get('Content-Type') == 'text/html; charset=UTF-8') {
            $content = $response->getContent();
            $content = preg_replace_callback('/<img\s+([^>]*?)src=["\']([^"\']*?)["\']([^>]*?)>/', function ($matches) {
                $attributes = $matches[1] . 'data-src="' . $matches[2] . '" ' . $matches[3];
                if (strpos($attributes, 'class="') !== false) {
                    $attributes = preg_replace('/class=["\']([^"\']*?)["\']/', 'class="$1 lazyload" ', $attributes);
                } else {
                    $attributes .= ' class="lazyload"';
                }
                return '<img ' . $attributes . ' src="/shimmer.gif">';
            }, $content);

            $content = preg_replace('/\s+/', ' ', $content);
            $response->setContent($content);
        }
        return $response;
    }
}
