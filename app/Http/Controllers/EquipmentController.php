<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function show(){}

    public function index()
    {
        return response([
            'data' => [
                'id' => 1,
                'name' => 'Equipment 1',
                'description' => 'Equipment 1 description',
                'price' => 100.00,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ]
        ]);
    }

    public function store(){}

    public function delete(){}
}
