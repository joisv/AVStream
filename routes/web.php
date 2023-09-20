<?php

use App\Http\Controllers\ActressController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VipController;
use App\Http\Controllers\WatchByController;
use App\Http\Livewire\About;
use App\Http\Livewire\Actress\Index as ActressIndex;
use App\Http\Livewire\Category\Index as CategorIndex;
use App\Http\Livewire\Download\Index as DownloadIndex;
use App\Http\Livewire\Genre\Index as GenreIndex;
use App\Http\Livewire\Movie\Index as MovieIndex;
use App\Http\Livewire\Plan\Index as PlanIndex;
use App\Http\Livewire\Post\Create as PostCreate;
use App\Http\Livewire\Post\Edit as PostEdit;
use App\Http\Livewire\Post\Index as PostIndex;
use App\Http\Livewire\Role\Index as RoleIndex;
use App\Http\Livewire\Studio\Index as StudioIndex;
use App\Http\Livewire\Subscription\SubscriptionLog;
use App\Http\Livewire\Terms;
use App\Http\Livewire\User\Index as UserIndex;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/actresses', [ ActressController::class, 'index' ])->name('actresses');

Route::get('/actress/{actress:slug}', [ ActressController::class, 'show' ])->name('actress');

Route::get('/genres', [GenreController::class, 'index'])->name('genres');

Route::get('/detail/genre/{genre:slug}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/studios', [StudioController::class, 'index'])->name('studios');

Route::get('/detail/studio/{studio:slug}', [StudioController::class, 'show'])->name('studio.show');

Route::get('/category/{category:slug}', [ ControllersCategoryController::class, 'show' ])->name('category');

Route::get('contacts', [ContactController::class, 'index'])->name('contact');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/watch', [HomeController::class, 'show'])->name('watch');

Route::get('/terms', [ContactController::class, 'terms'])->name('terms');
Route::get('/about', [ContactController::class, 'about'])->name('about');

Route::get('/watch-by/{keyword}', [ WatchByController::class, 'index' ] )->name('watch.by')->middleware('checkKeyword');

Route::get('/vip', [VipController::class, 'index'])->name('vip');

Route::middleware(['auth'])->group(function () {

    Route::get('notifications', function () {
        SEOTools::setTitle('Notification - ' . auth()->user()->name, false);
        return view('notifications');
    })->name('notifications');

    Route::get('/subscripton/log', function () {
        SEOTools::setTitle('Subscription Log - ' . auth()->user()->name, false);
        return view('user-subscription-log');
    })->name('usersubscription.log');

    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');

    Route::get('/actress-collection', [ActressController::class, 'actressCollection'])->name('actress.collection');

    Route::get('/save', function(){
        SEOTools::setTitle('Jav Collection: ' . auth()->user()->name, false);
        return view('save');
    })->name('save');
});
// 
Route::middleware(['auth', 'role:admin|super-admin|writer'])->prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post',  PostIndex::class)->name('post');
    Route::get('/post/create',  PostCreate::class)->name('post.create');
    Route::get('/post/{post}/edit',  PostEdit::class)->name('post.edit');

    Route::get('/actress',  ActressIndex::class)->name('actress.index');

    Route::get('/sutdio', StudioIndex::class)->name('studio.index');

    Route::get('/category', CategorIndex::class)->name('category.index');

    Route::get('/genre', GenreIndex::class)->name('genre');

    Route::get('/role', RoleIndex::class)->name('role');

    Route::get('/download', DownloadIndex::class)->name('download');
    Route::get('/movie', MovieIndex::class)->name('movie');

    Route::get('/user', UserIndex::class)->name('user.index');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting');

    Route::get('/terms', Terms::class)->name('terms.edit');
    Route::get('/about', About::class)->name('about.edit');

    Route::middleware('role:admin|super-admin')->group(function () {
        Route::get('/subscription-plan', PlanIndex::class)->name('subscription.plan');

        Route::get('/subscription/log', SubscriptionLog::class)->name('subscription.log');
    });
});

require __DIR__ . '/auth.php';
