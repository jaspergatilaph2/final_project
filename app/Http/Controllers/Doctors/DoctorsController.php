<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\logs;

use function view;

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
        logs::create(['description' => "Doctor {$doctor->name} successfully deleted."]);
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
            'is_available' => 'required|array', // Ensure it's a array, not an boolean
            'specialization' => 'required|string|max:255',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctor_images', 'public');
        } else {
            $imagePath = null;
        }

        // Create Doctor Record
        $doctor = new Doctor();
        $doctor->name = $validatedData['name'];
        $doctor->company = $validatedData['company'] ?? null;
        $doctor->email = $validatedData['email'];
        $doctor->phone = $validatedData['phone'];
        $doctor->image = $imagePath;
        $doctor->is_available = $validatedData['is_available'];
        $doctor->specialization = $validatedData['specialization'];
        $doctor->save();

        logs::create(['description' => "Doctor {$doctor->name} successfully added."]);
        return redirect()->back()->with('success', 'Data has been successfully saved!');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }


    public function update(Request $request, Doctor $doctor)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_available' => 'required|array', // Ensure it's an array
            'specialization'=> 'required|string|max:255',
        ]);

        $doctor->name = $validatedData['name'];
        $doctor->company = $validatedData['company'] ?? null;
        $doctor->email = $validatedData['email'];
        $doctor->phone = $validatedData['phone'];
        $doctor->is_available = json_encode($validatedData['is_available']); // Convert array to JSON
        $doctor->specialization = $validatedData['specialization'];

        if ($request->hasFile('image')) {
            if ($doctor->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($doctor->image);
            }
            $doctor->image = $request->file('image')->store('doctors', 'public');
        }

        $doctor->save();
        logs::create(['description' => "Doctor {$doctor->name} successfully updated."]);
        return redirect()->route('admin.doctors.view')->with('success', 'Doctor updated successfully!');
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('user.doctor.show', compact('doctor'));
    }
}
