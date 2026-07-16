<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckVoucherRequest;
use App\Http\Requests\GenerateVoucherRequest;
use App\Http\Resources\CheckVoucherResource;
use App\Http\Resources\GenerateVoucherResource;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function __construct(protected VoucherService $voucherService)
    {

    }

    public function check(CheckVoucherRequest $request)
    {
        $exists = $this->voucherService->check(
            $request->validated()
        );

        return new CheckVoucherResource([
            'exists' => $exists,
        ]);
    }

    public function generate(GenerateVoucherRequest $request){
        $voucher = $this->voucherService->generate(
            $request->validated()
        );

        return (new GenerateVoucherResource($voucher))
        ->response()
        ->setStatusCode(201);
    }
}
