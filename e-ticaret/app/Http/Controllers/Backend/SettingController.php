<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    public function index()
    {
        $settings = SiteSetting::get();
        return view('backend.pages.setting.index' ,compact('settings'));
    }


    public function create()
    {
        return view('backend.pages.setting.edit');
    }

    public function store(Request $request)
    {
        $key = $request->name;


            SiteSetting::firstOrCreate(
                [
                    'name' => $key,
                ],
                [
               'name' => $key,
                'data' => $request->data,
                'set_type' => $request->set_type,
            ]);

        return back()->withSuccess('Başarılı');
    }


    public function edit(string $id)
    {
        $setting = SiteSetting::where('id',$id)->first();

        return view('backend.pages.setting.edit' , compact('setting'));
    }

    public function update(Request $request, string $id)
    {
        $setting = SiteSetting::where('id',$id)->first();
        $key = $request->name;
        if($request->hasFile('data')){
            $resim = $request->file('data');
            $dosyaadi  = time().'-'. Str::slug($key).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/setting') , $dosyaadi);

            if ($setting->data) {
                $eskiDosyaYolu = public_path('img/setting') . '/' . $setting->data;
                if (file_exists($eskiDosyaYolu)) {
                    unlink($eskiDosyaYolu);
                }
            }
        } else {

            $dosyaadi = $setting->data;
        }

        if($request->set_type == 'file' || $request->set_type == 'image'){
            $dataItem = $dosyaadi ?? $setting->data;
        }else{
            $dataItem = $request->data ?? $setting->data;

        }
        $setting->update(
            [
                'name' => $key,
                'data' => $dataItem,
                'set_type' => $request->set_type,
            ]);
        return back()->withSuccess('Başarılı');
    }

    public function destroy(string $id)
    {
        //
    }
}
