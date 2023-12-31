@extends('layouts.welcome_app')
@section('contents')

{{-- Sort the list --}}
<div class="sorting-menu">
    <span>Sort by:</span>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'alphabetical' ? 'active' : '' }}"
                href="{{ url('/allrepo?sort=alphabetical') }}">Alphabetical |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'latest' ? 'active' : '' }}"
                href="{{ url('/allrepo?sort=latest') }}">Latest |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'watchers' ? 'active' : '' }}"
                href="{{ url('/allrepo?sort=watchers') }}">Number of Watchers |</a>
        </li>
    </ul>
</div>
<table class="table table-content" style="text-align: center;">
    <tr>
        <th style="text-align: center;">User name</th>
        <th style="text-align: center;">Repository Name</th>
        <th style="text-align: center;">watch</th>
        <th style="text-align: center;">Number of watcher</th>
        <th style="text-align: center;">Created at</th>
    </tr>

    @foreach($repository_list as $item)
    <tr>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->repository_name }}</td>
        {{-- <td style="width:10px;">
                    <input type="hidden" name="watcher_checkbox[{{ $item->id }}]" value="0">
        <input type="checkbox" name="watcher_checkbox[{{ $item->id }}]" value="1"
            {{ $item->is_watched ? 'checked' : '' }}>
        </td> --}}
        <td><input type="checkbox" name="watcher" class="watcherCheckbox " data-repository-id={{ $item->id }}
                {{ $item->is_watching ? 'checked' : '' }}></td>
        <td>{{ $item->number_of_watcher }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>
    @endforeach
</table>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.watcherCheckbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                let isChecked = this.checked;
                let repositoryId = this.getAttribute('data-repository-id');
                let url = "{{ url('watcher/update') }}";
                let csrfToken = '{{ csrf_token() }}';
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        repository_id: repositoryId,
                        watcher: isChecked,
                    }),
                })
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then(data => console.log(data))
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>

@endsection
@section('styles')
