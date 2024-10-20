@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center home-blade">
    <div class="text-center text-white">
        <h1 class="display-4 mb-4">Olá, {{ auth()->user()->name }}! Como você está se sentindo hoje?</h1>
        <div class="mt-5">
            <button class="btn btn-light btn-lg me-3" onclick="showAlert('Que bom que você está bem!', 'Continue assim e espalhe boas vibrações!', 'success', false, 'Ok')">
                <i class="bi bi-emoji-smile"></i> Bem
            </button>
            <button class="btn btn-light btn-lg" onclick="showAlert('Sinto muito em saber que você não está bem.', 'É normal não se sentir bem às vezes. Respire fundo e saiba que você não está sozinho nessa!', 'info', false, 'Ok')">
                <i class="bi bi-emoji-frown"></i> Mal
            </button>
        </div>
    </div>
</div>
@endsection
