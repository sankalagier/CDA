<x-mail::message>
# Nouvelle demande de contact

Une nouvelle demande de contact à été faite par :
- Nom & Prénom : {{ $data['name']}}
- Email : {{ $data['email']}}

**Message :**<br/>
{{ $data['message'] }}

</x-mail::message>
