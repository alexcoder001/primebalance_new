<x-layout>
    <div class="d-flex justify-content-center">
        <form action="/register" method="POST" class="auth-form col-12 col-md-5 col-lg-3">
            @csrf

            <h1 class="h3 mb-3 fw-normal">Register</h1>

            <div class="form-floating mb-3">
                <input name="first_name" type="text" class="form-control text-black" id="floatingInput" placeholder="First Name">
                <label for="floatingInput">First Name</label>
            </div>

            <div class="form-floating mb-3">
                <input name="last_name" type="text" class="form-control text-black" id="floatingInput" placeholder="Last Name">
                <label for="floatingInput">Last Name</label>
            </div>

            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control text-black" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control text-black" id="floatingPassword"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating mb-3">
                <input name="password_confirmation" type="password" class="form-control text-black" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password Confirmation</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Register</button>
            <a href="/login" class="">Already have an account</a>
        </form>
    </div>
</x-layout>

