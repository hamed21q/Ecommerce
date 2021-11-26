<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(['name' => 'required']);
        $tag = Tag::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
        ]);
        return $tag;
    }
    public function update(Request $request, $id)
    {
        $tag =  Tag::find($id);
        if($tag != null && $tag->user_id == auth()->user()->id)
        {
            $tag->update([
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
        $tag =  Tag::find($id);
        if($tag != null && $tag->user_id == auth()->user()->id)
        {
            $tag->delete();
            return 'seccessfull';
        }else{
            return response('not found', 404);
        }
    }
}
