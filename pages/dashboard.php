<section class="rounded bg-white my-3 p-3">

  <h2 class="bg-ice text-white rounded p-3 mb-3">Daftar Buku di Perpustakaan</h2>

  <div class="rounded bg-light p-3 mb-3">
    <a href="/dashboard/add-book" class="btn btn-info">Tambah Buku</a>
    <a href="/logout" class="btn btn-outline-dark">Logout</a>
  </div>

  <div class="rounded shadow p-3">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Author</th>
          <th scope="col">Genre</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php
            require "./helper/db.php";

            $books = $db->query("SELECT * FROM book;");

            $i = 1;
            while($res = $books->fetchArray(SQLITE3_ASSOC)) {

                if(!isset($res['book_id'])) continue;

                echo "<tr>";
                echo "<th scope='row'>$i</th>";
                echo "<td>".$res["title"]."</td>";
                echo "<td>".$res["author"]."</td>";
                echo "<td>".$res["genre"]."</td>";
                echo "<td>
                        <a href='dashboard/update-book?id=".$res["book_id"]."' class='btn btn-outline-secondary'>Update</a>
                        <a href='dashboard/delete-book?id=".$res["book_id"]."' class='btn btn-outline-danger'>Hapus</a>
                      </td>";
                echo "</tr>";
                $i++;
            }            

          ?>


      </tbody>
    </table>
  </div>

</section>

