<div class="fitur komunitas px-4 py-2">
  <div class="mb-2">
    <form class="w-100 d-flex"
      action="{{ Auth::user()->is_admin === 'yes' ? route('adminCommunity') : route('community') }}" method="POST">
      @csrf
      <input type="text" class="textKomunitas w-100 me-2 rounded-2" id="content" name="content"
        placeholder="Ceritakan hari-harimu!" />
      <button type="submit" class="btn btn-primary rounded-5">
        <i class="fas fa-location-arrow"></i>
      </button>
    </form>
  </div>
  <div id="postContainerKomunitas" class="overflow-y-auto" style="height: 60vh">
    @if ($posts->isEmpty())
    <div class="d-flex justify-content-center">
      <p class="text-secondary">Belum ada postingan yang diunggah</p>
    </div>
  @else
  @foreach ($posts as $post)
    <div class="bg-white p-2 mt-2 me-1 shadow-sm">
    <div class="d-flex">
    <img src="{{ asset('images/profiles/' . $post->account->picture) }}" class="rounded-5 me-2"
      style="height: 20px; width: 20px; object-fit: cover;" />
    <h6>{{$post->account->username}}</h6>
    </div>
    <div class="">
    <p>{{$post->content}}</p>
    </div>
    <div class="mb-3 text-secondary">
    </div>
    <form action="{{ route('favorite', $post->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-transparent">
      @if ($post->is_favorite)
      <i class="text-warning fs-5 fas fa-star"></i>
    @else
      <i class="fs-5 far fa-star"></i>
    @endif
    </button>
    <span>{{$post->likes}}</span>
    </form>
    <button class="btn btn-transparent" onclick="toggleCommentPanel({{ $post->id }})">
    <i class="fs-5 ms-2 far fa-comment"></i>
    </button>
    <span>{{$post->comments}}</span>
    <br>
    <div class="w-100 d-flex justify-content-between">
    <span class="text-secondary ">{{$post->created_at}}</span>
    @if ($post->account->username == Auth::user()->username)
    <span>
      <form method="POST" style="display:inline;"
      action="{{ Auth::user()->is_admin === 'yes' ? route('adminCommunityDelete', $post->id) : route('communityDelete', $post->id) }}">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-transparent"
      onclick="return confirm('Apakah anda yakin ingin menghapus unggahan ini?')" style="height:30px;">
      <i class="far fa-trash-alt"></i>
      </button>
      </form>
    </span>
  @endif
    </div>
    <div id="comment-panel-{{ $post->id }}" class="comment-panel bg-light mt-2 p-2" style="display: none;">
    <form action="{{ route('comment', $post->id) }}" method="POST" class="d-flex">
      @csrf
      <input type="text" id="reply" name="reply" placeholder="Balas di komentar!" class="w-100 me-2"required></input>
      <button type="submit" class="btn btn-primary rounded-5" style="">
      <i class="fs-6 fas fa-location-arrow"></i>
      </button>
    </form>
    @foreach ($post->comments()->get() as $comment)
    <div class="d-flex mt-3">
      <img src="{{ asset('images/profiles/' . $comment->account->picture) }}" class="rounded-5 me-2"
      style="height: 20px; width: 20px; object-fit: cover;" />
      <h6>{{$comment->account->username}}</h6>
    </div>
    <div class="">
      <span>{{$comment->reply}}</span>
    </div>
    @if ($comment->account->id == Auth::id())
    <form action="{{ route('commentDestroy', $comment->id) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-transparent mb-2"
      onclick="return confirm('Apakah anda yakin ingin menghapus komen ini?')" style="width:10px;">
      <i class="far fa-trash-alt"></i>
      </button>
    </form>
    @endif
  @endforeach
    </div>
    </div>

  @endforeach
@endif
  </div>
</div>
<script>
  function toggleCommentPanel(postId) {
    var panel = document.getElementById('comment-panel-' + postId);
    if (panel.style.display === 'none') {
      panel.style.display = 'block';
    } else {
      panel.style.display = 'none';
    }
  }
</script>