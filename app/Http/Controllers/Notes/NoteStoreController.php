<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Repositories\Notes\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteStoreController extends Controller
{

    private $repository;


    public function __construct()
    {
        $this->repository = new NoteRepository();
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
        ]);
        if($validator->fails()){
            return $this->respondWithError('Error', $validator->errors());
        }
        //$note = $this->setNote($title, $description);
        $data = $this->repository->store($request->all());
        if($data){
            return $this->respondWithData('Note saved', $data);
        }
        return $this->respondHttpBadRequest();
    }

}
