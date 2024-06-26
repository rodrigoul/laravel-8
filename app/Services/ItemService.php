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
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(array $data){

        try {
            
            return $this->itemModel::create($data);

        } catch (\Throwable $th) {
            throw $th;
        }
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
    
    public function delete($id){

        try {

            $item = $this->itemModel::find($id);

            if ($item) {

                $item->delete();
                return true;
            } 
            
            return false;
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
