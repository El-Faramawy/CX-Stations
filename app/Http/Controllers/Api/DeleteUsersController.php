<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\User;

class DeleteUsersController extends Controller
{
    use PaginateTrait;
    public function delete_users(){
        User::where('id','!=',0)->delete();
        return $this->apiResponse(null, 'done','simple');
    }
}
