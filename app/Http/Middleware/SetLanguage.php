<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;

class SetLanguage
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
        $locale = $request->header('Accept-Language');

        if ($locale && in_array($locale, ['en', 'ar'])) {
            Carbon::setLocale($locale);
            App::setLocale($locale);
        }

        return $next($request);
    }
}

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
// use Symfony\Component\HttpFoundation\Response;

// class SetLanguage
// {
//     public function handle(Request $request, Closure $next): Response
//     {
//         $lang = null;

//         // 1️⃣ شُف إذا في lang بالـ query string
//         if ($request->has('lang')) {
//             $lang = $request->query('lang');
//         }
//         // 2️⃣ إذا ما في query، شُف الـ session (لو كانت موجودة)
//         elseif ($request->session() && $request->session()->has('lang')) {
//             $lang = $request->session()->get('lang');
//         }
//         // 3️⃣ إذا ما في ولا حاجة، استخدم الـ default locale
//         else {
//             $lang = config('app.locale');
//         }

//         // ✅ اضبط الـ locale
//         App::setLocale($lang);

//         // ✅ اضبط الـ session لو كانت موجودة (web routes فقط)
//         if ($request->session()) {
//             $request->session()->put('lang', $lang);
//         }

//         return $next($request);
//     }
// }

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
// use Symfony\Component\HttpFoundation\Response;

// class SetLanguage
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {

//     if ($request->has('lang')) {
//             $lang = $request->query('lang');
//         } elseif ($request->session()->has('lang')) {
//             $lang = $request->session()->get('lang');
//         } else {
//             $lang = config('app.locale');
//         }
//         $request->session()->put('lang', $lang);
//         App::setlocale($lang);
//         return $next($request);
//     }
// }
