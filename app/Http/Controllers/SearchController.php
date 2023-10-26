<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Blog,Category};
class SearchController extends Controller
{
    public function blogCategory($category_id){
        $categoriesAll = Category::get();
        $blogs = Blog::where('category_id', 'LIKE', "%$category_id%")->where('is_active',1)->get();
        foreach ($blogs as $blog) {
            $ids = json_decode($blog->category_id);
            $categories = Category::whereIn('id', $ids)->get();
            $blog->categories = $categories;
        }
        return view('dashboard.blog')->with('title','Blog')->with(compact('blogs','categories','categoriesAll'));
    }
    public function blogSearch(Request $request)        
    {
    $blogs = Blog::where('is_active', 1)
                ->where('title', 'LIKE', "%$request->blog_search%")
                ->orWhere('description', 'LIKE', "%$request->blog_search%")
                 ->get();
                 foreach ($blogs as $blog) {
                    $ids = json_decode($blog->category_id);
                    $categories = Category::whereIn('id', $ids)->get();
                    $blog->categories = $categories;
                }
    $categoriesAll = Category::get();
    return view('dashboard.blog')->with('title','Blog')->with(compact('blogs','categories','categoriesAll'));
    }
}
