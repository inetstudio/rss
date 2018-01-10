{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}
<rss
	xmlns:yandex="http://news.yandex.ru"
	xmlns:media="http://search.yahoo.com/mrss/"<?php foreach($namespaces as $n) echo " ".$n; ?>
	xmlns:turbo="http://turbo.yandex.ru"
	version="2.0"
>
	<channel>
		<title>{!! $channel['title'] !!}</title>
		<link>{{ $channel['rssLink'] }}</link>
		<description>{!! $channel['description'] !!}></description>
		<language>{{ $channel['lang'] }}</language>

		@foreach($items as $item)
		<item turbo="true">
			<link>{{ $item['link'] }}</link>
			<author>{!! $item['author'] !!}</author>
			<turbo:topic>{!! $item['title'] !!}></turbo:topic>

			@if (!empty($item['category']))
			<category>{{ $item['category'] }}</category>
			@endif

			<pubDate>{{ $item['pubdate'] }}</pubDate>

			@if (!empty($item['content']))
				<turbo:content><![CDATA[{!! $item['content'] !!}]]></turbo:content>
			@endif
		</item>
		@endforeach
	</channel>
</rss>
