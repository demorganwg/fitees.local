<div class="navbar">
	<ul class="topics">
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
	</ul>
</div>
<style>
	.navbar {
		height: 100%;
		min-height: 1000px;
		border-right: 1px solid #b3e5fc;
		padding-top: 50px;
	}
	.navbar .topics {
/*		margin-top: 50px;*/
		list-style-type: none;
	}
	.navbar .topics li {
		margin-top: 10px;
		font-size: 20px;
	}
	.navbar .topics li a {
		text-decoration: none;
	}
	.navbar .pages li {
		font-size: 16px;
	}
</style>