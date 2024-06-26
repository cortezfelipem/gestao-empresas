<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaProdutoEcommerce;
use App\Models\SubCategoriaEcommerce;
use Illuminate\Support\Str;

class CategoriaProdutoEcommerceController extends Controller
{
	protected $empresa_id = null;
	public function __construct(){
		$this->middleware(function ($request, $next) {
			$this->empresa_id = $request->empresa_id;
			$value = session('user_logged');
			if(!$value){
				return redirect("/login");
			}
			return $next($request);
		});
	}

	public function index(){
		$categorias = CategoriaProdutoEcommerce::
		where('empresa_id', $this->empresa_id)
		->get();

		return view('categoriasEcommerce/list')
		->with('categorias', $categorias)
		->with('title', 'Categorias');
	}

	public function new(){
		return view('categoriasEcommerce/register')
		->with('title', 'Cadastrar Categoria');
	}

	public function save(Request $request){

		$category = new CategoriaProdutoEcommerce();
		$this->_validate($request);

		$nomeImagem = "";
		if($request->hasFile('file')){
    		//unlink anterior
			$file = $request->file('file');
			$nomeImagem = Str::random(20).".png";
			$upload = $file->move(public_path('ecommerce/categorias'), $nomeImagem);
		}
		$request->merge(['img' => $nomeImagem]);

		$request->merge(['destaque' => $request->destaque ? true : false]);
		$result = $category->create($request->all());

		if($result){
			session()->flash("mensagem_sucesso", "Cadastrado com sucesso!!");
		}else{
			session()->flash('mensagem_erro', 'Erro ao cadastrar categoria.');
		}

		return redirect('/categoriaEcommerce');
	}

	public function edit($id){
		$categoria = new CategoriaProdutoEcommerce(); 

		$resp = $categoria
		->where('id', $id)->first();  

		if(valida_objeto($resp)){
			return view('categoriasEcommerce/register')
			->with('categoria', $resp)
			->with('title', 'Editar Categoria');
		}else{
			return redirect('/403');
		}

	}

	public function update(Request $request){
		$categoria = new CategoriaProdutoEcommerce();

		$id = $request->input('id');
		$resp = $categoria
		->where('id', $id)->first(); 

		$this->_validate($request, true);

		$nomeImagem = $resp->img;
		if($request->hasFile('file')){
    		//unlink anterior

			if($resp->img != "" && file_exists(public_path('ecommerce/categorias'). "/".$resp->img)){
				unlink(public_path('ecommerce/categorias'). "/".$resp->img);
			}
			$file = $request->file('file');
			$nomeImagem = Str::random(20).".png";
			$upload = $file->move(public_path('ecommerce/categorias'), $nomeImagem);
		}

		$resp->nome = $request->input('nome');
		$resp->img = $nomeImagem;
		$resp->destaque = $request->destaque ? true : false;

		$result = $resp->save();
		if($result){
			session()->flash('mensagem_sucesso', 'Categoria editada com sucesso!');
		}else{
			session()->flash('mensagem_erro', 'Erro ao editar categoria!');
		}

		return redirect('/categoriaEcommerce'); 
	}

	public function delete($id){
		try{
			$categoria = CategoriaProdutoEcommerce
			::where('id', $id)
			->first();

			if(valida_objeto($categoria)){ 
				if($categoria->img != "" && file_exists(public_path("ecommerce/categorias/").$categoria->img)){
					unlink(public_path("ecommerce/categorias/").$categoria->img);
				}

				if($categoria->delete()){
					session()->flash('mensagem_sucesso', 'Registro removido!');
				}else{

					session()->flash('mensagem_erro', 'Erro!');
				}
				return redirect('/categoriaEcommerce');
			}else{
				return redirect('403');
			}
		}catch(\Exception $e){
			return view('errors.sql')
			->with('title', 'Erro ao deletar categoria')
			->with('motivo', $e->getMessage());
		}
	}

	private function _validate(Request $request, $update = false){
		$rules = [
			'nome' => 'required|max:50',
			'file' => !$update ? 'required' : ''
		];

		$messages = [
			'nome.required' => 'O campo nome é obrigatório.',
			'file.required' => 'O campo imagem é obrigatório.',
			'nome.max' => '50 caracteres maximos permitidos.'
		];
		$this->validate($request, $rules, $messages);
	}

	public function subs($id){
		$categoria = CategoriaProdutoEcommerce::find($id);

		return view('categoriasEcommerce/subs')
		->with('categoria', $categoria)
		->with('title', 'SubCategorias');
	}

	public function newSub($id){
		$categoria = CategoriaProdutoEcommerce::find($id);

		return view('categoriasEcommerce/register_sub')
		->with('categoria', $categoria)
		->with('title', 'Nova SubCategoria');

	}

	public function editSubs($id){

		$sub = SubCategoriaEcommerce::find($id);
		return view('categoriasEcommerce/register_sub')
		->with('categoria', $sub->categoria)
		->with('sub', $sub)
		->with('title', 'Nova SubCategoria');

	}

	public function deleteSub($id){

		$sub = SubCategoriaEcommerce
		::where('id', $id)
		->first();

		if(valida_objeto($sub->categoria)){ 

			if($sub->delete()){
				session()->flash('mensagem_sucesso', 'Registro removido!');
			}else{
				session()->flash('mensagem_erro', 'Erro!');
			}
			// return redirect('/categoriaEcommerce');
		return redirect('/categoriaEcommerce/subs/'.$sub->categoria_id);

		}else{
			return redirect('403');
		}
	}

	public function saveSub(Request $request){
		$this->_validateSub($request);
		try{
			SubCategoriaEcommerce::create($request->all());
			session()->flash("mensagem_sucesso", "Subcategoria cadastrada com sucesso");
		}catch(\Exception $e){
			session()->flash('mensagem_erro', 'Erro ao cadastrar!');
		}

		return redirect('/categoriaEcommerce/subs/'.$request->categoria_id);
	}

	public function updateSub(Request $request){
		$this->_validateSub($request);
		try{
			$sub = SubCategoriaEcommerce::find($request->id);
			$sub->nome = $request->nome;
			$sub->save();
			session()->flash("mensagem_sucesso", "Subcategoria atualizada com sucesso");
		}catch(\Exception $e){
			session()->flash('mensagem_erro', 'Erro ao atualizar!');
		}

		return redirect('/categoriaEcommerce/subs/'.$sub->categoria_id);
	}

	private function _validateSub(Request $request){
		$rules = [
			'nome' => 'required|max:50'
		];

		$messages = [
			'nome.required' => 'O campo nome é obrigatório.',
			'nome.max' => '50 caracteres maximos permitidos.'
		];
		$this->validate($request, $rules, $messages);
	}

}
