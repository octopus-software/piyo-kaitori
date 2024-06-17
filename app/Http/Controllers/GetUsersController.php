<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function __invoke(){
        $users = User::where('role',User::USER_ROLE['user'])
        ->with(['purchase_offers', 'purchase_offers.purchase_targets'])
        ->get()
        ->map(function($user){
            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'offers' => $user['purchase_offers']->map(function($offer){
                    return [
                        'id' =>  $offer['id'], // オファーID
                        'status' =>  $offer['status'],
                        'total_price' => $offer['purchase_targets']->sum('pivot.price'),
                        'total_amount' => $offer['purchase_targets']->sum('pivot.amount'),
                        'targets' => $offer['purchase_targets']->map(function($target){
                            return [
                                'id' => $target['id'],
                                'name' => $target['name'],
                                'price' => $target['pivot']['price'],
                                'amount' => $target['pivot']['amount']
                            ];
                        })
                    ];
                })
            ];
        });

        return $users;
    }
}
