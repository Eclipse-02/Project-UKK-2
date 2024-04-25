<?php

use App\DataTables\LogsDataTable;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Log;

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

Route::get('/', function () {
    $books = Book::all();
    return view('welcome', compact('books'));
})->name('welcome');

Route::get('/explore', function () {
    $books = Book::all();
    return view('explore', compact('books'));
})->name('explore');

Route::get('reads/{read}', [ReadController::class, 'show'])->name('reads.show');
Route::get('/{read}/download', [ReadController::class, 'download'])->name('reads.download');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {

    // ReadController
    Route::group(['prefix' => 'reads'], function() {
        Route::get('/', [ReadController::class, 'index'])->name('reads.index');
        Route::post('/', [ReadController::class, 'store'])->name('reads.store');
        Route::get('/create', [ReadController::class, 'create'])->name('reads.create');
        Route::match(['put', 'patch'], '/{read}', [ReadController::class, 'update'])->name('reads.update');
        Route::delete('/{read}', [ReadController::class, 'destroy'])->name('reads.destroy');
        Route::get('/{read}/edit', [ReadController::class, 'edit'])->name('reads.edit');
        Route::post('/{read}/borrow', [ReadController::class, 'borrow'])->name('reads.borrow');
        Route::get('/{read}/read', [ReadController::class, 'read'])->name('reads.read');
        Route::get('/{read}/later', [ReadController::class, 'later'])->name('reads.later');
        Route::post('/{read}/finish', [ReadController::class, 'finish'])->name('reads.finish');
    });

    // ProfileController
    Route::group(['prefix' => 'profiles'], function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profiles.index');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profiles.change.password');
        Route::get('/change-profile', [ProfileController::class, 'changeProfile'])->name('profiles.change.profile');
        Route::match(['put', 'patch'], '/update-password', [ProfileController::class, 'updatePassword'])->name('profiles.update.password');
        Route::match(['put', 'patch'], '/update-profile', [ProfileController::class, 'updateProfile'])->name('profiles.update.profile');
    });

    // ReviewController
    Route::group(['prefix' => 'reviews'], function() {
        Route::get('/', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/create', [ReviewController::class, 'create'])->name('reviews.create');
        Route::get('/{review}', [ReviewController::class, 'show'])->name('reviews.show');
        Route::match(['put', 'patch'], '/{review}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::get('/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    });

    Route::middleware('role:admin')->group(function() {

        // UserController
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
            Route::match(['put', 'patch'], '/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        });

        // Logs
        Route::get('/logs', function (LogsDataTable $dataTable) {
            return $dataTable->render('scaffolds.logs.index');
        })->name('logs.index');

    });

    Route::middleware('role:admin|employee')->group(function() {

        // BookController
        Route::group(['prefix' => 'books'], function() {
            Route::get('/', [BookController::class, 'index'])->name('books.index');
            Route::post('/', [BookController::class, 'store'])->name('books.store');
            Route::get('/create', [BookController::class, 'create'])->name('books.create');
            Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
            Route::match(['put', 'patch'], '/{book}', [BookController::class, 'update'])->name('books.update');
            Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
            Route::get('/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        });

        // BorrowingController
        Route::group(['prefix' => 'borrowings'], function() {
            Route::get('/', [BorrowingController::class, 'index'])->name('borrowings.index');
            Route::post('/', [BorrowingController::class, 'store'])->name('borrowings.store');
            Route::get('/{borrowing}', [BorrowingController::class, 'show'])->name('borrowings.show');
            Route::match(['put', 'patch'], '/{borrowing}', [BorrowingController::class, 'update'])->name('borrowings.update');
            Route::delete('/{borrowing}', [BorrowingController::class, 'destroy'])->name('borrowings.destroy');
            Route::get('/{borrowing}/edit', [BorrowingController::class, 'edit'])->name('borrowings.edit');
        });

        // CategoryController
        Route::group(['prefix' => 'categories'], function() {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
            Route::match(['put', 'patch'], '/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        });

        // PublisherController
        Route::group(['prefix' => 'publishers'], function() {
            Route::get('/', [PublisherController::class, 'index'])->name('publishers.index');
            Route::post('/', [PublisherController::class, 'store'])->name('publishers.store');
            Route::get('/create', [PublisherController::class, 'create'])->name('publishers.create');
            Route::get('/{publisher}', [PublisherController::class, 'show'])->name('publishers.show');
            Route::match(['put', 'patch'], '/{publisher}', [PublisherController::class, 'update'])->name('publishers.update');
            Route::delete('/{publisher}', [PublisherController::class, 'destroy'])->name('publishers.destroy');
            Route::get('/{publisher}/edit', [PublisherController::class, 'edit'])->name('publishers.edit');
        });

    });

    Route::middleware('role:user')->group(function() {

        // BookshelfController
        Route::group(['prefix' => 'shelves'], function() {
            Route::get('/', [BookshelfController::class, 'index'])->name('bookshelves.index');
            Route::post('/', [BookshelfController::class, 'store'])->name('bookshelves.store');
            Route::get('/create', [BookshelfController::class, 'create'])->name('bookshelves.create');
            Route::get('/{bookshelf}', [BookshelfController::class, 'show'])->name('bookshelves.show');
            Route::match(['put', 'patch'], '/{bookshelf}', [BookshelfController::class, 'update'])->name('bookshelves.update');
            Route::delete('/{bookshelf}', [BookshelfController::class, 'destroy'])->name('bookshelves.destroy');
            Route::get('/{bookshelf}/edit', [BookshelfController::class, 'edit'])->name('bookshelves.edit');
        });

    });

});