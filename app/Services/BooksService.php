<?php

namespace App\Services;

use App\Models\Books;
use App\Models\Categories;
use Exception;
use PhpParser\Node\Expr\Cast;

class BooksService{

    public function store($data){
        try{
            $storeBook = Books::updateOrCreate(
            ['ISBN' => $data['ISBN']]
            ,[
                'ISBN'      => $data['ISBN'],
                'Title'     => $data['Title'],
                'Author'    => $data['Author'],
                'Category'  => $data['Category'],
                'Price'     => $data['Price']    
            ]);
            $categories = explode(',',$storeBook->Category);
            foreach($categories as $category){
                $storeCategories = Categories::updateOrCreate(
                ['booksId' => $storeBook->id,'Category' => $category],    
                [
                    'booksId' => $storeBook->id,
                    'Category' => str_replace(' ','',$category)
                ]);
            }
            return [$storeBook->ISBN,$storeBook->Title,$storeBook->Author,$storeBook->Category,$storeBook->price];
        }catch(Exception $e)
        {
            return throw new Exception($e->getMessage());
        }
    }
    public function searchData($data){
        try{
            $returnQuery = Books::select('ISBN');
            if($data->authorName != ''){
                $returnQuery->where('Author','=',$data->authorName);
            }
            if($data->category != ''){
                $returnQuery->where('Category','Like','%'.$data->category.'%');
            }

            return $returnQuery->get();            
            ;
        }catch(Exception $e){
            return throw new Exception($e->getMessage());
        }
    }
    public function getCategory(?string $category){
        try{
            return Categories::distinct('category')->where('Category','LIKE','%'.$category.'%')->get('Category');
        }catch(Exception $e)
        {
            return throw new Exception($e->getMessage());
        }
    }
}