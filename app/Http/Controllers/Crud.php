<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class Crud extends Controller
{
    public function addstd()
    {
        return view('addstd');
    }
    public function insertStd(Request $r)
    {
        $n = $r->name;
        $g = $r->gender;
        $s = $r->stream;
        $sb = isset($r->sub) ? implode(",", $r->sub) : "";
        $fl = $r->file('stdimg');
        $fn = time() . "." . $fl->getClientOriginalName();
        $fl->move(public_path('uploads'), $fn);

        $obj = new Student();
        $obj->name = $n;
        $obj->gender = $g;
        $obj->stream = $s;
        $obj->subject = $sb;
        $obj->stdimg = $fn;
        $obj->save();

        return response()->json([
            'status' => true,
            'message' => 'Student added successfully'
        ]);
    }

    public function showStd()
    {
        //$obj = Student::all();
        $obj = Student::paginate(5); // 5 records per page

        $output = '';
        if ($obj->count() > 0) {
            $output .= '<table  border="1"  width="100%" cellspacing="0" cellpadding="10px" class="table table-bordered table-striped  table-hover table-responsive">
                <tr> 
                    <th class="text-center align-middle" width="100px">Id</th>
                    <th class="text-center align-middle" width="100px">Name</th>
                    <th class="text-center align-middle" width="100px">Gender</th>
                    <th class="text-center align-middle" width="100px">Stream</th>
                    <th class="text-center align-middle" width="100px">Subject</th>
                    <th class="text-center align-middle" width="100px">Image</th>
                    <th class="text-center align-middle" width="100px">Edit</th>
                    <th class="text-center align-middle" width="100px">Delete</th>
                </tr>';

            foreach ($obj as $student) {
                $output .= '<tr>
                    <td class="text-center align-middle">' . $student->sid . '</td>
                    <td class="text-center align-middle">' . $student->name . '</td>
                    <td class="text-center align-middle">' . $student->gender . '</td>
                    <td class="text-center align-middle">' . $student->stream . '</td>
                    <td class="text-center align-middle">' . $student->subject . '</td>
                    <td class="text-center align-middle"><img style="width: 100px;" src="' . asset("uploads/" . $student->stdimg) . '" /></td>
                    <td class="text-center align-middle" align="center"><button class="edit-btn btn btn-success" data-eid="' . $student->sid . '" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</button></td>
                    <td class="text-center align-middle"><button class="delete-btn btn btn-danger" data-id="' . $student->sid . '">Delete</button></td>
                </tr>';
            }

            $output .= '</table>';

            // Pagination
            $output .= '
            <div style="width: 100%;height: 70px;display: flex;justify-content: center;align-items: center;">
            <nav class="mt-3 ">
    <ul class="pagination">';

            for ($i = 1; $i <= $obj->lastPage(); $i++) {

                $active = ($i == $obj->currentPage()) ? 'active' : '';

                $output .= '
        <li class="page-item ' . $active . '">
            <a href="#" 
               class="page-link pagination-btn"
               data-page="' . $i . '">
               ' . $i . '
            </a>
        </li>';
            }

            $output .= '</ul>
    </nav>
    </div>
    ';
        } else {
            $output = '<h2>No Record Found.</h2>';
        }

        return response()->json(['html' => $output]);
    }
    public function deleteStd(Request $r)
    {
        $id = $r->id;
        $obj = Student::find($id);
        if ($obj->stdimg != 'default.jpg') {
            unlink(public_path('uploads/' . $obj->stdimg));
        }

        $obj->delete();

        return response()->json([
            'status' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
}
