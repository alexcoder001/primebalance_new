<x-layout>
    <div class="d-flex justify-content-center">
        <form action="/login" method="POST" class="auth-form col-12 col-md-5 col-lg-3">
            @csrf

            <h1 class="h3 mb-3 fw-normal">Log In</h1>

            <div class="form-floating mb-3">
                <input name="email" type="email" value="{{ old('email') }}" @class(["form-control text-black", 'is-invalid' => $errors->hasAny('email')]) id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input name="password" type="password" @class(["form-control text-black", 'is-invalid' => $errors->hasAny('password')]) id="floatingPassword"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Log in</button>
        </form>
    </div>
</x-layout>

