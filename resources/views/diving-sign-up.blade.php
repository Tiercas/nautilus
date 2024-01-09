<x-layout>
  <a href='/signup/DS2'>Click</a>

  @if (Session::has('Success'))
   <div class="alert alert-info">{{ Session::get('Success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</x-layout>