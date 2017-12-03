<?php namespace App\Http\Controllers\Counselor;

use App\Eloquent\QuestionCategory;
use App\Eloquent\User;
use App\Eloquent\UserStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class Report extends Controller
{
    public function index()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        var_dump(Session::get('cbk_msg', null));

        $reports = User::with(['student', 'answer'])->where('role', '=', 'student')->get();

        return view("layout.counselor.report.list.counselor_report_list_$this->theme", compact('reports'));
    }

    public function activation($id)
    {
        /** @var UserStudents $student */
        $student = UserStudents::where('user', '=', $id)->first();
        $student->setAttribute('active', true);
        $student->save();

        return redirect()->back()->with('cbk_msg', ['notify' => ['Siswa Berhasil Diaktifkan']]);
    }

    public function detail($id)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        var_dump(Session::get('cbk_msg', null));

        $categories = QuestionCategory::all();
        $report     = User::with(['student', 'answer' => function ($query) {
            $query->with('answer_result');
        }])->where('role', '=', 'student')->where('id', '=', $id)->first();

        return view("layout.counselor.report.detail.counselor_report_detail_$this->theme", compact('categories', 'report'));
    }

    public function publish($id, $answer)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        var_dump(Session::get('cbk_msg', null));

        $user = User::with(['answer' => function ($query) use ($answer) {
            $query->with('answer_result')->where('id', '=', $answer);
        }])->where('id', '=', $id)->first();
        dd($user);
    }
}
