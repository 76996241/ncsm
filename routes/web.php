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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ajax', 'HomeController@ajax')->name('ajax');

//管理后台路由
Route::group(['middleware' => 'userguest'], function () {
    //////////////////////////////////////////////////系统后台////////////////////////////////////////////////////////
    Route::get('/admin', ['as'=> 'admin', 'uses' =>'Admin\AdminController@index']);
    Route::get('/admin/systems/systems', ['as'=> 'admin.systems', 'uses' =>'Admin\SystemsController@systems']);
    Route::get('/admin/systems/mail', ['as'=> 'admin.mail', 'uses' =>'Admin\SystemsController@mail']);
    Route::get('/admin/systems/messages', ['as'=> 'admin.messages', 'uses' =>'Admin\SystemsController@messages']);
    Route::post('/admin/systems/update', ['as'=> 'systemsUpdate', 'uses' =>'Admin\SystemsController@update']);
    //分类管理
    Route::get('/admin/systems/cate', ['as'=> 'cate', 'uses' =>'Admin\SystemsController@cate']);
    Route::get('/admin/systems/cateedit', ['as'=> 'cateedit', 'uses' =>'Admin\SystemsController@cateedit']);
    Route::post('/admin/systems/cateedits', ['as'=> 'cateedits', 'uses' =>'Admin\SystemsController@cateedits']);
    Route::post('/admin/systems/cateadd', ['as'=> 'cateAdd', 'uses' =>'Admin\SystemsController@cateAdd']);
    Route::post('/admin/systems/catedel', ['as'=> 'catedel', 'uses' =>'Admin\SystemsController@catedel']);
    Route::get('/admin/systems/cateselect', ['as'=> 'cateselect', 'uses' =>'Admin\SystemsController@cateselect']);
    Route::get('/admin/systems/newsselect', ['as'=> 'newsselect', 'uses' =>'Admin\SystemsController@newsselect']);
    Route::get('/admin/systems/gageselect', ['as'=> 'gageselect', 'uses' =>'Admin\SystemsController@gageselect']);
    Route::get('/admin/systems/measureselect', ['as'=> 'measureselect', 'uses' =>'Admin\SystemsController@measureselect']);
    //权限管理
    Route::get('/admin/systems/authority', ['as'=> 'authority', 'uses' =>'Admin\SystemsController@authority']);
    Route::get('/admin/systems/authorityadmin', ['as'=> 'authorityadmin', 'uses' =>'Admin\SystemsController@authorityadmin']);
    Route::post('/admin/systems/authorityupdate', ['as'=> 'authorityupdate', 'uses' =>'Admin\SystemsController@authorityupdate']);
    Route::post('/admin/systems/authorityInit', ['as'=> 'authorityInit', 'uses' =>'Admin\SystemsController@authorityInit']);
    //用户管理
    Route::get('/admin/user', ['as'=> 'user', 'uses' =>'Admin\UserController@index']);
    Route::get('/admin/UserEdit', ['as'=> 'UserEdit', 'uses' =>'Admin\UserController@UserEdit']);
    Route::post('/admin/UserUpdate', ['as'=> 'UserUpdate', 'uses' =>'Admin\UserController@UserUpdate']);
    //资讯类信息管理
    Route::get('/admin/news', ['as'=> 'news', 'uses' =>'Admin\NewsController@index']);
    Route::get('/admin/news/add', ['as'=> 'newsadd', 'uses' =>'Admin\NewsController@add']);
    Route::post('/admin/news/NewsInsert', ['as'=> 'NewsInsert', 'uses' =>'Admin\NewsController@NewsInsert']);
    Route::get('/admin/news/edit', ['as'=> 'newsedit', 'uses' =>'Admin\NewsController@edit']);
    Route::post('/admin/news/NewsUpdate', ['as'=> 'NewsUpdate', 'uses' =>'Admin\NewsController@NewsUpdate']);
    Route::post('/admin/news/NewsDel', ['as'=> 'NewsDel', 'uses' =>'Admin\NewsController@NewsDel']);
    //量具教学资源管理
    Route::get('/admin/gage', ['as'=> 'gage', 'uses' =>'Admin\GageController@index']);
    Route::get('/admin/gage/add', ['as'=> 'gageadd', 'uses' =>'Admin\GageController@add']);
    Route::post('/admin/gage/GageInsert', ['as'=> 'GageInsert', 'uses' =>'Admin\GageController@GageInsert']);
    Route::get('/admin/gage/edit', ['as'=> 'gageedit', 'uses' =>'Admin\GageController@edit']);
    Route::post('/admin/gage/GageUpdate', ['as'=> 'GageUpdate', 'uses' =>'Admin\GageController@GageUpdate']);
    Route::post('/admin/gage/GageDel', ['as'=> 'GageDel', 'uses' =>'Admin\GageController@GageDel']);
    //题库管理
    Route::get('/admin/questions/{key}', ['as'=> 'questions', 'uses' =>'Admin\QuestionsController@index'])->where('key', '[Cnc][A-Za-z]+');;
    Route::get('/admin/questions/{key}/add', ['as'=> 'questionsadd', 'uses' =>'Admin\QuestionsController@add'])->where('key', '[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/QuestionsInsert', ['as'=> 'QuestionsInsert', 'uses' =>'Admin\QuestionsController@QuestionsInsert'])->where('key', '[Cnc][A-Za-z]+');;
    Route::get('/admin/questions/{key}/questionsedit', ['as'=> 'questionsedit', 'uses' =>'Admin\QuestionsController@edit'])->where('key', '[Cnc][A-Za-z]+');;
    Route::post('/admin/questions/{key}/QuestionsUpdate', ['as'=> 'QuestionsUpdate', 'uses' =>'Admin\QuestionsController@QuestionsUpdate'])->where('key', '[Cnc][A-Za-z]+');;
    Route::post('/admin/questions/{key}/QuestionsDel', ['as'=> 'QuestionsDel', 'uses' =>'Admin\QuestionsController@QuestionsDel'])->where('key', '[Cnc][A-Za-z]+');;
    Route::post('/admin/questions/{key}/QuestionsSelect', ['as'=> 'QuestionsSelect', 'uses' =>'Admin\QuestionsController@QuestionsSelect'])->where('key', '[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/QuestionsSelects', ['as'=> 'QuestionsSelects', 'uses' =>'Admin\QuestionsController@QuestionsSelects'])->where('key', '[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/QuestionsSelectss', ['as'=> 'QuestionsSelectss', 'uses' =>'Admin\QuestionsController@QuestionsSelectss'])->where('key', '[Cnc][A-Za-z]+');

    //题库管理 - 试题题目管理
    Route::get('/admin/questions/{key}/subject', ['as'=> 'subject', 'uses' =>'Admin\QuestionsController@subject'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/SubjectInsert', ['as'=> 'SubjectInsert', 'uses' =>'Admin\QuestionsController@SubjectInsert'])->where('key', '[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/SubjectUpdate', ['as'=> 'SubjectUpdate', 'uses' =>'Admin\QuestionsController@SubjectUpdate'])->where('key', '[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/subjectedit', ['as'=> 'subject', 'uses' =>'Admin\QuestionsController@subjectedit'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/StandardsInsert', ['as'=> 'StandardsInsert', 'uses' =>'Admin\QuestionsController@StandardsInsert'])->where('key', '[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/standards', ['as'=> 'standards', 'uses' =>'Admin\QuestionsController@standards'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/MeasuresInsert', ['as'=> 'MeasuresInsert', 'uses' =>'Admin\QuestionsController@MeasuresInsert'])->where('key', '[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/measures', ['as'=> 'measures', 'uses' =>'Admin\QuestionsController@measures'])->where('key', '[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/SubjectsSort', ['as'=> 'SubjectsSort', 'uses' =>'Admin\QuestionsController@SubjectsSort'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/StandardsSort', ['as'=> 'StandardsSort', 'uses' =>'Admin\QuestionsController@StandardsSort'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/MeasureSort', ['as'=> 'MeasureSort', 'uses' =>'Admin\QuestionsController@MeasureSort'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/SubjectsDel', ['as'=> 'SubjectsDel', 'uses' =>'Admin\QuestionsController@SubjectsDel'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/StandardsDel', ['as'=> 'StandardsDel', 'uses' =>'Admin\QuestionsController@StandardsDel'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/MeasureDel', ['as'=> 'MeasureDel', 'uses' =>'Admin\QuestionsController@MeasureDel'])->where('key','[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/combination', ['as'=> 'combination', 'uses' =>'Admin\QuestionsController@combination'])->where('key','[Cnc][A-Za-z]+');
    Route::get('/admin/questions/{key}/CombinationHtml', ['as'=> 'CombinationHtml', 'uses' =>'Admin\QuestionsController@CombinationHtml'])->where('key','[Cnc][A-Za-z]+');
    Route::post('/admin/questions/{key}/CombinationInsert', ['as'=> 'CombinationInsert', 'uses' =>'Admin\QuestionsController@CombinationInsert'])->where('key','[Cnc][A-Za-z]+');
    //////////////////////////////////////////////////公用页面////////////////////////////////////////////////////////
    Route::get('/prompt','PromptController@index');
    Route::post('/admin/systems/ncstore', ['as'=> 'ncstore', 'uses' =>'Admin\SystemsController@ncstore']);

    //////////////////////////////////////////////////个人模块////////////////////////////////////////////////////////
    Route::get('/personal', ['as'=> 'personal/index', 'uses' =>'Personal\HomeController@index']);
    Route::get('/personal/Difficult', ['as'=> 'Difficult', 'uses' =>'Personal\HomeController@Difficult']);
    Route::get('/personal/Page2', ['as'=> 'Page2', 'uses' =>'Personal\HomeController@Page2']);
    Route::get('/personal/TrainAdd', ['as'=> 'TrainAdd', 'uses' =>'Personal\HomeController@TrainAdd']);
    Route::get('/personal/trainpdf', ['as'=> 'trainpdf', 'uses' =>'Personal\HomeController@trainpdf']);
    Route::get('/personal/TrainState', ['as'=> 'TrainState', 'uses' =>'Personal\HomeController@TrainState']);
    Route::get('/personal/Measure', ['as'=> 'Measure', 'uses' =>'Personal\HomeController@Measure']);
    Route::post('/personal/PostMeasures', ['as'=> 'PostMeasures', 'uses' =>'Personal\HomeController@PostMeasures']);
    Route::post('/personal/EndMeasures', ['as'=> 'EndMeasures', 'uses' =>'Personal\HomeController@EndMeasures']);
    Route::get('/personal/Practice', ['as'=> 'Practice', 'uses' =>'Personal\HomeController@Practice']);
    Route::post('/personal/EditTime', ['as'=> 'EditTime', 'uses' =>'Personal\HomeController@EditTime']);
    Route::post('/personal/Results', ['as'=> 'Results', 'uses' =>'Personal\HomeController@Results']);
    Route::get('/personal/PracticeT', ['as'=> 'PracticeT', 'uses' =>'Personal\HomeController@PracticeT']);
    Route::get('/personal/TrainStateT', ['as'=> 'TrainStateT', 'uses' =>'Personal\HomeController@TrainStateT']);


    //////////////////////////////////////////////////教学模块////////////////////////////////////////////////////////
    Route::get('/teaching ', ['as'=> 'teaching/index', 'uses' =>'Teaching\HomeController@index']);

    //////////////////////////////////////////////////比赛模块////////////////////////////////////////////////////////
    Route::get('/game', ['as'=> 'game/index', 'uses' =>'Game\HomeController@index']);
});

