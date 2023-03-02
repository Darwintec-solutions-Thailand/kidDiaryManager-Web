<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/content/pages/News/index');
    }

    public function getNews()
    {
        $query = "SELECT * FROM news";
        $data = DB::select($query);


        return Datatables::of($data)->addIndexColumn()->make(true);

        // return $data;
    }

    public function showNews()
    {
        $pageConfigs = ['showMenu' => false];
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout without menu"]];
        return view('/content/pages/News/news', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    public function showNewsById($id)
    {
        $pageConfigs = ['showMenu' => false];
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout without menu"]];

        $query = "SELECT * FROM news WHERE ID = '$id'";
        $dataNew = DB::select($query);
        // dd($dataNew);
        return view('/content/pages/News/showNewsById', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'dataNew' => $dataNew]);
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
        dd($request->all());
        // $request->text($request->news_detail);
        $request->validate([
            'news_title' => 'required'
        ]);
        $rules = [
            'news_title' => 'required|string|min:0|max:250',
        ];

        $validator = Validator::make($request->all(), $rules);

        // เชค Validate ข้อมูลที่ส่งมา
        if (!$validator->fails()) {

            $news_title = $request->news_title;
            $news_detail = $request->news_detail;

            if (empty($request->modalType)) {
                //เพิ่มข้อมูล
                $query = "INSERT INTO news (news_title, news_detail) VALUES ('$news_title', '$news_detail')";
                $insert = DB::insert($query);
                return "200";
            } else {
                $query = "UPDATE news SET news_title = '$news_title', news_detail = '$news_detail' WHERE id = '$request->modalType'";
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
        $query = "SELECT * FROM news WHERE id = '$id'";
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
                DB::delete("DELETE FROM news WHERE id = $value ");
            }
            return "200";
        } else {
            DB::delete("DELETE FROM news WHERE id = $request->id");
            return "200";
        }
        return "error";
    }
}
