<?php

namespace App\Http\Livewire;

use App\Models\SeoSetting as ModelsSeoSetting;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class SeoSetting extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public ModelsSeoSetting $seoSetting;

    public $site_name,
        $description,
        $favicon,
        $keywords,
        $logo,
        $whatsapp_number,
        $banner_video_url;

    protected $rules = [
        'site_name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'keywords' => 'nullable|string|max:500',
        'whatsapp_number' => 'string|required|min:5',
        'banner_video_url' => 'required|url'
    ];

    protected function rules()
    {
        $favicon = is_object($this->favicon)
            ? 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:2048'
            : '';

        $logo = is_object($this->logo)
            ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            : '';

        return array_merge($this->rules, ['favicon' => $favicon, 'logo' => $logo]);
    }

    public function render()
    {
        return view('livewire.seo-setting');
    }

    public function mount()
    {
        $setting = ModelsSeoSetting::first();
        if (!is_null($setting)) {
            $this->seoSetting = $setting;
            $this->site_name = $setting->site_name;
            $this->description = $setting->description;
            $this->favicon = $setting->favicon;
            $this->logo = $setting->logo;
            $this->keywords = $setting->keywords;
            $this->whatsapp_number = $setting->whatsapp_number;
            $this->banner_video_url = $setting->banner_video_url;
        }
    }

    public function save()
    {
        $this->validate();

        ModelsSeoSetting::updateOrCreate(['id' => 1], [
            'site_name' => $this->site_name,
            'description' => $this->description,
            'favicon' => is_object($this->favicon) ? $this->deleteFavicon() : $this->favicon,
            'logo' => is_object($this->logo) ? $this->deleteLogo() : $this->logo,
            'keywords' => $this->keywords,
            'whatsapp_number' => $this->whatsapp_number,
            'banner_video_url' => $this->banner_video_url,
        ]);

        $this->alert('success', 'Setting saved');
    }

    public function deleteFavicon()
    {
        if (is_object($this->favicon) && !is_null($this->seoSetting->favicon)) {
            if (Storage::exists($this->seoSetting->favicon)) {
                Storage::delete($this->seoSetting->favicon);
            }
            $path = $this->favicon->store('favicon');
            return $path;
        }
        if (is_object($this->favicon)) {
            $path = $this->favicon->store('favicon');
            return $path;
        }

        return null; // Kembalikan null jika favicon tidak ada
    }

    public function deleteLogo()
    {
        if (is_object($this->logo) && !is_null($this->seoSetting->logo)) {
            if (Storage::exists($this->seoSetting->logo)) {
                Storage::delete($this->seoSetting->logo);
            }
        }
        if (is_object($this->logo)) {
            $path = $this->logo->store('logo');
            return $path;
        }

        return null; // Kembalikan null jika logo tidak ada
    }
}
