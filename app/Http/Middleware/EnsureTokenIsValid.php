<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าค่า header ที่ต้องการมีอยู่หรือไม่
        if (!$request->hasHeader('invitrace-api-key')) {
            // ถ้าไม่มี header นี้ ให้ตอบกลับด้วย error หรือ redirect
            return response()->json(['error' => 'Header not found'], 400);
        }
        // dd($request->Header('invitrace-api-key'));
        $service = Service::where('key', $request->Header('invitrace-api-key'))->first();
        // dd($service);
        // ตรวจสอบค่า header ที่ต้องการ
        if (!$service) {
            // ถ้าค่าไม่ตรง ให้ตอบกลับด้วย error หรือ redirect
            return response()->json(['error' => 'Invalid header value'], 403);
        }

        return $next($request);
    }
}
