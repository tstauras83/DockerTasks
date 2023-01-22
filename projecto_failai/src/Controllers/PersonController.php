<?php

namespace tstauras83\Controllers;

use tstauras83\Configs;
use tstauras83\Database;
use tstauras83\FS;
use tstauras83\Validator;

class PersonController
{
    public function index(): string
    {
        $config = new Configs();
        $db = new Database($config);

        $limiter = $_GET['amount'] ?? 10;
        $people = $db->query('SELECT * FROM persons ORDER BY id DESC LIMIT ' . $limiter);

        $rez = '<table class="table table-striped table-hover table-dark">
        <tr>
        <th scope="col">ID: </th>
        <th scope="col">First Name: </th>
        <th scope="col">Last Name: </th>
        <th scope="col">Email: </th>
        <th scope="col">Persona Code: </th>
        <th scope="col">Phone: </th>
        <th scope="col">Address ID: </th>
        <th scope="col">Actions: </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        </tr>';

        foreach ($people as $data) {
            $rez .= '<tr>';
            $rez .= '<th scope="row">' . $data['id'] . '</th>';
            $rez .= '<td>' . $data['first_name'] . '</td>';
            $rez .= '<td>' . $data['last_name'] . '</td>';
            $rez .= "<td><a href='mailto:{$data['email']}'>{$data['email']}</a></td>";
            $rez .= '<td>' . $data['code'] . '</td>';
            $rez .= "<td><a href='tel:{$data['phone']}'>{$data['phone']}</a></td>";
            $rez .= '<td>' . $data['address_id'] . '</td>';
            $rez .= "<td><a href='/person/view?id={$data['id']}'>View</a></td>";
            $rez .= "<td><a href='/person/edit?id={$data['id']}'>Update</a></td>";
            $rez .= "<td><a href='/person/delete?id={$data['id']}'>Delete</a></td>";
            $rez .= '</tr>';
        }
        $rez .= '</table>';

        $fileSystem = new FS('../src/html/person.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{body}}", $rez, $fileContent);

        return $fileContent;
    }

    public function new()
    {

        $fileSystem = new FS('../src/html/new_persons.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);

        return $fileContent;


/*        $fileSystem = new FS('../src/html/new_persons.html');
        $fileContent = $fileSystem->getFileContents();
        return $fileContent;*/
    }

    public function store()
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $address_id = $_POST['address_id'];

        Validator::required($first_name);
        Validator::required($last_name);
        Validator::required($email);
        Validator::email($email);
        Validator::required($code);
        Validator::required($phone);
        Validator::phone($phone);
        Validator::required($address_id);
        Validator::numeric($address_id);
        Validator::numeric($code);
        Validator::personalcode($code);

        $conf = new Configs();
        $conn = new Database($conf);

        $conn->query(
            "INSERT INTO `persons` (`first_name`, `last_name`, `email`, `code`,`phone`, `address_id`)
                    VALUES (:first_name, :last_name, :email, :code, :phone, :address_id)",
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'code' => $code,
                'phone' => $phone,
                'address_id' => $address_id
            ]
        );

        echo "New record created successfully";
    }

    public function delete()
    {
        $kuris = (int)$_GET['id'] ?? null;

        Validator::required($kuris);
        Validator::numeric($kuris);
        Validator::min($kuris, 1);

        $conf = new Configs();
        $db = new Database($conf);

        $db->query("DELETE FROM `persons` WHERE `id` = '$kuris'");

        return "Record deleted successfully";
    }

    public function edit()
    {
        $fileSystem = new FS('../src/html/update_persons.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);

        $id = (int)$_GET['id'] ?? null;

        $conf = new Configs();
        $db = new Database($conf);

        $person = $db->query("select `id`,`first_name`, `last_name`,`email`, `code`, `phone`, `address_id` from  `persons` where `id` = :id",
            ['id' => $id]);

        $id = $person[0]['id'];
        $first_name = $person[0]['first_name'];
        $last_name = $person[0]['last_name'];
        $email = $person[0]['email'];
        $code = $person[0]['code'];
        $phone = $person[0]['phone'];
        $address_id = $person[0]['address_id'];

        $fileContent = str_replace("{{id}}", $id, $fileContent);
        $fileContent = str_replace("{{first_name}}", $first_name, $fileContent);
        $fileContent = str_replace("{{last_name}}", $last_name, $fileContent);
        $fileContent = str_replace("{{email}}", $email, $fileContent);
        $fileContent = str_replace("{{code}}", $code, $fileContent);
        $fileContent = str_replace("{{phone}}", $phone, $fileContent);
        $fileContent = str_replace("{{address_id}}", $address_id, $fileContent);
        return $fileContent;
    }

    public function update()
    {
        $id = (int)$_POST['id'] ?? null;
        $first_name = (string)$_POST['first_name'] ?? null;
        $last_name = (string)$_POST['last_name'] ?? null;
        $email = (string)$_POST['email'] ?? null;
        $code = (int)$_POST['code'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $address_id = (int)$_POST['address_id'] ?? null;

        Validator::required($id);
        Validator::required($first_name);
        Validator::required($last_name);
        Validator::required($email);
        Validator::email($email);
        Validator::required($code);
        Validator::personalcode($code);
        Validator::numeric($code);
        Validator::required($phone);
        Validator::phone($phone);
        Validator::required($address_id);
        Validator::numeric($address_id);
        Validator::numeric($id);
        Validator::min($id, 1);

        $conf = new Configs();
        $db = new Database($conf);

        $db->query("update `persons` set `first_name` = :first_name, `last_name` = :last_name,
                     `email` = :email, `code` = :code, `phone` = :phone, `address_id` = :address_id
                 where `id` = :id",
            [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'code' => $code,
                'phone' => $phone,
                'address_id' => $address_id
            ]);
        return 'success';
    }

    public function view()
    {
        $fileSystem = new FS('../src/html/view_persons.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $id = (int)$_GET['id'] ?? null;

        $conf = new Configs();
        $db = new Database($conf);

        $person = $db->query("select `id`,`first_name`, `last_name`,`email`, `code`, `phone`, `address_id` from  `persons` where `id` = :id",
        ['id' => $id]);

        $id = $person[0]['id'];
        $first_name = $person[0]['first_name'];
        $last_name = $person[0]['last_name'];
        $email = $person[0]['email'];
        $code = $person[0]['code'];
        $phone = $person[0]['phone'];
        $address_id = $person[0]['address_id'];

        $fileContent = str_replace("{{id}}", $id, $fileContent);
        $fileContent = str_replace("{{first_name}}", $first_name, $fileContent);
        $fileContent = str_replace("{{last_name}}", $last_name, $fileContent);
        $fileContent = str_replace("{{email}}", $email, $fileContent);
        $fileContent = str_replace("{{code}}", $code, $fileContent);
        $fileContent = str_replace("{{phone}}", $phone, $fileContent);
        $fileContent = str_replace("{{address_id}}", $address_id, $fileContent);
        return $fileContent;
    }
}


