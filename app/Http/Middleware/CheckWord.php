<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckWord
{
    protected $words = [
        1 => 'apple',
        2 => 'banana',
        3 => 'cherry',
        4 => 'dog',
        5 => 'elephant',
    ];

    public function handle(Request $request, Closure $next)
    {
        $providedWord = $request->query('word');

        $correctWord = $this->words[5];

        if ($providedWord !== $correctWord) {
            return response('Access denied: You shall not pass!', 403);
        }

        return $next($request);
    }
}

