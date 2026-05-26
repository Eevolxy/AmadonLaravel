@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@push('styles')
<style>
    .auth-page-centered {
        min-height: calc(100vh - 68px - 73px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
        position: relative;
    }

    .auth-page-centered::before {
        content: '';
        position: absolute;
        top: -20%;
        left: 50%;
        transform: translateX(-50%);
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(34,211,238,0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .auth-card-single {
        background: var(--site-surface);
        border: 1px solid var(--site-border);
        border-radius: 24px;
        padding: 2.5rem;
        max-width: 460px;
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .auth-icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin: 0 auto 1.25rem;
    }

    .auth-icon-circle.cyan {
        background: var(--site-accent-soft);
        color: var(--site-accent);
    }

    .auth-card-single .auth-title {
        font-size: 1.5rem;
        font-weight: 900;
        color: white;
        text-align: center;
        letter-spacing: -0.02em;
        margin-bottom: 0.4rem;
    }

    .auth-card-single .auth-subtitle {
        font-size: 0.82rem;
        color: var(--site-text-muted);
        text-align: center;
        line-height: 1.6;
    }

    .auth-status-success {
        background: rgba(52,211,153,0.08);
        border: 1px solid rgba(52,211,153,0.2);
        border-radius: 14px;
        padding: 0.75rem 1rem;
        margin-top: 1.25rem;
        font-size: 0.82rem;
        color: #34d399;
        font-weight: 600;
        text-align: center;
    }

    .auth-error {
        background: rgba(248, 113, 113, 0.08);
        border: 1px solid rgba(248, 113, 113, 0.2);
        border-radius: 14px;
        padding: 0.75rem 1rem;
        margin-top: 1.25rem;
        font-size: 0.82rem;
        color: #f87171;
    }

    .auth-error ul { margin: 0.4rem 0 0; padding-left: 1rem; }

    .auth-form { display: flex; flex-direction: column; gap: 1.25rem; margin-top: 1.5rem; }

    .auth-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--site-text);
        margin-bottom: 0.4rem;
    }

    .auth-field input {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 12px;
        border: 1px solid var(--site-border);
        background: rgba(148, 163, 184, 0.05);
        color: var(--site-text);
        font-size: 0.85rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .auth-field input::placeholder { color: #475569; }
    .auth-field input:focus {
        border-color: var(--site-accent);
        box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.1);
    }

    .auth-submit {
        width: 100%;
        padding: 0.75rem;
        border-radius: 14px;
        border: none;
        background: linear-gradient(135deg, #06b6d4, #0ea5e9);
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .auth-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(6, 182, 212, 0.3);
    }

    .auth-footer-text {
        text-align: center;
        font-size: 0.82rem;
        color: var(--site-text-muted);
        margin-top: 1.5rem;
    }

    .auth-footer-text a {
        color: var(--site-accent);
        font-weight: 600;
    }

    .auth-footer-text a:hover { color: white; }
</style>
@endpush

@section('content')
    <div class="auth-page-centered">
        <div class="auth-card-single">
            <div class="auth-icon-circle cyan">
                <i class="fa-solid fa-key"></i>
            </div>
            <h2 class="auth-title">Mot de passe oublié ?</h2>
            <p class="auth-subtitle">Pas de panique ! Indique ton adresse email ci-dessous et nous t'enverrons un lien pour réinitialiser ton mot de passe.</p>

            @if (session('status'))
                <div class="auth-status-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="auth-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf

                <div class="auth-field">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ton@email.com" required>
                </div>

                <button type="submit" class="auth-submit">
                    <i class="fa-solid fa-paper-plane"></i>
                    Envoyer le lien de réinitialisation
                </button>
            </form>

            <p class="auth-footer-text">
                Tu t'en souviens finalement ?
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </p>
        </div>
    </div>
@endsection
