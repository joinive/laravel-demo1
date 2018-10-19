<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    /**
     * 显示创建新的博客文章的表单
     *
     * @return Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * 存储新的博客文章
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreBlogPost $request)
    {
        // 验证并存储博客文章...
        $validatedData = $request->validate([
            'title' => 'bail|required|unique:posts|max:255',
            'body' => 'required',
            'author.name' => 'required',
            'author.desc' => 'required',
            'publish_at' => 'nullable|date',

        ]);
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('post/create')
                ->withErrors($validator)
                ->withInput();
        }

        // 验证通过，存储到数据库...

    }

}
