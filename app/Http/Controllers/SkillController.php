<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    public function index(){
        return view('content.skill');
    }
    public function getSkills(){
        return Skill::all();
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $actor = new Skill();
            $actor->skill =  $request->input('skill');
            $actor->save();
            DB::commit();
            $response = ['object' => null, 'error' => false, 'message' => 'Skill Stored'];
        }catch (\Exception $e){
            DB::rollback();
            $response = ['object' => null, 'error' => true, 'message' => $e->getMessage()];
        }
        return $response;

    }
    public function newSkill(){
        return view('content.newskill');
    }
    public function editSkill($id){
        return view('content.editskill',['skill_id' => $id]);
    }
    public function getSkill($skill_id){
        return Skill::find($skill_id);
    }
    public function updateSkill(Request $request,$skill_id){
        try{
            DB::beginTransaction();
            $actor = Skill::find($skill_id);
            $actor->skill = $request->input('skill');
            $actor->save();
            DB::commit();
            $response = ['object' => null, 'error' => false, 'message' => 'Skill Updated'];
        }catch (\Exception $e){
            DB::rollback();
            $response = ['object' => null, 'error' => true, 'message' => $e->getMessage()];
        }
        return $response;
    }
    public function deleteSkill($skill_id){
        return Skill::destroy($skill_id);
    }
}
