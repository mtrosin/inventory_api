<?php
namespace App\Services;

#use App\Models\Inventory;

class InventoryService
{
    public function get() {
        return [
            'data' => [['id' => 1, 'nome' => 'aaa'],['id' => 2, 'nome' => 'bbb']],
            'status' => 200
        ];
    }
}