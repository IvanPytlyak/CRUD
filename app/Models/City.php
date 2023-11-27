<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;


    protected $fillable = [
        'index',
        'name'
    ];


    public function applyFilter(Request $request)
    {
        $sortField = $request->input('sort_sity', 'sort_id'); // Поле сортировки по умолчанию
        $sortOrder = $request->input('sort_order_by', 'sort_asc'); // Направление сортировки по умолчанию

        $query = $this->newQuery();

        if ($sortField === 'sort_id') {
            $query->orderBy('id', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        } elseif ($sortField === 'sort_sity') {
            $query->orderBy('name', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        } elseif ($sortField === 'sort_rangir') {
            $query->orderBy('index', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        }

        return $query->get();
    }
}
