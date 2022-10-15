
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de pessoa</title>
    <link href="css/form.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
    <?php 
        $id = $nome = $endereco = $bairro = $telefone = $email = $id_cidade = '';

        if (!empty($_REQUEST['action'])) {
            $host     = '127.0.0.1';
            $user     = 'root';
            $password = '';
            $database = 'livro';
            $conn     = mysqli_connect($host, $user, $password, $database);

            if ($_REQUEST['action'] == 'edit') {
                $id     = (int) $_GET['id'];
                $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id = '{$id}'");

                if ($row = mysqli_fetch_assoc($result)) {
                    $id        = $row['id']; 
                    $nome      = $row['nome'];
                    $endereco  = $row['endereco'];
                    $bairro    = $row['bairro'];
                    $telefone  = $row['telefone'];
                    $email     = $row['email'];
                    $id_cidade = $row['id_cidade'];
                }
            } else if ($_REQUEST['action'] == 'save') {
                $id        = (int) $_POST['id'];
                $nome      = $_POST['nome'];
                $endereco  = $_POST['endereco'];
                $bairro    = $_POST['bairro'];
                $telefone  = $_POST['telefone'];
                $email     = $_POST['email'];
                $id_cidade = $_POST['id_cidade'];

                if (empty($_POST['id'])) {
                    $result = mysqli_query($conn, 'SELECT MAX(id) as next FROM pessoa');
                    $id     = (int) mysqli_fetch_assoc($result)['next'] + 1;
                    $result = mysqli_query($conn, "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) VALUE ('{$id}', '{$nome}', '{$endereco}', '{$bairro}', '{$telefone}', '{$email}', '{$id_cidade}')");                  
                } else {
                    $result = mysqli_query($conn, "UPDATE pessoa SET nome = '{$nome}', endereco = '{$endereco}', bairro = '{$bairro}', telefone = '{$telefone}', email = '{$email}', id_cidade = '{$id_cidade}' WHERE id = '{$id}'");
                }
            }
            
            print ($result) ? 'Registro salvo com sucesso.' : $result;
            mysqli_close($conn);
        }
    ?>    

    <form enctype="multipart/form-data" method="post" action="pessoa_form.php?action=save">
        <label>Código</label>
        <input id="id" name="id" type="text" readonly="1" style="width: 30%" value="<?=$id?>">
        <label>Nome</label>
        <input id="nome" name="nome" type="text"  style="width: 50%" value="<?=$nome?>">
        <label>Endereço</label>
        <input id="endereco" name="endereco" type="text"  style="width: 50%" value="<?=$endereco?>">
        <label>Bairro</label>
        <input id="bairro" name="bairro" type="text"  style="width: 25%" value="<?=$bairro?>">
        <label>Telefone</label>
        <input id="telefone" name="telefone" type="text"  style="width: 25%" value="<?=$telefone?>">
        <label>Email</label>
        <input id="email" name="email" type="text"  style="width: 25%" value="<?=$email?>">
        <label>Cidade</label>
        <select id="id_cidade" name="id_cidade">
            <?php 
                require_once "lista_combo_cidades.php";
                print lista_combo_cidades($id_cidade);
            ?>
        </select>
        <input type="submit">
    </form>

</body>
</html>