<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;

class TestController extends Controller implements ICrud, IValidate
{
    /** API METHOD */
    public function getReadAll()
    {
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function getReadOne()
    {
        $id  = Route::current()->parameter('id');
        $one = $this->readOne($id);
        return response()->json($one, 200);
    }

    public function postCreateOne(Request $request)
    {
        $data      = $request->input($this->table_name);
        $validates = $this->validateInput($data);
        if (!$validates['status'])
            return response()->json(['msg' => $validates['errors']], 404);

        if (!$this->createOne($data))
            return response()->json(['msg' => ['Create failed!']], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 201);
    }

    public function putUpdateOne(Request $request)
    {
        $data      = $request->input($this->table_name);
        $validates = $this->validateInput($data);
        if (!$validates['status'])
            return response()->json(['msg' => $validates['errors']], 404);

        if (!$this->updateOne($data))
            return response()->json(['msg' => ['Update failed!']], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function patchDeactivateOne(Request $request)
    {
        $id = $request->input('id');
        if (!$this->deactivateOne($id))
            return response()->json(['msg' => 'Deactivate failed!'], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function deleteDeleteOne(Request $request)
    {
        $id = Route::current()->parameter('id');
        if (!$this->deleteOne($id))
            return response()->json(['msg' => 'Delete failed!'], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function getSearchOne()
    {
        $filter        = (array)json_decode($_GET['query']);
        $arr_datas = $this->searchOne($filter);
        return response()->json($arr_datas, 200);
    }

    /** LOGIC METHOD */
    public function readAll()
    {
        // TODO: Implement readAll() method.
    }

    public function readOne($id)
    {
        // TODO: Implement readOne() method.
    }

    public function createOne($data)
    {
        // TODO: Implement createOne() method.
    }

    public function updateOne($data)
    {
        // TODO: Implement updateOne() method.
    }

    public function deactivateOne($id)
    {
        // TODO: Implement deactivateOne() method.
    }

    public function deleteOne($id)
    {
        // TODO: Implement deleteOne() method.
    }

    public function searchOne($filter)
    {
        // TODO: Implement searchOne() method.
    }

    /** VALIDATION */
    public function validateInput($data)
    {
        // TODO: Implement validateInput() method.
    }

    public function validateEmpty($data)
    {
        // TODO: Implement validateEmpty() method.
    }

    public function validateLogic($data)
    {
        // TODO: Implement validateLogic() method.
    }

    /** MY FUNCTION */

}
