<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function showMainPage(){
        $vacancies = Vacancy::where('status_id','=','1')->paginate(6);
        Return view('welcome')->with(['vacancies'=>$vacancies]);
    }
    public function showVacancyPage(){
        $vacancies = Vacancy::where('status_id','=','1')->paginate(9);
        Return view('vacancy')->with(['vacancies'=>$vacancies]);
    }
    public function showAboutPage(){
        Return view('about');
    }

    public function showThisVacancy($vacancy_id){
        $vacancies = Vacancy::findOrFail($vacancy_id);
        $similars = Vacancy::where('status_id','=','1')->inRandomOrder()->limit(5)->get();
        Return view('thisvacancy')->with(['vacancies' =>$vacancies, 'similars'=>$similars]);;
    }
    public function search(Request $request){
        $search =  $request->search;
        $vacancies = Vacancy::where('name_job','like',"%{$search}%")->where('status_id','=','1')->paginate(9);
        Return view('vacancy')->with(['vacancies'=>$vacancies]);
    }

}
