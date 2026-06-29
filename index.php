<?php

$people = [

    [
        "name" => "Mons Abu Nada",
        "role" => "Software Engineer",
        "image" => "https://i.pravatar.cc/150?img=5",
        "skills" => ["Java", "Python", "SQL", "PostgreSQL", "Kotlin", "Git", "GitHub", "Docker", "RabbitMQ"]
    ],

    [
        "name" => "Abdullah Abu Nada",
        "role" => "Animal Engineer",
        "image" => "https://i.pravatar.cc/150?img=12",
        "skills" => ["Animal Nutrition", "Livestock Management", "Veterinary Science", "Animal Health", "Biology", "Field Research"]
    ]

];

function getColor($index) {
    $colors = ["#ff6b6b", "#4dd0e1", "#ba68c8", "#ffd54f", "#81c784"];
    return $colors[$index % count($colors)];
}

function countPeople($people) {
    return count($people);
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$filteredPeople = [];

foreach ($people as $person) {
    if (empty($search) || stripos($person['name'], $search) !== false) {
        $filteredPeople[] = $person;
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="UTF-8">
<title>Profile Card Generator</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: #0b0f1a;
    color: #eaeaea;
}

.header {
    text-align: center;
    padding: 25px;
    background: linear-gradient(135deg, #1a1f2e, #2a1b3d);
    border-bottom: 3px solid #ba68c8;
}

.container {
    padding: 20px;
}

.stats {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 25px;
}

.stat-box {
    background: rgba(255,255,255,0.05);
    padding: 15px;
    border-radius: 12px;
    text-align: center;
}

.number {
    font-size: 26px;
    color: #ba68c8;
}

.search-form {
    text-align: center;
    margin-bottom: 25px;
}

.search-form input {
    padding: 10px;
    border-radius: 25px;
    border: 1px solid #ba68c8;
    background: transparent;
    color: white;
}

.search-form button {
    padding: 10px 20px;
    border: none;
    background: #ba68c8;
    border-radius: 25px;
    cursor: pointer;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

.card {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    overflow: hidden;
}

.card-color-bar {
    height: 6px;
}

.card-body {
    text-align: center;
    padding: 15px;
}

.card-body img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

.role {
    margin: 10px 0;
    color: #ba68c8;
    font-weight: bold;
}

.skills span {
    display: inline-block;
    margin: 3px;
    padding: 4px 8px;
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
    font-size: 12px;
}
</style>

</head>

<body>

<div class="header">
    <h1>Profile Card Generator</h1>
    <p>Engineers Portfolio</p>
</div>

<div class="container">

    <div class="stats">
        <div class="stat-box">
            <div class="number"><?= countPeople($filteredPeople) ?></div>
            <div class="label">Total People</div>
        </div>

        <div class="stat-box">
            <div class="number"><?= date("Y-m-d") ?></div>
            <div class="label">Current Date</div>
        </div>
    </div>

    <form class="search-form" method="GET">
        <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>

    <div class="cards-grid">

        <?php if (empty($filteredPeople)): ?>

            <p style="text-align:center;">No results found</p>

        <?php else: ?>

            <?php $i = 0; foreach ($filteredPeople as $person): ?>

                <div class="card">

                    <div class="card-color-bar" style="background:<?= getColor($i) ?>"></div>

                    <div class="card-body">

                        <img src="<?= $person['image'] ?>">

                        <h3><?= $person['name'] ?></h3>

                        <div class="role"><?= $person['role'] ?></div>

                        <div class="skills">

                            <?php foreach ($person['skills'] as $skill): ?>
                                <span><?= $skill ?></span>
                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

                <?php $i++; ?>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>

</body>
</html>