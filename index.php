<?php
$people = [
    [
        "name"=>"Mons Abu Nada",
        "role"=>"Developer",
        "image_url"=>"https://i.pravatar.cc/150?img=5",
        "skills"=>["Java","Python","Kotlin","PostgreSQL","SQL","Git","GitHub","Docker","RabbitMQ"]
    ],
    [
        "name"=>"Abdullah Abu Nada",
        "role"=>"Manager",
        "image_url"=>"https://i.pravatar.cc/150?img=12",
        "skills"=>["Animal Nutrition","Livestock Management","Veterinary Science","Project Management"]
    ],
    [
        "name"=>"Albatool Baraka",
        "role"=>"Designer",
        "image_url"=>"https://i.pravatar.cc/150?img=32",
        "skills"=>["Figma","UI Design","UX Design","Adobe XD","Photoshop"]
    ],
    [
        "name"=>"Sameera Sweidan",
        "role"=>"Analyst",
        "image_url"=>"https://i.pravatar.cc/150?img=25",
        "skills"=>["Business Analysis","Data Analysis","SQL","Power BI","Excel"]
    ],
    [
        "name"=>"Sama Al-Khaldi",
        "role"=>"Tester",
        "image_url"=>"https://i.pravatar.cc/150?img=47",
        "skills"=>["Manual Testing","Automation Testing","Selenium","JUnit","Bug Tracking"]
    ]
];

function getCardColor(string $role): string {
    return match($role){
        "Developer"=>"#7c4dff",
        "Designer"=>"#ff4081",
        "Manager"=>"#00bfa5",
        "Analyst"=>"#ff6d00",
        "Tester"=>"#2979ff",
        default=>"#757575",
    };
}

function renderCard(array $person): string {
    $skills = implode(", ", $person["skills"]);
    $color = getCardColor($person["role"]);
    return "
    <div class='card'>
        <div class='card-color-bar' style='background:$color'></div>
        <div class='card-body'>
            <img src='{$person["image_url"]}' alt='{$person["name"]}'>
            <h3>{$person["name"]}</h3>
            <div class='role' style='background:{$color}22;color:$color'>{$person["role"]}</div>
            <div class='skills'>$skills</div>
        </div>
    </div>";
}

$searchQuery = $_GET["search"] ?? "";
$filteredPeople = empty($searchQuery)
    ? $people
    : array_filter($people, fn($p)=>stripos($p["name"], $searchQuery)!==false);

$totalPeople = count($filteredPeople);
$currentDate = date("F j, Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Card Generator</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
<h1>Profile <span>Card Generator</span></h1>
<p>PHP Arrays, Functions & Loops</p>
</div>

<div class="container">
<div class="stats">
<div class="stat-box"><div class="number"><?= $totalPeople ?></div><div class="label">Total People</div></div>
<div class="stat-box"><div class="number"><?= $currentDate ?></div><div class="label">Current Date</div></div>
</div>

<form class="search-form" method="GET">
<input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($searchQuery) ?>">
<button type="submit">Search</button>
</form>

<div class="cards-grid">
<?php
if(empty($filteredPeople)){
    echo "<div class='no-results'>No people found.</div>";
}else{
    foreach($filteredPeople as $person){
        echo renderCard($person);
    }
}
?>
</div>
</div>
</body>
</html>
