<?php

namespace App\Http\Controllers;

use Http;
use App\Models\Product;
use App\Jobs\ProductLiked;
use App\Models\ProductUser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function like($id, Request $request)
    {
      $response = \Http::get('http://localhost:8000/api/users');

      $user = $response->json();

    try{
      $productUser = ProductUser::create([
        'user_id' => $user['id'],
        'product_id' => $id
      ]);  

      ProductLiked::dispatch($productUser->toArray())->onQueue('admin_queue');
      
      return response([
        'message' => 'Success'
      ]);
    }catch(\Exception $exception){
        return response([
            'error' => 'You already Liked this Product'
          ], Response::HTTP_BAD_REQUEST);
    }
    }
}
