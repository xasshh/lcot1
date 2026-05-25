@include('layouts.header') 

       <!-- Hero Section -->
       <section class="page-hero">
        <div class="hero-content">
            <h1>Reference Form</h1>
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator">/</span>
                <a href="reference.html">Registration</a>
                <span class="separator">/</span>
                <span class="current">Reference Form</span>
            </div>
        </div>
    </section>
    
    <table class="reference-table">
        <thead>
            <tr>
                <th>Program Description</th>
                <th>Fill the Form below to start distributing your reference form to your Pastor and Friend. This applies to those who have purchased any of the programmes listed below and did not supply the email of the referee. Click on the download button to download the reference form.
                    The reference forms should be given to each of the referees, filled and sent back to the Registrar's office by the referees.
                </th>
            </tr>
        </thead>
        <table class="reference-table">
            <thead>
                <tr>
                    <th>Program Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $programs = [
                        ['name' => 'Bachelor of Theology', 'price' => 100],
                        ['name' => 'Certificate in Christian Ministry', 'price' => 2500],
                        ['name' => 'Certificate in Music', 'price' => 2000],
                        ['name' => 'Diploma in Music', 'price' => 2800],
                        ['name' => 'Diploma in Theology', 'price' => 3200],
                    ];
                @endphp
        
                @foreach ($programs as $program)
                <tr>
                    <td>{{ $program['name'] }}</td>
                    <td>
                        <form action="{{ route('reference.pay') }}" method="POST">
                            @csrf
                            <input type="hidden" name="program" value="{{ $program['name'] }}">
                            <input type="hidden" name="amount" value="{{ $program['price'] }}">
                            <button type="submit" class="buy-btn">
                                <i class="fas fa-download"></i> Buy Form (₦{{ number_format($program['price']) }})
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

@include('layouts.footer') 