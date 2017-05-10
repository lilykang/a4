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

# The following routes require authorization
Route::group(['middleware' => 'auth'], function () {

    Route::get('/ideas', 'IdeaController@index');

    # Get route to show a form to create a new idea
    Route::get('/ideas/new', 'IdeaController@createNewIdea');

    # Post route to process the form to add a new idea
    Route::post('/ideas/new', 'IdeaController@storeNewIdea');

    # Get route to show a form to edit an existing idea
    Route::get('/ideas/edit/{id}', 'IdeaController@edit');

    # Post route to process the form to save edits to an idea
    Route::post('/ideas/edit', 'IdeaController@saveEdits');

    # Get route to confirm deletion of idea
    Route::get('/ideas/delete/{id}', 'IdeaController@confirmDeletion');
    Route::get('/ideas/{id}/delete', 'IdeaController@confirmDeletion');

    # Post route to  destroy the idea
    Route::post('/ideas/delete', 'IdeaController@delete');
});

# Show individual idea
Route::get('/ideas/{id?}', 'IdeaController@show');

Auth::routes();

Route::get('/', 'IdeaController@index');
Route::get('/home', 'IdeaController@index');

Route::get('/logout', function() {
    Auth::logout();
});

if(App::environment('local')) {

    Route::get('/drop', function() {

        $db = Config::get('database.connections.mysql.database');

        DB::statement('DROP database '.$db);
        DB::statement('CREATE database '.$db);

        return 'Dropped '.$db.'; created '.$db.'.';
    });

};
