<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function __construct(
        private BookRepository $bookRepository
    )
    { 
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'pageNumbers' => 'required|integer',
            ],
            [
                'required' => ':attribute deve ser declarado no body',
                'integer' => ':attribute deve ser tipo :type',
                'string' => ':attribute deve ser tipo :type',
                'max' => ':attribute deve ser tipo :max',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $bookService = new BookService($this->bookRepository);

        $result = $bookService->store($request->all());

        if (is_array($result) && in_array('error', $result)) {
            return response()->json([
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json($result, 201);
    }

    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pagination' => 'required|integer',
            ],
            [
                'required' => ':attribute deve ser declarado no body',
                'integer' => ':attribute deve ser tipo :type',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $bookService = new BookService($this->bookRepository);

        $result = $bookService->list($request->input('pagination'));

        if (is_array($result) && in_array('error', $result)) {
            return response()->json([
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json($result, 200);
    }

    public function show($bookId)
    {
        $bookService = new BookService($this->bookRepository);

        $result = $bookService->show($bookId);

        if (is_array($result) && in_array('error', $result)) {
            return response()->json([
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json($result, 200);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'pageNumbers' => 'required|integer',
            ],
            [
                'required' => ':attribute deve ser declarado no body',
                'integer' => ':attribute deve ser tipo :type',
                'string' => ':attribute deve ser tipo :type',
                'max' => ':attribute deve ser tipo :max',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $bookService = new BookService($this->bookRepository);

        $result = $bookService->update($id, $request->all());

        if (is_array($result) && in_array('error', $result)) {
            return response()->json([
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json($result, 200);
    }

    public function destroy($bookId)
    {
        $bookService = new BookService($this->bookRepository);

        $result = $bookService->delete($bookId);

        if (is_array($result) && in_array('error', $result)) {
            return response()->json([
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json([], 204);
    }
}
