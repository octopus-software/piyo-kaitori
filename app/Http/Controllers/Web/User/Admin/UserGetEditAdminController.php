<?php

namespace App\Http\Controllers\Web\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserGetEditAdminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): Response
    {
        $user = User::query()->find($id);
        return Inertia::render('User/Admin/Edit', [
            'user' => [
                'id' => $id,
                'name' => $user['name'],
                'name_kana' => $user['name_kana'],
                'email' => $user['email'],
                'birthday' => (new Carbon($user['birthday']))->format('Y年m月d日'),
                'gender' => $user['gender'] === 1 ? '男性' : ($user['gender'] === 2 ? '女性' : 'その他'),
                'post_code' => $user['post_code'],
                'address' => $user['address'],
                'tel' => $user['tel'],
                'job' => $user['job'],
                'bank_name' => $user['bank_name'],
                'bank_branch_name' => $user['bank_branch_name'],
                'bank_branch_code' => $user['bank_branch_code'],
                'bank_account_type' => $user['bank_account_type'],
                'bank_account_number' => $user['bank_account_number'],
                'bank_account_name_kana' => $user['bank_account_name_kana'],
                'is_qualified_supplier' => (bool)$user['is_qualified_supplier'],
                'invoice_number' => $user['invoice_number'],
                'is_active' => (bool)$user['is_active'],
                'identification_file_url' => $user['identification_file_url'],
            ]
        ]);
    }
}
