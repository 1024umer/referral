<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\BlogRequest;
use App\Repositories\{ListRepository, FileRepository};
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\BlogResource;
use App\Models\Blog;

class BlogController extends Controller
{
    protected $listRep;
    protected $file;
    public function __construct(ListRepository $listRep, FileRepository $file)
    {
        $this->listRep = $listRep;
        $this->file = $file;
        $this->listRep->bindModel(Blog::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['title', 'description'])
            ->select('blogs.*')
            ->with('category', 'image');
        if (isset($_GET['is_active']) && intval($_GET['is_active']) > 0) {
            $query = $query->where('is_active', $_GET['is_active']);
        }
        if (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) {
            $query = $query->where('category_id', $_GET['category_id']);
        }
        if (isset($_GET['perpage']) && intval($_GET['perpage']) > 0) {
            $query = $query->paginate($_GET['perpage']);
        } else {
            $query = $query->get();
        }
        return BlogResource::collection($query);
    }
    public function store(BlogRequest $request)
    {
        $attributes = $request->only('category_id', 'title', 'description', 'is_active', 'is_featured', 'long_description', 'slug');
        $blogs = Blog::create($attributes);
        if ($request->image) {
            $images = $this->file->create([$request->image], 'blogs', $blogs->id);
        }
        if ($request->detail_image) {
            $images = $this->file->create([$request->detail_image], 'blogs_detail', $blogs->id);
        }
        $blogs->save();
        return new BlogResource($blogs);
    }
    public function show(Blog $blogs, $id)
    {
        $blogs = Blog::where('id', $id)->orderBy('id', 'desc')->with('image', 'detailImage')->first();
        return new BlogResource($blogs);
    }
    public function update(Request $request, $id)
    {
        $blogs = Blog::find($id);
        $blogs->update($request->only('category_id', 'title', 'description', 'is_active', 'is_featured', 'long_description', 'slug'));
        if ($request->image && $request->image != null) {
            $images = $this->file->create([$request->image], 'blogs', $blogs->id, 1);
        }
        if ($request->detail_image && $request->detail_image != null) {
            $images = $this->file->create([$request->detail_image], 'blogs_detail', $blogs->id, 1);
        }
        return new BlogResource($blogs);
    }
    public function destroy($id)
    {
        $blogs = Blog::find($id)->delete();
        return response()->json(null, 204);
    }
}