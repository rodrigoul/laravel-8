<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\ItemModel;
use App\Models\PurchaseModel;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class HomeService implements ServiceInterface
{   
    private $itemModel;

    public function __construct(ItemModel $itemModel) {

        $this->itemModel = $itemModel;
    }

    public function index(){

        
        try {   
            $user_id = Auth::id();
    
            $itemsByCategory = $this->itemModel::with('category')
                ->selectRaw('categories.name as category_name, COUNT(*) as total_items')
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->groupBy('categories.name')
                ->get();

            $mostBoughtItems = PurchaseModel::with('items')
                ->select('item_id', DB::raw('SUM(quantity) as total_sales'))
                ->whereHas('user', function ($query) use ($user_id) {
                    $query->where('id', $user_id);
                })
                ->groupBy('item_id')
                ->orderByDesc('total_sales')
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
