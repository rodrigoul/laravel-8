<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use App\Interfaces\ControllerInterface;
use App\Services\ShoppingListService;
use Exception;
use Illuminate\Http\Request;

class ShoppingListController extends Controller implements ControllerInterface
{       

    private $itemService;
    private $shoppingListService;

    public function __construct(ItemService $itemService, ShoppingListService $shoppingListService)
    {
        $this->middleware('auth');
        $this->itemService = $itemService;
        $this->shoppingListService = $shoppingListService;
    }
    
    public function index(){

        try {
            $shoppingLists = $this->shoppingListService->index();
            //return $shoppingLists;            
            //dd($shoppingLists);
            return view('shopping_list', ['shoppingLists' => $shoppingLists]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(Request $request){}
    public function show($id){}
    public function update($id, Request $request){}
    public function delete($id, Request $request){}
}
