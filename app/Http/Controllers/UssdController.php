<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UssdController extends Controller {

    public function index(Request $request) {
        $input = $request->all();

        if($input['RequestType'] == 1) {
            $message = "Welcome to SEEDCO, The african Seed Company\n";
            $first_menu = [
                "Available Products",
                "Pricing",
                "Promotions",
                "Best Practice",
                "Product Features",
                "Feedback"
            ];

            $ussd = $message;
            $ussd .= $this->make_menu($first_menu);

            $requestType = 2;
            return view("ussd", compact('request', 'requestType', 'ussd'));
        }else if($input['RequestType'] == 2){
            $selection = str_replace($request->USSDString,$request->SHORTCODE,"");
            var_dump("more ".$selection);
            $requestType = 2;
            return view("ussd", compact('request', 'requestType', 'ussd'));
        }

    }

    private function make_menu($menu) {
        $ussd = "";
        foreach ($menu as $fm => $m) {
            $index = $fm + 1;
            $ussd .= "{$index} - $m\n";
        }
        return $ussd;
    }

    private function get_menu($id){
        $first_menu = [
            "Available Products",
            "Pricing",
            "Promotions",
            "Best Practice",
            "Product Features",
            "Feedback"
        ];

        $products = [

        ];
}

}
