<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

use App\Models\Invite;
use App\Models\Story;
use App\Models\Thema;
use App\Models\Reservation;

use DB;
use Carbon\Carbon;

class InviteController extends Controller
{
    //public area
    public function index($nama){
        $dataUndangan = Invite::with('story', 'reservation')->where('url_invite', $nama)->First();
        $tema = Thema::where('id', $dataUndangan->tema_id)->First();
        return view($tema->url)->with('data', $dataUndangan);
    }

    public function reservasi(Request $request){
        $ucapan = new Reservation;
        $ucapan->invite_id = $request->get('invite_id');
        $ucapan->nama = $request->get('nama');
        $ucapan->no_wa = $request->get('no_wa');
        $ucapan->is_hadir = $request->get('is_hadir');
        $ucapan->ucapan_dan_doa = $request->get('ucapan_dan_doa');
        $ucapan->save();
        $ucapan->dateUcapan = $ucapan->created_at->diffForHumans();
        return $ucapan;
    }

    public function reservasiGet($id){
        $ucapan = DB::table('reservations')
        ->join('invites', 'reservations.invite_id', '=', 'invites.id')
        ->select('reservations.*')
        ->where('invites.url_invite', $id)
        ->get();
        
        foreach($ucapan as $ucp){
            $ucp->dateUcapan = Carbon::parse($ucp->created_at)->diffForHumans();
        }

        return $ucapan;
    }


    //admin area
    public function inputPage(){
        $themes = Thema::all();
        return view('input.input')->with("themes", $themes);
    }

    public function post(Request $request){
        $url_invite = $request->get("url_invite");
        if($url_invite != null){
            $invite = new Invite;
            $invite->url_invite = $url_invite;

            //spouse
            $invite->foto_header = $this->saveFoto($request, "foto_header", $url_invite, "bg", "images");
            $invite->foto_suami = $this->saveFoto($request, "foto_suami", $url_invite, "spouse", "images");
            $invite->foto_istri = $this->saveFoto($request, "foto_istri", $url_invite, "spouse", "images");
            
            //pepatah
            $invite->pepatah_foto = $this->saveFoto($request, "pepatah_foto", $url_invite, "bg", "images");
            $invite->pepatah_kata = $request->get("pepatah_kata");
            $invite->pepatah_author = $request->get("pepatah_author");

            //gallery
            $invite->galeri_top1 = $this->saveFoto($request, "galeri_top1", $url_invite, "gallery", "images");
            $invite->galeri_top2 = $this->saveFoto($request, "galeri_top2", $url_invite, "gallery", "images");
            $invite->galeri_top3 = $this->saveFoto($request, "galeri_top3", $url_invite, "gallery", "images");
            $invite->galeri_middle = $this->saveFoto($request, "galeri_middle", $url_invite, "gallery", "images");
            $invite->galeri_bottom1 = $this->saveFoto($request, "galeri_bottom1", $url_invite, "gallery", "images");
            $invite->galeri_bottom2 = $this->saveFoto($request, "galeri_bottom2", $url_invite, "gallery", "images");
            $invite->galeri_bottom3 = $this->saveFoto($request, "galeri_bottom3", $url_invite, "gallery", "images");
            $invite->galeri_bottom4 = $this->saveFoto($request, "galeri_bottom4", $url_invite, "gallery", "images");
            $invite->galeri_bottom5 = $this->saveFoto($request, "galeri_bottom5", $url_invite, "gallery", "images");
            $invite->galeri_bottom6 = $this->saveFoto($request, "galeri_bottom6", $url_invite, "gallery", "images");

            //media player
            $invite->video = $this->saveFoto($request, "video", $url_invite, "media", "video");
            $invite->music = $this->saveFoto($request, "music", $url_invite, "media", "music");
            
            $invite->tema_id = $request->get("tema_id");
            $invite->nama_suami = $request->get("nama_suami");
            $invite->putra_ke_suami = $request->get("putra_ke_suami");
            $invite->nama_panggilan_suami = $request->get("nama_panggilan_suami");
            $invite->nama_suami_initial = $request->get("nama_suami_initial");
            $invite->nama_istri = $request->get("nama_istri");
            $invite->putri_ke_istri = $request->get("putri_ke_istri");
            $invite->nama_panggilan_istri = $request->get("nama_panggilan_istri");
            $invite->nama_istri_initial = $request->get("nama_istri_initial");
            $invite->tanggal_nikah = $request->get("tanggal_nikah");
            $invite->kata_mutiara = $request->get("kata_mutiara");
            $invite->galeri_keterangan = $request->get("galeri_keterangan");

            $invite->nama_suami_ortu_bapak = $request->get("nama_suami_ortu_bapak");
            $invite->nama_suami_ortu_ibu = $request->get("nama_suami_ortu_ibu");
            $invite->nama_istri_ortu_bapak = $request->get("nama_istri_ortu_bapak");
            $invite->nama_istri_ortu_ibu = $request->get("nama_istri_ortu_ibu");

            $invite->jadwal_nikah_pembuka = $request->get("jadwal_nikah_pembuka");
            $invite->jadwal_nikah_isi = $request->get("jadwal_nikah_isi");
            $invite->jadwal_nikah_tanggal = $request->get("jadwal_nikah_tanggal");
            $invite->jadwal_nikah_waktu = $request->get("jadwal_nikah_waktu");
            $invite->jadwal_nikah_lokasi = $request->get("jadwal_nikah_lokasi");
            $invite->jadwal_nikah_lokasi_link = $request->get("jadwal_nikah_lokasi_link");
            $invite->jadwal_isi_bottom = $request->get("jadwal_isi_bottom");
            $invite->jadwal_penutup = $request->get("jadwal_penutup");

            $invite->save();

            //kisah cinta    
            // for($i=0; $i < 3; $i++){
            //     $story = new Story;
            //     $story->invite_id = $invite->id;
            //     $story->kisah_cinta_tahun = $request->get("kisah_cinta_tahun")[$i];
            //     $story->kisah_cinta_judul = $request->get("kisah_cinta_judul")[$i];
            //     $story->kisah_cinta_isi = $request->get("kisah_cinta_isi")[$i];
            //     $story->kisah_cinta_foto = $this->saveFotoIndex($request, "kisah_cinta_foto", $url_invite, "story", "images", $i);
            //     $story->save();
            // }
        }

        return redirect('/admin/list');
    }

