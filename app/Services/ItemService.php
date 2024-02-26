<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use Illuminate\Http\Request;
use App\Models\ItemModel;
use Exception;

class ItemService implements ServiceInterface
{   
    private $itemModel;

    public function __construct(ItemModel $itemModel) {

        $this->itemModel = $itemModel;
    }

    public function index(){

        try {
            
            return $this->itemModel::query();
            
        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }
    public function create(array $data){}
    public function show($id){}
    public function update($id, array $data){}
    public function delete($id){}
}
