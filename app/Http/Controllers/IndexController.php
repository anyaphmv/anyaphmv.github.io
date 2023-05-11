<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function showMainPage(){
        $vacancies = Vacancy::where('status_id','=','1')->paginate(6);
        Return view('welcome')->with(['vacancies'=>$vacancies]);
    }
    public function showVacancyPage(){
        $citys = Vacancy::select('place')->distinct()->get();
        $vacancies = Vacancy::where('status_id', '=', '1')->paginate(9);
        return view('vacancy')->with(['vacancies' => $vacancies,'citys'=>$citys]);
    }
    public function showAboutPage(){
        Return view('about');
    }
    public function showThisVacancy($vacancy_id){
        $vacancies = Vacancy::findOrFail($vacancy_id);
        $similars = Vacancy::where('status_id','=','1')->inRandomOrder()->limit(5)->get();
        Return view('thisvacancy')->with(['vacancies' =>$vacancies, 'similars'=>$similars]);;
    }
    public function showAllResume(){
        $resumes = Resume::paginate(9);
        $staffes = Resume::select('Staff')->distinct()->get();
        Return view('allResume')->with(['resumes'=>$resumes,'staffes'=>$staffes]);
    }
    public function thisResume($resume_id){
        $resumes = Resume::findOrFail($resume_id);
        Return view('thisResume')->with(['resumes' =>$resumes]);;
    }
    public function search(Request $request){
        $search =  $request->search;
        $citys = Vacancy::select('place')->distinct()->get();
        $vacancies = Vacancy::where('name_job','like',"%{$search}%")->where('status_id','=','1')->paginate(9);
        Return view('vacancy')->with(['vacancies'=>$vacancies, 'citys'=>$citys]);
    }
    public function filters(Request $request){
        $citys = Vacancy::select('place')->distinct()->get();
        if($request->place or $request->prices1 or $request->prices2){
            if ($request->place) {
                $vacancies = Vacancy::where('place', '=', $request->place)->paginate(9);
            }
            if ($request->prices1) {
                $vacancies = Vacancy::where('paycheck', '>=', $request->prices1)->paginate(9);
            }
            if ($request->prices2) {
                $vacancies = Vacancy::where('paycheck', '<=', $request->prices2)->paginate(9);
            }
            if ($request->place and $request->prices1) {
                $vacancies = Vacancy::where('paycheck', '>=', $request->prices1)->where('place', '=', $request->place)->paginate(9);
            }
            if ($request->place and $request->prices2) {
                $vacancies = Vacancy::where('paycheck', '<=', $request->prices2)->where('place', '=', $request->place)->paginate(9);
            }
            if ($request->prices1 and $request->prices2) {
                $vacancies = Vacancy::where('paycheck', '>=', $request->prices1)->where('paycheck', '<=', $request->prices2)->paginate(9);
            }
            if ($request->place and $request->prices1 and $request->prices2) {
                $vacancies = Vacancy::where('place', '=', $request->place)->where('paycheck', '>=', $request->prices1)->where('paycheck', '<=', $request->prices2)->paginate(9);
            }
            Return view('vacancy')->with(['vacancies'=>$vacancies,'citys'=>$citys]);
        }
        else {
            $vacancies = Vacancy::where('status_id', '=', '1')->paginate(9);
            return Redirect::route('vacancyPage')->with(['vacancies'=>$vacancies,'citys'=>$citys])->withErrors(['msg' => 'Ничего не найдено!']);
        }
    }
    public function searchResum(Request $request){
        $staffes = Resume::select('Staff')->distinct()->get();
        $search =  $request->search;
        $resumes = Resume::where('FIO','like',"%{$search}%")->paginate(9);
        Return view('allResume')->with(['resumes'=>$resumes,'staffes'=>$staffes]);
    }
    public function filterRes(Request $request){
        $staffes = Resume::select('Staff')->distinct()->get();
        if($request->staff or $request->staff1 or $request->staff2){
            if ($request->staff) {
                $resumes = Resume::where('Staff', '=', $request->staff)->paginate(9);
            }
            if ($request->staff1) {
                $resumes = Resume::where('Stage', '>=', $request->staff1)->paginate(9);
            }
            if ($request->staff2) {
                $resumes = Resume::where('Stage', '<=', $request->staff2)->paginate(9);
            }
            if ($request->staff and $request->staff2) {
                $resumes = Resume::where('Staff', '=', $request->staff)->where('Stage', '<=', $request->staff2)->paginate(9);
            }
            if ($request->staff1 and $request->staff2) {
                $resumes = Resume::where('Stage', '>=', $request->staff1)->where('Stage', '<=', $request->staff2)->paginate(9);
            }
            if ($request->staff and $request->staff1) {
                $resumes = Resume::where('Staff', '=', $request->staff)->where('Stage', '>=', $request->staff1)->paginate(9);
            }
            if ($request->staff and $request->staff1 and $request->staff2) {
                $resumes = Resume::where('Staff', '=', $request->staff)->where('Stage', '>=', $request->staff1)->where('Stage', '<=', $request->staff2)->paginate(9);
            }
            Return view('allResume')->with(['resumes'=>$resumes,'staffes'=>$staffes]);
        }
        else {
            $resumes = Resume::paginate(9);
            return Redirect::route('showAllResume')->with(['resumes'=>$resumes,'staffes'=>$staffes])->withErrors(['msg' => 'Ничего не найдено!']);
        }
    }
}
