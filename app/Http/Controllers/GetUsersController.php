<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function __invoke(){
        $users = User::where('role',User::USER_ROLE['user'])
        ->with(['purchase_offers', 'purchase_offers.purchase_target'])
        ->get();

        // return csrf_token();
        // return $users;
    }
}
