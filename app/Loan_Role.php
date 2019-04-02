<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan_Role extends Model
{
    protected $fillable = array(		
        'role',
        'slug',
    );

    protected  $table = 'loan_roles';
}
