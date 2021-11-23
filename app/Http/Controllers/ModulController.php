<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Moduller;
use App\Models\Kategoriler;
use File;


class ModulController extends Controller
{
    function __construct()
    {
        view()->share('moduller',Moduller::whereDurum(1)->get()); /* Construck ile yapıyı aldık */
    }
    public function index()
    {
        return view("admin.include.moduller");
    }
    public  function  modulekle(Request $request)
    {
        $request->validate([
           "baslik"=>'required|string',
        ]);

        $baslik=$request->baslik;
        $seflink=Str::of($baslik)->slug('');
        $kontrol=Moduller::whereSeflink($seflink)->first();
        if ($kontrol)
        {

            return redirect()->route('moduller')->with('hata','Bu modul daha önce eklenmiştir.');
        }
        else{

            /* 1.ADIM MODUL OLUSTURMA İŞLEMİ*/
            Moduller::create([
                "baslik"=>$baslik,
                "seflink"=>$seflink
            ]);
            /*2 İNCİ ADIM KATEGORİ KAYIT İŞLEMİ */


            Kategoriler::create([
                "baslik"=>$baslik,
                "seflink"=>$seflink,
                "tablo"=>"modul",
                "sirano"=>1
            ]);

            /* 3.adım DİNAMİK TABLO  OLUŞTURMA */


            Schema::create($seflink, function (Blueprint $table) {
                $table->id();
                $table->string('baslik',255);
                $table->string('seflink',255);
                $table->string('resim',255)->nullable();
                $table->longText('metin')->nullable();
                $table->unsignedBigInteger('kategori')->nullable();
                $table->string('anahtar',255)->nullable();
                $table->string('description',255)->nullable();
                $table->enum('durum',[1,2])->default(1);
                $table->integer('sirano')->nullable();
                $table->timestamps();

                /* TABLOLAR ARASI İLİŞKİ KURMA  KATEGORİ İLİŞKİSİ */
                $table->foreign('kategori')->references('id')->on('kategoriler')->onDelete('cascade');
            });
            /*4. ADIM MODEL OLUŞTURMA */

            $modelDosyası='<?php

                namespace App\Models;

                use Illuminate\Database\Eloquent\Factories\HasFactory;
                use Illuminate\Database\Eloquent\Model;

                class '.ucwords($seflink).' extends Model
                {

                    use HasFactory;
                    protected $table="'.$seflink.'";
                    protected $fillable=["id","baslik","seflink","kategori","resim","metin","anahtar","description","durum","sirano","created_at","updated_at"];
                }';
            File::put(app_path('Models')."/".ucwords($seflink).'.php',$modelDosyası); /*Hizmetler.php*/

            return redirect()->route('moduller')->with('basarili','işlemimiz başarıyla kaydedildi.');
        }



    }
}
