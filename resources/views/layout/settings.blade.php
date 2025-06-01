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
            <td><input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required></td>
          </tr>
          <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="username">Username:</label>
            </td>
            <td>
              <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}"
                required>
            </td>
          </tr>
          <tr>
            <td><label for="picture">Foto Profil:</label></td>
            <td><input type="file" id="picture" name="picture"></td>
          </tr>
        </table>
        <button type="submit" class="btn btn-warning mt-2">Perbarui Profil</button>
      </form>
    </div>
  </div> <br>
  <a class="toggle-button mt-3 fs-5" data-toggle="collapse" href="#description2" role="button"
    aria-expanded="false" aria-controls="description2"> <i class="fas fa-chevron-right" id="icon2"></i> Kelola password
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
        <button type="submit" class="btn btn-warning mt-2">Perbarui Kata Sandi</button>
      </form>
    </div>
  </div>
</div>
<style>
  i,
  i:visited,
  .toggle-button {
    text-decoration: none;
    color: black;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $('.toggle-button').click(function () { var icon = $(this).find('i'); var isExpanded = $(this).attr('aria-expanded') === 'true'; icon.toggleClass('fa-chevron-right', isExpanded); icon.toggleClass('fa-chevron-down', !isExpanded); });
</script>