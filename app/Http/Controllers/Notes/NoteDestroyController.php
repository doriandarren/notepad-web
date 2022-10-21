<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Notes\Note;
use App\Repositories\Notes\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteDestroyController extends Controller
{

    private $repository;


    public function __construct()
    {
        $this->repository = new NoteRepository();
    }

    public function __invoke(Request $request, Note $note)
    {
        $data = $this->repository->destroy($note->id);
        if($data){
            return $this->respondWithData('Note deleted', []);
        }
        return $this->respondHttpBadRequest();
    }


}
