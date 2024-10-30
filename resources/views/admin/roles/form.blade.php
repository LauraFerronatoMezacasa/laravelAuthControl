@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">{{ isset($role) ? 'Editar Tipo de Acesso' : 'Criar Novo Tipo de Acesso' }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store') }}" method="POST">
                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="name">Nome do Tipo de Acesso</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="permissions">Permissões</label>
                                <div>
                                    <input type="checkbox" id="select_all_permissions" class="form-check-input">
                                    <label for="select_all_permissions" class="form-check-label">Selecionar Todas</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @foreach ($allPermissions->chunk($allPermissions->count() / 2) as $chunk)
                                    <div class="col-md-6">
                                        @foreach ($chunk as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" 
                                                data-description="{{ $permission->description }}"        
                                                {{ isset($role) && $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->description }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/custom_permissions.js') }}"></script>
@endsection
