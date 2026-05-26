@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <main class="min-h-[calc(100vh-68px)] bg-[radial-gradient(circle_at_top,_rgba(34,211,238,0.16),_transparent_30%),linear-gradient(180deg,_#f8fafc_0%,_#e2e8f0_100%)] px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-6xl items-start gap-10 lg:grid-cols-[1fr_1fr]">
            {{-- Info Panel --}}
            <section class="rounded-[2rem] bg-slate-900 p-10 text-white shadow-2xl ring-1 ring-white/10">
                <div class="max-w-md space-y-6">
                    <span class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-4 py-1 text-sm font-semibold text-cyan-300 ring-1 ring-cyan-300/20">
                        <i class="fa-solid fa-paper-plane"></i>
                        Contacte-nous
                    </span>
                    <h1 class="text-4xl font-black leading-tight">
                        Une question ? On est là pour t'aider.
                    </h1>
                    <p class="text-base leading-7 text-slate-300">
                        Remplis le formulaire et notre équipe te répondra dans les plus brefs délais. Tu peux aussi nous écrire directement par email.
                    </p>
                    <div class="grid gap-4 pt-4 text-sm text-slate-200">
                        <div class="flex items-start gap-3 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                            <i class="fa-solid fa-envelope mt-1 text-cyan-300"></i>
                            <div>
                                <p class="font-semibold text-white">Email</p>
                                <p class="text-slate-300">contact@amadon.fr</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                            <i class="fa-solid fa-clock mt-1 text-cyan-300"></i>
                            <div>
                                <p class="font-semibold text-white">Réponse rapide</p>
                                <p class="text-slate-300">Nous répondons sous 24h en moyenne.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Contact Form --}}
            <section class="rounded-[2rem] bg-white/80 p-6 shadow-xl ring-1 ring-slate-200/80 backdrop-blur sm:p-8 lg:p-10">
                <div class="mb-8 space-y-2">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">Formulaire</p>
                    <h2 class="text-3xl font-black text-slate-900">Envoie-nous un message</h2>
                </div>

                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 text-center font-semibold">
                        <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
                    </div>
                @endif

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

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-slate-700">Nom</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ton nom"
                                   class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-slate-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ton@email.com"
                                   class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-semibold text-slate-700">Sujet</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="De quoi veux-tu nous parler ?"
                               class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100">
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-semibold text-slate-700">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Ton message..."
                                  class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 resize-none">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-900 px-5 py-3.5 text-sm font-bold text-white transition duration-200 hover:-translate-y-0.5 hover:bg-cyan-600 focus:outline-none focus:ring-4 focus:ring-cyan-200 cursor-pointer">
                        <i class="fa-solid fa-paper-plane"></i>
                        Envoyer le message
                    </button>
                </form>
            </section>
        </div>
    </main>
@endsection
