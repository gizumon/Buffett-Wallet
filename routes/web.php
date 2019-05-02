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

Auth::routes();

//Home page
Route::get('/', ['middleware' => 'auth', function () {
    return redirect('/home');
}]);
Route::get('/home', 'HomeController@index')->name('home');

//Evaluation list page
Route::get('/list', 'ListController@index')->name('list');
Route::post('/list', 'ListController@listRegist')->name('list');
Route::patch('/list', 'ListController@listUpdate')->name('list');
Route::delete('/list/{id}', 'ListController@listDelete')->name('list');


//Route::get('/list', ['middleware' => 'auth', function () {
//    $stock_code = 0;
//    $name = "stock";
//    return redirect('/list');
//}]);

Route::get('/serch', ['middleware' => 'auth', function () {
    return redirect('/serch');
}]);

Route::post('/book', ['middleware' => 'auth',  function (Request $request) {
    $validator = Validator::make($request->all(),[
        'name' => 'required|max:255',
    ]);

    if($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $book = new Book; //ORM
    $book->title = $request->name;
    $book->save();

    return redirect('/');
}]);

//{id}で囲んだ値を取得し、$idに格納
Route::delete('/book/{book}', ['middleware' => 'auth',  function (Book $book) {
    $book->delete();

    return redirect('/');    
}]);