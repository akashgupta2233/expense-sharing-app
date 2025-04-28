<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Displays the main page with the group, users, and expenses
    public function index()
    {
        $groupName = session('groupName', ''); // Retrieve the group name from the session
        $users = session('users', []); // Retrieve the users list from the session
        $expenses = session('expenses', []); // Retrieve the expenses list from the session
        
        return view('home', compact('groupName', 'users', 'expenses'));
    }

    // Creates a new group and resets users and expenses
    public function createGroup(Request $request)
    {
        $request->validate([
            'groupName' => 'required|string|max:255',
        ]);
    
        // Set the new group name in session
        session(['groupName' => $request->groupName]);
    
        // Reset the users, expenses, and split amount session data
        session(['users' => []]);
        session(['expenses' => []]);
        session(['splitAmount' => 0]); // Ensure split amount is reset to 0
    
        return redirect()->route('home');
    }
    

    // Adds a new user to the group
    public function addUser(Request $request)
    {
        // Validate the user input
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        // Retrieve the current users list from the session
        $users = session('users', []);
        
        // Add the new user to the users list
        $users[] = [
            'id' => time(), // Unique ID for the user
            'username' => $request->username,
        ];

        // Save the updated users list to the session
        session(['users' => $users]);

        return redirect()->route('home');
    }

    // Deletes a user from the group
    public function deleteUser($id)
    {
        // Retrieve the users list from the session
        $users = session('users', []);

        // Filter out the user with the provided ID
        $users = array_filter($users, fn($user) => $user['id'] != $id);

        // Save the updated users list to the session
        session(['users' => $users]);

        return redirect()->route('home');
    }

    // Resets the group, users, and expenses
    public function reset()
    {
        // Clear the session data for the group, users, and expenses
        session()->forget('groupName');
        session()->forget('users');
        session()->forget('expenses');

        return redirect()->route('home');
    }

    // Adds an expense to the group
    public function addExpense(Request $request)
    {
        // Validate the expense input
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
        ]);

        // Retrieve the current expenses list from the session
        $expenses = session('expenses', []);

        // Add the new expense to the list
        $expenses[] = [
            'amount' => $request->amount,
            'description' => $request->description,
        ];

        // Save the updated expenses list to the session
        session(['expenses' => $expenses]);

        return redirect()->route('home');
    }

    // Splits the total expenses equally among users
    public function splitExpense()
    {
        // Retrieve the expenses list from the session
        $expenses = session('expenses', []);

        // Calculate the total amount of all expenses
        $totalExpense = array_sum(array_column($expenses, 'amount'));

        // Retrieve the users list from the session
        $users = session('users', []);
        $numUsers = count($users);

        // Calculate the amount each user needs to pay
        if ($numUsers > 0) {
            $splitAmount = $totalExpense / $numUsers;
            session(['splitAmount' => $splitAmount]); // Save the split amount to the session
        } else {
            session(['splitAmount' => 0]); // If no users, set split amount to 0
        }

        return redirect()->route('home');
    }
}
