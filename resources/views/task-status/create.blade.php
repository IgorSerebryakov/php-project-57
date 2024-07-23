{{ html()->modelForm($taskStatus, 'POST', route('task-statuses.store'))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
    {{ html()->submit('Создать') }}
{{ html()->closeModelForm() }}
