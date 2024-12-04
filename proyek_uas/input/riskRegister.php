<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form laporan</title>
</head>
<body>
    <h1>Form Laporan</h1>
    <h2>Fakultas</h2>
    <h3>Score/Nilai inherent Disk</h3>
    <table border="1">
        <tr>
            <th>likehood</th>
            <th>impact</th>
            <th>Level of resiko</th>
        </tr>
        <tr>
            <td>
                <form action="" method="post">
                    <input type="radio" name="nilai" id="">
                    <label for="nilai">1</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">2</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">3</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">4</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">5</label><br>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="radio" name="nilai" id="">
                    <label for="nilai">1</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">2</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">3</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">4</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">5</label><br>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="radio" name="nilai" id="">
                    <label for="nilai">1</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">2</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">3</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">4</label><br>
                    <input type="radio" name="nilai" id="">
                    <label for="dua">5</label><br>
                </form>
            </td>
        </tr>
    </table>
    <h3>Existing Contool</h3>
    <table border="1">
        <tr>
            <th>Ada/Tidak Ada</th>
            <th>Memadai/belum</th>
            <th>100%/ belum</th>
    
        </tr>
        <tr>
            <td>
                <form action="" method="post">
                    <input type="radio" name="memadai" id="">memadai
                    <input type="radio" name="memadai" id="">tidak memadai
                </form>
            </td>
            <td>
                <form action="" method="post">             
                    <input type="radio" name="memadai" id="">memadai
                    <input type="radio" name="memadai" id="">tidak memadai
                </form>
            </td>
            <td>
                <form action="" method="post"></form>
                <input type="radio" name="dijalankan" id="">dijalankan 100%
                </form>
            </td>
        </tr>
    </table>
    <h3>Risk Treatment</h3>
    <table border="1">
        <tr>
        <th>Opsi Perlakuan</th>
        <th>Deskripsi tindakan Mitigasi</th>
        </tr>
        <tr>
            <td>
                <select name="perlaukan" id="">
                <option value="accept">Accept</option>
                <option value="share">Share</option>
                <option value="reduce">Reduce</option>
                </select>
            </td>
            <td>
                <label for="deskripsi">Tindakan : </label>
                <input type="text" name="deskripsi">
            </td>
        </tr>
    </table>
    <br>
    <button type="submit">Save</button>
</body>
</html>