<h1>{{ config('app.name') }}</h1>
<p>Merhaba {{ $users->name }},Kaydınız başırılı bir şekilde yapıldı..</p>
<p>Kaydınızı aktifleştirmek için <a href="{{ config('app.url') }}/User/Activate/{{ $users->activation }}">tıklayın</a>veya aşağıdaki bağlantıyı tarayıcınızda açın.</p>
<p>Kaydınızı aktifleştirmek için <a href="{{ config('app.url') }}/User/Activate/{{ $users->activation }}">tıklayın</a>