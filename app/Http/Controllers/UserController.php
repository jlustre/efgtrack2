<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Display a listing of users
    public function index(Request $request)
    {
        $query = User::with(['sponsor', 'mentor', 'manager', 'stateProvince', 'country']);

        // Filters
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('member_status')) {
            $query->where('member_status', $status);
        }

        if ($country = $request->input('country_id')) {
            $query->where('country_id', $country);
        }

        // Sorting
        $allowedSorts = ['id', 'name', 'username', 'email', 'created_at'];
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc') === 'asc' ? 'asc' : 'desc';
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $perPage = (int) $request->input('per_page', 25);
        $users = $query->orderBy($sort, $direction)->paginate($perPage)->withQueryString();

        $countries = \App\Models\Country::where('is_active', true)->orderBy('name')->get();

        return view('users.index', compact('users', 'countries'));
    }

    // Show the form for creating a new user
    public function create()
    {
        // Provide an empty User instance so the create view and any shared partials
        // can safely reference $user without checking for existence.
        $user = new User();
        $countries = \App\Models\Country::where('is_active', true)->orderBy('name')->get();
        $states = \App\Models\StateProvince::orderBy('name')->get();
        $timezones = DB::table('timezones')->where('is_active', true)->orderBy('name')->get();
        $contactTimes = [
            'weekdays-am' => 'Weekdays AM',
            'weekdays-pm' => 'Weekdays PM',
            'weekends-am' => 'Weekends AM',
            'weekends-pm' => 'Weekends PM',
            'friday-only' => 'Friday Only',
            'saturday-only' => 'Saturday Only',
            'sunday-only' => 'Sunday Only',
            'anytime' => 'Anytime',
        ];

        return view('users.create', compact('user', 'countries', 'states', 'timezones', 'contactTimes'));
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $countries = \App\Models\Country::where('is_active', true)->orderBy('name')->get();
        $states = \App\Models\StateProvince::orderBy('name')->get();
        $timezones = DB::table('timezones')->where('is_active', true)->orderBy('name')->get();
        $contactTimes = [
            'weekdays-am' => 'Weekdays AM',
            'weekdays-pm' => 'Weekdays PM',
            'weekends-am' => 'Weekends AM',
            'weekends-pm' => 'Weekends PM',
            'friday-only' => 'Friday Only',
            'saturday-only' => 'Saturday Only',
            'sunday-only' => 'Sunday Only',
            'anytime' => 'Anytime',
        ];
        return view('users.edit', compact('user', 'countries', 'states', 'timezones', 'contactTimes'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
