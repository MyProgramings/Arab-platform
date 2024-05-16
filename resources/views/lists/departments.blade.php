@foreach ($departments as $department)
    <option value="{{ $department->id }}">{{ $department->name }}</option>
@endforeach