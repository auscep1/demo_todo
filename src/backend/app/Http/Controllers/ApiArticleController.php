<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiArticleController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Article::all(), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url_title' => ['required', 'string', 'max:255'],
            'css_content' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $obj = Article::create([
            'url_title' => $request->url_title,
            'css_content' => $request->css_content,
        ]);
        return response()->json($obj, 201);
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( $id)
    {
        return response()->json(Article::findOrFail($id), 200);
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'url_title' => ['required', 'string', 'max:255'],
            'css_content' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $article->url_title = $request->url_title;
        $article->css_content = $request->css_content;
        $article->save();
        return response()->json($article, 200);
    }

    /**
     * @param Article $article
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
