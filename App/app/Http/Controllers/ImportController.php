<?php

namespace App\Http\Controllers;

use App\Services\ImportService;
use Illuminate\Http\JsonResponse;

class ImportController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(ImportService $service)
    {
        return response()->json($service->run());
    }
}
