<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Query\JoinClause;

// Category
use App\Models\Category;

// eloquent sluggable
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // simpan subquery dari join table users dan publish_permissions
        $admin_publish = DB::table('publish_permissions')
                            ->join('users', 'users.id', '=', 'publish_permissions.user_id')
                            ->join('articles','articles.id', '=', 'publish_permissions.article_id') 
                            ->select('users.name as admin_nm', 'publish_permissions.user_id as admin_id', 'articles.id as article_id');

        // Ambil data hasil join dari table article, users, aticle_user_links, categories, publish_permision dan subquery $admin_publish
        $articles = DB::table('article_user_links')
                        ->join('users', 'users.id', '=', 'article_user_links.user_id')
                        ->join('articles', 'articles.id', '=', 'article_user_links.article_id')
                        ->join('categories', 'categories.id', '=', 'articles.category_id')
                        ->join('publish_permissions', 'publish_permissions.article_id', '=', 'articles.id')
                        ->join('userdetails', 'userdetails.user_id', '=', 'users.id')
                        ->joinSub($admin_publish, 'admin', function($join){
                            $join->on('articles.id', '=', 'admin.article_id');
                        })
                        ->where('publish_permissions.status_permission', '=', 'publish')
                        ->groupByRaw('article_user_links.article_id, articles.title, categories.category, publish_permissions.publish_at, publish_permissions.user_id, admin.admin_nm, articles.excerpt, articles.imagetitle, articles.id')
                        ->select(DB::raw('group_concat(users.name) as writer, articles.title, categories.category, publish_permissions.publish_at, publish_permissions.user_id, admin.admin_nm, articles.excerpt, articles.imagetitle, articles.id'))
                        ->get();

        // Redirect dengan data
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUser = auth()->user();
        $dataCat  = Category::all();

        return view('article.articleCreate', ['categories' => $dataCat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    // eloquent sluggable
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    } 
}
