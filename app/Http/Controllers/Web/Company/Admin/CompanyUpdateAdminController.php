<?php

namespace App\Http\Controllers\Web\Company\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Admin\CompanyUpdateAdminRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompanyUpdateAdminController extends Controller
{
    public function __invoke(CompanyUpdateAdminRequest $request, int $id): RedirectResponse
    {
        $data = $request->toArray();
        Company::query()->find($id)->update($data);
        // 最初の企業登録後は編集画面へ遷移させる
        return Redirect::route('admin.company.edit', ['id' => $id]);
    }
}
