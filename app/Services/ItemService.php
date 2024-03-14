<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
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
            
            return $this->itemModel::with('category')->get();
            
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create(array $data){

        return $this->itemModel::create($data);
    }
    
    public function show($id)
    {
        try {

            return $this->itemModel::with('category')->find($id);

        } catch (\Exception $e) {

            throw $e; 
        }
    }

    public function update($id, array $data){

        return $this->itemModel::where('id', $id)->update($data);
    }
    
    public function delete($id){}
}
