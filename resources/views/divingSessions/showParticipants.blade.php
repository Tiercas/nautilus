@foreach($users as $user)   
<p>{{$user->US_NAME}} {{$user->US_FIRST_NAME}}</p>
@endforeach

<x-button>
    <a href="/dives">Retour à la séance</a>
</x-button>