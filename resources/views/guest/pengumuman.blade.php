<div class="m-2">
    <p class="font-weight-bold"><i class="fas fa-bullhorn"></i> Berita Terkini</p>
</div>
@foreach($announcements as $announcement)
<div class="card mt-3 mb-3">
    <div class="card-header bg-light text-dark">
        <h3>{{ $announcement->judul }}</h3>
    </div>
    <div class="card-body">
        {!! strip_tags(substr($announcement->isi, 0, 100))  !!} ...
        <p class="text-right"><a href="{{ route('index.detail_pengumuman', $announcement->id_announcement) }}" class="btn btn-primary">Selengkapnya</a></p>
    </div>
</div>
@endforeach
<nav>
<ul class="pagination justify-content-end"> <span style="color: #ff0000;"></span>
    <li class="page-item">
        {{ $announcements->links() }}
    </li>    
</ul>
</nav>