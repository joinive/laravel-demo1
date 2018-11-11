<?php

namespace App\Http\Controllers;

use App\Mail\Test2;
use App\Notifications\InvoicePaid;
use App\Notifications\Test1;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Clue\React\Buzz\Browser;
//use Intervention\Image\ImageManagerStatic as Image;
use Image;
use Illuminate\Support\Facades\Storage;
use PDF;
use phpDocumentor\GraphViz\Exception;
use Zipper;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('doNotCacheResponse', ['only' => ['fooAction', 'barAction']]);

    }

    public function browser() {
        $browser = \Agent::browser();
        if ($browser == 'IE' && \Agent::version($browser) <= 8) {
            dd('不支持 IE 8 及以下浏览器');
        }
        return 'yes';
    }

    public function index() {
        return User::all();
    }
    public function tt() {
        User::first()->delete();
        //User::withTrashed()->first()->restore();

        return 'adf';
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    //
    public function geo() {
        $ip = '119.4.121.109';
        dd(geoip($ip));
        return geoip($ip)->toArray();
    }

    public function notice() {

//        $user = User::find(1);
//        foreach ($user->notifications as $notification) {
//            $notification->markAsRead();
//            echo $notification->type,'<br/>';
//        }
//        return 'yes';
//
//        Mail::to(User::find(1))->send(new Test2());
//        return 'yes';
//
//        set_time_limit(30);

        $user = User::findOrfail(1);
        $user->notify(new Test1());
//        $users = User::all();
//        Notification::send($users, new InvoicePaid());
        return 'yes';
    }


    public function pics() {
        set_time_limit(0);
        $res = $result = '';
        $loop = \React\EventLoop\Factory::create();

        $client = new Browser($loop);
        $result = $client->get('https://www.pexels.com/photo/kitten-cat-rush-lucky-cat-45170/')
            ->then(function(\Psr\Http\Message\ResponseInterface $response) {
                echo $response->getBody();
            });
        $client->get('https://www.pexels.com/photo/adorable-animal-baby-blur-177809/')
            ->then(function(\Psr\Http\Message\ResponseInterface $response) {
                echo $response->getBody();
            });
        $loop->run();


        return 'adsf';

    }

    public function image() {
        //Image::configure(array('driver' => 'imagick'));
        // open an image fileI
//        $img = Image::make(storage_path('app/public/72f082025aafa40f8197e0cca764034f78f01949.jpg'));
//// resize image instance
//        $img->resize(320, 240);
//// insert a watermark
//        $img->insert(storage_path('app/public/baidu_jgylogo3.gif'));
//// save image in desired format
//        $img->save(storage_path('app/public/final.png'));
//        return asset('final.png');

//        // create a new image resource
//        $img = Image::canvas(800, 600, '#ff0000');
//        // send HTTP header and output image data
//        //return $img->response('jpg', 70);
//
//        // send HTTP header and output image data
//        header('Content-Type: image/png');
//        return "<img src='".$img->encode('png')."'>";

 //       Image::make(Input::file('photo'))->resize(300, 200)->save('foo.jpg');

        // pass calls to image cache
        $img = Image::cache(function($image) {
            $image->make(storage_path('app/public/final.png'))->resize(1080, 720)->greyscale();
        });
        //$img->save(storage_path('app/public/final1.png'));
        return 'yes';
    }

    public function hashid() {
        return route('users.show', 1);
    }

    public function qiniu() {
        $disk = Storage::disk('qiniu');

// create a file
        $disk->put('avatars/filename.jpg', readfile(storage_path('app/public/final.png')));

        $disk->put('avatars/filename.txt', 'asdfsdf');

// check if a file exists
        $exists = $disk->has('file.jpg');
        var_dump($exists);
// get timestamp
        $time = $disk->lastModified('avatars/filename.jpg');
        echo $time,'<br/>';
        $time = $disk->getTimestamp('avatars/filename.jpg');
        echo $time,'<br/>';
// copy a file
        $disk->copy('avatars/filename.jpg', 'avatars/filename3.jpg');

// move a file
        $disk->move('avatars/filename.jpg', 'avatars/filename1.jpg');
// get file contents
        $contents = $disk->read('avatars/filename.txt');
        echo $contents;

// fetch url content
        $file = $disk->fetch('folder/newfilename.txt', 'https://github.com/overtrue/laravel-filesystem-qiniu');
        var_dump($file);

// get file url
        $url = $disk->getUrl('folder/newfilename.txt');
        var_dump($url);
// get file upload token
        $token = $disk->getUploadToken('folder/newfilename.txt');
        $token = $disk->getUploadToken('folder/newfilename.txt', 3600);
        var_dump($token);
// get private url
        $url = $disk->privateDownloadUrl('folder/newfilename.txt');
        var_dump($url);

        dd($disk);

    }
    public function phone(Request $request) {
        $param = $request->validate([
            'phone'=> 'phone'
        ]);
        return $param;
    }

    public function remember() {
        $users = User::remember(60)->cacheTags('user_queries')->cacheDriver('redis')->count();

        $u = new User;

        return $u->getAllCached();
        return $users;
    }

    public function pdf() {
        return PDF::loadFile('http://www.github.com')->inline('github.pdf');

        $data = ['name'=>'yyyyyyyyyyyy'];
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');

        $snappy = App::make('snappy.pdf');
//To file
        $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
        $snappy->generateFromHtml($html, storage_path('app/pulic/bill-123.pdf'));
        $snappy->generate('http://www.github.com', storage_path('app/pulic/github.pdf'));

//Or output:
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }

    public function zip() {
        $files = glob(storage_path('app/public'));
        Zipper::make(storage_path('test.zip'))->add($files)->close();

        return 'yes';
    }

    public function config() {
        return config('only_name');
    }

    public function exception() {
         //throw new Exception('asdfsdfsd');
        $a = config('adsf');
        return $a->toArray();

    }

    public function upload(Request $request) {
        return [
            'status' => 0,
            'path' => 'http://pic.pptbz.com/201506/2015070581208537.JPG'
        ];
        $path = $request->file('file')->store(storage_path('upload'));
        return [
            'status' => 0,
            'path' => url('storage/upload')
        ];
    }
}
