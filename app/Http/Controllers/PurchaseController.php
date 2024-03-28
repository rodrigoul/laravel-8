<?php

namespace App\Http\Controllers;

use App\Interfaces\ControllerInterface;
use App\Http\Requests\ItemValidation;
use App\Services\ItemService;
use App\Services\CategoryService;
use App\Services\PurchaseService;
use Illuminate\Http\Request;
use Exception;

class PurchaseController extends Controller implements ControllerInterface
{

    private $itemService;
    private $purchaseService;

    public function __construct(PurchaseService $purchaseService )
    {
        $this->middleware('auth');
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        try {
            
            $getAll = $this->purchaseService->index();
            return view('item/item_list', ['data' => $getAll]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(Request $request){}

    public function show($id){}

    public function update($id, Request $request){}

    public function delete($id, Request $request)
    {
        try {
            
            $delete = $this->purchaseService->delete($request->id);

            if(!$delete) return false;

            return $delete;
            
        } catch (\Throwable $th) {
            
            throw $th;
        }

    }
}
