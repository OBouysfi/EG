<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function print($participantId)
    {
        $participant = Participant::findOrFail($participantId);
        return view('diplomes.print', compact('participant'));
    }
public function updateDiplomeImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Path to the old image
    $oldImagePath = public_path('assets/img/diplome.png');

    // Delete the old image if it exists
    if (file_exists($oldImagePath)) {
        unlink($oldImagePath);
    }

    // Upload the new image
    $imageName = 'diplome.png'; // Keep the name the same
    $request->image->move(public_path('assets/img'), $imageName);

    return redirect()->back()->with('success', 'Diplome image updated successfully!');
}
public function diplome()
{
    // Logic for displaying the diploma settings view
    return view('parametrage.diplome');
}


}
