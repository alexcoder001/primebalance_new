<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = $this->user->transactions();

        if($request->has('search')) {
            $query->where('description', 'LIKE', request('search') . '%');
        }

        if ($filter === 'incomes') {
            $query->where('amount', '>', 0);
        } else if ($filter === 'expenses') {
            $query->where('amount', '<', 0);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('transactions', compact('transactions', 'filter'));
    }

    public function store(TransactionStoreRequest $request)
    {
        $attributes = $request->validated();

        $multiplier = intval($attributes['type']);

        $balance = Transaction::where('user_id', $this->user->id)->sum('amount');

        if ($multiplier === -1 && $attributes['amount'] > $balance) {
            return redirect('/dashboard')->with('error', 'You don\'t have enough money for this transaction');
        }

        $transaction = $this->createTransaction($attributes, $multiplier);

        $this->user->transactions()->save($transaction);

        return redirect('/dashboard');
    }

    protected function createTransaction(array $data, int $multiplier): Transaction
    {
        return new Transaction([
            'amount' => $data['amount'] * $multiplier,
            'description' => $data['description'],
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('/transactions')->with('success', 'Transaction ' . $transaction->description . ' successfully deleted.');
    }
}
