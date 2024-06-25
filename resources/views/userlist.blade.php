<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>User List</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #d7ebf5a6;
        }

        header {
            padding: 20px;
            background-color: #75caf8;
            color: black;
        }

        table, th, td {
            border: 3px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        th, td {
            padding: 20px;
        }

        @media screen and (max-width: 768px) {
            .w3-container {
                width: 100%;
            }
        }

        @media screen and (min-width: 768px) {
            .w3-container {
                width: 700px;
                margin: 0 auto;
            }
        }

        .modal-header {
            background-color: #D32F2F;
            color: white;
            padding: 15px;
        }

        .modal-content {
            padding: 20px;
        }

        .w3-button {
            margin: 5px 0;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination button {
            background-color: #f0f0f0;
            color: #333;
            border: none;
            padding: 10px 15px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .pagination button.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    @if (session('save'))
    <script>
        alert("Success");
    </script>
    @endif
    @if (session('error'))
    <script>
        alert("Failed");
    </script>
    @endif

    <header class="w3-center" style="display: flex; justify-content: space-between; align-items: center;">
        <h2>User Lists</h2>
        <div style="display: flex;">
            <form method="GET" action="{{ route('courselist') }}" style="display:inline; margin-right: 10px;">
                @csrf
                <button type="submit" class="w3-button w3-round w3-blue">Course</button>
            </form>
            <form method="GET" action="{{ route('tutorlist') }}" style="display:inline; margin-right: 10px;">
                @csrf
                <button type="submit" class="w3-button w3-round w3-blue">Tutor</button>
            </form>
            <form method="POST" action="{{ route('logout') }}" style="display:inline; margin-right: 10px;">
                @csrf
                <button type="submit" class="w3-button w3-round w3-red">Logout</button>
            </form>
        </div>
        
    </header>
    
    <div class="w3-padding" style="max-width: 1000px; margin: auto; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <input type="text" id="searchInput" class="w3-input w3-border w3-round" placeholder="Search users..." onkeyup="searchUsers()">
        </div>
        <div>
            <button class="w3-button w3-round w3-light-blue w3-margin" onclick="document.getElementById('newuser').style.display='block'; return false;">New User</button>
        </div>
    </div>
    
    <div class="w3-padding" style="max-width: 1000px; margin: auto;">
        <table class="w3-table w3-striped w3-bordered w3-light-green">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($listUser as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="w3-cell">
                            <form id="deleteForm{{ $user->id }}" method="POST" action="{{ route('user.delete', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                        <div id="editUserModal{{ $user->id }}" class="w3-modal w3-animate-opacity">
                            <div class="w3-modal-content w3-round" style="width: 500px;">
                                <header class="w3-container modal-header">
                                    <span onclick="document.getElementById('editUserModal{{ $user->id }}').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h4>Edit User</h4>
                                </header>
                                <div class="w3-padding modal-content">
                                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="POST">
                                        <p><input class="w3-input w3-round w3-border" type="text" name="name" placeholder="Name" value="{{ $user->name }}" required></p>
                                        <p><input class="w3-input w3-round w3-border" type="email" name="email" placeholder="Email" value="{{ $user->email }}" required></p>
                                        <p><input class="w3-input w3-round w3-border" type="password" name="password" placeholder="Password (leave blank for no change)"></p>
                                        <button class="w3-button w3-blue w3-round" type="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button class="w3-button w3-round w3-block w3-blue" onclick="editUser('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')">Edit</button>
                        <button class="w3-button w3-round w3-block w3-red" onclick="deleteUser('{{ $user->id }}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="newuser" class="w3-modal w3-animate-opacity">
        <div class="w3-modal-content w3-round" style="width: 500px;">
            <header class="w3-container modal-header">
                <span onclick="document.getElementById('newuser').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h4>New User Form</h4>
            </header>
            <div class="w3-padding modal-content">
                <form method="post" action="{{ route('saveuser') }}" accept-charset="UTF-8" onsubmit="return confirm('Confirm to add this user?');">
                    {{ csrf_field() }}
                    <p><input class="w3-input w3-round w3-border" type="text" name="name" placeholder="Name" required></p>
                    <p><input class="w3-input w3-round w3-border" type="email" name="email" placeholder="Email" required></p>
                    <p><input class="w3-input w3-round w3-border" type="password" name="password" placeholder="Password" required></p>
                    <button class="w3-button w3-red w3-round" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editUser(id, name, email, password) {
            document.getElementById('editUserModal' + id).style.display = 'block';
            document.querySelector('#editUserModal' + id + ' input[name="name"]').value = name;
            document.querySelector('#editUserModal' + id + ' input[name="email"]').value = email;
            document.querySelector('#editUserModal' + id + ' input[name="password"]').value = password;
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.querySelector('#deleteForm' + id).submit();
            }
        }

        function searchUsers() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toLowerCase();
            table = document.querySelector('.w3-table');
            tr = table.getElementsByTagName('tr');

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                td = tr[i].getElementsByTagName('td');
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Handle success or error alerts
            @if (session('save'))
            alert('Success');
            @endif

            @if (session('error'))
            alert('Failed');
            @endif
        });
    </script>
</body>

</html>
