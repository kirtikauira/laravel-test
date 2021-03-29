<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Teacher extends Model
{
    use HasFactory,Sortable;
    
    protected $fillable = [
        'name',
        'tech_image',
      ];

    protected $Sortable = [
        'name',
        'tech_image',
        
    ];

    public function student()
    {
        return $this->hasMany(Teacher::class, 'teacher_id');
    }
}
