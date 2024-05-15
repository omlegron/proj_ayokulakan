@foreach($record as $items)
<li class="bg-dark lapaks-show" style="padding: 10px 5px; border:1px solid black;">
    <a href="javascript:void(0)" class="add-low button" data-id="{{ $items->id }}" data-titlemodal="{{ $titleModal or '' }}" style="display: flex; width: 100%">
        <img src="{{ ($items->attachments) ? imgExist(url('storage/'.$items->attachments->url)) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
        <p style="line-height: 50px; padding-left: 10px">{{ $items->sub_nama }}</p>
    </a>
</li>
@endforeach