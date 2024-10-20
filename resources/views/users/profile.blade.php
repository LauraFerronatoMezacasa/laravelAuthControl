@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Meus dados</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.updatePassword') }}">
                        @csrf
                    
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nome</label>                            
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>

                        <hr>

                        <h5 class="fw-bold">Redefinir Senha</h5>

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-bold">Senha Atual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label fw-bold">Nova Senha</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label fw-bold">Confirme a Nova Senha</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.status-messages')
</div>
@endsection
