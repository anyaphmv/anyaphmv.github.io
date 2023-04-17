<?php

namespace App\Http\Controllers;

use App\Models\Colomn;
use App\Models\Resume;
use App\Models\Status;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HRController extends Controller
{
    public function showADDResume(){
        if (optional(auth()->user())->user_role == 4) {
            $resumes = Resume::all();
            return view('addResume')->with(['resumes'=>$resumes]);
        }
        else{
            $vacancies = Vacancy::where('status_id','=','1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies'=>$vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function showAllResume(){
        $resumes = Resume::paginate(9);
        Return view('allResume')->with(['resumes'=>$resumes]);
    }
    public function thisResume($resume_id){
        $resumes = Resume::findOrFail($resume_id);
        Return view('thisResume')->with(['resumes' =>$resumes]);;
    }
    public function AddResume(Request $request){
        $this->validate($request, ['FIO' => 'required|max:255', 'Stage' => 'regex:/(^[0-9]+$)+/', 'Phone' => 'regex:/(^[0-9]{11}+$)+/', 'Staff' => 'required|max:255', 'Discription' => 'required|max:1000']);
        $resumes = new Resume();
        $resumes->FIO = $request->input('FIO');
        $resumes->Stage = $request->input('Stage');
        $resumes->Phone = $request->input('Phone');
        $resumes->Staff = $request->input('Staff');
        $resumes->Discription = $request->input('Discription');
        $resumes->save();
        return redirect()->route('thisResume', [$resumes->resume_id]);
    }
    public function showUpdResume($resume_id){
        if (optional(auth()->user())->user_role == 4) {
            $resumes = Resume::query()->findOrFail($resume_id);
            return view('updateResume')->with(['resumes' => $resumes]);
        } else {
            $vacancies = Vacancy::where('status_id', '=', '1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies' => $vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function UpdResume(Request $request, $resume_id){
        $resumes = Resume::find($resume_id);
        $this->validate($request, ['FIO' => 'required|max:255', 'Stage' => 'regex:/(^[0-9]+$)+/', 'Phone' => 'regex:/(^[0-9]{11}+$)+/', 'Staff' => 'required|max:255', 'Discription' => 'required|max:1000']);
        $resumes->FIO = $request->input('FIO');
        $resumes->Stage = $request->input('Stage');
        $resumes->Phone = $request->input('Phone');
        $resumes->Staff = $request->input('Staff');
        $resumes->Discription = $request->input('Discription');
        $resumes->save();
        return view('thisResume')->with(['resumes'=>$resumes]);
    }
    public function delRes($resume_id){
        Resume::find($resume_id)->delete();
        $resumes = Resume::paginate(9);
        Return redirect()->route('showAllResume')->with(['resumes'=>$resumes]);
    }
    public function showKanban(){
        if (optional(auth()->user())->user_role == 4) {
            $vacancies = Vacancy::where('status_id', '=', '1')->get();
            $resumes = Resume::all();
            $cols = Colomn::all();
            $countCol = Colomn::count();
            return view('kanbanboard')->with(['vacancies' => $vacancies, 'resumes' => $resumes, 'cols' => $cols, 'countCol' => $countCol]);
        } else {
            $vacancies = Vacancy::where('status_id', '=', '1')->paginate(6);
            return Redirect::route('mainPage')->with(['vacancies' => $vacancies])->withErrors(['msg' => 'Нет доступа к данной странице!']);
        }
    }
    public function NewCol(Request $request){
        $this->validate($request, ['title' => 'required|max:255']);
        $colomn = new Colomn();
        $colomn->title = $request->input('title');
        $colomn->save();
        $vacancies = Vacancy::where('status_id','=','1')->get();
        $resumes = Resume::all();
        $cols = Colomn::all();
        $countCol = Colomn::count();
        return redirect()->route('showKanban', ['vacancies'=>$vacancies, 'resumes'=>$resumes,'cols'=>$cols, 'countCol'=>$countCol]);
    }
    public function EditCol(Request $request, $id){
        $col = Colomn::find($id);
        $this->validate($request, ['title' => 'required|max:255']);
        $col->title = $request->input('title');
        $col->save();
        $vacancies = Vacancy::where('status_id','=','1')->get();
        $resumes = Resume::all();
        $cols = Colomn::all();
        $countCol = Colomn::count();
        return redirect()->route('showKanban', ['vacancies'=>$vacancies, 'resumes'=>$resumes,'cols'=>$cols, 'countCol'=>$countCol]);
    }
    public function deleteCol($id){
        Colomn::find($id)->delete();
        $vacancies = Vacancy::where('status_id','=','1')->get();
        $resumes = Resume::all();
        $cols = Colomn::all();
        $countCol = Colomn::count();
        return redirect()->route('showKanban', ['vacancies'=>$vacancies, 'resumes'=>$resumes,'cols'=>$cols, 'countCol'=>$countCol]);
    }
    public function FormRecords(Request $request, $resume_id, $vacancy_id){
        if($request->input('delete')){
            $res = Resume::find($resume_id);
            $res->colom_id = NULL;
            $res->id_vac = NULL;
            $res->save();
        }
        else if($request->input('sent')){
            $res = Resume::find($resume_id);
            $res->colom_id = 1;
            $res->id_vac = $vacancy_id;
            $res->save();
        }
        $vacancies = Vacancy::where('status_id','=','1')->get();
        $resumes = Resume::all();
        $cols = Colomn::all();
        $countCol = Colomn::count();
        return redirect()->route('showKanban', ['vacancies'=>$vacancies, 'resumes'=>$resumes,'cols'=>$cols, 'countCol'=>$countCol]);
    }
    public function AddNewRecord(Request $request, $colom_id, $id_vac){
        $id = $request->id;
        $res = Resume::find($id);
        $res->colom_id = $colom_id;
        $res->id_vac = $id_vac;
        $res->save();
        $vacancies = Vacancy::where('status_id','=','1')->get();
        $resumes = Resume::all();
        $cols = Colomn::all();
        $countCol = Colomn::count();
        return redirect()->route('showKanban', ['vacancies'=>$vacancies, 'resumes'=>$resumes,'cols'=>$cols, 'countCol'=>$countCol]);
    }
}
