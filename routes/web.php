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
use App\Http\Livewire\Report\Index as ReportIndex;
use App\Http\Livewire\Role\Index as RoleIndex;
use App\Http\Livewire\Studio\Index as StudioIndex;
use App\Http\Livewire\Subscription\SubscriptionLog;
use App\Http\Livewire\Terms;
use App\Http\Livewire\User\Index as UserIndex;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

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

Route::get('analytics', function() {
    $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
    return $analyticsData;
});

Route::get('sitemap', function () {
    $posts =  Post::latest('id')->take(8)->get();
    SitemapGenerator::create(config('app.url'))
        ->getSitemap()
        ->add($posts->map(function ($post) {
            return Url::create("/watch?c=$post->code")
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.5);
        }))
        ->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap created';
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/actresses', [ActressController::class, 'index'])->name('actresses');

Route::get('/actress/{actress:slug}', [ActressController::class, 'show'])->name('actress');

Route::get('/genres', [GenreController::class, 'index'])->name('genres');

Route::get('/genre/{genre:slug}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/studios', [StudioController::class, 'index'])->name('studios');

Route::get('/detail/studio/{studio:slug}', [StudioController::class, 'show'])->name('studio.show');

Route::get('/category/{category:slug}', [ControllersCategoryController::class, 'show'])->name('category');

Route::get('contacts', [ContactController::class, 'index'])->name('contact');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/watch', [HomeController::class, 'show'])->name('watch');

Route::get('/terms', [ContactController::class, 'terms'])->name('terms');
Route::get('/about', [ContactController::class, 'about'])->name('about');

Route::get('/watch-by/{keyword}', [WatchByController::class, 'index'])->name('watch.by')->middleware('checkKeyword');

Route::get('/vip', [VipController::class, 'index'])->name('vip');

Route::middleware(['auth'])->group(function () {

    Route::get('notifications', [UserProfileController::class, 'userNotifications'])->name('notifications');

    Route::get('/subscriptions', [UserProfileController::class, 'userSubscription'])->name('usersubscription.log');

    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');

    Route::get('/actress-collection', [ActressController::class, 'actressCollection'])->name('actress.collection');

    Route::get('/jav/collection', [ActressController::class, 'javCollection'])->name('save');
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

    Route::get('/actresses',  ActressIndex::class)->name('actress.index');

    Route::get('/sutdios', StudioIndex::class)->name('studio.index');

    Route::get('/category', CategorIndex::class)->name('category.index');

    Route::get('/genres', GenreIndex::class)->name('genre');

    Route::get('/roles', RoleIndex::class)->name('role');

    Route::get('/downloads', DownloadIndex::class)->name('download');
    Route::get('/movies', MovieIndex::class)->name('movie');

    Route::get('/users', UserIndex::class)->name('user.index');

    Route::get('/terms', Terms::class)->name('terms.edit');
    Route::get('/about', About::class)->name('about.edit');

    Route::middleware('role:admin|super-admin')->group(function () {
        Route::get('/subscription-plan', PlanIndex::class)->name('subscription.plan');

        Route::get('/subscription/log', SubscriptionLog::class)->name('subscription.log');
    });

    Route::get('/reports', ReportIndex::class)->name('reports');
    
    Route::get('/basic', [SettingController::class, 'basic'])->name('setting.basic');
    Route::get('/telegram', [SettingController::class, 'telegram'])->name('setting.telegram');
    Route::get('/contact-payment', [SettingController::class, 'contactPayment'])->name('setting.contact-payment');
});

require __DIR__ . '/auth.php';
