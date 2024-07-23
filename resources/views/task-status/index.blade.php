<h1>Список статусов</h1>
@foreach($taskStatuses as $status)
    <h2>{{ $status->name }}</h2>
@endforeach
