<?php
@session_start();
error_reporting(0);

if (isset($_POST['auth_db'])) {
    $_SESSION['h'] = $_POST['h']; $_SESSION['u'] = $_POST['u'];
    $_SESSION['p'] = $_POST['p']; $_SESSION['n'] = $_POST['n'];
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: ?"); exit; }

$active = false;
if (isset($_SESSION['h'])) {
    $conn = @new mysqli($_SESSION['h'], $_SESSION['u'], $_SESSION['p'], $_SESSION['n']);
    if (!$conn->connect_error) { $active = true; $conn->set_charset("utf8"); }
}

$msg = "";
if ($active) {
    if (isset($_GET['del']) && isset($_GET['tbl']) && isset($_GET['pk'])) {
        $tbl = $conn->real_escape_string($_GET['tbl']);
        $pk  = $conn->real_escape_string($_GET['pk']);
        $id  = $conn->real_escape_string($_GET['del']);
        if ($conn->query("DELETE FROM `$tbl` WHERE `$pk` = '$id'")) {
            $msg = "SYSTEM: Target record eliminated.";
        } else { $msg = "ERROR: " . $conn->error; }
    }

    if (isset($_POST['update_rec'])) {
        $tbl = $_POST['tbl']; $pk = $_POST['pk']; $id = $_POST['id'];
        $col = $_POST['col']; $val = $conn->real_escape_string($_POST['new_val']);
        if($conn->query("UPDATE `$tbl` SET `$col` = '$val' WHERE `$pk` = '$id'")) $msg = "SYSTEM: Data modification successful.";
    }

    if (isset($_POST['insert_data'])) {
        $tbl = $_POST['tbl_name'];
        $cols = implode("`, `", array_keys($_POST['fields']));
        $vals = implode("', '", array_map([$conn, 'real_escape_string'], array_values($_POST['fields'])));
        if($conn->query("INSERT INTO `$tbl` (`$cols`) VALUES ('$vals')")) $msg = "SYSTEM: New data injected.";
    }

    if (isset($_POST['run_sql']) && !empty($_POST['sql_cmd'])) {
        if ($conn->multi_query($_POST['sql_cmd'])) $msg = "SYSTEM: SQL sequence executed.";
        else $msg = "SQL FAULT: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>CYBER STUDIO PRO | RED & BLACK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --main-red: #ff0000; --dark-red: #8b0000; --bg: #000000; --panel: #0a0a0a; --border: #1a1a1a; --text: #cccccc; }
        body { margin: 0; background: var(--bg); color: var(--text); font-family: 'Consolas', 'Courier New', monospace; display: flex; height: 100vh; overflow: hidden; }
        
        /* Sidebar */
        aside { width: 280px; background: var(--panel); border-right: 2px solid var(--dark-red); display: flex; flex-direction: column; }
        .side-header { padding: 25px; border-bottom: 1px solid var(--border); background: #050505; text-align: center; }
        .tbl-list { flex: 1; overflow-y: auto; padding: 10px; }
        .tbl-item { display: flex; align-items: center; padding: 12px; color: #555; text-decoration: none; border-radius: 0; margin-bottom: 2px; font-size: 13px; border-left: 3px solid transparent; transition: 0.3s; }
        .tbl-item:hover, .tbl-item.active { background: #111; color: var(--main-red); border-left: 3px solid var(--main-red); }
        .tbl-item i { margin-right: 10px; }

        /* Content */
        main { flex: 1; overflow-y: auto; padding: 25px; background: radial-gradient(circle at center, #0a0000 0%, #000 100%); }
        .card { background: rgba(10, 10, 10, 0.9); border: 1px solid var(--border); border-radius: 0; margin-bottom: 25px; padding: 20px; box-shadow: 0 0 15px rgba(255, 0, 0, 0.05); }
        .card-title { font-weight: bold; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; color: var(--main-red); text-transform: uppercase; letter-spacing: 2px; }
        
        input, textarea, select { background: #000; border: 1px solid var(--dark-red); color: var(--main-red); padding: 12px; border-radius: 0; width: 100%; box-sizing: border-box; font-family: inherit; }
        input:focus { outline: none; box-shadow: 0 0 10px var(--dark-red); }
        
        .btn { background: var(--dark-red); color: #fff; border: none; padding: 10px 20px; cursor: pointer; font-weight: bold; text-transform: uppercase; transition: 0.3s; }
        .btn:hover { background: var(--main-red); box-shadow: 0 0 15px var(--main-red); }
        .btn-outline { background: transparent; border: 1px solid var(--dark-red); color: var(--main-red); font-size: 11px; padding: 5px 10px; margin: 2px; cursor: pointer; }
        
        /* Table */
        .table-container { overflow-x: auto; border: 1px solid var(--border); }
        table { width: 100%; border-collapse: collapse; background: #000; font-size: 12px; }
        th { background: #050505; color: var(--main-red); padding: 15px; text-align: left; border-bottom: 2px solid var(--dark-red); text-transform: uppercase; }
        td { padding: 12px; border-bottom: 1px solid var(--border); }
        tr:hover td { background: #080000; color: #fff; }
        
        .msg-box { border: 1px solid var(--main-red); background: rgba(255, 0, 0, 0.05); color: var(--main-red); padding: 15px; margin-bottom: 20px; border-left: 5px solid var(--main-red); }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: var(--dark-red); }
    </style>
</head>
<body>

<?php if (!$active): ?>
    <div style="margin: auto; width: 380px;">
        <div class="card" style="border: 2px solid var(--main-red);">
            <h2 style="text-align:center; color: var(--main-red); letter-spacing: 5px;">ACCESS GRANTED</h2>
            <form method="post">
                <input type="text" name="h" placeholder="HOST" value="localhost"><br><br>
                <input type="text" name="u" placeholder="USER"><br><br>
                <input type="password" name="p" placeholder="PASSWORD"><br><br>
                <input type="text" name="n" placeholder="DATABASE"><br><br>
                <button type="submit" name="auth_db" class="btn" style="width:100%;">INITIALIZE</button>
            </form>
        </div>
    </div>
<?php else: ?>

    <aside>
        <div class="side-header">
            <h3 style="margin:0; color:var(--main-red); letter-spacing:3px;">CYBER STUDIO</h3>
            <small style="color:#444;">DATABASE: <?= $_SESSION['n'] ?></small>
        </div>
        <div class="tbl-list">
            <?php
            $res = $conn->query("SHOW TABLES");
            while($row = $res->fetch_array()) {
                $t = $row[0];
                $act = (isset($_GET['tbl']) && $_GET['tbl'] == $t) ? 'active' : '';
                echo "<a href='?tbl=$t' class='tbl-item $act'><i class=\"fas fa-skull\"></i> $t</a>";
            }
            ?>
        </div>
        <div style="padding:20px; border-top:1px solid var(--border);">
            <a href="?logout=1" style="color:var(--main-red); text-decoration:none; font-size:12px; font-weight:bold;">[ TERMINATE SESSION ]</a>
        </div>
    </aside>

    <main>
        <?php if($msg): ?>
            <div class="msg-box">> <?= $msg ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-title"><i class="fas fa-code"></i> TERMINAL</div>
            <div style="margin-bottom:10px;">
                <button class="btn-outline" onclick="setCmd('SELECT * FROM `table` LIMIT 100')">SELECT</button>
                <button class="btn-outline" onclick="setCmd('UPDATE `table` SET `col`=\'val\' WHERE `id`=1')">UPDATE</button>
                <button class="btn-outline" onclick="setCmd('DROP TABLE `table`')">DROP</button>
                <button class="btn-outline" onclick="setCmd('UPDATE wp_users SET user_pass = MD5(\'123456\') WHERE ID = 1')">WP-RESET</button>
            </div>
            <form method="post">
                <textarea id="sql_box" name="sql_cmd" style="height:100px; margin-bottom:15px;" placeholder="INPUT SQL COMMAND..."></textarea>
                <button type="submit" name="run_sql" class="btn">EXECUTE</button>
            </form>
        </div>

        <?php if (isset($_GET['tbl'])): 
            $tbl = $_GET['tbl'];
            $res_meta = $conn->query("SELECT * FROM `$tbl` LIMIT 1");
            $meta = $res_meta->fetch_fields();
            $pk = (isset($meta[0])) ? $meta[0]->name : "id";
            $q = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : "";
            $where = "";
            if ($q) {
                $conds = [];
                foreach($meta as $m) $conds[] = "`{$m->name}` LIKE '%$q%'";
                $where = " WHERE " . implode(" OR ", $conds);
            }
            $data = $conn->query("SELECT * FROM `$tbl` $where LIMIT 100");
        ?>
            <div class="card">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <div class="card-title" style="margin:0;"><i class="fas fa-database"></i> ENCRYPTED_DATA: <?= $tbl ?></div>
                    <form method="get" style="width:250px;">
                        <input type="hidden" name="tbl" value="<?= $tbl ?>">
                        <input type="text" name="search" placeholder="FILTER..." value="<?= htmlspecialchars($q) ?>">
                    </form>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach($meta as $m) echo "<th>{$m->name}</th>"; ?>
                                <th style="width:50px; color:var(--main-red);">CMD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $data->fetch_assoc()): ?>
                                <tr>
                                    <?php foreach($row as $col => $val): ?>
                                        <td onclick="openEdit('<?= $tbl ?>', '<?= $pk ?>', '<?= $row[$pk] ?>', '<?= $col ?>', '<?= addslashes($val) ?>')">
                                            <?= htmlspecialchars($val) ?>
                                        </td>
                                    <?php endforeach; ?>
                                    <td style="text-align:center;">
                                        <a href="?tbl=<?=$tbl?>&del=<?=$row[$pk]?>&pk=<?=$pk?>" style="color:var(--main-red);" onclick="return confirm('DELETE PERMANENTLY?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.95); justify-content:center; align-items:center; z-index:9999;">
        <form method="post" class="card" style="width:500px; border: 1px solid var(--main-red);">
            <h3 id="edTitle" style="color:var(--main-red); margin-top:0;">OVERWRITE FIELD</h3>
            <input type="hidden" name="tbl" id="edTbl">
            <input type="hidden" name="pk" id="edPk">
            <input type="hidden" name="id" id="edId">
            <input type="hidden" name="col" id="edCol">
            <textarea name="new_val" id="edVal" style="height:150px; margin-bottom:20px; border-color:var(--main-red);"></textarea>
            <div style="display:flex; gap:10px;">
                <button type="submit" name="update_rec" class="btn" style="flex:1;">COMMIT</button>
                <button type="button" class="btn" style="flex:1; background:#111;" onclick="closeEdit()">ABORT</button>
            </div>
        </form>
    </div>

    <script>
        function setCmd(c) { document.getElementById('sql_box').value = c; }
        function openEdit(tbl, pk, id, col, val) {
            document.getElementById('editModal').style.display = 'flex';
            document.getElementById('edTbl').value = tbl;
            document.getElementById('edPk').value = pk;
            document.getElementById('edId').value = id;
            document.getElementById('edCol').value = col;
            document.getElementById('edVal').value = val;
            document.getElementById('edTitle').innerText = "EDITING NODE: " + col;
        }
        function closeEdit() { document.getElementById('editModal').style.display = 'none'; }
    </script>
<?php endif; ?>
</body>
</html>