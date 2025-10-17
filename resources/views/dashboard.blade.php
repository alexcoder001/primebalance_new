<x-dashboard-layout>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-11 pt-4 mb-3">
            <h2 class="text-white mb-1">Hello, {{ $user->first_name }}</h2>
            <p class="text-white-65">{{ substr(now()->toFormattedDayDateString(), 0, -6) }}</p>
        </div>
    </div>

    @if (session('error'))
        <div id="alert" class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-11 pt-4 mb-3">
                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center mb-4 g-3">
        <div class="col-12 col-lg-5 col-xl-3">
            <div class="card h-100 rounded-3">
                <div class="card-body p-2">
                    <p class="fs-5 text-white text-start mt-2 mb-3 ms-3">Balance</p>
                    <div class="d-flex bg-dark-green rounded-1 p-3 align-items-start">
                        <p class="text-primary h3 mb-0">${{ number_format($balance, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5 col-xl-4">
            <div class="card h-100 rounded-3">
                <div class="card-body p-2">
                    <p class="fs-5 text-white text-start mt-2 mb-3 ms-3">Recent Transactions</p>
                    <div @class(['d-none' => $transactions->isEmpty(), 'd-flex bg-dark-green rounded-1 p-2'])>
                        <ul class="list-group w-100">
                            @foreach($transactions as $transaction)
                                <li @class(['list-group-item d-flex justify-content-between border-white border-opacity-25',
                                'border-bottom' => !$loop->last])>
                                    <p class="text-white mb-0">{{ $transaction->description }}</p>
                                    <p @class([
                                            'mb-0',
                                             'text-danger' => $transaction->amount < 0,
                                             'text-primary' => $transaction->amount > 0,
                                           ])>
                                        ${{ number_format(abs($transaction->amount), 2) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-10 col-xl-4">
            <div class="card h-100 rounded-3">
                <div class="card-body p-2">
                    <p class="fs-5 text-white text-start mt-2 mb-3 ms-3">Goals</p>
                    <div @class(['d-none' => $goals->isEmpty(), 'd-flex bg-dark-green rounded-1 p-2'])>

                        <ul class="list-group w-100">
                            @foreach($goals as $goal)
                                <li @class(['list-group-item d-flex justify-content-between border-white border-opacity-25',
                                'border-bottom' => !$loop->last])>
                                    <p class="text-white mb-0">{{ $goal->description }}</p>
                                    <p @class(['mb-0', 'text-white' => abs($goal->transactions_sum_amount) != $goal->amount, 'text-primary' => abs($goal->transactions_sum_amount) >= $goal->amount])>${{ number_format($goal->amount, 2) }}</p>
                                    @if(abs($goal->transactions_sum_amount) >= $goal->amount)
                                        <p class="text-white">Done</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-10 col-xl-11">
            <div class="card rounded-3">
                <div class="card-body p-2">
                    <p class="fs-5 text-white text-start mt-2 mb-3 ms-3">Quick Actions</p>

                    <div class="bg-dark-green rounded-1 p-3 text-center">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <button type="button" class="btn w-100 action" data-bs-toggle="modal" data-bs-target="#actionModal" data-type="expense">
                                    New Transaction
                                </button>
                            </div>
                            <div class="col-12 col-sm-6">
                                <button type="button" class="btn w-100 action" data-bs-toggle="modal" data-bs-target="#goalModal" data-type="goal">
                                    New Goal
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="actionForm" method="POST" action="{{ route('transactions.index') }}">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">New Transaction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <select @class(["form-select border-light", 'is-invalid' => $errors->hasAny('type')]) id="type" name="type" aria-label="Default select example">
                                    <option selected>Choose transaction type</option>
                                    <option value="-1">Expense</option>
                                    <option value="1">Income</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" step="any" @class(["form-control border-light", 'is-invalid' => $errors->hasAny('amount')]) id="amount" name="amount">
                                @error('amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" @class(["form-control border-light", 'is-invalid' => $errors->hasAny('description')]) id="description" name="description">
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="goalModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="goalForm" method="POST" action="{{ route('goals') }}">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">New Goal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" step="any" @class(["form-control border-light", 'is-invalid' => $errors->hasAny('amount')]) id="amount" name="amount">
                                @error('amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" @class(["form-control border-light", 'is-invalid' => $errors->hasAny('description')]) id="description" name="description">
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

