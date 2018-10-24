<yml_catalog date="{{ \Carbon\Carbon::now()->toDateTimeString() }}">
    <shop>
        <name>{{ config('app.name') }}</name>
        <company>{{ config('app.name') }}</company>
        <url>{{ url('/') }}</url>
        <email>bukin@inetstudio.ru</email>
        <categories>
            @foreach ($categories as $category)
                <category id="{{ $category['id'] }}" {!! $category['parent_id'] ? 'parentId="'.$category['parent_id'].'"' : '' !!}>{{ $category['title'] }}</category>
            @endforeach
        </categories>
        <offers>
            @foreach ($materials as $material)
                <offer id="{{ $material['id'] }}" available="{{ $material['available'] }}">
                    <categories>
                        @foreach ($material['categories'] as $categoryID)
                            <categoryId>{{ $categoryID }}</categoryId>
                        @endforeach
                    </categories>
                    <url>{{ $material['url'] }}</url>
                    <picture>{{ $material['picture'] }}</picture>
                    <name>{{ $material['name'] }}</name>
                    <description>{{ $material['description'] }}</description>
                    <param name="tags">{{ $material['tags'] }}</param>
                    <param name="type">{{ $material['type'] }}</param>
                </offer>
            @endforeach
        </offers>
    </shop>
</yml_catalog>
