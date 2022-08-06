<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class OuterController extends Controller
{
    public function index()
    {
        // $articles = Articles::orderByDesc('id')->get(); //baca dokumentasi lazy loading dan eager loading
        $articles = Articles::get();
        //nama depan filenya
        return view('home', [
            'title' => 'Deacourse-Laravel Artikel',
            'articles' => $articles
        ]);
    }

    public function article_detail($id)
    {

        return view('article', [
            'article' => Articles::find($id)
        ]);
    }
}
