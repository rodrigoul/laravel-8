<?php

namespace App\Http\Controllers;

use App\Interfaces\ControllerInterface;
use App\Http\Requests\ItemValidation;
use App\Services\ItemService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Exception;

class ItemController extends Controller implements ControllerInterface
{

    private $itemService;
    private $categoryService;

    public function __construct(ItemService $itemService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->itemService = $itemService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            $getAll = $this->itemService->index();
            $categories = $this->categoryService->index();
            return view('item/item_list', ['items' => $getAll, 'categories' => $categories]);
        } catch (Exception $e) {
            // Tratar exceção aqui
        }
    }

    public function create(Request $request){
        try {

            if ($request->isMethod('post')) {

                $validation = new ItemValidation($request->all());
                $validatedData = $validation->validate();

                $create = $this->itemService->create($validatedData);

                if (!$create) {
                    return redirect()->route('items.index')->with('error', 'Erro ao Inserir.');
                }
                return redirect()->route('items.index')->with('success', 'Item criado com sucesso.');
            }

            $categories = $this->categoryService->index();

            return view('item/item_add', ['categories' => $categories]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {

            $item = $this->itemService->show($id);

            if (!$item) {
                return redirect()->route('items.index')->with('error', 'Item não encontrado.');
            }

            $categories = $this->categoryService->index();

            return view('item/item_show', ['item' => $item, 'categories' => $categories]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update($id, Request $request)
    {
        try {
            
            $validation = new ItemValidation($request->all());
            $validatedData = $validation->validate();

            $update = $this->itemService->update($id,  $validatedData);

            if (!$update) {
                return redirect()->route('items.index')->with('error', 'Erro ao Inserir.');
            }
            return redirect()->route('items.index')->with('success', 'Item Atualizado com sucesso.');

        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->route('items.show', ['id' => $id])->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($id, Request $request)
    {
        try {

            $delete = $this->itemService->delete($request->id);

            if(!$delete) return false;

            return $delete;
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
