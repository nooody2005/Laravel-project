<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'department_id',
    ];

    // داخل app/Models/User.php

public function department()
    {
        return $this->belongsTo(Department::class);
    }


}
