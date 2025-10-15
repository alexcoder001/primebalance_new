<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $balance = Transaction::where('user_id', $user->id)->sum('amount');

        $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(3)->get();

        $goals = $user->goals()->withSum('transactions', 'amount')->get();

        return view('dashboard', compact('user', 'balance', 'transactions', 'goals'));
    }
}
