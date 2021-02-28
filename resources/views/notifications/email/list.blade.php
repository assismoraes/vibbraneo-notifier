<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Sender name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Sent</th>
            <th scope="col">Sent at</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($emailNotifications as $not)
        <tr data-toggle="collapse" href="#collapse{{ $not->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
            <td>{{ $not->sender_name }}</td>
            <td>{{ $not->email }}</td>
            <td>{{ $not->sent ? 'Yes' : 'No' }}</td>
            <td>{{ !empty($not->sent_at) ? $not->sent_at->format('d/m/Y \a\t H:i:s') : '' }}</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="notification-details" >
                <div  class="collapse" id="collapse{{ $not->id }}">
                    <ul class="list-group">
                        <li class="list-group-item">Channel: <b>E-mail</b></li>
                        <li class="list-group-item">Sent at: <b>{{ !empty($not->sent_at) ? $not->sent_at->format('d/m/Y \a\t H:i:s') : 'N/A' }}</b></li>
                        <li class="list-group-item">Delivered at: <b>N/A</b></li>
                        <li class="list-group-item">Content: <b>{!! $not->content !!}</b></li>
                      </ul>
                </div>
            </td>
        </tr>
        
        @endforeach
        @if ($emailNotifications->count() == 0)
        <tr>
            <td>No notification found</td>
        </tr>
        @endif
    </tbody>
</table>

<ul class="pagination pagination-sm justify-content-center">
    {{ $emailNotifications->appends(['channel' => Request::get('channel')])->links() }}
</ul>