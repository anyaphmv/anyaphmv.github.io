<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Resume;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class CompanyController extends Controller
{
    public function showPageMyVacancy($id){
        if (optional(auth()->user())->user_role == 1) {
            if (auth::user()->id == $id) {
                $myVacancies = Vacancy::where('user_id', '=', $id)->get();
                return view('myVacancy')->with(['myVacancies' => $myVacancies]);
            }
        }  else{
            $vacancies = Vacancy::where('status_id','=','1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies'=>$vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function showPageAddVacancy(){
        if (optional(auth()->user())->user_role == 1) {
            return view('addVacancy');
        }
        else{
            $vacancies = Vacancy::where('status_id','=','1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies'=>$vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function AddVacancy(Request $request, $id)
    {
        $this->validate($request, ['name_job'=>'required|max:255', 'paycheck'=>'regex:/(^[0-9]+$)+/', 'place'=>'regex:/([^0-9]+$)+/', 'discription'=>'required|max:1000']);
        $vacancies = new Vacancy();
        $vacancies->name_job = $request->input('name_job');
        $vacancies->paycheck = $request->input('paycheck');
        $vacancies->place = $request->input('place');
        $vacancies->status_id = 3;
        $vacancies->comments = NULL;
        $vacancies->discription = $request->input('discription');
        $vacancies->user_id = $id;
        $vacancies->save();
        return redirect()->route('showThisVacancy', [$vacancies->vacancy_id]);
    }
    public function showPageUpdateVacancy($vacancy_id){
        if (optional(auth()->user())->user_role == 1) {
            $vacancies = Vacancy::query()->findOrFail($vacancy_id);
            return view('updateVacancy')->with(['vacancies' => $vacancies]);
        } else {
            $vacancies = Vacancy::where('status_id', '=', '1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies' => $vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function UpdateVacancy(Request $request, $vacancy_id, $id){
        $vacancies = Vacancy::find($vacancy_id);
        $request->validate(['name_job'=>'required|max:255', 'paycheck'=>'regex:/(^[0-9]+$)+/', 'place'=>'regex:/([^0-9]+$)+/', 'discription'=>'required|max:1000']);
        $vacancies->name_job = $request->input('name_job');
        $vacancies->paycheck = $request->input('paycheck');
        $vacancies->place = $request->input('place');
        $vacancies->status_id = 3;
        $vacancies->comments = NULL;
        $vacancies->discription = $request->input('discription');
        $vacancies->user_id = $id;
        $vacancies->save();
        $similars = Vacancy::inRandomOrder()->limit(5)->get();
        return view('thisvacancy')->with(['vacancies'=>$vacancies, 'similars' =>$similars]);
    }
    public function deleteVacancy($vacancy_id, $id){
        Vacancy::find($vacancy_id)->delete();
        $myVacancies = Vacancy::where('user_id', '=', $id)->get();
        return redirect()->route('showPageMyVacancy',['id'=>$id])->with(['myVacancies' => $myVacancies]);
    }
    public function showMessagePage($id){
        if (optional(auth()->user())->user_role == 1) {
            if (auth::user()->id == $id) {
                $resumes = Resume::where('colom_id','=',1)->get();
                $vacancies = Vacancy::where('user_id', '=', $id)->get('vacancy_id');
                foreach ($resumes as $res){
                    foreach ($vacancies as $vac) {
                        if ($res->id_vac == $vac->vacancy_id) {
                            $massiv = Vacancy::find($vac->vacancy_id);
                            $array[] = $massiv;
                        }
                    }
                }
                $vacs = array_unique($array);
            return view('messages')->with(['vacs'=>$vacs]);
            }
        } else {
            $vacancies = Vacancy::where('status_id', '=', '1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies' => $vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function showConfirmPage($vacancy_id){
        if (optional(auth()->user())->user_role == 1) {
                $vacancies = Vacancy::find($vacancy_id);
                $resumes = Resume::where('id_vac','=', $vacancies->vacancy_id)->where('colom_id','=',1)->get();
                return view('confirmPage')->with(['vacancies'=>$vacancies,'resumes'=>$resumes]);
        } else {
            $vacancies = Vacancy::where('status_id', '=', '1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies' => $vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function AgreeRes($resume_id,$vacancy_id){
        $res = Resume::find($resume_id);
        $res->colom_id = 4;
        $res->save();
        $doc = new Documents();
        $doc->date = Carbon::now()->format('Y-m-d');
        $doc->id_resume = $resume_id;
        $doc->name_id = 1;
        $doc->save();
        $doc = new Documents();
        $doc->date = Carbon::now()->format('Y-m-d');
        $doc->id_resume = $resume_id;
        $doc->name_id = 2;
        $doc->save();
        return redirect()->route('showConfirmPage', [$vacancy_id]);
    }
    public function refusalRes($resume_id,$vacancy_id){
        $res = Resume::find($resume_id);
        $res->colom_id = 3;
        $res->save();
        return redirect()->route('showConfirmPage',[$vacancy_id]);
    }
    public function revisionResum(Request $request,$resume_id,$vacancy_id){
        $this->validate($request, ['comment' => 'required|max:255']);
        $res = Resume::find($resume_id);
        $res->colom_id = 2;
        $res->comment = $request->input('comment');
        $res->save();
        return redirect()->route('showConfirmPage',[$vacancy_id]);
    }
    public function showDocumentsPage(){
        if (optional(auth()->user())->user_role == 1) {
            $docs = Documents::all();
            return view('documents')->with(['docs'=>$docs]);
        }
        else{
            $vacancies = Vacancy::where('status_id','=','1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies'=>$vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function pdfExportAct($id){
        $docs = Documents::find($id);
        $res = Resume::find($docs->id_resume);
        $vac = Vacancy::find($res->id_vac);
        $pdf = PDF::loadView('pdfAct',['docs'=>$docs,'vac'=>$vac])->setPaper('a4','portrait');
        $fileName = 'Акт о выполненных работах';
        return $pdf->stream($fileName . '.pdf');
    }
    public function pdfExportBill($id){
        $alldocs = Documents::all();
        $docs = Documents::find($id);
        $res = Resume::find($docs->id_resume);
        $vac = Vacancy::find($res->id_vac);
        $pdf = PDF::loadView('pdfBill',['docs'=>$docs,'alldocs'=>$alldocs,'vac'=>$vac])->setPaper('a4','portrait');
        $fileName = 'Счет на оплату услуг';
        return $pdf->stream($fileName . '.pdf');
    }
}
