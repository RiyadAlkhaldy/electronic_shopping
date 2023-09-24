<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        // $query = Category::query() ;
        $categories = Category::leftJoin('categories as parents', 'parents.id', "=", 'categories.parent_id')
            ->select(['categories.*', 'parents.name as parent_name'])
            ->filter($request)->paginate(3);
        // dd($categories);

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        Category::create($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'created success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { //select * from categories;
        $category = Category::find($id);
        //select * from categories where id <> $id and ( parent_id is null or parent_id <> $id  )
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get(['id', 'name']);
        return view('dashboard/categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('uploads')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('success', 'updated success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $category = Category::findOrFail($id);
        $category->delete();
        //    if($category->image){
        //     Storage::disk('uploads')->delete($category->image);
        //    }
        return Redirect::route('dashboard.categories.index')->with('success', "deleted {$category->id} success");
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        return $file->store('categories', "uploads");
    }
    public function trash()
    {
        $request = request();
        $categories = Category::leftJoin('categories as parents', 'parents.id', "=", 'categories.parent_id')
            ->select(['categories.*', 'parents.name as parent_name'])
            ->filter($request)->onlyTrashed()->paginate(3);
        return view('dashboard.categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return Redirect::route('dashboard.categories.trash')->with('success', "Category of id = $id restored");
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('uploads')->delete($category->image);
        }
        return Redirect::route('dashboard.categories.trash')->with('success', "Category of id = $id is deleted for ever");
    }
}
