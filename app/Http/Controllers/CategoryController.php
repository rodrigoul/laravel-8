<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryValidation;
use App\Interfaces\ControllerInterface;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller implements ControllerInterface
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            
            $getAll = $this->categoryService->index();
            return view('category/category_list', ['categories' => $getAll]);

        } catch (Exception $e) {
           return $e;
        }
    }

    public function create(Request $request){
        try {

            if ($request->isMethod('post')) {

                $validation = new CategoryValidation($request->all());
                $validatedData = $validation->validate();

                $create = $this->categoryService->create($validatedData);

                if (!$create) {
                    return redirect()->route('category.index')->with('error', 'Erro ao Inserir.');
                }
                return redirect()->route('category.index')->with('success', 'Categoria criada com sucesso.');
            }

            return view('category/category_add');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {

            $category = $this->categoryService->show($id);

            if (!$category) {
                return redirect()->route('category.index')->with('error', 'Categoria não encontrada.');
            }

            return view('category/category_show', ['category' => $category]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update($id, Request $request)
    {
        try {
            
            //dd($request->all());
            $validation = new CategoryValidation($request->all());
            $validatedData = $validation->validate();

            $update = $this->categoryService->update($id,  $validatedData);

            if (!$update) {
                return redirect()->route('category.index')->with('error', 'Erro ao Inserir.');
            }
            return redirect()->route('category.index')->with('success', 'Categoria Atualizada com sucesso.');

        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->route('category.show', ['id' => $id])->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($id, Request $request)
    {
        try {

            //var_dump($request->id); exit();
            $delete = $this->categoryService->delete($request->id);


            if(!$delete) return false;

            return $delete;
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
