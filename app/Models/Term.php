<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Term extends Model
{
    protected $fillable = [
        'name',
        'content',
        'published_at'
    ];

    public static function last_term_id() {
        if(!Term::all()->count()) {
            return '';
        }
        $last_term = Term::orderBy('published_at', 'DESC')->first();
        if($last_term->published_at) {
            return $last_term->id;
        }
    }
}
