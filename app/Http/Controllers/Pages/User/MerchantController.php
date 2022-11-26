<?php

namespace App\Http\Controllers\Pages\User;

use App\DataTables\MerchantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Merchant\MerchantRepository;
use App\Http\Services\Merchant\MerchantService;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    use MessageFixer;

    protected $merchantService, $merchantRepository;

    public function __construct(MerchantService $merchantService, MerchantRepository $merchantRepository)
    {
        $this->merchantService = $merchantService;
        $this->merchantRepository = $merchantRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MerchantDataTable $dataTable)
    {
        return $dataTable->render('users.merchant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = $this->merchantService->findOrFail($id);

        return view('users.merchant.show', compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
