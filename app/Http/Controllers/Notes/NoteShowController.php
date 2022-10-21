<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Notes\Note;
use App\Repositories\Notes\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteShowController extends Controller
{

    private $repository;


    public function __construct()
    {
        $this->repository = new NoteRepository();
    }

    public function __invoke(Note $note)
    {

        $data = $this->repository->show($note->id);
        if($data){
            return $this->respondWithData('Note show', $data);
        }
        return $this->respondHttpBadRequest();
    }

}
