<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Models\CategoryModel;
use Exception;

class CategoryService implements ServiceInterface
{   
    private $categoryModel;

    public function __construct(CategoryModel $categoryModel) {

        $this->categoryModel = $categoryModel;
    }

    public function index(){

        try {
            
            return $this->categoryModel::all();
            
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create(array $data){

        try {
    
            return $this->categoryModel::create($data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {

            return $this->categoryModel::find($id);

        } catch (\Exception $e) {

            throw $e; 
        }
    }
    
    public function update($id, array $data){

        return $this->categoryModel::where('id', $id)->update($data);
    }

    public function delete($id){

        try {

            $category = $this->categoryModel::find($id);

            if ($category) {

                $category->delete();
                return true;
            } 
            
            return false;
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
