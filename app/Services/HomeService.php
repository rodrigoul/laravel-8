<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\ItemModel;
use Exception;

class HomeService implements ServiceInterface
{   
    private $itemModel;

    public function __construct(ItemModel $itemModel) {

        $this->itemModel = $itemModel;
    }

    public function index(){

        
        try {
    
            $itemsByCategory = $this->itemModel::with('category')
                ->selectRaw('categories.name as category_name, COUNT(*) as total_items')
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->groupBy('categories.name')
                ->get();

            return $itemsByCategory;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(array $data){}

    public function show($id){}
    
    public function update($id, array $data){}

    public function delete($id){}
}
