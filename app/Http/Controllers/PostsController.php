<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostsModel;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function getAllPosts(){
        if (auth()->user()->admin == 1){
            return view('posts', [
                'posts' => PostsModel::all()
            ]);
        }
        else {
            return view('posts', [
                'posts' => PostsModel::where('userId', auth()->user()->id)->get()
            ]);
        }
    }
    
    public function addPost(Request $request){
        PostsModel::create([
            'userId' => auth()->user()->id,
            'title' => $request->get("title"),
            'subTitle' => $request->get("subTitle"),
            'publisher' => $request->get("publisher"),
            'date' => $request->get("date"),
            'excerpt' => $request->get("excerpt"),
        ]);

        return redirect("/posts");
    }

    public function editPost($id){
        return view('posts', [
            'posts' => PostsModel::where('userId', auth()->user()->id)->get(),
            'upForEdit'=> PostsModel::where('id', $id)->first(),
        ]);
    }

    public function updatePost(Request $request){
        if (PostsModel::where('id', $request->get('id'))->count() == 0){
            echo 'NOT FOUND';
        }
        else {
            PostsModel::where('id', $request->post('id'))->update([
                'title' => $request->get("title"),
                'subTitle' => $request->get("subTitle"),
                'publisher' => $request->get("publisher"),
                'date' => $request->get("date"),
                'excerpt' => $request->get("excerpt"),
            ]);
            return redirect("/posts");
        }
    }

    public function deletePost($id){
        if (PostsModel::where(['id' => $id, 'userId' => auth()->user()->id])->count() == 0){
            echo 'NOT FOUND';
        }
        else {
            if (!is_numeric($id)){
                echo 'INVALID OPERATION CODE.';
            }
            else {
                PostsModel::where(['id' => $id, 'userId' => auth()->user()->id])->delete();
                return redirect("/posts");
            }
        }
    }
}
