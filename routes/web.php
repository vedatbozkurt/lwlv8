<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts;

use App\Http\Livewire\Contact\ContactIndex;
use App\Http\Livewire\Contact\Create;
use App\Http\Livewire\Contact\Update;
use App\Http\Livewire\Contact\Index;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('post', Posts::class)->name('posts');
Route::get('contact', ContactIndex::class)->name('contact');
Route::get('contact/create', Create::class)->name('contact.create');
Route::get('/contact/{id}/edit', Update::class)->name('contact.edit');
Route::get('contacts', Index::class)->name('contacts');
// Route::get('contacts', function () {
//     return view('livewire.contact.index');
// });
