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
        @if (Auth::check())
        <th style="text-align: center;">watch</th>
        @endif
        <th style="text-align: center;">Number of watcher</th>
        <th style="text-align: center;">Created at</th>
    </tr>

    @foreach($repository_list as $item)
    <tr>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->repository_name }}</td>
        @if (Auth::check())
            <td><input type="checkbox" name="watcher" class="watcherCheckbox " data-repository-id={{ $item->id }}
                    {{ $item->is_watching ? 'checked' : '' }}></td>
        @endif
        <td>{{ $item->watchers_count }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>
    @endforeach
</table>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.watcherCheckbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', async function () {
                try {
                    let isChecked = this.checked;
                    let repositoryId = this.getAttribute('data-repository-id');
                    let url = "{{ url('watcher/update') }}";
                    let csrfToken = '{{ csrf_token() }}';

                    let response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            repository_id: repositoryId,
                            watcher: isChecked,
                        }),
                    });
                    console.log(response);
                } catch (error) {
                    console.error('Unexpected error:', error);
                }
                finally{
                    window.location.reload();
                }
            });
        });
    });

</script>

@endsection
@section('styles')
