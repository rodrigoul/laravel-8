<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\ItemModel;
use App\Models\PurchaseModel;
use Illuminate\Support\Facades\DB;
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

            $mostBoughtItems = PurchaseModel::with('items')
                ->select('item_id', DB::raw('COUNT(id) as total_sales'))
                ->groupBy('item_id')
                ->orderByDesc('total_sales')
                //->limit(100)
                ->get();
            //dd($mostBoughtItems->toArray());

            return ['itemsByCategory' => $itemsByCategory, 'mostBoughtItems' => $mostBoughtItems];

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(array $data){}

    public function show($id){}
    
    public function update($id, array $data){}

    public function delete($id){}
}
