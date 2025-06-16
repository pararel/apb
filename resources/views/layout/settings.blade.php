<div class="p-2 mx-3">
  <a class="toggle-button fs-5" data-toggle="collapse" href="#description1" role="button" aria-expanded="false"
    aria-controls="description1"> <i class="fas fa-chevron-right" id="icon1"></i> Edit profil </a>
  <div class="collapse mt-3" id="description1">
    <div class="">
      <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table>
          <tr>
            <td><label for="name">Nama:</label></td>
            <td><input type="text" id="name" name="name"></td>
          </tr>
          <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email">
            </td>
          </tr>
          <tr>
            <td>
              <label for="username">Username:</label>
            </td>
            <td>
              <input type="text" id="username" name="username">
            </td>
          </tr>
        </table>
        <button type="submit" class="btn btn-primary mt-2">Perbarui Profil</button>
      </form>
    </div>
  </div> <br>
  <a class="toggle-button mt-3 fs-5" data-toggle="collapse" href="#description2" role="button" aria-expanded="false"
    aria-controls="description2"> <i class="fas fa-chevron-right" id="icon2"></i> Kelola password
  </a>
  <div class="collapse mt-3" id="description2">
    <div class="">
      <form action="{{ route('updatePassword') }}" method="POST">
        @csrf
        <table>
          <tr>
            <td>
              <label for="new_password">Kata Sandi Baru:</label>
            </td>
            <td>
              <input type="password" id="new_password" name="new_password" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="confirm_password">Kata Sandi Sebelumnya:</label>
            </td>
            <td>
              <input type="password" id="current_password" name="current_password" required>
            </td>
          </tr>
        </table>
        <button type="submit" class="btn btn-primary mt-2">Perbarui Kata Sandi</button>
      </form>
    </div>
  </div>
</div>

<style>
  body {
    background-color: #F0F0F0; 
  }

  .p-2.mx-3 {
    background-color: #FFFFFF; /* Secondary color for content background */
    border-radius: 8px; /* Slightly rounded corners */
    padding: 20px; /* More padding for better spacing */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  }

  i,
  i:visited,
  .toggle-button {
    text-decoration: none;
    color: #615D5D; /* Neutral color for text, slightly darker for better readability */
    font-weight: bold;
    display: block; /* Make the whole area clickable */
    padding: 10px 0; /* Padding for click area */
    transition: color 0.3s ease;
  }

  .toggle-button:hover {
    color: #000000; /* Darker on hover */
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #D9D9D9; /* Light grey for input borders */
    border-radius: 4px;
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
  }

  input[type="text"]:focus,
  input[type="email"]:focus,
  input[type="password"]:focus {
    border-color: #007AFF; /* Primary color on focus */
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Bootstrap-like focus shadow */
  }

  /* Label styling */
  label {
    color: #000000; 
    font-weight: normal;
  }

  /* Table styling for forms */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
  }

  table td {
    padding: 8px 0;
    vertical-align: top; 
  }

  table td:first-child {
    width: 30%; 
    padding-right: 10px;
  }

  /* Button styling */
  .btn-primary {
    background-color: #007AFF; /* Primary color for buttons */
    color: #FFFFFF; /* White text on buttons */
    border: 1px solid #007AFF; /* Border matching background */
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0056b3; /* Slightly darker blue on hover */
    border-color: #0056b3;
  }

  /* Collapse animation adjustments */
  .collapse {
    transition: height 0.3s ease-in-out;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $('.toggle-button').click(function () {
    var icon = $(this).find('i');
    var isExpanded = $(this).attr('aria-expanded') === 'true';
    icon.toggleClass('fa-chevron-right', isExpanded);
    icon.toggleClass('fa-chevron-down', !isExpanded);
  });
</script>