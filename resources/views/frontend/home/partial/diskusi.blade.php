@if ($message->count() > 0)
    @foreach ($message as $value)
        @if ($value->user_id != auth()->user()->id)
        <div class="rows">
            <div class="col-2 col-sm-1 col-md-1">
                <img src="{{ ($value->user->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->user->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="chat-pic rounded-circle" alt="" srcset="">
            </div>
            <div class="col-6 col-sm-6 col-md-6">
                <p class="recive">{{ $value->message }}
                <span class="time float-right" title="">{{ $value->waktu }}</span>
                </p>
            </div>
        </div>
        @else
            <div class="rows justify-content-end">
                <div class="col-6 col-sm-6 col-md-6" style="text-align: end">
                    <p class="reciver">{{ $value->message }}
                        <span class="time float-right" title="">{{ $value->waktu }}</span>
                    </p>
                </div>
                <div class="col-2 col-sm-1 col-md-1">
                    <img src="{{ ($value->user->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->user->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="chat-pic rounded-circle" alt="" srcset="">
                </div>
            </div>
        @endif
    @endforeach
@endif