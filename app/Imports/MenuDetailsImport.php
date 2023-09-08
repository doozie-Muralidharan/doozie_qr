<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Customer;
use App\Models\MenuDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuDetailsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $customer_id;
    public function __construct($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function model(array $row)
    {

        // Look up the customer based on the customer name
        // $customer = Customer::where('restaurant_name', $row['customer_name'])
        //     ->first();

        $category = Category::where('name', $row['category_name'])
            ->first();

         // Save image_thumbnail to disk and get the URL
         $image_thumbnail = null;
         if (isset($row['image_thumbnail'])) {
             $image_thumbnail = Storage::url(Storage::putFile('public/images', $row['image_thumbnail']));
         }

         // Save large_image_to_display to disk and get the URL
         $large_image_to_display = null;
         if (isset($row['large_image_to_display'])) {
             $large_image_to_display = Storage::url(Storage::putFile('public/images', $row['large_image_to_display']));
         }


        $menu_details = new MenuDetails([
            'customer_id' => $this->customer_id,
            'cuisines_name' => $row['cuisines_name'],
            'cuisines_order' => $row['cuisines_order'],
            'menu_priority' => $row['menu_priority'],
            'menu_item_name' => $row['menu_item_name'],
            'category_ids' => $category->id,
            'catgory_tag' => $row['category_tag'],
            'image_thumbnail' => $image_thumbnail,
            'large_image_to_display' => $large_image_to_display,
            'video_url' => $row['video_url'],
            'short_description' => $row['short_description'],
            'detailed_description' => $row['detailed_description'],
            'cost_in_inr' => $row['cost_in_inr'],

        ]);

        return $menu_details;

    }
}
