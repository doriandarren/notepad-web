<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Notes\Note;
use App\Repositories\Notes\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteUpdateController extends Controller
{

    private $repository;


    public function __construct()
    {
        $this->repository = new NoteRepository();
    }

    public function __invoke(Request $request, Note $note)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required'
        ]);
        if($validator->fails()){
            return $this->respondWithError('Error', $validator->errors());
        }


        $data = $this->repository->update($note->id, $request->all());
        if($data){
            return $this->respondWithData('Note updated', $data);
        }
        return $this->respondHttpBadRequest();
    }

}
