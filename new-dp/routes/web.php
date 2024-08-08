<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FeedController;
use App\Services\Feed\RssService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Admin/Feed',function(){
    return Inertia::render('Admin/Feed/index');
})->middleware(['auth', 'verified'])->name('admin.feed');

Route::get('/Admin/Feed/{id}',function($id){
    return Inertia::render('Admin/Feed/view',[
        'id'=>$id
    ]);
})->middleware(['auth', 'verified'])->name('admin.feed.view');

Route::get('/Admin/Sns/Store',function(){
    return Inertia::render('Admin/Feed/store');
})->middleware(['auth', 'verified'])->name('admin.feed.store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/api/feeds', [FeedController::class, 'getFeeds']);
Route::get('/api/feeds/{id}', [FeedController::class, 'getFeed']);
Route::get('/api/lastFetchFeed',[FeedController::class, 'lastFetchFeed']);
Route::get('/api/rss-fetch', [RssService::class, 'saveFeeds']);

Route::middleware('auth')->group(function () {
    Route::post('/api/feed/store', [FeedController::class, 'store']);
});

require __DIR__.'/auth.php';
