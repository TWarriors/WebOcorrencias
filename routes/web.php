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

Route::get('/', 'Controller@list_escolas');

Auth::routes();

Route::get('/home', 'HomeController@index');

//ADMIN

Route::get('/admin', 'AdminController@index')->middleware('admin');

//HOME PESQUISAR

Route::get('/pesquisar_publico', 'Controller@pesquisar');


//USER

Route::get('/user', 'UserController@index');

Route::get('/user/form/edit', 'UserController@edit');

Route::get('/user/form/selecionar_user/{id}', 'UserController@select_user');

//SOBRE

Route::get('/sobre', function(){
  return view('sobre');
});

//ALUNOS

Route::get('/alunos/list', 'AlunosController@list');

Route::get('/alunos/form/adicionar_aluno', 'AlunosController@adicionar_aluno');

Route::get('/alunos/form/editar_aluno', 'AlunosController@editar_aluno');

Route::get('/alunos/form/excluir_aluno', 'AlunosController@excluir_aluno');

Route::get('/alunos/form/selecionar_aluno_by_id/{id}', 'AlunosController@select_aluno_by_id');

//Ocorrencias

Route::get('/ocorrencias/list', 'OcorrenciasController@list');

Route::get('/ocorrencias/form/adicionar_ocorrencia', 'OcorrenciasController@adicionar_ocorrencia');

Route::get('/ocorrencias/form/editar_ocorrencia', 'OcorrenciasController@editar_ocorrencia');

Route::get('/ocorrencias/form/excluir_ocorrencia', 'OcorrenciasController@excluir_ocorrencia');

Route::get('/ocorrencias/form/selecionar_ocorrencia_by_id/{id}', 'OcorrenciasController@select_ocorrencia_by_id');