    public function updatePage($id){
        $invite = Invite::with('story')->where('id', $id)->First();
        $themes = Thema::all();
        return view('input.input')->with("data", $invite)->with('themes', $themes);
    }

    public function update(Request $request){
        $invite = Invite::all()->where('id', $request->get('id'))->First();
        $url_invite = $invite->url_invite;
        $invite->tema_id = $request->get("tema_id");
        $invite->nama_suami = $request->get("nama_suami");
        $invite->putra_ke_suami = $request->get("putra_ke_suami");
        $invite->nama_panggilan_suami = $request->get("nama_panggilan_suami");
        $invite->nama_suami_initial = $request->get("nama_suami_initial");
        $invite->nama_istri = $request->get("nama_istri");
        $invite->putri_ke_istri = $request->get("putri_ke_istri");
        $invite->nama_panggilan_istri = $request->get("nama_panggilan_istri");
        $invite->nama_istri_initial = $request->get("nama_istri_initial");
        $invite->tanggal_nikah = $request->get("tanggal_nikah");
        $invite->kata_mutiara = $request->get("kata_mutiara");
        $invite->galeri_keterangan = $request->get("galeri_keterangan");

        $invite->nama_suami_ortu_bapak = $request->get("nama_suami_ortu_bapak");
        $invite->nama_suami_ortu_ibu = $request->get("nama_suami_ortu_ibu");
        $invite->nama_istri_ortu_bapak = $request->get("nama_istri_ortu_bapak");
        $invite->nama_istri_ortu_ibu = $request->get("nama_istri_ortu_ibu");

        $invite->pepatah_kata = $request->get("pepatah_kata");
        $invite->pepatah_author = $request->get("pepatah_author");

        $invite->jadwal_nikah_pembuka = $request->get("jadwal_nikah_pembuka");
        $invite->jadwal_nikah_isi = $request->get("jadwal_nikah_isi");
        $invite->jadwal_nikah_tanggal = $request->get("jadwal_nikah_tanggal");
        $invite->jadwal_nikah_waktu = $request->get("jadwal_nikah_waktu");
        $invite->jadwal_nikah_lokasi = $request->get("jadwal_nikah_lokasi");
        $invite->jadwal_nikah_lokasi_link = $request->get("jadwal_nikah_lokasi_link");
       
        $invite->jadwal_isi_bottom = $request->get("jadwal_isi_bottom");
        $invite->jadwal_penutup = $request->get("jadwal_penutup");

        if($request->hasFile("foto_header")){
            $invite->foto_header = $this->saveFoto($request, "foto_header", $url_invite, "bg", "images");            
        }
        if($request->hasFile("foto_suami")){
            $invite->foto_suami = $this->saveFoto($request, "foto_suami", $url_invite, "spouse", "images");            
        }
        if($request->hasFile("foto_istri")){
            $invite->foto_istri = $this->saveFoto($request, "foto_istri", $url_invite, "spouse", "images");
        }
        if($request->hasFile("galeri_top1")){
            $invite->galeri_top1 = $this->saveFoto($request, "galeri_top1", $url_invite, "gallery", "images");
        }
        if($request->hasFile("galeri_top2")){
            $invite->galeri_top2 = $this->saveFoto($request, "galeri_top2", $url_invite, "gallery", "images");            
        }
        if($request->hasFile("galeri_top3")){            
            $invite->galeri_top3 = $this->saveFoto($request, "galeri_top3", $url_invite, "gallery", "images");
        }
        if($request->hasFile("galeri_middle")){            
            $invite->galeri_middle = $this->saveFoto($request, "galeri_middle", $url_invite, "gallery", "images");
        }
        if($request->hasFile("galeri_bottom1")){            
            $invite->galeri_bottom1 = $this->saveFoto($request, "galeri_bottom1", $url_invite, "gallery", "images");            
        }
        if($request->hasFile("galeri_bottom2")){            
            $invite->galeri_bottom2 = $this->saveFoto($request, "galeri_bottom2", $url_invite, "gallery", "images");
        }
        if($request->hasFile("galeri_bottom3")){            
            $invite->galeri_bottom3 = $this->saveFoto($request, "galeri_bottom3", $url_invite, "gallery", "images");
        }
        if($request->hasFile("galeri_bottom4")){            
            $invite->galeri_bottom4 = $this->saveFoto($request, "galeri_bottom4", $url_invite, "gallery", "images");            
        }
        if($request->hasFile("galeri_bottom5")){            
            $invite->galeri_bottom5 = $this->saveFoto($request, "galeri_bottom5", $url_invite, "gallery", "images");
        }
        if($request->hasFile("galeri_bottom6")){            
            $invite->galeri_bottom6 = $this->saveFoto($request, "galeri_bottom6", $url_invite, "gallery", "images");
        }
        if($request->hasFile("video")){
            $invite->video = $this->saveFoto($request, "video", $url_invite, "media", "video");
        }
        if($request->hasFile("music")){            
            $invite->music = $this->saveFoto($request, "music", $url_invite, "media", "music");
        }
        if($request->hasFile("pepatah_foto")){            
            $invite->pepatah_foto = $this->saveFoto($request, "pepatah_foto", $url_invite, "bg", "images");
        }
       

        $invite->update();  


        // //kisah cinta    
        // for($i=0; $i < 3; $i++){
        //     $story = Story::all()->where('id', $request->get('kisah_cinta_id')[$i])->First();
        //     $story->invite_id = $invite->id;
        //     $story->kisah_cinta_tahun = $request->get("kisah_cinta_tahun")[$i];
        //     $story->kisah_cinta_judul = $request->get("kisah_cinta_judul")[$i];
        //     $story->kisah_cinta_isi = $request->get("kisah_cinta_isi")[$i];
        //     if($request->hasFile("kisah_cinta_foto.". $i)){ 
        //         $story->kisah_cinta_foto = $this->saveFotoIndex($request, "kisah_cinta_foto", $url_invite, "story", "images", $i);
        //     }
        //     $story->save();
        // }
        
        return redirect('/admin/list');
    }

