<?php

namespace App\Repositories\Notes;

use App\Models\Notes\Note;

class NoteRepository
{

    const PER_PAGE = 10;


    /**
     * @inheritDoc
     */
    public function list()
    {
        return Note::latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function list_paginate($filter = null)
    {
        if($filter){
            return Note::when($filter, function ($q) use ($filter) {
                $q->where('tax_number', 'like', "%{$filter}%")
                    ->orWhere('email_princ', 'like', "%{$filter}%");
            })->latest()->paginate(self::PER_PAGE);
        }else{
            return Note::latest()->paginate(self::PER_PAGE);
        }
    }

    /**
     * @inheritDoc
     */
    public function show($id)
    {
        return Note::find($id);
    }

    /**
     * @inheritDoc
     */
    public function store($attributes)
    {
        if(is_array($attributes)){
            $note = json_decode(json_encode($attributes), FALSE);
        }else{
            $note = $attributes;
        }
        $noteNew = new Note();
        $noteNew->title = $note->title;
        $noteNew->description = $note->description;
        $noteNew->save();
        return $noteNew;
    }
    /**
     * @inheritDoc
     */
    public function update($id, $attributes)
    {
        if(is_array($attributes)){
            $note = json_decode(json_encode($attributes), FALSE);
        }else{
            $note = $attributes;
        }
        $noteOld = Note::find($id);

        if($note->title != '' && !empty($note->title)){
            $noteOld->title = $note->title;
        }

        if($note->description != '' && !empty($note->description)){
            $noteOld->description = $note->description;
        }

        $noteOld->save();

        return $noteOld;

    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        $data = Note::find($id);
        $data->delete();
        return true;
    }


}
