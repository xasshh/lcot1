<x-app-layout>
    <style>
        /* dashboard.css */

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h1, h2, h3, h4 {
            letter-spacing: 0.5px;
        }

        .shadow-md, .shadow-lg {
            transition: all 0.3s ease-in-out;
        }

        .shadow-md:hover, .shadow-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        table th {
            background: linear-gradient(to right, #f76f6f, #f70404);
            color: white;
        }

        table td, table th {
            padding: 10px;
            border: 1px solid #e5e7eb;
        }

        img.rounded-full {
            border: 3px solid #f0202b;
            transition: transform 0.3s ease-in-out;
        }

        img.rounded-full:hover {
            transform: scale(1.05);
        }

        img.rounded-full {
    width: 6rem;      /* Same as w-24 */
    height: 6rem;     /* Same as h-24 */
    border-radius: 9999px;
    object-fit: cover;
}


        a {
            transition: color 0.3s ease-in-out, background 0.3s ease-in-out;
        }

        a:hover {
            text-decoration: none;
            color: #ca3844;
        }

        .progress-bar {
            background: linear-gradient(to right, #10b981, #34d399);
            height: 12px;
            border-radius: 9999px;
        }

        .card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            background-color: #f70404;
        }

    </style>
    <head>
    </head>
    <div class="flex min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200">
        <!-- Sidebar -->
        <aside class="w-80  text-black flex flex-col sidebar p-6 shadow-lg">
            <div class="text-3xl font-bold mb-10 tracking-wide">Student Portal</div>
            <nav class="flex flex-col gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2  p-3 rounded-lg transition-all font-medium">🏠 Home</a>
                <a href="#" class="flex items-center gap-2 0 p-3 rounded-lg transition-all font-medium">📚 Courses</a>
                <a href="#" class="flex items-center gap-2  p-3 rounded-lg transition-all font-medium">⚙️ Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Welcome Header -->
            <div class="bg-red-600 text-black p-6 rounded-2xl shadow-md mb-8">
                <h1 class="text-4xl font-bold">Welcome, {{ auth()->user()->name }}</h1>
                <p class="text-lg mt-1 opacity-90">Here's your current academic overview.</p>
            </div>

            <!-- Grid Cards -->
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6 mb-8">
                <!-- Profile Card -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <div class="flex items-center gap-4">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="w-24 h-24 rounded-full object-cover border-4 border-indigo-500">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">No Photo</div>
                        @endif
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-500">Matric No: {{ auth()->user()->matric_number }}</p>
                            <p class="text-sm text-gray-500">Level: {{ auth()->user()->level }}</p>
                            <p class="text-sm text-gray-500">Program: {{ auth()->user()->program }}</p>
                        </div>
                    </div>
                </div>

                <!-- Academic Progress -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Academic Progress</h4>
                    <p>GPA: <span class="font-bold text-indigo-600">{{ auth()->user()->gpa }}</span></p>
                    <p>CGPA: <span class="font-bold text-indigo-600">{{ auth()->user()->cgpa }}</span></p>
                    <div class="w-full bg-gray-200 h-3 rounded-full mt-2">
                        <div class="h-3 rounded-full bg-green-500" style="width: 80%"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">80% completed</p>
                </div>

                <!-- Tuition Info -->
                {{-- <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Fees & Payments</h4>
                    <p>Balance: <span class="text-2xl font-bold text-red-600">₦{{ number_format(auth()->user()->tuition_balance, 2) }}</span></p>
                    <a href="#" class="block mt-3 text-sm text-white bg-indigo-600 px-4 py-2 rounded hover:bg-indigo-700 transition w-fit">Pay Now</a>
                    <a href="#" class="block text-sm text-gray-500 hover:underline mt-1">Download Receipt</a>
                </div> --}}
            </div>

            <!-- Courses Table -->
            <div class="bg-white p-6 rounded-2xl shadow mb-8">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Enrolled Courses</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border text-left">Course Title</th>
                                <th class="p-2 border text-left">Code</th>
                                <th class="p-2 border text-left">Instructor</th>
                                <th class="p-2 border text-left">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->courses as $course)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-2 border">{{ $course->title }}</td>
                                    <td class="p-2 border">{{ $course->code }}</td>
                                    <td class="p-2 border">{{ $course->instructor }}</td>
                                    <td class="p-2 border">{{ $course->unit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Timetables -->
            @php
                function renderTimetable($timetableText) {
                    $rows = explode("\n", trim($timetableText));
                    $html = '<table class="w-full table-auto border text-sm">';
                    foreach($rows as $i => $row) {
                        $columns = array_map('trim', explode('|', $row));
                        $html .= '<tr>';
                        foreach($columns as $col) {
                            $tag = $i === 0 ? 'th' : 'td';
                            $html .= "<$tag class='border px-2 py-1'>$col</$tag>";
                        }
                        $html .= '</tr>';
                    }
                    $html .= '</table>';
                    return $html;
                }
            @endphp

            <div class="bg-white p-6 rounded-2xl shadow mb-8">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Timetables</h4>

                <p class="font-medium text-gray-600">Course Timetable:</p>
                <div class="bg-gray-100 p-4 rounded mt-2 overflow-auto">
                    {!! renderTimetable(auth()->user()->course_timetable) !!}
                </div>

                <p class="font-medium text-gray-600 mt-6">Exam Timetable:</p>
                <div class="bg-gray-100 p-4 rounded mt-2 overflow-auto">
                    {!! renderTimetable(auth()->user()->exam_timetable) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
