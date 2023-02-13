<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class KnowLedgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "SELECT * FROM knowledge_group";
        $dataKnowLedgeGroup = DB::select($query);
        return view('/content/pages/KnowLedge/index', [
            'dataKnowLedgeGroup' => $dataKnowLedgeGroup
        ]);
    }


    public function getKnowLedge()
    {
        $query = "SELECT A.id, A.title, A.description, A.group_id, A.resource, B.title as groupName FROM knowledge A LEFT JOIN knowledge_group B on A.group_id = B.id";
        $data = DB::select($query);

        return Datatables::of($data)->addIndexColumn()->make(true);

        // return $data;
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
        // dd($request->all());
        $request->validate([
            'title' => 'required',

        ]);
        $rules = [
            'title' => 'required|string|min:0|max:250',
        ];

        $validator = Validator::make($request->all(), $rules);

        // เชค Validate ข้อมูลที่ส่งมา
        if (!$validator->fails()) {

            $title = $request->title;
            $description = $request->description;
            $resource = $request->resource;
            $groupId = $request->groupId;

            if (empty($request->modalType)) {
                //เพิ่มข้อมูล
                $query = "INSERT INTO knowledge (title, description, resource, group_id) VALUES ('$title', '$description', '$resource', '$groupId')";
                $insert = DB::insert($query);
                return "200";
            } else {
                $query = "UPDATE knowledge SET title = '$title', description = '$description', resource = '$resource', group_id = '$groupId' WHERE id = '$request->modalType'";
                $update = DB::update($query);
                return "200";
            }
        } else {
            return "error";
        }
    }

    public function getDataById(Request $request)
    {
        $id = $request->id;
        $query = "SELECT * FROM knowledge WHERE id = '$id'";
        $data = DB::select($query);
        return $data[0];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //เชคถ้าลบหลายรายการ
        if (isset($request->arr_del)) {
            foreach ($request->arr_del as $key => $value) {
                // dd($value);
                DB::delete("DELETE FROM knowledge WHERE id = $value ");
            }
            return "200";
        } else {
            DB::delete("DELETE FROM knowledge WHERE id = $request->id");
            return "200";
        }
        return "error";
    }
}
