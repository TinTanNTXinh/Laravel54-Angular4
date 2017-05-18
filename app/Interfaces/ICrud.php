<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ICrud
{
    /** API METHOD */
    public function getReadAll();

    public function getReadOne();

    public function postCreateOne(Request $request);

    public function putUpdateOne(Request $request);

    public function patchDeactivateOne(Request $request);

    public function deleteDeleteOne(Request $request);

    public function getSearchOne();

    /** LOGIC METHOD */
    public function readAll();

    public function readOne($id);

    public function createOne($data);

    public function updateOne($data);

    public function deactivateOne($id);

    public function deleteOne($id);

    public function searchOne($filter);
}