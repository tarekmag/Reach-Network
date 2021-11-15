Hello, {{ $advertiserName }}

Your next Ad remainder
<hr>

@foreach ($ads as $row)
    <p>Title: {{ $row['title'] }}</p>
    <p>Description: {{ $row['description'] }}</p>
    <p>Start Date: {{ \Carbon\Carbon::parse($row['start_date'])->format(App\Enums\Define::DATE_FORMAT_12) }}</p>
    <p>Category: {{ $row['category']['name'] }}</p>
    <p>Tags: 

        <ul>
            @foreach ($row['tags'] as $tag)
            <li>{{ $tag['name'] }}</li>
            @endforeach
        </ul>

    </p>

    <hr>
@endforeach

Thanks,<br>
{{ config('app.name') }}