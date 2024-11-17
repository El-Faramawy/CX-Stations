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
<p class="text">{{$comment->comment ?? ''}}</p>
<form class="repaly" action="{{route('brand.add_comment_reply')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$comment->id}}">
    <textarea rows="5"
              class="form-control shadow-none border-0 bg-transparent"
              name="reply"
              placeholder="{{ __('messages.type_a_message') }}"></textarea>
    <div
        class="d-flex align-items-center justify-content-between border-top pt-2 px-3 pb-0">
        <a href="#" class="avtar avtar-xs btn-link-secondary">
            {{-- <i class="fa-regular fa-paperclip f-18"></i> --}}
        </a>
        <button type="submit" class="py-2 rounded btn btnMain">
            {{ __('messages.send') }}
            <i class="fa-regular fa-solid fa-paper-plane f-18"></i>
        </button>
    </div>
</form>
