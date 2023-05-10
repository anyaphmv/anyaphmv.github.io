<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function showPageModerate(){
        if (optional(auth()->user())->user_role == 3) {
        $vacancies = Vacancy::where('status_id','=',3)->get();
        return view('moderate')->with(['vacancies'=>$vacancies]);
        }
        else{
            return redirect()->route('mainPage')->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function confirm($vacancy_id){
        Mail::send(['text'=>'mail'],['name', 'Rendement'],function ($message){
            $message->to('pakhomova.anna.ea@gmail.com','Для кадровика')->subject('Уведомление о новой вакансии.');
            $message->from(auth::user()->email,'От модератора');
        });
        $vacansies = Vacancy::find($vacancy_id);
        $vacansies->status_id = 1;
        $vacansies->comments = NULL;
        $vacansies->save();
        $vacancies = Vacancy::where('status_id','=', 3)->get();
        return redirect()->route('showPageModerate')->with(['vacancies'=>$vacancies]);
    }
    public function showPageComments($vacancy_id){
        if (optional(auth()->user())->user_role == 3) {
            $vacancies = Vacancy::find($vacancy_id);
            return view('comments')->with(['vacancies' => $vacancies]);
        } else {
            return redirect()->route('mainPage')->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function refusalVacancy(Request $request,$vacancy_id){
        $this->validate($request, ['comments' => 'required|max:255']);
        $vacansies = Vacancy::find($vacancy_id);
        $vacansies->status_id = 2;
        $vacansies->comments = $request->input('comments');
        $vacansies->save();
        $vacancies = Vacancy::where('status_id','=', 3)->get();
        return view('moderate')->with(['vacancies'=>$vacancies]);
    }
}
