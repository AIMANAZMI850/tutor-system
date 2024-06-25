<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Tutor List</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #d7ebf5a6;
        }

        header {
            padding: 20px;
            background-color: #75caf8;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .w3-container {
            width: 100%;
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .card h4 {
            margin: 10px 0;
        }

        .card p {
            margin: 5px 0;
            color: #333;
        }

        .card button {
            margin: 5px 0;
        }

        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            max-width: 1000px;
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

    <header>
        <h2>Tutor Lists</h2>
        <div>
            <form method="GET" action="{{ route('userlist') }}" style="display:inline; margin-right: 10px;">
                @csrf
                <button type="submit" class="w3-button w3-round w3-blue">Back</button>
            </form>
            <form method="POST" action="{{ route('logout') }}" style="display:inline; margin-right: 10px;">
                @csrf
                <button type="submit" class="w3-button w3-round w3-red">Logout</button>
            </form>
        </div>
    </header>

    <div class="search-bar">
        <input type="text" id="searchInput" class="w3-input w3-border w3-round" placeholder="Search tutors..." onkeyup="searchTutor() ">
        <button class="w3-button w3-round w3-light-blue" onclick="document.getElementById('newtutor').style.display='block'; return false;">New Tutor</button>
    </div>

    <div class="w3-container">
        @foreach ($listTutor as $tutor)
        <div class="card" data-name="{{ $tutor->name }}">
            <img src="{{ asset('/asset/tutor1.jpg') }}" alt="Tutor Image">
            <h4>{{ $tutor->name }}</h4>
            <p>Email: {{ $tutor->email }}</p>
            <p>Phone: {{ $tutor->phone }}</p>
            <button class="w3-button w3-blue w3-round" onclick="editTutor('{{ $tutor->id }}', '{{ $tutor->name }}', '{{ $tutor->phone }}')">Edit</button>
            <button class="w3-button w3-red w3-round" onclick="deleteTutor('{{ $tutor->id }}')">Delete</button>
        </div>

        <div id="editTutorModal{{ $tutor->id }}" class="w3-modal w3-animate-opacity">
            <div class="w3-modal-content w3-round" style="width: 500px;">
                <header class="w3-container modal-header">
                    <span onclick="document.getElementById('editTutorModal{{ $tutor->id }}').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <h4>Edit Tutor</h4>
                </header>
                <div class="w3-padding modal-content">
                    <form method="POST" action="{{ route('tutor.update', $tutor->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <p><input class="w3-input w3-round w3-border" type="text" name="name" placeholder="Name" value="{{ $tutor->name }}" required></p>
                        <p><input class="w3-input w3-round w3-border" type="text" name="phone" placeholder="Phone" value="{{ $tutor->phone }}" required></p>
                        <button class="w3-button w3-blue w3-round" type="submit">Update</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <form id="deleteForm{{ $tutor->id }}" method="POST" action="{{ route('tutor.delete', $tutor->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
            @csrf
            @method('DELETE')
        </form>
        @endforeach
    </div>

    <div id="newtutor" class="w3-modal w3-animate-opacity">
        <div class="w3-modal-content w3-round" style="width: 500px;">
            <header class="w3-container modal-header">
                <span onclick="document.getElementById('newtutor').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h4>New Tutor Form</h4>
            </header>
            <div class="w3-padding modal-content">
                <form method="post" action="{{ route('saveTutor') }}" accept-charset="UTF-8" onsubmit="return confirm('Confirm to add this tutor?');">
                    {{ csrf_field() }}
                    <p><input class="w3-input w3-round w3-border" type="text" name="name" placeholder="Name" required></p>
                    <p><input class="w3-input w3-round w3-border" type="email" name="email" placeholder="Email" required></p>
                    <p><input class="w3-input w3-round w3-border" type="text" name="phone" placeholder="Phone"></p>
                    <button class="w3-button w3-red w3-round" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
    

    <script>
        function editTutor(id, name, phone) {
            document.getElementById('editTutorModal' + id).style.display = 'block';
            document.querySelector('#editTutorModal' + id + ' input[name="name"]').value = name;
            document.querySelector('#editTutorModal' + id + ' input[name="phone"]').value = phone;
        }

        function deleteTutor(id) {
            if (confirm('Are you sure you want to delete this tutor?')) {
                document.querySelector('#deleteForm' + id).submit();
            }
        }

        function searchTutor() {
            var input, filter, cards, cardContainer, h4, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toLowerCase();
            cardContainer = document.getElementsByClassName('w3-container')[0];
            cards = cardContainer.getElementsByClassName('card');

            for (i = 0; i < cards.length; i++) {
                h4 = cards[i].getElementsByTagName('h4')[0];
                if (h4) {
                    txtValue = h4.textContent || h4.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        cards[i].style.display = '';
                    } else {
                        cards[i].style.display = 'none';
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

