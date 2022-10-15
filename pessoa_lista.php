<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de pessoas</title>
    <link href="css/list.css" rel="stylesheet" type="text/css" media="screen"/>
</head>
<body>
    <?php
        $host     = '127.0.0.1';
        $user     = 'root';
        $password = '';
        $database = 'livro';

        $conn   = mysqli_connect($host, $user, $password, $database);

        if (!empty($_GET['action']) AND $_GET['action'] == 'delete') {
            $id     = (int) $_GET['id'];
            $result = mysqli_query($conn, "DELETE FROM pessoa WHERE id = '{$id}'");
        }

        $result = mysqli_query($conn, "SELECT * FROM pessoa ORDER BY id");

        print "<table border=1>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th> Id </th>
                        <th> Nome </th>
                        <th> Endereço </th>
                        <th> Bairro </th>
                        <th> Telefone </th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            print "<tr>
                        <td align='center'>
                            <a href='pessoa_form.php?action=edit&id={$id}'><img src='imagens/pencil.png' style='width:17px'></a>
                        </td>
                        <td align='center'>
                            <a href='pessoa_lista.php?action=delete&id={$id}'><img src='imagens/remove.png' style='width:17px'></a>
                        </td>
                        <td> {$id} </td>
                        <td> {$nome} </td>
                        <td> {$endereco} </td>
                        <td> {$bairro} </td>
                        <td> {$telefone} </td>
                    </tr>";
        }

        print "</tbody>
               </table>";
        
        mysqli_close($conn);
    ?>

    <button onclick="window.location='pessoa_form.php'">
        <img src="imagens/insert.png" style="width:17px;"> Inserir
    </button>
    
</body>
</html>