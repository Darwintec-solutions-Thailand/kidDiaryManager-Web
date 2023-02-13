<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class GrowthAnalystController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('/content/pages/GrowthAnalyst/index');
    }

    public function getGrowthAnalyst()
    {
        $query = "SELECT * FROM analysis_growth_analyst";
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
            'title_message' => 'required'
        ]);
        $rules = [
            'title_message' => 'required|string|min:0|max:250',
        ];

        $validator = Validator::make($request->all(), $rules);

        // เชค Validate ข้อมูลที่ส่งมา
        if (!$validator->fails()) {

            $title_message = $request->title_message;
            $description = $request->description;

            if (empty($request->modalType)) {
                //เพิ่มข้อมูล
                $query = "INSERT INTO analysis_growth_analyst (title_message, description) VALUES ('$title_message', '$description')";
                $insert = DB::insert($query);
                return "200";
            } else {
                $query = "UPDATE analysis_growth_analyst SET title_message = '$title_message', description = '$description' WHERE id = '$request->modalType'";
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
        $query = "SELECT * FROM analysis_growth_analyst WHERE id = '$id'";
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
                DB::delete("DELETE FROM analysis_growth_analyst WHERE id = $value ");
            }
            return "200";
        } else {
            DB::delete("DELETE FROM analysis_growth_analyst WHERE id = $request->id");
            return "200";
        }
        return "error";
    }
}
