<h1>Список статусов</h1>
@foreach($taskStatuses as $status)
    <h2>{{ $status->name }}</h2>
    {{ html()->modelForm($status, 'DELETE', route('task_statuses.destroy', $status))->open() }}
    {{ html()->submit('Удалить') }}
    {{ html()->closeModelForm() }}
@endforeach
