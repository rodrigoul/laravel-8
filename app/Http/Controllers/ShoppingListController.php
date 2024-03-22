<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingListValidation;
use App\Services\ItemService;
use App\Interfaces\ControllerInterface;
use App\Services\CategoryService;
use App\Services\ShoppingListService;
use Exception;
use Illuminate\Http\Request;

class ShoppingListController extends Controller implements ControllerInterface
{       

    private $itemService;
    private $shoppingListService;
    private $categoryService;

    public function __construct(ItemService $itemService, ShoppingListService $shoppingListService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->itemService = $itemService;
        $this->shoppingListService = $shoppingListService;
        $this->categoryService = $categoryService;
    }
    
    public function index(){

        try {

            $shoppingLists = $this->shoppingListService->index();
            return view('shopping-list/shopping_list', ['data' => $shoppingLists]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(Request $request){

        try {

            if ($request->isMethod('post')) {

                $validation = new ShoppingListValidation($request->all());
                $validatedData = $validation->validate();

                $create = $this->shoppingListService->create($validatedData);

                if (!$create) {
                    return redirect()->route('shopping-list.index')->with('error', 'Erro ao Inserir.');
                }
                return redirect()->route('shopping-list.index')->with('success', 'Lista criada com sucesso.');
            }

            return view('shopping-list/shopping_add');

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function show($id)
    {
        try {

            $items = $this->itemService->index();
            $categories = $this->categoryService->index();
            $shoppingList = $this->shoppingListService->show($id);


            if (!$shoppingList) {
                return redirect()->route('shopping-list.index')->with('error', 'Lista não encontrada.');
            }

            return view(
                'shopping-list/shopping_show', 
                ['shoppingList' => $shoppingList, 'items' => $items, 'categories' => $categories]
            );
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update($id, Request $request){

        
       //dd($request->all());
    }

    public function delete($id, Request $request){}
}
