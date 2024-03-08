<?php

namespace App\Http\Controllers;

use App\Http\Requests\createItem;
use App\Services\ItemService;
use App\Interfaces\ControllerInterface;
use App\Models\ItemModel;
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
            return view('items_list', ['items'=> $getAll,'categories' => $categories]);
            
        } catch (Exception $e) {
            
        }
    }

    public function create(Request $request)
    {
        try {

            if ($request->isMethod('post')) {

                $validatedData = $request->validate([
                    'name' => 'required|string|max:50',
                    'category_id' => 'required|integer|exists:categories,id'
                ]);

                $create = $this->itemService->create($validatedData);

                if(!$create){
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

    public function show($id){}
    public function update($id, Request $request){}
    public function delete($id, Request $request){}
}
