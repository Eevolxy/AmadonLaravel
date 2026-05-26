@extends('layouts.app')

@section('title', 'Vérification d\'email')

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

    .auth-form { display: flex; flex-direction: column; gap: 1.25rem; margin-top: 1.5rem; }

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
</style>
@endpush

@section('content')
    <div class="auth-page-centered">
        <div class="auth-card-single">
            <div class="auth-icon-circle cyan">
                <i class="fa-regular fa-envelope-open"></i>
            </div>
            <h2 class="auth-title">Vérifie ton adresse email</h2>
            <p class="auth-subtitle">Merci de t'être inscrit ! Avant de commencer, pourrais-tu vérifier ton adresse email en cliquant sur le lien que nous venons de t'envoyer ? Si tu ne l'as pas reçu, nous pouvons t'en envoyer un autre.</p>

            @if (session('message'))
                <div class="auth-status-success">{{ session('message') }}</div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="auth-form">
                @csrf
                <button type="submit" class="auth-submit">
                    <i class="fa-solid fa-paper-plane"></i>
                    Renvoyer l'email de vérification
                </button>
            </form>
        </div>
    </div>
@endsection
