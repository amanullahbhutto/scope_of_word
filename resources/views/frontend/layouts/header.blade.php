<style>
  /* Navbar Styles */
  .navbar {
    background-color: #ffffff; /* White background for a clean look */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: all 0.3s ease;
  }

  .navbar-brand img {
    height: 50px;
  }

  .navbar-toggler {
    border: none;
    outline: none;
  }

  .navbar-toggler-icon {
    background-image: url('https://cdn-icons-png.flaticon.com/512/1828/1828859.png'); /* Custom icon for toggler */
    background-size: contain;
    width: 30px;
    height: 30px;
  }

  .navbar-nav .nav-link {
    color: #555; /* Neutral color for links */
    font-size: 16px;
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 30px; /* Rounded corners for better appearance */
    transition: all 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    {{--  text-transform: uppercase;  --}}
    color: #fff;
    background-color: #2F4F94; /* Primary hover color */
    box-shadow: 0 4px 8px rgba(47, 79, 148, 0.3); /* Subtle shadow on hover */
  }

  .navbar-nav .nav-link.active {
    color: #fff;
    background-color: #007bff; /* Active link color */
    font-weight: bold;
    box-shadow: 0 3px 6px rgba(0, 123, 255, 0.4); /* Add depth to active links */
  }

  /* Responsive Adjustments */
  @media (max-width: 992px) {
    .navbar-nav {
      text-align: center;
    }

    .navbar-nav .nav-link {
      margin-bottom: 10px; /* Space between items in mobile view */
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('images/stepon-logos-R-01.png') }}" alt="Logo">
    </a>

    <!-- Toggler for mobile view -->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link yyy" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Adopted School</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('school.adopte') }}">Request For Monitoring School</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
