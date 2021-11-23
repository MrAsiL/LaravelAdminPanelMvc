<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Moduller;
use App\Models\Kategoriler;
use App\Models\Ayarlar;



class AdminYonetimController extends Controller
{
    function __construct()
    {
        view()->share('moduller',Moduller::whereDurum(1)->get()); /* Construck ile yapıyı aldık */

    }
    public function  home()
    {
        return view('admin.include.home');
    }
    public function liste($modul)
    {
        $dinamikModul=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        if ($dinamikModul)
        {
            $dinamikModel="App\Models\\".ucfirst($dinamikModul->seflink);
            $veriler=$dinamikModel::get();
            return view("admin.include.liste",compact(['veriler','dinamikModul']));
        }
        else
        {
            return redirect()->route('home');
        }

    }
    public function ekle($modul)
    {
        $modullerBilgisi=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        $kategoriBilgisi=Kategoriler::whereTablo('modul')->whereSeflink($modul)->get();
        if ($modullerBilgisi && $kategoriBilgisi)
        {
            return view("admin.include.ekle",compact(['modullerBilgisi','kategoriBilgisi']));
        }
        else
        {
            return redirect()->route('home');
        }

    }
    public function eklePost($modul,Request $request)
    {
        $modullerBilgisi=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        if ($modullerBilgisi)
        {
            $modelDosyaAdi=ucfirst($modullerBilgisi->seflink);
            $request->validate([
                "baslik"=>'required|string',
                "kategori"=>'required',
                "anahtar"=>'required',
                "description"=>'required',
            ]);
            $baslik=$request->baslik;
            $seflink=Str::of($baslik)->slug('');
            $metin=$request->metin;
            $kategori=$request->kategori;
            $anahtar=$request->anahtar;
            $description=$request->description;
            $sirano=$request->sirano;

            $dinamikModel="App\Models\\".$modelDosyaAdi;
            $resimDosyasi=$request->file('resim');
            if (isset($resimDosyasi))
            {
                $resim=uniqid().".".$resimDosyasi->getClientOriginalExtension();
                $resimDosyasi->move(public_path("images/".$modullerBilgisi->seflink),$resim);
                $kaydet=$dinamikModel::create([
                    "baslik"=>$baslik,
                    "seflink"=>$seflink,
                    "metin"=>$metin,
                    "kategori"=>$kategori,
                    "resim"=>$resim,
                    "anahtar"=>$anahtar,
                    "description"=>$description,
                    "sirano"=>$sirano
                ]);
            }
            else
            {
                $kaydet=$dinamikModel::create([
                    "baslik"=>$baslik,
                    "seflink"=>$seflink,
                    "metin"=>$metin,
                    "kategori"=>$kategori,
                    "anahtar"=>$anahtar,
                    "description"=>$description,
                    "sirano"=>$sirano
                ]);
            }

            return redirect()->route('ekle',$modullerBilgisi->seflink)->with('basarili','işlemimiz başarıyla kaydedildi.');



        }
        else{

                return redirect()->route('home');

        }
    }
                          //    DÜZENLEME FOKSİYONU
    public function duzenle($modul,$id)
    {
        $modullerBilgisi=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        $kategoriBilgisi=Kategoriler::whereTablo('modul')->whereSeflink($modul)->get();
        if ($modullerBilgisi && $kategoriBilgisi)
        {
            $modelDosyaAdi=ucfirst($modullerBilgisi->seflink);
            $dinamikModel="App\Models\\".$modelDosyaAdi;
            $veriler=$dinamikModel::whereId($id)->first();
            return view("admin.include.duzenle",compact(['modullerBilgisi','kategoriBilgisi','veriler']));
        }
        else
        {
            return redirect()->route('home');
        }

    }
    public function duzenlePost($modul,$id,Request $request)
    {
        $modullerBilgisi=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        if ($modullerBilgisi)
        {
            $modelDosyaAdi=ucfirst($modullerBilgisi->seflink);
            $request->validate([
                "baslik"=>'required|string',
                "kategori"=>'required',
                "anahtar"=>'required',
                "description"=>'required',
            ]);
            $baslik=$request->baslik;
            $seflink=Str::of($baslik)->slug('');
            $metin=$request->metin;
            $kategori=$request->kategori;
            $anahtar=$request->anahtar;
            $description=$request->description;
            $sirano=$request->sirano;

            $dinamikModel="App\Models\\".$modelDosyaAdi;
            $resimDosyasi=$request->file('resim');
            if (isset($resimDosyasi))
            {
                $resim=uniqid().".".$resimDosyasi->getClientOriginalExtension();
                $resimDosyasi->move(public_path("images/".$modullerBilgisi->seflink),$resim);
                $kaydet=$dinamikModel::whereId($id)->update([
                    "baslik"=>$baslik,
                    "seflink"=>$seflink,
                    "metin"=>$metin,
                    "kategori"=>$kategori,
                    "resim"=>$resim,
                    "anahtar"=>$anahtar,
                    "description"=>$description,
                    "sirano"=>$sirano
                ]);
            }
            else
            {
                $kaydet=$dinamikModel::whereId($id)->update([
                    "baslik"=>$baslik,
                    "seflink"=>$seflink,
                    "metin"=>$metin,
                    "kategori"=>$kategori,
                    "anahtar"=>$anahtar,
                    "description"=>$description,
                    "sirano"=>$sirano
                ]);
            }

            return redirect()->route('duzenle',[$modullerBilgisi->seflink,$id])->with('basarili','işlemimiz başarıyla kaydedildi.');



        }
        else{

            return redirect()->route('home');

        }
    }
            //         SİLME İŞLEMİ
    public function sil($modul,$id)
    {
        $modullerBilgisi=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        $modelDosyaAdi=ucfirst($modullerBilgisi->seflink);
        $dinamikModel="App\Models\\".$modelDosyaAdi;
        $veriler=$dinamikModel::whereId($id)->first();
        if ($modullerBilgisi && $veriler)
        {
            $silme=$dinamikModel::whereId($id)->delete();
            return redirect()->route('liste',$modullerBilgisi->seflink);
        }
        else
        {
            return redirect()->route('home');
        }

    }
//                    DURUM ALANI AYARLANMASI
    public function  durum($modul,$id)
    {
        $modullerBilgisi=Moduller::whereDurum(1)->whereSeflink($modul)->first();
        $kategoriBilgisi=Kategoriler::whereTablo('modul')->whereSeflink($modul)->get();
        if ($modullerBilgisi && $kategoriBilgisi)
        {
            $modelDosyaAdi=ucfirst($modullerBilgisi->seflink);
            $dinamikModel="App\Models\\".$modelDosyaAdi;
            $veriler=$dinamikModel::whereId($id)->first();
            if ($veriler)
            {
                if ($veriler->durum==1){$durum=2;}else{$durum=1;}
                $kaydet=$dinamikModel::whereId($id)->update([
                    "durum"=>$durum
                ]);

                return redirect()->back()->with('basarili','işlemimiz başarıyla kaydedildi.');
            }
            else
            {
                return redirect()->back();

            }
        }
        else
        {
            return redirect()->back();
        }

    }
    public function ayarlar()
    {
        $veriler=Ayarlar::whereId(1)->first();    /*  DİYEDE YAZILABILIR  find(1) */
        return view("admin.include.ayarlar",compact('veriler'));
    }
    public function ayarpost(Request $request)
    {
        $request->validate([
            "title"=>'required|string',
            "keywords"=>'required|string',
            "description"=>'required|string',
        ]);
        $ilkguncelleme=Ayarlar::whereId(1)->update([
            "title"=>$request->title,
            "keywords"=>$request->keywords,
            "description"=>$request->description,
            "bakimmodu"=>$request->bakimmodu
        ]);
            /* RESİM DOSYASI VARSA YUKLEME YAPMA  2 . GÜNCELLEME*/
        $logoDosyasi=$request->file('logo');
        if (isset($logoDosyasi)) {
            $logo= "logo." . $logoDosyasi->getClientOriginalExtension();
            $logoDosyasi->move(public_path("images"),$logo);
            $ikinciguncelleme=Ayarlar::whereId(1)->update([
                "logo"=>$logo

            ]);
            /* FAVİCON YUKLEME   3. GUNCELLEME */
            $faviconDosyasi=$request->file('favicon');
            if (isset($faviconDosyasi)) {
                $favicon="favicon." . $faviconDosyasi->getClientOriginalExtension();
                $faviconDosyasi->move(public_path("images"),$favicon);
                $ucuncuguncelleme=Ayarlar::whereId(1)->update([
                    "favicon"=>$favicon

                ]);
            }
        }
        return redirect()->route('ayarlar')->with('basarili', 'işlemimiz başarıyla kaydedildi.');

    }


}
