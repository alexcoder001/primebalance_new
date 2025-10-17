<x-dashboard-layout>
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 pt-4 mb-4">
            <div class="row d-md-flex justify-content-between align-items-center">
                <div class="col-12 col-md-3 d-md-block">
                    <h2 class="text-white fw-normal mb-1 mb-3 mb-md-0">Transactions</h2>
                </div>

                <div class="col-12 col-md-3">
                    <form class="mb-3 mb-md-0" action="{{ route('transactions.index') }}" method="GET">
                        <input class="form-control search-input" name="search" placeholder="Type to search">
                    </form>
                </div>

                <div class="col-12 col-md-5">
                    <div class="btn-group" role="group">
                        <a href="{{ route('transactions.index', ['filter' => 'all']) }}"
                           class="btn btn-outline-white {{ request('filter') === 'all' ? 'active' : '' }}">
                            All
                        </a>
                        <a href="{{ route('transactions.index', ['filter' => 'incomes']) }}"
                           class="btn btn-outline-white {{ request('filter') === 'incomes' ? 'active' : '' }}">
                            Incomes
                        </a>
                        <a href="{{ route('transactions.index', ['filter' => 'expenses']) }}"
                           class="btn btn-outline-white {{ request('filter') === 'expenses' ? 'active' : '' }}">
                            Expenses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="alert" class="row justify-content-center">
            <div class="col-12 col-lg-11 pt-4 mb-3">
                <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div id="transactions-list">
        <div class="row d-md-none">
            <div class="col-12">
                <div class="card h-100 rounded-3">
                    <div class="card-body p-2">
                        <div @class(['d-none' => $transactions->isEmpty(), 'd-flex bg-dark-green rounded-1 px-2'])>
                            <ul class="list-group w-100">
                                @foreach($transactions as $transaction)
                                    <a href="" class="text-decoration-none">
                                        <li @class(['list-group-item d-flex justify-content-between py-4 border-white border-opacity-25',
                                'border-bottom' => !$loop->last])>
                                            <p class="text-white mb-0">{{ $transaction->description }}</p>
                                            <p @class([
                                            'mb-0',
                                             'text-danger' => $transaction->amount < 0,
                                             'text-primary' => $transaction->amount > 0,
                                           ])>
                                                ${{ number_format(abs($transaction->amount), 2) }}</p>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center d-none d-md-flex">
            <div class="col-12 col-md-11">
                <table class="table custom-table rounded-3 caption-top">
                    <thead>
                    <tr>
                        <th class="fs-5 fw-normal" scope="col">Name</th>
                        <th class="fs-5 fw-normal" scope="col">Date</th>
                        <th class="fs-5 fw-normal" scope="col">Amount</th>
                        <th class="fs-5 fw-normal" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr @class(['bg-dark-green rounded-1',
                                'border-bottom' => !$loop->last])>
                            <th scope="row">{{ $transaction->description }}</th>
                            <td>{{ $transaction->created_at->toDateString() }}</td>
                            <td @class([
                                    'mb-0',
                                    'text-danger' => $transaction->amount < 0,
                                    'text-primary' => $transaction->amount > 0,
                        ])>
                                ${{ number_format(abs($transaction->amount), 2) }}
                            </td>
                            <td>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                    @csrf

                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{--                            {{ $transactions->links() }}--}}

            </div>
        </div>
    </div>
</x-dashboard-layout>
