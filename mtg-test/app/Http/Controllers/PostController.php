<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function getPostLists(Request $request)
    {
        $response = Http::withToken($request->bearerToken())->get('https://awesome-borg.103-47-185-219.plesk.page/api/post-lists');

        return $response->json();
    }

    public function createPost(Request $request)
    {
        $response = Http::withToken($request->bearerToken())
            ->attach('image', file_get_contents($request->file('image')), 'photo-one.jpg')
            ->post('https://awesome-borg.103-47-185-219.plesk.page/api/post-create', [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'userId' => $request->input('userId'),
            ]);

        return $response->json(); 
    }

    public function getPostDetails(Request $request, $id)
    {
        $response = Http::withToken($request->bearerToken())
            ->get("https://awesome-borg.103-47-185-219.plesk.page/api/post-details/{$id}");

        return $response->json();
    }

    public function updatePost(Request $request, $id)
    {
        $response = Http::withToken($request->bearerToken())
            ->put("https://awesome-borg.103-47-185-219.plesk.page/api/post-update/{$id}", [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'userId' => $request->input('userId'),
            ]);

        return $response->json();
    }

    public function deletePost(Request $request, $id)
    {
        $response = Http::withToken($request->bearerToken())
            ->delete("https://awesome-borg.103-47-185-219.plesk.page/api/post-delete/{$id}");

        return $response->json();
    }
}
