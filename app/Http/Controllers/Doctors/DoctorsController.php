<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;

class DoctorsController extends Controller
{
    public function index()
    {
        return view('admin.doctors.index');
    }

    public function create()
    {
        return view('admin.doctors.create', [
            'activeMenu' => 'Doctors',
            'activeSub' => 'Add Doctors' 
        ]);
    }

    public function view(Doctor $doctors)
    {
        $doctors = Doctor::all();
        return view('admin.doctors.view', [
            'activeMenu' => 'Doctors',
            'activeSub' => 'View Doctor',
        ], compact('doctors'));
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('admin.doctors.view')->with('success', 'Doctor deleted successfully.');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctor_images', 'public');
            $validatedData['image'] = $imagePath; 
        }

        Doctor::create($validatedData);

        return redirect()->back()->with('success', 'Data has been successfully saved!');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }


    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $doctor->name = $request->input('name');
        $doctor->company = $request->input('company');
        $doctor->email = $request->input('email');
        $doctor->phone = $request->input('phone');

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('doctors', 'public');
            $doctor->image = $filePath;
        }

        $doctor->save();

        return redirect()->route('admin.doctors.view')->with('success', 'Doctor updated successfully!');
    }
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id); 
        return view('user.doctor.show', compact('doctor'));
    }
}