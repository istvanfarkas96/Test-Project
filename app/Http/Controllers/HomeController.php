<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('home', ['users' => $users]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('users')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('phone', 'like', '%' . $query . '%')
                    ->get();
            } else {
                $data = DB::table('users')->orderBy('id', 'desc')->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr id="sid{{ $user->id }}">
                    <th scope="row">' . $row->id . '</th>
                    <td>' . $row->name . '</td>
                    <td>' . $row->email . '</td>
                    <td>' . $row->phone . '</td>
                    <td>' . $row->created_at . '</td>
                    <td><a href="/users/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                        <button class="deleteRecord btn-danger btn-sm" data-id="' . $row->id . '" >Delete</button>
                    </td>
                     <td>';
                    if ($row->email_verified_at) {
                        $output .=
                            '<form method="POST" action="/users/' . $row->id . '/unverify" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="PATCH">
                            <input name="_token" type="hidden" value="' . csrf_token() . '">
                                <div class="form-group">
                                    <input class="btn btn-warning btn-sm" type="submit" value="Unverify">
                                </div>
                        </form>';
                    } else {
                        $output .=
                            '<div class="form-group">
                            <button class="btn btn-secondary btn-sm disabled">Unverify</button>
                        </div>';
                    }
                    $output .= '<tr>';
                }
            } else {
                $output .= '
                    <tr>
                    <td>No Data</td>
                    </tr>
                    ';
            }
            $data = array(
                'table_data' => $output
            );

            echo json_encode($data);
        }
    }
}
