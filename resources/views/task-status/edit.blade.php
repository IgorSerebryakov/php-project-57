{{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
    {{ html()->submit('Обновить') }}
{{ html()->closeModelForm() }}
