@extends("Vigilante_layout.index")
@section("vigilante_template")

<div class="container-fluid px-4">
    <h1 class="mt-4">Meu perfil</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Altere seus dados
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('vigilante_perfil_alterar') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $vigilante->name }}">
                        <label for="name">Nome</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="vigia_celular" id="vigia_celular"
                            value="{{ $vigilante->vigia_celular }}">
                        <label for="vigia_celular">Celular</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="email" id="email"
                            value="{{ $vigilante->email }}" disabled>
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password">
                        <label for="password">Nova Senha (se não quiser alterar, deixe em branco)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        <label for="password_confirmation">Confirme a Nova Senha</label>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
