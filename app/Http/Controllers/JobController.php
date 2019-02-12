<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends ApiBaseController
{
    public $job;
    public function __construct(Job $job){
        $this->job = $job;
    }
    public function store(Request $request)
    {
        $this->job->saveJob($request);
        return $this->sendResponse($this->job->orderBY('created_at','desc')->get(), 'Job Title have been add');
        
    }
    public function index()
    {
        return $this->sendResponse($this->job->orderBY('created_at','desc')->get(), 'Job Title Retrieved');
    }
    
    public function update(Request $request,$id)
    {
        $job = $this->job->updateJob($request, $id);
        if($job)
        {
             return $this->sendResponse($this->job->orderBy('created_at','desc')->get(),'Job Title update Successfully');
        } 
  
        return $this->sendError('Job Title hasnot been update');
     
    } 
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        
        if(! $job){
            return response()->json([
                'success'=>false,
                'message'=>'Job with id ' .$id. ' not found '
        ]);
        }
        if($job->destroy($id)){
            return response()->json([
                'success'=>true,
                'message'=>'Job with id ' .$id. ' successfully deleted'
        ]);
        }
    }     

}
