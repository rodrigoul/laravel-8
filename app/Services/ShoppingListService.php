<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\ShoppingListModel;
use Exception;

class ShoppingListService implements ServiceInterface
{   
    private $itemModel;
    private $shoppingListModel;

    public function __construct(ShoppingListModel $shoppingListModel) {

        $this->shoppingListModel = $shoppingListModel;
    }

    public function index(){

        try {

            $shoppingLists = $this->shoppingListModel::query()->get();
            return $shoppingLists;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(array $data){

        try {
    
            return $this->shoppingListModel::create($data);

        } catch (\Throwable $th) {

            throw $th;
        }
    }

    public function show($id)
    {
        try {

            return $this->shoppingListModel::find($id);

        } catch (\Exception $e) {

            throw $e; 
        }
    }

    public function update($id, array $data){


    }
    
    public function delete($id){}
}
