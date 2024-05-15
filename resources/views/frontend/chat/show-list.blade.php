@if ($record->count() > 0)
<li class="list-group-item" style="background-color: #f8f8f8">
    <input type="text" placeholder="Search Nerw Chat" class="form-control form-rounded">
</li>
    @foreach ($record as $key => $value)
        @if ($value->id != auth()->user()->id)
            <li class="list-group-item list-group-item-action" onclick="addchat({{ $value->id }})" data-dismiss="modal">
                <div class="rows">
                    <div class="col-md-2">
                        <img src="{{ ($value->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="profile-pic rounded-circle" alt="" srcset="">
                    </div>
                    <div class="col-md-10" style="cursor: pointer; padding: 10px">
                        <div class="name" style="">{{ $value->nama }}</div>
                    </div>
                </div>
            </li>
        @endif
    @endforeach
@endif