    public function delete($url){
        $invite = Invite::where('url_invite', $url)->First();
        $imagePath = storage_path('app/public/images/client/'. $invite->url_invite);
        $videoPath = storage_path('app/public/video/client/'. $invite->url_invite);
        $musicPath = storage_path('app/public/music/client/'. $invite->url_invite);
        
        $invite->delete();

        $file = new Filesystem;
        $file->cleanDirectory($imagePath);
        $file->cleanDirectory($videoPath);
        $file->cleanDirectory($musicPath);
        return redirect('/admin/list');
    }

    public function getList(){
        $dataUndangan = Invite::all();
        return view("list.list")->with('invites', $dataUndangan);
    }
    
    private function saveFoto($request, $fotoName, $owner, $folderName, $category){
        if($request->hasFile($fotoName)){
            $filenameWithExt = $request->file($fotoName)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($fotoName)->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            
            $path = $request->file($fotoName)->storeAs('public/'. $category. '/client/'. $owner . '/' . $folderName, $filenameSimpan);
            return substr($path, 7);
        }else{
            return null;
        }
    }
    private function saveFotoIndex($request, $fotoName, $owner, $folderName, $category, $index){
        if($request->hasFile($fotoName . '.' . $index)){
            $filenameWithExt = $request->file($fotoName . '.' . $index)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($fotoName. '.' . $index)->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            
            $path = $request->file($fotoName. '.' . $index)->storeAs('public/'. $category. '/client/'. $owner . '/' . $folderName, $filenameSimpan);
            return substr($path, 7);
        }else{
            return null;
        }
    }


}
