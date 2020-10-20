<?php


namespace App\Http\Controllers;


use App\Mail\TermNotification;
use App\Models\Term;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Term::all();

        return view('terms.index', ['terms' => $terms]);
    }

    public function create()
    {
        return view('terms.create');
    }

    public function store(Request $request)
    {
        Term::create($request->all());

        return redirect('terms');
    }

    public function publish(Term $term)
    {
        $term->published_at = Carbon::now();
        $term->update();

        $this->notifyUsers($term);

        return redirect('terms');
    }

    public function edit(Term $term)
    {
        if($term->published_at){
            return "Published terms can't be edited!";
        }

        return view('terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term)
    {
        $term->name = $request->name;
        $term->content = $request->content;

        $term->update();

        return redirect('terms');
    }

    public function current()
    {
        $terms = Term::whereNotNull('published_at')->get();
        return view('terms.show', ['terms' => $terms]);
    }

    private function notifyUsers(Term $term)
    {
        $emails = User::all()->pluck('email');

        Mail::to($emails)->queue(new TermNotification($term));
    }


}
