<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\ItemModel;
use App\Models\ShoppingListModel;
use Exception;

class ShoppingListService implements ServiceInterface
{   
    private $itemModel;
    private $shoppingListModel;

    public function __construct(ItemModel $itemModel, ShoppingListModel $shoppingListModel) {

        $this->itemModel = $itemModel;
        $this->shoppingListModel = $shoppingListModel;
    }

    public function index(){

        try {
            $shoppingLists = $this->shoppingListModel::query()->get()->toArray();
    
            return $shoppingLists;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(array $data){}
    public function show($id){}
    public function update($id, array $data){}
    public function delete($id){}
}
