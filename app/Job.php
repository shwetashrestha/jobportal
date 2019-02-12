<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table ="jobs";
    protected $primaryKey ="id";
    protected $fillable = ['job_category','job_level','emp_type','job_location','image'];
 
    public function saveJob($request){
        if ($request->hasFile('image')){ 
            if($request->file('image')->isValid()){
               $file = $request->file('image');
                $name = rand(11111,99999).'.'.$file->getClientOriginalExtension();
                $request->file('image')->move("upload",$name);
           }
        } 
        $data = [
            'job_category' => $request->get('job_category'),
            'job_level' => $request->get('job_level'),
            'emp_type' => $request->get('emp_type'),
            'job_location' => $request->get('job_location'),
            'image' =>url('/').'/upload/'. $name
             
        ];
        return self::create($data);
    }
    public function updateJob($request,$id){
        if ($request->hasFile('image')){ 
            if($request->file('image')->isValid()){
               $file = $request->file('image');
                $name = rand(11111,99999).'.'.$file->getClientOriginalExtension();
                $request->file('image')->move("upload",$name);
           }
        } 
    
        $job = self::find($id);
        $data = [
            'job_category' => $request->get('job_category'),
            'job_level' => $request->get('job_level'),
            'emp_type' => $request->get('emp_type'),
            'job_location' => $request->get('job_location'),
            'image' =>url('/').'/upload/'. $name
             
        ];
        if($job->update($data))
        {
            return true;
        }	
        return false;
    }

}
