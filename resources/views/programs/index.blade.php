<h1>Programs</h1>
<a href="{{ route('programs.edit') }}">Create Program</a>
<ul>
    @foreach ($programs as $program)
        <li>
            <a href="{{ route('programs.show', $program) }}">{{ $program->name }}</a>
            <a href="{{ route('programs.edit', $program->id) }}">Edit</a>
            <form action="{{ route('programs.destroy', $program) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
