<yml_catalog date="{{ \Carbon\Carbon::now()->toDateTimeString() }}">
    <shop>
        <name>{{ config('app.name') }}</name>
        <company>{{ config('app.name') }}</company>
        <url>{{ url('/') }}</url>
        <email>bukin@inetstudio.ru</email>
        <offers>
            @foreach ($quizzes as $quiz)
                <offer id="{{ $quiz['id'] }}" available="true">
                    <picture>{{ $quiz['img']['src'] }}</picture>
                    <name>{{ $quiz['title'] }}</name>
                    <description><![CDATA[{!! $quiz['description'] !!}]]></description>
                </offer>
                @foreach ($quiz['results'] as $result)
                    <offer id="{{ $result['id'] }}" group_id="{{ $quiz['id'] }}" available="true">
                        <picture>{{ $result['img']['src'] }}</picture>
                        <name>{{ $result['title'] }}</name>
                        <description><![CDATA[{!! $result['result'] !!}]]></description>
                    </offer>
                @endforeach
            @endforeach
        </offers>
    </shop>
</yml_catalog>
