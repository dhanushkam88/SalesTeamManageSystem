<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\DocImport\DocImportRepositoryInterface;

class AdminController extends Controller
{
    private $userRepo;
    private $docImportRepo;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DocImportRepositoryInterface $DocImportRepository
    )
    {
        $this->userRepo = $userRepository;
        $this->docImportRepo = $DocImportRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userRepo->getDataforTable();
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
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'contact_number' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['password' =>  'required', 'max:100',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/',
                'confirmed:password_confirmation'],
            'password_confirmation' =>  ['required'],
            'user_type' => ['required'],
            'joined_date' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'zip' => ['required'],
            'route' => ['required'],
        ]);

        return $this->userRepo->createUser($request);
    }


    /**
     * importView
     *
     * @return void
     */
    public function importView()
    {
        return view('importDoc.importDoc');
    }

    /**
     * importDoc
     *
     * @param  mixed $request
     * @return void
     */
    public function importDoc(Request $request)
    {
        Validator::make($request->all(), [
            'file' => ['required','mimes:xlsx,xls,csv'],
        ]);
        return $this->docImportRepo->importDoc();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->userRepo->editDeleteUser();
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
        return $this->userRepo->editUserRequest($request);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $request->validate([
            'confirmText' => [ Rule::in('DELETE')],
        ]);

        return $this->userRepo->deleteUserRequest($request);
    }
}
