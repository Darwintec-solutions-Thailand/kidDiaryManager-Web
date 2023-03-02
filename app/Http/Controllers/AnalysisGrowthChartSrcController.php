<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

use Illuminate\Http\Request;

class AnalysisGrowthChartSrcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('/content/pages/AnalysisGrowthChartSrc/index');
    }


    public function getAnalysisGrowthChartSrc()
    {
        $query = "SELECT * FROM analysis_growth_chart_src";
        $data = DB::select($query);

// dd($data);
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
            'desc_en' => 'required'
        ]);
        $rules = [
            'desc_en' => 'required|string|min:0|max:250',
        ];

        $validator = Validator::make($request->all(), $rules);

        // เชค Validate ข้อมูลที่ส่งมา
        if (!$validator->fails()) {

            $desc_en = $request->desc_en;
            $desc_th = $request->desc_th;
            $owner = $request->owner;

            if (empty($request->modalType)) {
                //เพิ่มข้อมูล
                $query = "INSERT INTO analysis_growth_chart_src (desc_en, desc_th, owner) VALUES ('$desc_en', '$desc_th', '$owner')";
                $insert = DB::insert($query);
                return "200";
            } else {
                $query = "UPDATE analysis_growth_chart_src SET desc_en = '$desc_en', desc_th = '$desc_th',owner = '$owner' WHERE id = '$request->modalType'";
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
        $query = "SELECT * FROM analysis_growth_chart_src WHERE id = '$id'";
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
                DB::delete("DELETE FROM analysis_growth_chart_src WHERE id = $value ");
            }
            return "200";
        } else {
            DB::delete("DELETE FROM analysis_growth_chart_src WHERE id = $request->id");
            return "200";
        }
        return "error";
    }
}
