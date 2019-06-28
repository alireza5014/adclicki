<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function setting()
    {
        $setting = Setting::first();
        return view('admin.setting', compact('setting'));
    }

    public function modify(Request $request)
    {
        $result = Setting::where('id', 1)->update([
            'author' => $request->author,
            'key_word' => $request->key_word,
            'description' => $request->description,
            'instagram_link' => $request->instagram_link,
            'telegram_link' => $request->telegram_link,
            'video_link' => $request->video_link,
            'ppc' => $request->ppc,
            'referer_percent' => $request->referer_percent,

        ]);

        if ($result)
            flash()->success('توجه', 'user add successfully');
        else
            flash()->error('توجه', 'error');


        return back();
    }
}
