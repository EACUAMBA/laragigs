<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //Precisamos de informar ao eloquente que campos queremos que seja possível preenchermos no formulário.
    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description'];

    public function scopeFilter($query, array $filters)
    {
        //Esta instrição verifica se temos uma tag na variavel $filters, se tivermos ela é true e se não ela é false e vai para o else.
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}
