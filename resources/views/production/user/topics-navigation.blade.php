<ol class="topics">
	@foreach ($navbar_topics as $topic)
		<li>
			<a href="{!! url('/courses/'.$courseAlias.'/topics/'.$topic['alias']); !!}">{{ $topic['name'] }}</a>
			<ol class="pages">
				@foreach ($topic['pages'] as $page)
					<li><a href="{!! url('/courses/'.$courseAlias.'/topics/'.$topic['alias'].'/'.$page['number']); !!}">{{ $page['name'] }}</a></li>
				@endforeach
			</ol>
		</li>
	@endforeach
</ol>