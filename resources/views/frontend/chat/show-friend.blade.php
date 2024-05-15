@if (isset($record))
    <li class="list-group-item" style="background-color: #f8f8f8">
        <input type="text" placeholder="Search Nerw Chat" class="form-control form-rounded">
    </li>
    @foreach ($record as $key => $value)
        @if ($value->friend_id === auth()->user()->id)
            <li class="list-group-item list-group-item-action startchat" data-key="{{ $value->id }}" data-nama="{{ $value->user->nama }}" data-id="{{ $value->user->id }}">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ ($value->user->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->user->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="profile-pic rounded-circle image-chat{{ $value->id }}" alt="" srcset="">
                    </div>
                    <div class="col-md-10" style="cursor: pointer">
                        <div class="name">{{ $value->user->nama }}</div>
                        <div class="under-name">
                            {{ ($value->chatFriend->sortByDesc('created_at')->first() ? $value->chatFriend->sortByDesc('created_at')->first()->message : 'This is some mesage text ...') }}
                        </div>
                    </div>
                </div>
            </li>
        @elseif($value->user_id === auth()->user()->id)
            <li class="list-group-item list-group-item-action startchat" data-key="{{ $value->id }}" data-nama="{{ $value->friend->nama }}" data-id="{{ $value->friend->id }}">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ ($value->friend->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->friend->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="profile-pic rounded-circle image-chat{{ $value->id }}" alt="" srcset="">
                    </div>
                    <div class="col-md-10" style="cursor: pointer">
                        <div class="name">{{ $value->friend->nama }}</div>
                        <div class="under-name">
                            {{ ($value->chatFriend->sortByDesc('created_at')->first() ? $value->chatFriend->sortByDesc('created_at')->first()->message : 'This is some mesage text ...') }}
                        </div>
                    </div>
                </div>
            </li>
        @endif
    @endforeach
@endif