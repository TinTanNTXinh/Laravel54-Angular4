<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\OilRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Common\DateTimeHelper;
use App\Common\AuthHelper;
use Route;
use DB;
use League\Flysystem\Exception;

class OilController extends Controller implements ICrud, IValidate
{
    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $oilRepo;

    public function __construct(OilRepositoryInterface $oilRepo)
    {
        $this->oilRepo = $oilRepo;

        $jwt_data = AuthHelper::getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = AuthHelper::getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $current_month   = DateTimeHelper::getFirstDayLastDay();
        $this->first_day = $current_month['first_day'];
        $this->last_day  = $current_month['last_day'];
        $this->today     = $current_month['today'];

        $this->table_name = 'oil';
        $this->skeleton   = $this->oilRepo->allSkeleton();
    }

    /** ===== API METHOD ===== */
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
        $filter    = (array)json_decode($_GET['query']);
        $arr_datas = $this->searchOne($filter);
        return response()->json($arr_datas, 200);
    }

    /** ===== LOGIC METHOD ===== */
    public function readAll()
    {
        $all = $this->skeleton->get();

        return [
            'oils' => $all
        ];
    }

    public function readOne($id)
    {
        $one = $this->oilRepo->oneSkeleton($id)->first();

        return [
            $this->table_name => $one
        ];
    }

    public function createOne($data)
    {
        try {
            DB::beginTransaction();

            $i_one = [
                'code'         => $this->oilRepo->generateCode('OIL'),
                'price'        => $data['price'],
                'type'         => 'OIL',
                'apply_date'   => DateTimeHelper::toStringDateTimeClientForDB($data['apply_date']),
                'note'         => $data['note'],
                'created_by'   => $this->user->id,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ];

            $one = $this->oilRepo->create($i_one);

            if (!$one) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function updateOne($data)
    {
        try {
            DB::beginTransaction();

            $one = $this->oilRepo->find($data['id']);

            $i_one = [
                'price'        => $data['price'],
                'type'         => 'OIL',
                'apply_date'   => DateTimeHelper::toStringDateTimeClientForDB($data['apply_date']),
                'note'         => $data['note'],
                'updated_by'   => $this->user->id,
                'updated_date' => date('Y-m-d'),
                'active'       => true
            ];

            $one = $this->oilRepo->update($one, $i_one);

            if (!$one) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function deactivateOne($id)
    {
        try {
            DB::beginTransaction();

            $one = $this->oilRepo->deactivate($id);

            if (!$one) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteOne($id)
    {
        try {
            DB::beginTransaction();

            $one = $this->oilRepo->destroy($id);

            if (!$one) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function searchOne($filter)
    {
        $from_date = $filter['from_date'];
        $to_date   = $filter['to_date'];
        $range     = $filter['range'];

        $filtered = $this->skeleton;

        $filtered = $this->oilRepo->filterFromDateToDate($filtered, 'fuels.created_date', $from_date, $to_date);

        $filtered = $this->oilRepo->filterRangeDate($filtered, 'fuels.created_date', $range);

        return [
            'oils' => $filtered->get()
        ];
    }

    /** ===== VALIDATION ===== */
    public function validateInput($data)
    {
        if (!$this->validateEmpty($data))
            return ['status' => false, 'errors' => 'Dữ liệu không hợp lệ.'];

        $msgs = $this->validateLogic($data);
        return $msgs;
    }

    public function validateEmpty($data)
    {
        return true;
    }

    public function validateLogic($data)
    {
        $msg_error = [];

        $skip_id = isset($data['id']) ? [$data['id']] : [];

        return [
            'status' => count($msg_error) > 0 ? false : true,
            'errors' => $msg_error
        ];
    }

    /** ===== MY FUNCTION ===== */
    public function getReadByApplyDate()
    {
        $data = (array)json_decode($_GET['query']);
        $one        = $this->readByApplyDate($data['apply_date']);
        return response()->json($one, 200);
    }

    private function readByApplyDate($apply_date)
    {
        $apply_date = DateTimeHelper::toStringDateTimeClientForDB($apply_date);
        $oil = $this->oilRepo->findByApplyDate($apply_date);
        return [
            'oil' => $oil
        ];
    }
}
