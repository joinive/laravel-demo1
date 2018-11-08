<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    $headers = array('Content-Type'=>'text/plain');
    return response('<h1>Hello world</h1>', 200)
        ->header('Content-Type', 'text/html')
        ->header('X-Header-One', 'Header Value')
        ->header('X-Header-Two', 'Header Value')
        ->cookie('name', 'value', 30)
        ->header('Cache-Control', 'no-cache, public');
});
Route::get('qcloud/test','QcloudController@test');
//
Route::get('file',function() {
    return \response()->file(storage_path('app\\public\\72f082025aafa40f8197e0cca764034f78f01949.jpg'));

    return \response()->download(storage_path('app\\public\\72f082025aafa40f8197e0cca764034f78f01949.jpg','aaa.jpg'));

//    return \response()->download(storage_path('app\\public\\72f082025aafa40f8197e0cca764034f78f01949.jpg'));
    //return response('asdf',200);

//    return response()->json([
//        'name'=>'ads',
//        'sex'=>'male'
//    ]);
});

Route::get('/profile/{id}','UserController@showProfile');

Route::get('/scache', function () {
    return Cache::add('username','aa',300) ? 'yes' : 'no';
});
Route::get('/cache', function () {
    return Cache::get('username');
});

Route::get('login/github', 'LoginController@redirectToProvider');
Route::get('login/github/callback', 'LoginController@handleProviderCallback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user/{id}', 'UserController@show');


// 显示创建博客文章表单...
Route::get('post/create', 'PostController@create');
// 存储新的博客文章...
Route::post('post', 'PostController@store')->name('post.store');

Route::post('comment/{comment}');


Route::get('welcome/{locale}', function ($locale) {
    App::setLocale($locale);
    //
});

Route::get('test', 'HomeController@test');

Route::get('/test1', function (Request $request, Response $response) {
    //return response()->make( 'aaa');
    return response('aaaaa',200);

});

//Route::get('/test2', function (Request $request, Response $response) {
//    return response('bbbbbbb',200);
//})->middleware('test');

Route::middleware('test')->get('/test2', function (Request $request, Response $response) {
    return response('bbbbbbb',200);
});

Route::get('notice', 'TestController@notice');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test/pics', 'TestController@pics')->name('pics');
Route::get('/test/image', 'TestController@image');
Route::get('/test/hashid', 'TestController@hashid');
Route::get('/users/{id}', 'UserController@show')->name('users.show');

Route::get('/test/phone', 'TestController@phone');
Route::get('/test/qiniu', 'TestController@qiniu');
Route::get('/test/remember', 'TestController@remember');
Route::get('/test/pdf', 'TestController@pdf');
Route::get('/test/zip', 'TestController@zip');
Route::get('/test/geo', 'TestController@geo');
Route::get('/test/export', 'TestController@export');
Route::get('/test/tt', 'TestController@tt');
Route::get('/test', 'TestController@index');
Route::get('/test/agent', 'TestController@browser');

