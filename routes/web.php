<?php



Route::get('/', 'HomeController@index');

//subscribers
Route::post('subscriber', 'SubscriberController@store')->name('subscribers.store');


//login
Auth::routes();


Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']], function (){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //aprobar posts
    Route::get('pendientes/posts', 'PostController@pending')->name('posts.pending');
    Route::put('posts/{post}/aprobar', 'PostController@approval')->name('posts.approve');

    //Posts
    Route::resource('posts', 'PostController');
    Route::resource('categorias', 'CategoryController')->parameters([
        'categorias' => 'category'
    ]);
    Route::resource('etiquetas', 'TagController')->parameters([
        'etiquetas' => 'tag'
    ]);

    //Subscribers
    Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    Route::delete('/subscribers/{subscriber}', 'SubscriberController@destroy')->name('subscribers.destroy');



});

Route::group([
    'as' => 'author.',
    'prefix' => 'author',
    'namespace' => 'Author',
    'middleware' => ['auth', 'author']], function (){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //Posts
    Route::resources([
        'posts' => 'PostController',
    ]);



});
