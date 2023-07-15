<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataExamResource;
use App\Models\DataExam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DataExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $data = DataExamResource::collection(DataExam::all());
        return new Response(['status'=>true,'data'=>$data] , Response::HTTP_OK);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
           //

           $validator = Validator($request->all(),
           [
               'name'=>'required|string|min:6',
               'midTerm'=>'required|numeric',
               'final' => 'required|numeric',
               'activities' => 'nullable|string',
           ]);

           if(! $validator->fails()){
            $dataExam = new DataExam();
            $dataExam->name = $request->input('name');
            $dataExam->midTerm = $request->input('midTerm');
            $dataExam->final = $request->input('final');
            $dataExam->activities = $request->input('activities');

            $saved = $dataExam->save();
            $object = new DataExamResource($dataExam);
            return new Response(['message'=>$saved ,"object"=>$object ]);

            }else{
               return new Response(['message'=>$validator->getMessageBag()->first()]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataExam $dataExam)
    {
        //
        return new Response(['status'=>true , 'message'=>'success' , 'data'=>$dataExam]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataExam $dataExam)
    {
        //
        $validator = Validator($request->all(),
        [
            'name'=>'required|string|min:6',
            'midTerm'=>'required|numeric',
            'final' => 'required|numeric',
            'activities' => 'nullable|string',
        ]);

        if(! $validator->fails()){
         $dataExam = new DataExam();
         $dataExam->name = $request->input('name');
         $dataExam->midTerm = $request->input('midTerm');
         $dataExam->final = $request->input('final');
         $dataExam->activities = $request->input('activities');

         $saved = $dataExam->save();
         $object = new DataExamResource($dataExam);
         return new Response(['message'=>$saved ,"object"=>$object ]);

         }else{
            return new Response(['message'=>$validator->getMessageBag()->first()]);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataExam $dataExam)
    {
        //

        $deleted = $dataExam->delete();
        return new Response(['status'=>true , 'message'=>$deleted ],Response::HTTP_OK );
    }
}
