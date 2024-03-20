<?php

namespace App\Interfaces;

interface ServiceInterface
{
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);    
}
