<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'                 => 'Flash Sale Pentium Gold G5420 8th Gen Special PC',
            'sku'                 => 'C01P01',
            'brand_id'            => 12,
            'category_id'         => 18,
            'price'               => 23020,
            'stock'               => 5,
            'discount_percentage' => 0,
            'description'         => 'The Flash Sale Pentium Gold G5420 8th Gen Special PC features Intel Pentium Gold G5420 8th Gen Coffee Lake Processor. Intel Pentium GOLD processors are great options for value-segment buyers who need basic functionality at an affordable price. Leveraging Intel’s latest, most advanced 14nm process technology and optimizations, the processors are ideal for everyday computing like basic productivity, browsing visually stunning webpages, streaming 4K Ultra HD video, and editing photos. This special PC has ASRock H370M-HDV 8th and 9th Gen Micro ATX Motherboard inside it. ASRock H370M-HDV Motherboard has all three types of most used graphics output connectors. It supports D-Sub, DVI-D, HDMI combo. It also has an HDMI port which supports 4k resolution. It may need the help of integrated graphics though. You can use 3 monitors at the same time without installing another graphics card.  PATRIOT Signature Line 4GB DDR4 2666MHZ HEATSINK Desktop RAM and PNY CS900 120GB 2.5" SATA III Internal SSD have been installed for fast performance. It will get your work done faster than you want. All these special features have been bundled in MaxGreen G563BL Window ATX Casing. It will take the outlook of your build to the next level with its half-transparent panel on the left side. It has 2x12cm 15xLeds Ring Blue LED fans in the front panel. It really looks pretty stunning. This special PC also includes Gigabyte KM6300 USB Multimedia Keyboard Mouse Combo. No need for any additional installation, just plug in the computer to use. The convenient hotkeys offer you instant media control and easy access to the most common tools. The comfortable appearance allows consumers to use it for a long time. Precise 1000dpi optical sensor provides accurate and smooth tracking on the table. Adjustable keyboard tilt by extending the feet stands allows you to find personal optimal wrist position.',
        ])->images()->create([
            'path' => 'public/images/products/product-1.jpg',
        ]);

        Product::create([
            'name'                 => 'Flash Sale AMD Athlon 3000G Special PC',
            'sku'                 => 'C01P02',
            'brand_id'            => 12,
            'category_id'         => 18,
            'price'               => 25900,
            'stock'               => 5,
            'discount_percentage' => 10,
            'description'         => 'The Flash Sale AMD Athlon 3000G Special PC features AMD Athlon 3000G Processor with Radeon Graphics. It has been designed for overclocking, the Athlon 3000G 3.5 GHz Dual-Core AM4 Processor from AMD has a base clock speed of 3.5 GHz, two cores with four threads in an AM4 socket, 1MB of L2 cache memory, and 4MB of L3 cache memory. This special PC has ASRock A320M-HDV R4.0 AMD Motherboard inside it. PATRIOT Signature Line 4GB DDR4 2666MHZ HEATSINK Desktop RAM and Seagate Internal 1TB SATA Barracuda HDD has been installed for fast performance. It will get your work done faster than you want. And with the 1TB storage capacity, you can store everything you wish. All these special features have been bundled in MaxGreen G563BL Window ATX Casing. It will take the outlook of your build to the next level with its half-transparent panel on the left side. It has 2x12cm 15xLeds Ring Blue LED fans in the front panel. It really looks pretty stunning. This special PC also includes Gigabyte KM6300 USB Multimedia Keyboard Mouse Combo. No need for any additional installation, just plug in the computer to use. The convenient hotkeys offer you instant media control and easy access to the most common tools. The comfortable appearance allows consumers to use it for a long time. Precise 1000dpi optical sensor provides accurate and smooth tracking on the table. Adjustable keyboard tilt by extending the feet stands allows you to find personal optimal wrist position.',
        ])->images()->create([
            'path' => 'public/images/products/product-2.jpg',
        ]);
    }
}
