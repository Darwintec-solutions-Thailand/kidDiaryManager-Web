<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class KnowLedgeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/content/pages/KnowLedgeGroup/index');
    }


    public function getKnowLedgeGroup()
    {
        $query = "SELECT * FROM knowledge_group";
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
        $request->validate([
            'title' => 'required'
        ]);
        $rules = [
            'title' => 'required|string|min:0|max:250',
        ];

        $validator = Validator::make($request->all(), $rules);

        // เชค Validate ข้อมูลที่ส่งมา
        if (!$validator->fails()) {

            $title = $request->title;
            $ageMin = $request->ageMin;
            $ageMax = $request->ageMax;

            if (empty($request->modalType)) {
                //เพิ่มข้อมูล
                $query = "INSERT INTO knowledge_group (title, age_min, age_max) VALUES ('$title', '$ageMin', '$ageMax')";
                $insert = DB::insert($query);
                return "200";
            } else {
                $query = "UPDATE knowledge_group SET title = '$title', age_min = '$ageMin', age_max = '$ageMax'  WHERE id = '$request->modalType'";
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
        $query = "SELECT * FROM knowledge_group WHERE id = '$id'";
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
                DB::delete("DELETE FROM knowledge_group WHERE id = $value ");
            }
            return "200";
        } else {
            DB::delete("DELETE FROM knowledge_group WHERE id = $request->id");
            return "200";
        }
        return "error";
    }
}
