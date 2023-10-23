<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoSetting>
 */
class SeoSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_name' => $this->faker->word(),
            'terms' => $this->faker->paragraph(25, true),
            'about' => $this->faker->paragraph(25, true),
            'description' => 'Best Japan AV porn site, free forever,
            high speed, no lag, over 100,000 videos, daily update, no ads while playing video.',
            'whatsapp_number' => '000000000000',
            'keywords' => 'jav guru, jav, jav sub indo, jav most, jav streaming, free jav, jav stream, jav online, streaming jav, jav subtitle, jav subindo, jav subtitle indo, jav uncesored leak, jav hd, jav cosplay',
            'banner_video_url' => 'https://c4.cdnjhd.com/content-01/thumbs/2-sm3d2dbd-10-maomi-nagasawa-s-model-10/thumbs/special/video.mp4'
        ];
    }
}
