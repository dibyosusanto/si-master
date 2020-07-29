<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcements;

class AnnouncementsController extends Controller
{
    public function tampil_pengumuman()
    {
        $announcements = Announcements::where('publish', 1)->get();
        return view('pengumuman', compact('announcements'));
    }
    
    public function detail_pengumuman($id_announcement)
    {
        # code...
    }
}
