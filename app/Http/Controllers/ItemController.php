<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use App\Interfaces\ControllerInterface;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller implements ControllerInterface
{       

    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->middleware('auth');
        $this->itemService = $itemService;
    }
    
    public function index(){

        try {

            $getAll = $this->itemService->index();
            dd($getAll);
            return view('home', $getAll);
            
        } catch (Exception $e) {
            
        }

    }
    public function create(Request $request){}
    public function show($id){}
    public function update($id, Request $request){}
    public function delete($id, Request $request){}
}
