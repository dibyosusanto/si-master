@extends('admin.master')
@section('content')
    <div class="my-4">
        <select name="masjid" class="masjid" id="masjid_id">
            <option value="" disabled selected>--PIlih--</option>
            @foreach($masjids as $masjid)
                <option value="{{ $masjid->id_masjid }}"> {{ $masjid->nama_masjid }} </option>
            @endforeach
        </select>
        <select name="jamaah" class="jamaah" id="jamaah_id">
            <option value="" disabled selected>--Pilih Jamaah--</option>
        </select>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change', '.masjid', function(){
                var m_id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('findJamaahName')!!}',
                    data:{'id_masjid':m_id},
                    success:function(){
                        console.log('success');
                        console.log(data);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>
        
@endsection