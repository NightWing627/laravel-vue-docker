<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        $url = '/ttt';
        $nav_items = array(
            array(
                'link'=> '/action1',
                'display_name'=> '/action1',
                'sub_menu'=> array(
                    array(
                        'display_name'=> '/action1_sub1',
                        'link'=> array( 'cached_url' => '/action1_sub1_catched_url')
                    ),
                    array(
                        'display_name' => '/action1_sub2',
                        'link' => array( 'cached_url' => '/action1_sub2_catched_url' )
                    )
                )
            ),
            array(
                'link'=> '/action2',
                'display_name'=> '/action2',
                'sub_menu'=> array(
                    array(
                        'display_name'=> '/action2_sub1',
                        'link'=> array( 'cached_url' => '/action2_sub1_catched_url')
                    ),
                    array(
                        'display_name' => '/action1_sub2',
                        'link' => array( 'cached_url' => '/action1_sub2_catched_url' )
                    )
                )
            ),
            array(
                'link'=> '/action1',
                'display_name'=> '/action1',
                'sub_menu'=> array(
                    array(
                        'display_name'=> '/action1_sub1',
                        'link'=> array( 'cached_url' => '/action1_sub1_catched_url')
                    ),
                    array(
                        'display_name' => '/action1_sub2',
                        'link' => array( 'cached_url' => '/action1_sub2_catched_url' )
                    )
                )
            ),
        );
        return view('test', compact('url', 'nav_items'));
    }
}