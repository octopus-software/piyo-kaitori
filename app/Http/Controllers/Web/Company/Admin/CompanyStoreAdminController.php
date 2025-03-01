<?php

namespace App\Http\Controllers\Web\Company\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Admin\CompanyStoreAdminRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CompanyStoreAdminController extends Controller
{
    public function __invoke(CompanyStoreAdminRequest $request): RedirectResponse
    {
        $data = $request->toArray();
        $data['user_id'] = auth()->id();
        Company::query()->create($data);
        // 最初の企業登録後は編集画面へ遷移させる
        return Redirect::route('admin.company.edit');
    }
}
