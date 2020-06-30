<?php

namespace App\Http\Controllers\Cisco\Geometric;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *  Cisco Geometric
 */

class CiscoGeometricController extends Controller
{
    public function show()
    {
        // Draw Geometric Figure

        return view( 'geometric.canvas' );
    }
}