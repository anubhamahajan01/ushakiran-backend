<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\DonationService;
use App\Transformers\DonationTransformer;


class DonationController extends Controller
{
    /**
     * @var App\Services\DonationService
     */
    protected $donations;

    /**
     * @param DonationService $donations
     */
    public function __construct(
        DonationService $donations
    ){
        $this->donations = $donations;
    }

    /**
     *  @return Illuminate\Http\Response
     */
    public function create()
    {
        $inputs = request()->all();

        $donations = app()->call([$this->donations, 'create'], [
            'inputs'    => $inputs,
            'user'      => auth()->user(),
        ]);

        return response()->success($this->getTransformedData($donations, new DonationTransformer));
    }
}