<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearch extends Controller
{
    function index(){
        return view('live_search');
    }

    function action (request $request)
    {
        if($request -> ajax()) {
            $output = '';
            $query = $request -> get ('query');
            $total_row = 0;

            if($query != '') 
            {
                $data_task = DB::table('task')
                        -> where ('title','like','%' . $query.'%')
                        -> orderby ('title','asc')
                        -> get ();

                $data_proj = DB::table('project')
                        -> where ('name','like','%' . $query.'%')
                        -> orwhere ('company','like','%' . $query.'%')
                        -> orderby ('name','asc')
                        -> get ();

                $data_team = DB::table('team')
                        -> where ('name','like','%' . $query.'%')
                        -> orderby ('name','asc')
                        -> get ();

                $total_row = $data_task -> count() + $data_proj -> count() + $data_team -> count();
            }
            
            
            if ($total_row > 0)
            {
                if ($data_proj -> count() >0){
                    $output .= '<h3>Projects:</h3>';
                    foreach ($data_proj as $row)
                    {
                        $output .= '
                        <tr>
                            <td> '.$row->name.' </td>
                            <td> '.$row->description.' </td>
                        </tr>
                        ';
                    }
                }

                if ($data_task -> count() > 0){
                    $output .= '<h3>Tasks:</h3>';
                    foreach ($data_task as $row)
                    {
                        
                        $output .= '
                        <tr>
                            <td> '.$row->title.' </td>
                            <td> '.$row->description.' </td>
                        </tr>
                        ';
                    }
                }

                if ($data_team -> count() > 0){
                    $output .= '<h3>Teams:</h3>';
                    foreach ($data_team as $row)
                    {
                        
                        $output .= '
                        <tr>
                            <td> '.$row->name.' </td>
                        </tr>
                        ';
                    }
                }

                   
            }
            else
            {
                if($query != '')
                {
                    $output = '
                    <tr>
                        <td align="center" colspan="5"> No Data Found</td>
                    </tr>
                    ';
                }
            }

            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }
    }

    function action_proj (request $request)
    {
        if($request -> ajax()) {
            $output = '';
            $query = $request -> get ('query');
            $total_row = 0;

            if($query != '') 
            {

                $data_proj = DB::table('project')
                        -> where ('name','like','%' . $query.'%')
                        -> orwhere ('company','like','%' . $query.'%')
                        -> orderby ('name','asc')
                        -> get ();

                $total_row = $data_proj -> count();
            }
            
            
            if ($total_row > 0)
            {
                if ($data_proj -> count() >0){
                    $output .= '<h3>Projects:</h3>';
                    foreach ($data_proj as $row)
                    {
                        $output .= '
                        <tr>
                            <td> '.$row->name.' </td>
                            <td> '.$row->description.' </td>
                        </tr>
                        ';
                    }
                }


                   
            }
            else
            {
                if($query != '')
                {
                    $output = '
                    <tr>
                        <td align="center" colspan="5"> No Data Found</td>
                    </tr>
                    ';
                }
            }

            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }
    }
}
