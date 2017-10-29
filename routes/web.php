<?php

use App\Skill;
use Illuminate\Http\Request;


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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');

Route::get('/home', function (Request $request) {
    $user = $request->user();
    $skills = $user->skills;
//Skill::orderBy('created_at', 'asc')->get();

    return view('home', [
        'skills' => $skills
    ]);
});


Route::get('/skills', 'SkillController@index');
Route::get('search',array('as'=>'search','uses'=>'SkillController@search'));
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SkillController@autocomplete'));

Route::post('/skill', 'SkillController@store');
Route::delete('/skill/{skill}', 'SkillController@destroy');

Route::get('/profil', 'ProfilController@grab'); 

