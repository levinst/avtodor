<?php
use Alexusmai\LaravelFileManager\Controllers\FileManagerController;
use Alexusmai\LaravelFileManager\Services\ConfigService\ConfigRepository;
// use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Admin\Banners;
use App\Http\Livewire\Admin\Categories;
use App\Http\Livewire\Admin\Contents;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Faqs;
use App\Http\Livewire\Admin\Files;
use App\Http\Livewire\Admin\InfoCarrier;
use App\Http\Livewire\Admin\News;
use App\Http\Livewire\Admin\PhotoReports;
use App\Http\Livewire\Admin\ContrCatDoc;
use App\Http\Livewire\Admin\ContrDoc;
use App\Http\Livewire\ContrDocView as LivewireContrDocView;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Category;
use App\Http\Livewire\ContentView;
use App\Http\Livewire\Faqs as LivewireFaqs;
use App\Http\Livewire\Files as LivewireFiles;
// use App\Http\Livewire\Auth\Passwords\Confirm;
// use App\Http\Livewire\Auth\Passwords\Email;
// use App\Http\Livewire\Auth\Passwords\Reset;
// use App\Http\Livewire\Auth\Register;
// use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;
use App\Http\Livewire\News as LivewireNews;
use App\Http\Livewire\NewsView;
use App\Http\Livewire\CarrierView;
use App\Http\Livewire\Carrier as LivewireCarrier;
use App\Http\Livewire\PhotoReports as LivewirePhotoReports;
use App\Http\Livewire\PhotoReportsView;
use App\Http\Livewire\ContrDoc as LivewireContrDoc;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/link', function () {
    Artisan::call('storage:link');
    return "Ссылка содана!";
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Сброс кэша выполнен!";
});
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////

Route::get('/', Home::class)->name('home');
Route::get('news', LivewireNews::class)->name('newsAll');
Route::get('news/{slug}', NewsView::class)->name('newsView');
Route::get('carrier', LivewireCarrier::class)->name('carrierAll');
Route::get('carrier/{slug}', CarrierView::class)->name('carrierView');
Route::get('contrdoc', LivewireContrDoc::class)->name('contrdocAll');
Route::get('contrdoc/{slug}', LivewireContrDocView::class)->name('contrdocView');
Route::get('content/{slug}', ContentView::class)->name('contentView');
Route::get('photoreports', LivewirePhotoReports::class)->name('photoreportsAll');
Route::get('photoreports/{slug}', PhotoReportsView::class)->name('photoreportsView');
Route::get('files/{category}', LivewireFiles::class)->name('files-list');
Route::get('faqs', LivewireFaqs::class)->name('faqs-list');
Route::get('category/{slug}', Category::class)->name('category');

// Administrator
Route::middleware('auth')->prefix('administrator')->group(function () {
    Route::get('/', Dashboard::class)->name('administrator');
    Route::get('news', News::class)->name('news');
    Route::get('info-carrier', InfoCarrier::class)->name('info-carrier');
    Route::get('photoreports', PhotoReports::class)->name('photoreports');
    Route::get('files', Files::class)->name('files');
    Route::get('faqs', Faqs::class)->name('faqs');
    Route::get('categories', Categories::class)->name('categories');
    Route::get('contents', Contents::class)->name('contents');
    Route::get('banners', Banners::class)->name('banners');
    Route::get('contr-cat-doc', ContrCatDoc::class)->name('contr-cat-doc');
    Route::get('contr-doc', ContrDoc::class)->name('contr-doc');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    // Route::get('register', Register::class)
    //     ->name('register');
});

// Route::get('password/reset', Email::class)
//     ->name('password.request');

// Route::get('password/reset/{token}', Reset::class)
//     ->name('password.reset');

// Route::middleware('auth')->group(function () {
//     Route::get('email/verify', Verify::class)
//         ->middleware('throttle:6,1')
//         ->name('verification.notice');

//     Route::get('password/confirm', Confirm::class)
//         ->name('password.confirm');
// });

Route::middleware('auth')->group(function () {
    // Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
    //     ->middleware('signed')
    //     ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});


// Laravel FileManager
// Route::middleware('auth')->prefix('laravel-filemanager')->group(function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

///////////////////////
//*** FileManager ***//
///////////////////////
$config = resolve(ConfigRepository::class);

// App middleware list
$middleware = $config->getMiddleware();

/**
 * If ACL ON add "fm-acl" middleware to array
 */
if ($config->getAcl()) {
    $middleware[] = 'fm-acl';
}

Route::group([
    'middleware' => $middleware,
    'prefix'     => $config->getRoutePrefix(),
    'namespace'  => 'Alexusmai\LaravelFileManager\Controllers',
], function () {

    Route::get('initialize', [FileManagerController::class, 'initialize'])
        ->name('fm.initialize');

    Route::get('content', [FileManagerController::class, 'content'])
        ->name('fm.content');

    Route::get('tree', [FileManagerController::class, 'tree'])
        ->name('fm.tree');

    Route::get('select-disk', [FileManagerController::class, 'selectDisk'])
        ->name('fm.select-disk');

    Route::post('upload', [FileManagerController::class, 'upload'])
        ->name('fm.upload');

    Route::post('delete', [FileManagerController::class, 'delete'])
        ->name('fm.delete');

    Route::post('paste', [FileManagerController::class, 'paste'])
        ->name('fm.paste');

    Route::post('rename', [FileManagerController::class, 'rename'])
        ->name('fm.rename');

    Route::get('download', [FileManagerController::class, 'download'])
        ->name('fm.download');

    Route::get('thumbnails', [FileManagerController::class, 'thumbnails'])
        ->name('fm.thumbnails');

    Route::get('preview', [FileManagerController::class, 'preview'])
        ->name('fm.preview');

    Route::get('url', [FileManagerController::class, 'url'])
        ->name('fm.url');

    Route::post('create-directory', [FileManagerController::class, 'createDirectory'])
        ->name('fm.create-directory');

    Route::post('create-file', [FileManagerController::class, 'createFile'])
        ->name('fm.create-file');

    Route::post('update-file', [FileManagerController::class, 'updateFile'])
        ->name('fm.update-file');

    Route::get('stream-file', [FileManagerController::class, 'streamFile'])
        ->name('fm.stream-file');

    Route::post('zip', [FileManagerController::class, 'zip'])
        ->name('fm.zip');

    Route::post('unzip', [FileManagerController::class, 'unzip'])
        ->name('fm.unzip');

    // Route::get('properties', 'FileManagerController@properties');

    // Integration with editors
    Route::get('tinymce5', [FileManagerController::class, 'tinymce5'])
        ->name('fm.tinymce5');

    Route::get('fm-button', [FileManagerController::class, 'fmButton'])
        ->name('fm.fm-button');
});
