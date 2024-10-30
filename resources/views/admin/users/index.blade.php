@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gerenciar Usuários</h2>
        @if (auth()->user()->hasPermission('create_users'))
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Adicionar Usuário
            </a>
        @endif
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3 d-flex justify-content-end align-items-center">
        <label for="per_page" class="mr-2">Registros por página:</label>
        <select name="per_page" id="per_page" class="form-control w-auto shadow-sm" style="border-radius: 5px; margin-left: 10px;" onchange="this.form.submit()">
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
        </select>
    </form>

    <div class="table-responsive shadow mb-4" style="border-radius: 10px;">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    @if ((auth()->user()->hasPermission('modify_users') || auth()->user()->hasPermission('delete_users')))
                        <th>Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        @if ((auth()->user()->hasPermission('modify_users') || auth()->user()->hasPermission('delete_users')))
                            <td class="d-flex">
                                @if (auth()->user()->hasPermission('modify_users') && (!($user->id == 1 || $user->id == auth()->user()->id )))
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary mr-2" title="Editar" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif

                                @if (auth()->user()->hasPermission('delete_users') && (!($user->id == 1 || $user->id == auth()->user()->id )))
                                    <button type="button" class="btn btn-sm btn-danger" title="Excluir" onclick="confirmDelete({{ $user->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            Mostrando {{ $users->count() }} de {{ $users->total() }} registros
        </div>
        <div>
            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex align-items-center">
                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                <label for="page" class="mr-2">Ir para a página:</label>
                <input type="number" name="page" id="page" min="1" max="{{ $users->lastPage() }}" value="{{ request('page', $users->currentPage()) }}" class="form-control w-auto mr-2" required>
                <button type="submit" class="btn btn-primary">Ir</button>
            </form>
        </div>
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->url(1) }}&per_page={{ request('per_page', 10) }}" aria-label="Primeira">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}&per_page={{ request('per_page', 10) }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}&per_page={{ request('per_page', 10) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}&per_page={{ request('per_page', 10) }}" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $users->url($users->lastPage()) }}&per_page={{ request('per_page', 10) }}" aria-label="Última">
                        <span aria-hidden="true">&raquo;&raquo;</span> 
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    @include('components.status-messages')
</div>
@endsection
