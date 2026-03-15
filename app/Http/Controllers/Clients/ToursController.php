<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToursController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new Tours();
    }

    public function index(Request $request)
    {
        $title = 'Tours';

        $query = Tours::query();

        /*
        |--------------------------------------------------------------------------
        | Search Destination
        |--------------------------------------------------------------------------
        */
        if ($request->filled('destination')) {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
        }

        /*
        |--------------------------------------------------------------------------
        | Start Date
        |--------------------------------------------------------------------------
        */
        if ($request->filled('start_date')) {
            $query->whereDate('startdate', '>=', $request->start_date);
        }

        /*
        |--------------------------------------------------------------------------
        | End Date
        |--------------------------------------------------------------------------
        */
        if ($request->filled('end_date')) {
            $query->whereDate('enddate', '<=', $request->end_date);
        }

        /*
        |--------------------------------------------------------------------------
        | Guests
        |--------------------------------------------------------------------------
        */
        if ($request->filled('guests')) {
            $query->where('quantity', '>=', $request->guests);
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $tours = $query->paginate(9)->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Lấy ảnh tour
        |--------------------------------------------------------------------------
        */
        foreach ($tours as $tour) {

            if (!empty($tour->images)) {
                $tour->display_image = $tour->images;
            } 
            else {

                $firstImage = DB::table('tbl_images')
                    ->where('tourid', $tour->tourid)
                    ->value('imageUrl');

                $tour->display_image = $firstImage ?? 'default.jpg';
            }
        }

        return view('clients.Tours', compact('title', 'tours'));
    }
}