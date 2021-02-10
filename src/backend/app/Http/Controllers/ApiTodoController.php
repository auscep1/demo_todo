<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class ApiTodoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Todo::all(), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'string', 'max:255'],
            'css_selector' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $obj = Todo::create([
            'url' => $request->url,
            'css_selector' => $request->css_selector,
        ]);
        return response()->json($obj, 201);
    }

    /**
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Todo $todo)
    {
        return response()->json($todo, 200);
    }

    /**
     * @param Request $request
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'string', 'max:255'],
            'css_selector' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $todo->url = $request->url;
        $todo->css_selector = $request->css_selector;
        $todo->save();
        return response()->json($todo, 200);
    }

    /**
     * @param Todo $todo
     * @throws \Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
    }
}
