@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
    <main class="min-h-[calc(100vh-68px)] bg-[radial-gradient(circle_at_top,_rgba(34,211,238,0.16),_transparent_30%),linear-gradient(180deg,_#f8fafc_0%,_#e2e8f0_100%)] px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-6xl items-center gap-10 lg:grid-cols-[1.1fr_0.9fr]">
            <section class="hidden rounded-[2rem] bg-slate-900 p-10 text-white shadow-2xl ring-1 ring-white/10 lg:block">
                <div class="max-w-md space-y-6">
                    <span class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-4 py-1 text-sm font-semibold text-cyan-300 ring-1 ring-cyan-300/20">
                        <i class="fa-solid fa-sparkles"></i>
                        Rejoins la marketplace
                    </span>
                    <h1 class="text-4xl font-black leading-tight">
                        Crée ton compte et commence à vendre rapidement.
                    </h1>
                    <p class="text-base leading-7 text-slate-300">
                        Gère tes produits, suis tes commandes et construis une boutique avec une interface plus propre et plus lisible.
                    </p>
                    <div class="grid gap-4 pt-4 text-sm text-slate-200">
                        <div class="flex items-start gap-3 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                            <i class="fa-solid fa-bolt mt-1 text-cyan-300"></i>
                            <div>
                                <p class="font-semibold text-white">Mise en route rapide</p>
                                <p class="text-slate-300">Inscription simple avec accès direct aux fonctionnalités de la marketplace.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                            <i class="fa-solid fa-shield-halved mt-1 text-cyan-300"></i>
                            <div>
                                <p class="font-semibold text-white">Espace sécurisé</p>
                                <p class="text-slate-300">Ton compte est protégé par des mesures de sécurité avancées.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] bg-white/80 p-6 shadow-xl ring-1 ring-slate-200/80 backdrop-blur sm:p-8 lg:p-10">
                <div class="mb-8 space-y-2">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">Inscription</p>
                    <h2 class="text-3xl font-black text-slate-900">Créer un compte</h2>
                    <p class="text-sm leading-6 text-slate-600">
                        Renseigne tes informations pour accéder à ton espace Amadon.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <p class="font-semibold">Le formulaire contient des erreurs.</p>
                        <ul class="mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700">Nom d'utilisateur</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Ton nom d'utilisateur"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-slate-700">Adresse email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="ton@email.com"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                        >
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-3">
                            <label for="password" class="block text-sm font-semibold text-slate-700">Mot de passe</label>
                            <span class="text-xs text-slate-400">8 caractères minimum recommandé</span>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Choisis un mot de passe solide"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                        >
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-3">
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirmer le mot de passe</label>
                        </div>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirme le mot de passe"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                        >
                    </div>

                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-900 px-5 py-3.5 text-sm font-bold text-white transition duration-200 hover:-translate-y-0.5 hover:bg-cyan-600 focus:outline-none focus:ring-4 focus:ring-cyan-200"
                    >
                        <i class="fa-solid fa-user-plus"></i>
                        Créer mon compte
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="font-semibold text-cyan-700 transition hover:text-cyan-500">
                        Connecte-toi ici
                    </a>
                </p>
            </section>
        </div>
    </main>
@endsection
