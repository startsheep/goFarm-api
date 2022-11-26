<?php

namespace App\Http\Controllers\Pages\User;

use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Doctor\DoctorRepository;
use App\Http\Requests\WEB\User\Doctor\CreateRequest;
use App\Http\Requests\WEB\User\Doctor\UpdateRequest;
use App\Http\Services\Doctor\DoctorService;
use App\Http\Traits\MessageFixer;
use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DoctorController extends Controller
{
    use MessageFixer;

    protected $doctorService, $doctorRepository;

    public function __construct(DoctorService $doctorService, DoctorRepository $doctorRepository)
    {
        $this->doctorService = $doctorService;
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorDataTable $dataTable)
    {
        return $dataTable->render('users.doctor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            $image = $request->file->store('users/doctors');

            $request->merge([
                'image' => $image,
                'password' => 'password',
                'role_id' => ModelsRole::DOCTOR
            ]);

            $user = $this->doctorRepository->create($request->all());
            $user->syncRoles(Role::find(ModelsRole::DOCTOR));

            return $this->success(route('doctor.index'), 'doctor has been created!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = $this->doctorService->findOrFail($id);

        return view('users.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = $this->doctorService->findOrFail($id);

        return view('users.doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();
            $doctor = $this->doctorService->findOrFail($id);

            if ($request->hasFile('file')) {
                $image = str_replace(url('storage'), '', $doctor->image);
                if ($image) {
                    Storage::delete($image);
                }

                $image = $request->file->store('users/doctors');
                $request->merge([
                    'image' => $image,
                ]);
            }

            $this->doctorService->update($id, $request->all());

            return $this->success(route('doctor.show', $id), 'doctor has been updated!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = $this->doctorRepository->findOrFail($id);

        $image = str_replace(url('storage'), '', $doctor->image);
        if ($image) {
            Storage::delete($image);
        }

        $doctor->delete();
        return $this->success(route('doctor.index'), 'doctor has been deleted!');
    }
}
