<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(['name' => 'required']);
        $category = Category::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
        ]);
        return $category;
    }
    public function update(Request $request, $id)
    {
        $category =  Category::find($id);
        if($category != null)
        {
            $category->update([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
            ]);
            return 'seccessfull';

        }else{
            return response('not found', 404);
        }
    }
    public function delete($id)
    {
        $category =  Category::find($id);
        if($category != null)
        {
            $category->delete();
            return 'seccessfull';
        }else{
            return response('not found', 404);
        }
    }
}
