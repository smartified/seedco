<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UssdController extends Controller {

    public function index(Request $request) {
        $input = $request->all();

        if ($input['RequestType'] == 1) {
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
        } else if ($input['RequestType'] == 2) {
            $message = $this->headers()[$request->USSDString-1];
            $requestType = 2;
            $ussd = $message. $this->make_menu($this->menus()[$request->USSDString-1]);
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

    private function menus() {
        return [
            [
                "Maize",
                "Soya Beans",
                "Wheat",
                "Vegetables",
                "Back to Menu",
            ],

            [
                "Late Maturity",
                "Medium Maturiy",
                "Early Maturity",
                "Very Early Maturity",
                "Back to Menu"
            ],

            [
                "Buy 1 Get 1 Free",
                "Buy 1 Get 4 Free",
                "Win a bicycle"
            ]

        ];
    }

    private function headers() {
        return [
            "Choose a cultivar to continue\n",
            "Choose a maturity class to continue\n",
            "Bwana Mbeu ALWAYS has something for you!\n"
        ];
    }

}
