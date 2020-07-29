<div class="my-4">
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nama Masjid</th>
                    <th>Alamat</th>
                    <th>No Rekening</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($masjids as $masjid)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $masjid->nama_masjid}}</td>
                    <td>{{ $masjid->alamat }}</td>
                    <td>{{ $masjid->no_rekening }}</td>
                    <td class="text-center">
                        <a href="{{ route('jamaah_web.detail_masjid', $masjid->id_masjid) }}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>