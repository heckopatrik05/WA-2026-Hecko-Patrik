<?php
$name = "";
$age = 0;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    if ($name == "admin") {
        $message = "Welcome, admin!";
    } else {
        $message = "Neznám te!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST["age"];
    if ($age < 18) {
        $message .= " You are a minor.";
    } else {
        $message .= " You are an adult.";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Test PHP</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor veniam, amet ipsam magnam unde rerum consequatur sit maiores, eum ea nisi fugit atque dicta molestias qui excepturi non nam explicabo.</p>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. A soluta molestias vero aliquid, explicabo, doloribus praesentium voluptatem consequuntur, alias harum aspernatur quasi cum numquam. Perferendis ex aliquid sed magni natus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi itaque alias a placeat ea, cumque sunt, voluptatem nulla dolore porro aliquam fuga error cupiditate, voluptas mollitia ratione sint non quasi.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam corrupti rerum doloremque commodi enim provident perspiciatis harum, eaque reprehenderit, voluptatibus eligendi earum assumenda animi delectus non! Dolorum nihil officiis voluptatibus.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam aperiam temporibus, placeat aut quos sequi omnis libero quo! Perferendis animi mollitia cum culpa vero, aperiam impedit veniam quibusdam dolor! Exercitationem. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta quos nisi alias sunt, hic cum quas ipsum ullam tempore nemo repellat nam officiis dolore aperiam, earum voluptatibus. Pariatur, corrupti quaerat? Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia quod quo consequuntur. Placeat odit doloribus asperiores tempora! Iure consequuntur laboriosam repellendus ullam commodi, esse, itaque suscipit laborum illo, voluptas voluptatem.</p> 
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum dolore temporibus sit recusandae ratione provident natus totam quaerat eaque. Delectus impedit dignissimos minus ad officia cupiditate expedita sint quibusdam? Repellendus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus deserunt quas aut porro blanditiis neque deleniti distinctio qui, architecto odit totam accusamus nihil incidunt eligendi illo cum? Nobis, laborum modi.</p>   
    <a href="https://www.example.com">Example Link</a>
    <form method="post">
        <input type="text" name="name" placeholder="Username">
        <input type="number" name="age" placeholder="Age">
        <button type="submit">Submit</button>
    </form>
    <p>
        <?php echo "Text: " . $message; ?>
    </p>
    <p>
        <?php echo "Age: " . $age; ?>
    </p>
</body>
</html>