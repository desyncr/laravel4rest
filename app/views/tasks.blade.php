@foreach($items as $item)
{{ $item['title']}} - {{ $item['completed'] ? 'Completed' : 'Incomplete' }} {{ PHP_EOL }}
@endforeach
