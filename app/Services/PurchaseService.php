<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\PurchaseModel;
use Exception;

class PurchaseService implements ServiceInterface
{   
    private $purchaseModel;

    public function __construct(PurchaseModel $purchaseModel) {

        $this->purchaseModel = $purchaseModel;
    }

    public function index(){

        try {

            $purchases = $this->purchaseModel::with(['shoppingList', 'items', 'user'])->get();            
            return $purchases;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(array $data){

        try {
            
            $purchaseData = [];
            
            if (isset($data['items']) && isset($data['quantity'])) {

                foreach ($data['items'] as $index => $itemId) {

                    if (isset($data['quantity'][$index])) {
                        $purchaseData[] = [
                            'user_id' => $data['user_id'],
                            'shopping_list_id' => $data['id'],
                            'item_id' => $itemId,
                            'quantity' => $data['quantity'][$index]
                        ];
                    }
                }
            }
    
            if (!empty($purchaseData)) {
                return $this->purchaseModel::insert($purchaseData);
            }
    
            return false; 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {

            $purchase = $this->purchaseModel::where('shopping_list_id', $id)
                ->with(['shoppingList', 'items', 'user'])
                ->get();

            return $purchase;

        } catch (\Exception $e) {

            throw $e; 
        }
    }

    public function update($id, array $data){
        
        return $this->purchaseModel::where('id', $id)->update($data);
    }
    
    public function delete($id){
        
        try {

            $purchase = $this->purchaseModel::find($id);

            if ($purchase) {

                $purchase->delete();
                return true;
            } 
            
            return false;
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
