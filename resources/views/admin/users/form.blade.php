@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">{{ isset($user) ? 'Editar Usuário' : 'Adicionar Novo Usuário' }}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                        @csrf
                        @if(isset($user)) @method('PUT') @endif

                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Senha</label>
                            <div class="input-group">
                                <input type="text" id="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }} readonly>
                                <button type="button" class="btn btn-outline-secondary" id="generate-password">
                                    {{ isset($user) ? 'Regenerar Senha' : 'Gerar Senha' }}
                                </button>
                            </div>
                            @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Tipo de Acesso</label>
                            <select name="role" id="role" class="form-select" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ isset($user) && $user->roles->contains($role->id) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
