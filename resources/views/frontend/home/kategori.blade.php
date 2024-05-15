<ul id="seconds" style="">
    @foreach($record as $items)
    <li class="bg-dark lapaks-show" style="padding: 10px 5px;">
        <a href="{{ url('sc/cat-barang/mps/'.slugify($items->sub_nama)) }}" class="add-low button" data-id="{{ $items->id }}" style="display: flex; width: 100%">
            <img src="{{ ($items->attachments) ? url('storage/'.$items->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
            <p style="line-height: 50px; padding-left: 10px">{{ $items->sub_nama }}</p>
        </a>
    </li>
    @endforeach
</ul>