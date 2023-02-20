<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\RolePermission\Permissions\HasPermissionsTrait;

class User extends Model
{
    use HasFactory, HasPermissionsTrait;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Users\Database\factories\UserFactory::new();
    }
}
