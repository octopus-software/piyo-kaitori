<?php

namespace App\Http\Controllers\Web\User\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserUpdateClientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,int $id)
    {
        $user_update = User::query()->where('id', $id)->update([   
            'name' => $request['name'],
            'name_kana' => $request['name_kana'],
            'email' => $request['email'],
            'birthday' => $request['birthday'],
            'gender' => $request['gender'],
            'post_code' => $request['post_code'],
            'address' => $request['address'],
            'tel' => $request['tel'],
            'job' => $request['job'],
            'bank_name' => $request['bank_name'],
            'bank_branch_name' => $request['bank_branch_name'],
            'bank_branch_code' => $request['bank_branch_code'],
            'bank_account_type' => $request['bank_account_type'],
            'bank_account_number' => $request['bank_account_number'],
            'bank_account_name_kana' => $request['bank_account_name_kana'],
            'is_qualified_supplier' => (bool)$request['is_qualified_supplier'],
            'invoice_number' => $request['invoice_number'],
            'is_active' => (bool)$request['is_active'],
        ]);
        return $user_update;
    }
}