Route::get('jpush/test', 'JPushController@test');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('sitemap', function() {

    // create new sitemap object
    $sitemap = App::make('sitemap');

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 60);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached()) {
        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

        // add item with translations (url, date, priority, freq, images, title, translations)
        $translations = [
            ['language' => 'fr', 'url' => URL::to('pageFr')],
            ['language' => 'de', 'url' => URL::to('pageDe')],
            ['language' => 'bg', 'url' => URL::to('pageBg')],
        ];
        $sitemap->add(URL::to('pageEn'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', [], null, $translations);

        // add item with images
        $images = [
            ['url' => URL::to('images/pic1.jpg'), 'title' => 'Image title', 'caption' => 'Image caption', 'geo_location' => 'Plovdiv, Bulgaria'],
            ['url' => URL::to('images/pic2.jpg'), 'title' => 'Image title2', 'caption' => 'Image caption2'],
            ['url' => URL::to('images/pic3.jpg'), 'title' => 'Image title3'],
        ];
        $sitemap->add(URL::to('post-with-images'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', $images);

        // get all posts from db
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
        foreach ($posts as $post) {
            $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
        }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');
});


Route::get('BigSitemap', function() {
    // create new sitemap object
    $sitemap = App::make('sitemap');

    // get all products from db (or wherever you store them)
    $products = DB::table('products')->orderBy('created_at', 'desc')->get();

    // counters
    $counter = 0;
    $sitemapCounter = 0;

    // add every product to multiple sitemaps with one sitemap index
    foreach ($products as $p) {
        if ($counter == 50000) {
            // generate new sitemap file
            $sitemap->store('xml', 'sitemap-' . $sitemapCounter);
            // add the file to the sitemaps array
            $sitemap->addSitemap(secure_url('sitemap-' . $sitemapCounter . '.xml'));
            // reset items array (clear memory)
            $sitemap->model->resetItems();
            // reset the counter
            $counter = 0;
            // count generated sitemap
            $sitemapCounter++;
        }

        // add product to items array
        $sitemap->add($p->slug, $p->modified, $p->priority, $p->freq);
        // count number of elements
        $counter++;
    }

    // you need to check for unused items
    if (!empty($sitemap->model->getItems())) {
        // generate sitemap with last items
        $sitemap->store('xml', 'sitemap-' . $sitemapCounter);
        // add sitemap to sitemaps array
        $sitemap->addSitemap(secure_url('sitemap-' . $sitemapCounter . '.xml'));
        // reset items array
        $sitemap->model->resetItems();
    }

    // generate new sitemapindex that will contain all generated sitemaps above
    $sitemap->store('sitemapindex', 'sitemap');
});


Route::get('mysitemap', function(){

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    // get all posts from db
    $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

    // add every post to the sitemap
    foreach ($posts as $post)
    {
        $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // generate your sitemap (format, filename)
    $sitemap->store('xml', 'mysitemap');
    // this will generate file mysitemap.xml to your public folder

});

// sitemap with posts
Route::get('sitemap-posts', function()
{
    // create sitemap
    $sitemap_posts = App::make("sitemap");

    // set cache
    $sitemap_posts->setCache('laravel.sitemap-posts', 3600);

    // add items
    $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

    foreach ($posts as $post)
    {
        $sitemap_posts->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // show sitemap
    return $sitemap_posts->render('xml');
});

// sitemap with tags
Route::get('sitemap-tags', function()
{
    // create sitemap
    $sitemap_tags = App::make("sitemap");

    // set cache
    $sitemap_tags->setCache('laravel.sitemap-tags', 3600);

    // add items
    $tags = DB::table('tags')->get();

    foreach ($tags as $tag)
    {
        $sitemap_tags->add($tag->slug, null, '0.5', 'weekly');
    }

    // show sitemap
    return $sitemap_tags->render('xml');
});
// sitemap index
Route::get('sitemap', function()
{
    // create sitemap
    $sitemap = App::make("sitemap");

    // set cache
    $sitemap->setCache('laravel.sitemap-index', 3600);

    // add sitemaps (loc, lastmod (optional))
    $sitemap->addSitemap(URL::to('sitemap-posts'));
    $sitemap->addSitemap(URL::to('sitemap-tags'));

    // show sitemap
    return $sitemap->render('sitemapindex');
});


Route::get('sitemap-store', function()
{
    // create sitemap
    $sitemap_posts = App::make("sitemap");

    // add items
    $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
    foreach ($posts as $post)
    {
        $sitemap_posts->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // create file sitemap-posts.xml in your public folder (format, filename)
    $sitemap_posts->store('xml','sitemap-posts');

    // create sitemap
    $sitemap_tags = App::make("sitemap");

    // add items
    $tags = DB::table('tags')->get();

    foreach ($tags as $tag)
    {
        $sitemap_tags->add($tag->slug, null, '0.5', 'weekly');
    }

    // create file sitemap-tags.xml in your public folder (format, filename)
    $sitemap_tags->store('xml','sitemap-tags');

    // create sitemap index
    $sitemap = App::make ("sitemap");

    // add sitemaps (loc, lastmod (optional))
    $sitemap->addSitemap(URL::to('sitemap-posts'));
    $sitemap->addSitemap(URL::to('sitemap-tags'));

    // create file sitemap.xml in your public folder (format, filename)
    $sitemap->store('sitemapindex','sitemap');
});


Route::get('/app', function() {
    if (!Agent::isMobile()) {
        return response('PC 访问');
    }

    if (Agent::isiOS()) {
        // 判断是微信
        if (str_contains(Agent::getUserAgent(), 'MicroMessenger')) {
            return response('请使用 Safari 打开下载');
        }

        return response('https://itunes.apple.com/xxx');
    }
});
Route::get('hprose', 'HproseController@test');
Route::resource('demo', 'DemoController');
Route::resource('solr', 'SolrController');