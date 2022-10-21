<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Repositories\Notes\NoteRepository;
use Illuminate\Http\Request;

class NoteListController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->repository = new NoteRepository();
    }

    public function __invoke()
    {
        $data = $this->repository->list();
        if($data){
            return $this->respondWithData('All Notes', $data);
        }
        return $this->respondHttpBadRequest();
    }
}
