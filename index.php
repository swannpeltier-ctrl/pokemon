<?php
$jsonString = file_get_contents('pokemon.json');

$data = json_decode($jsonString, false);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Erreur JSON : ' . json_last_error_msg());
}

$couleurs = [
    'Normal' => '#d4c9ae', 'Feu' => '#f5a46b', 'Eau' => '#7fb2ec',
    'Plante' => '#8fd17f', 'Électrik' => '#f7d85a', 'Glace' => '#a6e3e9',
    'Combat' => '#d9806f', 'Poison' => '#c283e0', 'Sol' => '#dcc088',
    'Vol' => '#b3c3f2', 'Psy' => '#f48fb1', 'Insecte' => '#c3d35a',
    'Roche' => '#c8b76f', 'Spectre' => '#9a86c4', 'Dragon' => '#8c7ae6',
    'Ténèbres' => '#8a7b73', 'Acier' => '#b8bfcb', 'Fée' => '#f4b6d2',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pokédex</title>
    <style>
        body { background: #e4e8ef; font-family: Arial, sans-serif; padding: 30px 0; }
        .grille { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; max-width: 740px; margin: 0 auto; }
        .carte { background: #e9e4d6; border: 3px solid #3b3f4a; border-radius: 18px; overflow: hidden; }
        .image { position: relative; height: 205px; display: flex; align-items: center; justify-content: center; }
        .image img { max-width: 85%; max-height: 85%; }
        .types { position: absolute; left: 10px; bottom: 8px; display: flex; gap: 5px; }
        .type { background: #2b2b2b; color: #d6c8a0; font-size: 12px; font-weight: bold; text-transform: uppercase; padding: 5px 9px; border-radius: 4px; }
        .infos { padding: 12px 18px 14px; }
        .nom { margin: 0 0 6px; font-size: 20px; color: #857b62; }
        .nom small { font-size: 12px; }
        .stat { display: flex; justify-content: space-between; font-size: 12px; }
        .stat span:first-child { font-weight: bold; }
    </style>
</head>
<body>

<div class="grille">
<?php foreach ($data as $pokemon) {
    if ($pokemon->types === null || $pokemon->stats === null) {
        continue;
    }
    $fond = $couleurs[$pokemon->types[0]->name] ?? '#d4c9ae';
?>
    <div class="carte">
        <div class="image" style="background: <?= $fond ?>;">
            <img src="<?= $pokemon->sprites->regular ?>" loading="lazy">
            <div class="types">
                <?php foreach ($pokemon->types as $type) { ?>
                    <span class="type"><?= $type->name ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="infos">
            <h2 class="nom"><small>#<?= $pokemon->pokedex_id ?></small> <?= $pokemon->name->fr ?></h2>
            <div class="stat"><span>Points de vie</span><span><?= $pokemon->stats->hp ?></span></div>
            <div class="stat"><span>Attaque</span><span><?= $pokemon->stats->atk ?></span></div>
            <div class="stat"><span>Défense</span><span><?= $pokemon->stats->def ?></span></div>
            <div class="stat"><span>Attaque spéciale</span><span><?= $pokemon->stats->spe_atk ?></span></div>
            <div class="stat"><span>Vitesse</span><span><?= $pokemon->stats->vit ?></span></div>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>