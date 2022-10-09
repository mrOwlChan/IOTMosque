<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str; 
use Illuminate\Database\Query\JoinClause;
use App\Models\Category; // Category
use \Cviebrock\EloquentSluggable\Services\SlugService; // eloquent sluggable

use App\Models\PublishPermission; // Table publish_permissions
use App\Models\Author; // Table authors

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) { // Jika terdapat request('search')
            // simpan subquery dari join table users dan publish_permissions
            $admin_publish = DB::table('publish_permissions')
            ->join('users', 'users.id', '=', 'publish_permissions.publisher_id')
            ->join('articles','articles.id', '=', 'publish_permissions.article_id') 
            ->select('users.name as admin_nm', 'publish_permissions.publisher_id as admin_id', 'articles.id as article_id');

            // Ambil data hasil join dari table article, users, aticle_user_links, categories, publish_permision dan subquery $admin_publish
            $articles = DB::table('authors')
                ->join('users', 'users.id', '=', 'authors.author_id')
                ->join('articles', 'articles.id', '=', 'authors.article_id')
                ->join('categories', 'categories.id', '=', 'articles.category_id')
                ->join('publish_permissions', 'publish_permissions.article_id', '=', 'articles.id')
                ->join('userdetails', 'userdetails.user_id', '=', 'users.id')
                ->joinSub($admin_publish, 'admin', function($join){
                    $join->on('articles.id', '=', 'admin.article_id');
                })
                ->where('publish_permissions.status', '=', '2') // 2 = publish. Kolom ini merupakan foreign key yang link ke tabel status_permission kolom id.
                ->where('articles.title', 'like', '%'.request('search').'%')
                ->orwhere('categories.category', 'like', '%'.request('search').'%')
                ->orwhere('categories.name', 'like', '%'.request('search').'%')
                ->orwhere('users.name', 'like', '%'.request('search').'%')
                ->groupByRaw('authors.article_id, articles.title, categories.category, categories.name ,publish_permissions.publish_at, publish_permissions.publisher_id, admin.admin_nm, articles.excerpt, articles.imagetitle, articles.id, articles.slug')
                ->select(DB::raw('group_concat(users.name) as writer, articles.title, articles.slug,categories.category, categories.name as cat_name,publish_permissions.publish_at, publish_permissions.publisher_id, admin.admin_nm, articles.excerpt, articles.imagetitle, articles.id'))
                ->paginate(6);
        }else{ // Tidak ada request('search')
            // simpan subquery dari join table users dan publish_permissions
            $admin_publish = DB::table('publish_permissions')
                                ->join('users', 'users.id', '=', 'publish_permissions.publisher_id')
                                ->join('articles','articles.id', '=', 'publish_permissions.article_id') 
                                ->select('users.name as admin_nm', 'publish_permissions.publisher_id as admin_id', 'articles.id as article_id');

            // Ambil data hasil join dari table article, users, aticle_user_links, categories, publish_permision dan subquery $admin_publish
            $articles = DB::table('authors')
                ->join('users', 'users.id', '=', 'authors.author_id')
                ->join('articles', 'articles.id', '=', 'authors.article_id')
                ->join('categories', 'categories.id', '=', 'articles.category_id')
                ->join('publish_permissions', 'publish_permissions.article_id', '=', 'articles.id')
                ->join('userdetails', 'userdetails.user_id', '=', 'users.id')
                ->joinSub($admin_publish, 'admin', function($join){
                    $join->on('articles.id', '=', 'admin.article_id');
                })
                ->where('publish_permissions.status', '=', '2') // 2 = publish. Kolom ini merupakan foreign key yang link ke tabel status_permission kolom id.
                ->groupByRaw('authors.article_id, articles.title, categories.category, categories.name ,publish_permissions.publish_at, publish_permissions.publisher_id, admin.admin_nm, articles.excerpt, articles.imagetitle, articles.id, articles.slug')
                ->select(DB::raw('group_concat(users.name) as writer, articles.title, articles.slug,categories.category, categories.name as cat_name,publish_permissions.publish_at, publish_permissions.publisher_id, admin.admin_nm, articles.excerpt, articles.imagetitle, articles.id'))
                ->paginate(6);
        } 
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
        $validated = $request->validate([
            'title'         => ['required', 'max:255'],
            'slug'          => ['required', 'unique:articles'],
            'category_id'   => 'required',
            'body'          => 'required'
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($validated['body']), 300, '... '); // Method static untuk mengambil data pada suatu input dengan limit maksimum karakter

        // Proses input data ke table articles
        $newArticle = Article::create($validated);

        // Proses input data ke table publish_permissions
        PublishPermission::create([
            'article_id'        => $newArticle->id,
            'status'            => 1,
            'publisher_id'      => $validated['user_id']
        ]);

        // Proses input data ke table authors
        Author::create([
            'article_id' => $newArticle->id,
            'author_id'    => $validated['user_id']
        ]);

        return redirect('/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article, $index)
    {
        $article = Article::find($index);
        
        return view('article.articleContent', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article, $index)
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

    // // Search
    // public function search(Request $request, $search){
        
    // }
}
