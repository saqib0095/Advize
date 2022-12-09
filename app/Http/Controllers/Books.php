<?php

namespace App\Http\Controllers;

use App\Services\BooksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreBooksRequest;

class Books extends Controller
{
    
    public function upload(BooksService $booksService,
                           StoreBooksRequest $request)
    {
        $validated = $request->safe()->only([
            'ISBN',
            'Title',
            'Author',
            'Category',
            'Price'
        ]);
        
        if($storeBook = $booksService->store($validated)){
            return response($storeBook,201);
        }
    }

    public function searchData(Request $request,
                              BooksService $booksService)
    {
        $validator = Validator::make($request->all(),[
            'authorName' => 'regex:/[a-zA-Z0-9\s]+/',
            'category'  => 'regex:/[a-zA-Z0-9\s]+/'
        ]);
        if($validator->fails()){
            return response()->json(
                array_merge([
                    'error' => 1,
                    'message' => 'Parameters are not valid!'
                ],
                $validator->errors()->messages()
            ),400
            );
        }
        return response()->json($booksService->searchData($request));
    }
    public function getCategory(Request $request,
                              BooksService $booksService)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'regex:/[a-zA-Z0-9\s]+/'
        ]);
        if($validator->fails()){
            return response()->json(
                array_merge([
                    'error' => 1,
                    'message' => 'Parameters are not valid!'
                ],
                $validator->errors()->messages()
            ),400
            );
        }
        return response()->json($booksService->getCategory($request->category));
    }
}
