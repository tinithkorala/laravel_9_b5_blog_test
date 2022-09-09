<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("category.category_index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('category.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,c_name|min:3|max:255'
        ]);

        DB::beginTransaction();

        try {

            Category::create([
                'c_name' => $request->input('category_name'),
                'is_active' => 1
            ]);
            
            DB::commit();

            return redirect()->route('categories.create')->with('success', 'Category has been successfully inserted !');

        }catch(\Exception $e) {

            return redirect()->route('categories.create')->with('error', 'Category has not been successfully inserted. Try again !');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'category_name' => 'required|unique:categories,c_name,'.$category->id
            ]);
           
            $checkbox = $request->input('category_status');

            if((int) $checkbox == 1) {
                $checkbox = 1;
            }else {
                $checkbox = 0;
            }

            $category->update([
                'c_name' => $request->input('category_name'),
                'is_active' => $checkbox,
            ]);
            
            DB::commit();

            return redirect()->route('categories.edit', $category)->with('success', 'Category has been successfully updated !');

        }catch(\Exception $e) {

            return redirect()->route('categories.edit', $category)->with('error', 'Category has not been successfully updated. Try again !');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {

            $category->delete();
            
            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Category has been successfully deleted !');

        }catch(\Exception $e) {

            return redirect()->route('categories.index')->with('error', 'Category has not been successfully deleted. Try again !');

        }
    }
}
