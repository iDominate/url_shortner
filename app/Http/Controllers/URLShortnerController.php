<?php

namespace App\Http\Controllers;

use App\Http\Requests\URLRequest;
use App\Models\UrlEntry;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\URL;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

class URLShortnerController extends Controller
{
    public function shorten(URLRequest $request)
    {
        $uniqueId = uniqid();
        $data = [
            UrlEntry::UNIQUE_ID => $uniqueId . '',
            UrlEntry::ORIGINAL_URL => $request->validated()['url'],
            UrlEntry::SHORTEND_URL => env('APP_URL') . ":8000/api/visit/" . $uniqueId
        ];
        UrlEntry::create($data);
        return response()->with(code: Response::HTTP_OK, data: $data, status: 'ok');
    }

    public function visit(Request $request, $id)
    {
        $url = UrlEntry::where(UrlEntry::UNIQUE_ID, $id)->first();
        return redirect()->away($url->original_url);
    }
}