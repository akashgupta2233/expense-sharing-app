<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expense Splitter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-green-500 mb-4 text-center uppercase">Expense Splitter</h1>

        @if (!$groupName)
            <!-- Create Group Form -->
            <form action="{{ route('create.group') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="groupName" placeholder="Your group name" class="input w-full border p-2 rounded" />
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full">Create Group</button>
            </form>
        @else
            <div class="mb-6 text-center">
                <h2 class="text-xl font-semibold mb-2">Your group, #{{ $groupName }}</h2>

                <!-- Add User Form -->
                <form action="{{ route('add.user') }}" method="POST" class="flex items-center mb-4">
                    @csrf
                    <input type="text" name="username" placeholder="Add your friend" class="flex-1 border p-2 rounded mr-2" />
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
                </form>

                <!-- User List -->
                <ul class="text-left">
                    @forelse ($users as $user)
                        <li class="flex justify-between items-center border-b py-2">
                            <span>{{ $user['username'] }}</span>
                            <form action="{{ route('delete.user', $user['id']) }}" method="POST">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-400">No users yet.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Add Expense Form -->
            <form action="{{ route('add.expense') }}" method="POST" class="flex items-center mb-4">
                @csrf
                <input type="number" name="amount" step="0.01" placeholder="Expense Amount" class="flex-1 border p-2 rounded mr-2" />
                <input type="text" name="description" placeholder="Description" class="flex-1 border p-2 rounded mr-2" />
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Expense</button>
            </form>

            <!-- Expenses Table -->
            <h3 class="text-xl font-semibold mb-4">Added Expenses</h3>
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left">Description</th>
                        <th class="border px-4 py-2 text-left">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                        <tr>
                            <td class="border px-4 py-2">{{ $expense['description'] }}</td>
                            <td class="border px-4 py-2">${{ number_format($expense['amount'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="2">No expenses added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Split Expense Button -->
            <form action="{{ route('split.expense') }}" method="POST" class="text-center mt-4">
                @csrf
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Split Expense Equally</button>
            </form>

            <!-- Display Split Amount -->
            @if(session('splitAmount'))
                <div class="text-center mt-4">
                    <p class="font-semibold">Each user should pay: <span class="text-green-500">${{ number_format(session('splitAmount'), 2) }}</span></p>
                </div>
            @endif

            <!-- Reset Group Button -->
            <form action="{{ route('reset.all') }}" method="POST" class="text-center mt-4">
                @csrf
                <button class="bg-blue-500 text-white px-4 py-2 rounded">Create New Group</button>
            </form>
        @endif
    </div>
</body>
</html>
