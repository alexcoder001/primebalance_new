<x-dashboard-layout>
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 pt-4 mb-4">
            <div class="row d-md-flex justify-content-between align-items-center">
                <div class="col-12 col-md-3 d-md-block">
                    <h2 class="text-white fw-normal mb-1 mb-md-0">Transaction</h2>
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

    <a href="{{ route('transactions.index') }}" class="btn btn-outline-white mb-4">Go back</a>

    <div class="row d-md-none">
        <div class="col-12">
            <div class="card h-100 rounded-3">
                <div class="card-body p-2">
                    <p class="fs-5 text-white text-start mt-2 mb-3 ms-3">{{ $transaction->description }}</p>
                    <div @class(['d-flex bg-dark-green rounded-1 px-2'])>
                        <ul class="list-group w-100">
                            <li class="list-group-item d-flex justify-content-between py-3 border-white border-opacity-25 border-bottom">
                                <p class="text-white mb-0">Date</p>
                                <p class="text-white mb-0">{{ $transaction->created_at->toDateString() }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between py-3 border-white border-opacity-25 border-bottom">
                                <p class="text-white mb-0">Amount</p>
                                <p class="text-white mb-0">${{ number_format(abs($transaction->amount), 2) }}</p>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between py-3 border-white border-opacity-25">
                                <p class="text-white mb-0">Action</p>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                    @csrf

                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
