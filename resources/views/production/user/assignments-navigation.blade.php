<ul class="tasks">
	@foreach ($assignmentQuestions as $question)
		<li>
			<a href="#question-{{ $question['number'] }}">Question #{{ $question['number'] }}</a>
		</li>
	@endforeach
</ul>