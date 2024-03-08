<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemValidation;
use App\Services\ItemService;
use App\Interfaces\ControllerInterface;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

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
            return view('items_list', ['items' => $getAll, 'categories' => $categories]);
        } catch (Exception $e) {
            // Tratar exceção aqui
        }
    }

    public function create(Request $request)
    {
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

            return view('item_add', ['categories' => $categories]);
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

            return view('item_show', ['item' => $item]);

        } catch (\Exception $e) {
            echo $e;
            //return redirect()->route('items.index')->with('error', 'Erro ao buscar o item.');
        }
    }   

    public function update($id, Request $request)
    {
    }
    public function delete($id, Request $request)
    {
    }
}
