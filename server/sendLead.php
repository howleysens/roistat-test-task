<?php
require_once 'autoload.php';
require_once 'config.php';

use Classes\ApiClient;
use Classes\Validator;

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$isSpentTimeOut = $_POST['spentTime'];
$price = $_POST['price'];

$errors = Validator::validate($name, $email, $phone, $price, $isSpentTimeOut);

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
    echo "<a href='/' style='padding: 5px; background: gray;'>Back</a>";
    exit();
}

function createJsonData($name, $email, $phone, $isSpentTimeOut, $price)
{
    return [
        [
            'price' => (int)$price,
            'created_by' => 0,
            'custom_fields_values' => [
                [
                    'field_id' => 76633,
                    'values' => [
                        [
                            'value' => $isSpentTimeOut,
                        ]
                    ]
                ]
            ],
            '_embedded' => [
                'contacts' => [
                    [
                        'name' => $name,
                        'custom_fields_values' => [
                            [
                                'field_code' => 'PHONE',
                                'values' => [
                                    [
                                        'value' => $phone,
                                    ]
                                ]
                            ],
                            [
                                'field_code' => 'EMAIL',
                                'values' => [
                                    [
                                        'value' => $email,
                                    ]
                                ]
                            ]
                        ],
                    ],
                ]
            ]
        ]
    ];
}


$jsonData = createJsonData($name, $email, $phone, $isSpentTimeOut, $price);
$client = new ApiClient($url, $client_secret);
$result = $client->sendRequest($jsonData);

echo "Response Code: " . $result['httpcode'];
echo "Response Body: " . $result['response'];
echo "<a href='/' style='padding: 5px; background: gray;'>Back</a>"

?>
