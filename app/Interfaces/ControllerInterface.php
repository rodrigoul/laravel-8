<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ControllerInterface
{
    public function create(Request $request);
    public function show($id);
    public function update($id, Request $request);
    public function delete($id, Request $request);
}
