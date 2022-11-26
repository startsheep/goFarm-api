<?php

namespace App\Http\Controllers;

use App\Http\Requests\Merchant\CreateMerchantRequest;
use App\Http\Requests\Merchant\UpdateMerchantRequest;
use App\Http\Resources\Merchant\MerchantCollection;
use App\Http\Resources\Merchant\MerchantDetail;
use App\Http\Searches\MerchantSearch;
use App\Http\Services\Merchant\MerchantService;
use App\Http\Traits\ErrorFixer;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    use ErrorFixer;

    protected $merchantService;

    public function __construct(MerchantService $merchantService)
    {
        $this->merchantService = $merchantService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $factory = app()->make(MerchantSearch::class);
        $merchants = $factory->apply()->paginate($request->per_page);

        return new MerchantCollection($merchants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMerchantRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();
            return $this->merchantService->create($request->all());
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->createError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = $this->merchantService->findOrFail($id);

        return new MerchantDetail($merchant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();
            return $this->merchantService->update($id, $request->all());
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return $this->updateError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::beginTransaction();

        try {
            DB::commit();
            return $this->merchantService->delete($id);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->deleteError();
        }
    }

    public function updateStatus($id)
    {
        $merchant = $this->merchantService->findOrFail($id);

        $request['status'] = $merchant->status ? 0 : 1;
        $status = $merchant->status ? 'deactive' : 'active';

        $merchant = $this->merchantService->update($id, $request);

        return response()->json([
            'message' => "merchant has been $status!",
            'status' => 'success',
            'data' => $status
        ], Response::HTTP_OK);
    }
}
