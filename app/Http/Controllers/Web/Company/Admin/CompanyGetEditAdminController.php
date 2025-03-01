<?php

namespace App\Http\Controllers\Web\Company\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Inertia\Inertia;
use Inertia\Response;

class CompanyGetEditAdminController extends Controller
{
    public function __invoke($id): Response
    {
        $company = Company::query()->find($id)->toArray();
        return Inertia::render('Company/Admin/Edit', [
            'company' => $company
        ]);
    }
}
