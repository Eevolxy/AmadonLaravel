<x-mail::message>
# Nouveau message de contact

**De :** {{ $contact->name }} ({{ $contact->email }})

**Sujet :** {{ $contact->subject }}

---

{{ $contact->message }}

---

*Ce message a été envoyé depuis le formulaire de contact d'Amadon.*
</x-mail::message>
