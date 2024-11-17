<button type="button" class="btn-close" data-bs-dismiss="modal"
        aria-label="Close"></button>
<div class="date py-4">
                                                    <span
                                                        class="line"></span> {{date('d F Y', strtotime($comment->created_at))}}
    <span class="line"></span>
</div>
<div class="user">
    <img src="{{get_file($comment->user->image ?? '')}}" alt="">
    <div class="user-info">
        <p class="name"> {{$comment->user->name ?? ''}} </p>
        <p class="phone"> {{$comment->user->phone_code ?? ''}}  {{$comment->user->phone ?? ''}} </p>
    </div>
</div>
<p class="text">{{$comment->comment}}</p>
<div class="date py-4">
                                                    <span
                                                        class="line"></span> {{date('d F Y', strtotime($comment->updated_at))}}
    <span class="line"></span>
</div>
<div class="user justify-content-end pe-5">
    <img src="{{get_file($comment->ad->brand->image ?? '')}}" alt="">
    <div class="user-info">
        <p class="name"> {{$comment->ad->brand->name ?? ''}} </p>
        <p class="phone"> {{$comment->ad->brand->phone_code ?? ''}}  {{$comment->ad->brand->phone ?? ''}} </p>
    </div>
</div>
<p class="text">{{$comment->reply}}</p>
