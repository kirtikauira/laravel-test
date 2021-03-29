<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Student extends Model
{
    use HasFactory, Sortable;
    
    protected $fillable = [
        'name',
        'tech_image',
      ];

    protected $Sortable = [
        'name',
        'tech_image',
        
    ];
    public function teacher()
    {
       return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
