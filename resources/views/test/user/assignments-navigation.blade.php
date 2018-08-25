<div class="navbar">
	<ul class="tasks">
		@foreach ($assignmentQuestions as $question)
			<li>
				<a href="#question-{{ $question['number'] }}">Question #{{ $question['number'] }}</a>
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
	.navbar .tasks {
/*		margin-top: 50px;*/
		list-style-type: none;
	}
	.navbar .tasks li {
		margin-top: 10px;
		font-size: 20px;
	}
	.navbar .tasks li a {
		text-decoration: none;
	}
</style>